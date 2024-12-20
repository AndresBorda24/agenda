<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use App\Auth;
use App\Models\Pago;
use App\Models\Usuario;
use UltraMsg\WhatsAppApi;
use App\Models\PasswordReset;
use App\Controllers\Validation\SetCardValidation;
use Psr\Http\Message\ResponseInterface as Response;
use App\Controllers\Validation\CreateUserValidation;
use App\Controllers\Validation\UpdateUserValidation;
use App\Controllers\Validation\ResetPasswdValidation;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\Validation\Exceptions\FormValidationException;
use Slim\Routing\RouteContext;

use function App\responseJSON;

class UsuarioController
{
    public function __construct(
        private Usuario $usuario,
        private WhatsAppApi $wp
    ) {}

    public function registro(
        Request $request,
        Response $response,
        CreateUserValidation $validation,
        Auth $auth
    ): Response {
        try {
            $data = $request->getParsedBody();
            $validation->check($data);

            $id = $this->usuario->create($data);
            $auth->logIn($this->usuario->find($id));
            $context = RouteContext::fromRequest($request);

            return responseJSON($response, [
                "__id" => $id,
                "redirect" => $context->getRouteParser()->urlFor("planes")
            ]);
        } catch(\Exception|FormValidationException $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
                "fields" => $e instanceof FormValidationException
                    ? $e->getInvalidFields()
                    : []
            ], 422);
        }
    }

    public function update(
        Request $request,
        Response $response,
        UpdateUserValidation $validator
    ): Response {
        try {
            $data = $request->getParsedBody();
            $validator->checkUpdate($data, $this->usuario);

            return responseJSON($response, [
                "status" => true,
                "__ctrl" => $this
                    ->usuario
                    ->update($data, $validator->auth->user()->id())
            ]);
        } catch(FormValidationException|\Exception $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
                "fields" => $e instanceof FormValidationException
                    ? $e->getInvalidFields() : []
            ], 422);
        }
    }

    public function updatePass(
        Request $request,
        Response $response,
        UpdateUserValidation $validator
    ): Response {
        try {
            $data = $request->getParsedBody();
            $validator->checkPassword($data);

            return responseJSON($response, [
                "status" => true,
                "__ctrl" => $this
                    ->usuario
                    ->updatePassword($data, $validator->auth->user()->id())
            ]);
        } catch(FormValidationException|\Exception $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
                "fields" => $e instanceof FormValidationException
                    ? $e->getInvalidFields() : []
            ], 422);
        }
    }

    /**
     * Relaciona una tarjeta con un pago.
    */
    public function activateCard(
        Request $request,
        Response $response,
        Pago $pago,
        SetCardValidation $val,
        Auth $auth
    ): Response
    {
        try {
            $data = $request->getParsedBody();
            $val->check($data); // Se valida que este el serial y que sea unico

            $pagoId = $auth->user()?->getPago()?->id;
            if ($pagoId === null) throw new \Exception("Pago not found");

            $_ = $pago->setCard($pagoId, $data["serial"]);
            $val->tarjeta->setUsed($data["serial"]);

            return responseJSON($response, $_);
        } catch(\Exception|FormValidationException $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
                "fields" => $e instanceof FormValidationException
                    ? $e->getInvalidFields()
                    : []
            ], 422);
        }
    }

    /**
     * Restablecer contrasenia.
    */
    public function startResetPasswd(
        Request $request,
        Response $response,
        PasswordReset $passwd
    ): Response
    {
        try {
            $cc = @$request->getParsedBody()["doc"] ?? "";
            $user = $this->usuario->get($cc, "num_histo");

            if ($user === null) throw new FormValidationException([
                "documento" => ["Documento no registrado."]
            ]);

            $cod = $passwd->create($user->id);

            $this->wp->sendChatMessage($user->telefono,
                "Este es tu código para restablecer tu contraseña:"
                . "\n\n*$cod*\n\n"
                . "Recuerda que el código expira pronto..."
            , 2);

            return responseJSON($response, [
                "doc" => $user->documento,
                "tel" => sprintf("%s******%s",
                    substr($user->telefono, 0, 3),
                    substr($user->telefono, -1)
                )
            ]);
        } catch(\Exception|FormValidationException $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
                "fields" => $e instanceof FormValidationException
                    ? $e->getInvalidFields()
                    : []
            ], 422);
        }
    }

    /**
     * Actualiza la contrasenia en caso de olvido.
    */
    public function resetPasswd(
        Request $request,
        Response $response,
        PasswordReset $passwd,
        ResetPasswdValidation $validation
    ): Response
    {
        try {
            $data = $request->getParsedBody();
            $user = $this->usuario->get(@$data["doc"] ?? "", "num_histo");

            if ($user === null) throw new \Exception("User not found");
            $validation->check($data, $user->id);

            $passwd->setUsed($user->id, $data["cod"]);

            return responseJSON($response, $this
                ->usuario
                ->updatePassword([
                    "new_password" => $data["password"]
                ], $user->id)
            );
        } catch(\Exception|FormValidationException $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
                "fields" => $e instanceof FormValidationException
                    ? $e->getInvalidFields()
                    : []
            ], 422);
        }
    }

    public function getBasic(Response $response, Auth $auth): Response
    {
        try {
            $_ = $auth->user();
            return responseJSON($response, $this->usuario->basic($_->id()));
        } catch(\Exception|FormValidationException $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
                "fields" => $e instanceof FormValidationException
                    ? $e->getInvalidFields()
                    : []
            ], 422);
        }
    }
}

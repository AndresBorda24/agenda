<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use App\Auth;
use App\Models\Usuario;
use App\Controllers\Validation\CreateUserValidation;
use App\Controllers\Validation\UpdateUserValidation;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\Validation\Exceptions\FormValidationException;
use App\Controllers\Validation\SetCardValidation;
use App\Models\Pago;
use App\Models\PasswordReset;

use function App\responseJSON;

class UsuarioController
{
    public function __construct(private Usuario $usuario) {}

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

            return responseJSON($response, [
                "__id" => $id,
                "redirect" => "/planes"
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

            if ($user === null) throw new \Exception("User not found");

            $passwd->create($user->id);
            // Aqui se enviaria el mensaje al wp
            // implementar

            return responseJSON($response, [
                "doc" => $user->documento,
                "tel" => sprintf("%s******%s",
                    substr($user->telefono, 0, 3),
                    substr($user->telefono, -1)
                )
            ]);
        } catch(\Exception $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage()
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

<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use App\Models\Pago;
use App\Models\CodigoRegalo;
use App\Contracts\UserInterface;
use App\DataObjects\CreatePagoInfo;
use App\DataObjects\UpdatePagoInfo;
use Psr\Http\Message\ResponseInterface as Response;
use App\Controllers\Validation\Exceptions\FormValidationException;

use function App\responseJSON;

class RegaloController
{
    public function __construct(
        private CodigoRegalo $cr,
        private Pago $pago
    ) {}

    public function __invoke(
        Response $response,
        UserInterface $user,
        string $code
    ): Response {
        try {
            $c = $this->cr->find($code, "code");

            if ($c === null || $c->used) {
                throw new FormValidationException([
                    "gift-code" => ["Codigo de Regalo no Valido."]
                ]);
            }

            $error = null;
            $this->cr->db->action(function() use(&$error, $user, $c) {
                try {
                    $pagoId = $this->pago->create(new CreatePagoInfo(
                        (int) $user->id(),
                        $c->plan_id,
                        false,
                        \App\Enums\MpStatus::APROVADO->value,
                        0
                    ));

                    $this->pago->updateInfo(
                        id: $pagoId,
                        data: new UpdatePagoInfo(
                            "GIFT-$pagoId",
                            date("Y-m-d"),
                            \App\Enums\MpStatus::APROVADO->value,
                            "REGALO",
                            "TARJETA-REGALO"
                        )
                    );

                    $this->cr->setUsed($c->code);
                } catch(\Exception $e) {
                    $error = $e;
                    return false;
                }
            });

            if ($error !== null) throw $error;

            return responseJSON($response, true);
        } catch(\Exception $e) {
            return responseJSON($response, [
                "error"  => $e->getMessage(),
                "fields" => $e instanceof FormValidationException
                    ? $e->getInvalidFields()
                    : []
            ], 422);
        }
    }
}

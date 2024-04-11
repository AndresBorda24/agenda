<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Pago;
use App\Enums\MpStatus;
use App\Contracts\UserInterface;
use App\DataObjects\CreatePagoInfo;
use App\DataObjects\UpdatePagoInfo;
use Psr\Http\Message\ResponseInterface as Response;

class GouMicrositioController
{
    /** Guardamos un pago como "pendiente" para tener un poco de control */
    public function __invoke(
        Response $response,
        UserInterface $user,
        Pago $pago
    ): Response {
        /**
         * De esta manera el usuario no crea más de un pago en caso de que
         * acceda nuevamente a la ruta
        */
        if ($user->pago?->status != MpStatus::PENDIENTE->value) {
            $pagoId = $pago->create(new CreatePagoInfo(
                envio: false,
                userId: (int) $user->id(),
                planId: 1,
                status: MpStatus::PENDIENTE->value,
                valorPagado: 0
            ));

            if (gettype($pagoId) === "boolean")
                throw new \RuntimeException("No se pudo crear la informacion del pago");

            $pago->updateInfo($pagoId, new UpdatePagoInfo(
                id: "GOW_PENDIENTE_" . date("H:i:s"),
                start: null,
                detail: "GOW_MICROSITIO",
                status: MpStatus::PENDIENTE->value,
                type: "Efectivo"
            ));
        }

        return $response
            ->withHeader(
                "Location",
                "https://micrositios.goupagos.com.co/clinica-asotrauma-ma"
            )->withStatus(302);
    }
}

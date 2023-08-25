<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Pago;
use App\Models\Plan;
use App\Models\Usuario;

/**
 * Registra el pago y, en caso que sea un pago exitoso, actualiza la info del
 * usuario.
*/
class PagoService
{
    public function __construct(
        private Plan $plan,
        private Pago $pago,
        private Usuario $usuario,
        private MercadoPagoService $mercadoPagoService
    ) {}

    /**
     * Realiza acciones necesarias despues de realizado el pago.
     *
     * @param array $data Deben ser los datos que retorna en el query string
     * mercado pago.
    */
    public function register(array $data): void
    {
        try {
            $pref = $this
                ->mercadoPagoService
                ->getPreference($data["preference_id"]);
            $status = \App\Enums\MpStatus::from($data["status"]);

            $metadata = (array) $pref->metadata;
            if ($status == \App\Enums\MpStatus::APROVADO) {
                $updateError = $this->updateUser($metadata);
            }

            $this->pago->store([
                "id" => $data["payment_id"],
                "usuario_id" => $metadata["user"],
                "error" => @$updateError
            ], $status);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Actualiza un usuario y relaciona el plan correspondiente.
     *
     * @param array $data Un array en el que se encuentran el id del plan y el
     * usuario, viene de la metadata de la preferencia.
     * @return null|array Retorna la info del error, si la hay.
    */
    private function updateUser(array $data): ?string
    {
        try {
            $plan = $this->plan->find($data["plan_id"]);
            $this->usuario->setPlan($data["user"], $plan);

            return null;
        } catch(\Exception $e) {
            return json_encode([
                "metadata" => $data,
                "info" => $e->getMessage(),
                "_" => $e->getTraceAsString()
            ]);
        }
    }
}

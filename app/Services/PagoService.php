<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Pago;
use App\Models\Plan;
use App\Models\Usuario;
use App\Enums\MpStatus;

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
            $status = MpStatus::from($data["status"]);

            $metadata = (array) $pref->metadata;
            $plan = $this->plan->find($metadata["plan_id"]);

            if ($status !== \App\Enums\MpStatus::NULO && $plan) {
                $pagoId = $this->pago->store([
                    "payment_id" => $data["payment_id"],
                    "usuario_id" => $metadata["user"],
                    "plan_id" => $plan->id,
                    "expires_at" => date("Y-m-d H:i:s", strtotime("+$plan->vigencia days"))
                ], $status);

                if (gettype($pagoId) === 'integer') $error =
                    $this->updateUser($metadata["user"], $pagoId);
            }

            // Por hacer:
            // 1. En la linea 49 se toma un $error. Hay que registrarlo en algún lado

        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Actualiza un usuario y relaciona el plan correspondiente.
     * @return null|array Retorna la info del error, si la hay.
    */
    private function updateUser(int $id, int $pagoId): ?string
    {
        try {
            $this->usuario->setPlan($id, $pagoId);

            return null;
        } catch(\Exception $e) {
            return json_encode([
                "metadata" => [ "user_id" => $id, "pago" => $pagoId ],
                "info" => $e->getMessage(),
                "_" => $e->getTraceAsString()
            ]);
        }
    }
}

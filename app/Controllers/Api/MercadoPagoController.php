<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use App\Models\Pago;
use App\Models\Plan;
use App\Contracts\UserInterface;
use App\DataObjects\CreatePagoInfo;
use App\Services\MercadoPagoService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use function App\responseJSON;

class MercadoPagoController
{
    public function __construct(
        public readonly Plan $plan,
        public readonly Pago $pago,
        public readonly MercadoPagoService $mercadoPagoService
    ) {}

    /**
     * Antes de continuar con el pago se debe crear una "Preferencia".
    */
    public function createPreference(
        Request $request,
        Response $response,
        int $planId,
        UserInterface $user
    ): Response {
        try {
            $tarjeta = (bool) @$request->getParsedBody()["tarjeta"];
            $plan = $this->plan->find($planId);
            $pago = $this->pago->create(new CreatePagoInfo(
                envio: $tarjeta,
                planId: $plan->id,
                userId: $user->id(),
                status: PAGO::ASO_PENDIENTE
            ));

            $prefId = $this->mercadoPagoService->genPreference($plan, $pago);
            if (!$prefId) throw new \Exception("Couldn generate preference");

            $this->pago->setPrefId($pago, $prefId);

            return responseJSON($response, [
                "id" => $prefId,
                "pago" => $pago
            ]);
        } catch(\Exception $e) {
            $data = [ "error" => $e->getMessage() ];
            return responseJSON($response, $data, 500);
        }
    }

    public function getPayment(Response $response, string $id): Response
    {
        $pago = $this->mercadoPagoService->getPayment($id);
        return responseJSON($response,  $pago?->toArray());
    }

    public function getMerch(Response $response, string $id): Response
    {
        $m = \MercadoPago\MerchantOrder::find_by_id($id);
        return responseJSON($response, $m?->toArray());
    }

    public function getPref(Response $response, string $id): Response
    {
        $pre = \MercadoPago\Preference::find_by_id($id);
        return responseJSON($response, $pre?->toArray());
    }

}

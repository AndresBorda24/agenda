<?php
declare(strict_types=1);

namespace App\Services;

use App\Auth;
use App\Config;
use MercadoPago\SDK;
use MercadoPago\Payment;
use MercadoPago\Preference;
use App\DataObjects\PlanDTO;
use MercadoPago\MerchantOrder;
use App\Contracts\UserInterface;

class MercadoPagoService
{
    private ?UserInterface $user;

    public function __construct(
        public readonly Config $config,
        public readonly Auth $auth
    ) {
        SDK::setAccessToken($config->get("mp.token"));
        $this->user = $this->auth->user();
    }

    /**
     * Genera una nueva "preferencia".
     * @return string|null el id de la preferencia recien creada.
    */
    public function genPreference(PlanDTO $plan, int $pagoId): ?string
    {
        if (! $this->user) null;

        $preference = new Preference();
        $preference->items = [ $this->generateItem($plan) ];
        $preference->payer = $this->generatePayer();
        $preference->external_reference = $pagoId;

        if ($this->config->get("app.env") === "prod") {
            $preference->notification_url = sprintf(
                $this->config->get("app.url") . "api/pagos/%s/webhook",
                $pagoId
            );
        } else {
            $preference->notification_url = sprintf(
                "https://panelusuario.asotrauma.com.co/api/pagos/%s/webhook",
                $pagoId
            );
        }

        // Una vez que el pago se completa, independientemente de su estado,
        // mecado pago redirecciona al usuario a una de estas url
        $preference->back_urls = array(
            "success" => $this->config->get("app.url") . "planes/feedback",
            "failure" => $this->config->get("app.url") . "planes/feedback",
            "pending" => $this->config->get("app.url") . "planes/feedback"
        );

        $preference->save();
        return $preference->id;
    }

    /**
     * Genera un Item para la compra de mercado pago.
    */
    private function generateItem(PlanDTO $plan): \MercadoPago\Item
    {
        $item = new \MercadoPago\Item();
        $item->id          = $plan->id;
        $item->title       = 'Plan - ' . $plan->nombre;
        $item->quantity    = 1;
        $item->unit_price  = $plan->valor;
        $item->currency_id = "COP";
        $item->description =
            "Beneficios: \n"
            . " - "
            . preg_replace("/;/", "\n -", $plan->beneficios);

        return $item;
    }

    /**
     * Genera un Payer. En si, es la informacion del usuario que compra el
     * plan.
    */
    private function generatePayer(): \MercadoPago\Payer
    {
        $payer = new \MercadoPago\Payer();
        $payer->email   = $this->user->info->email;
        $payer->name    = $this->user->info->nom1;
        $payer->surname = $this->user->info->ape1;
        $payer->identification  = [
            "type" => "CC",
            "number" => $this->user->info->documento
        ];
        $payer->phone           = [
            "area_code" => "57",
            "number" => $this->user->info->telefono
        ];

        return $payer;
    }

    /**
     * Busca la informacion de una referencia basado en el extarnal id
    */
    public function findByExternalId($id)
    {
        return Preference::search([
            "external_reference" => $id,
            "limit" => 1
        ]);
    }

    /**
     * Busca la info de una preferencia.
    */
    public function getPreference(string $prefId)
    {
        return Preference::find_by_id($prefId);
    }

    /**
     * @param string $id El id lo obtenemos cuando se completa el pago,
     * independientemente del estado.
     *
     * @return object|null
    */
    public function getPayment(string $id)
    {
        return Payment::find_by_id($id);
    }

    public function getMerhant(string $id)
    {
        return MerchantOrder::find_by_id($id);
    }
}

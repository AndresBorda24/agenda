<?php
declare(strict_types=1);

namespace App\Services;

use App\Config;
use MercadoPago\SDK;
use MercadoPago\Preference;
use App\DataObjects\PlanDTO;

class MercadoPagoService
{
    public function __construct(
        public readonly Config $config
    ) {
        SDK::setAccessToken($config->get("mp.token"));
    }

    /**
     * Genera una nueva "preferencia".
     * @return mixed Retorna el id de la preferencia recien creada.
    */
    public function genPreference(PlanDTO $plan)
    {
        $preference = new Preference();

        $item = new \MercadoPago\Item();

        // $item->id = "plan-".time()."-".$plan->id;
        $item->title = 'Plan - ' . $plan->nombre;
        $item->quantity = 1;
        $item->unit_price = $plan->valor;
        $item->currency_id = "COP";

        $preference->items = array($item);

        $preference->back_urls = array(
            "success" => $this->config->get("app.url") . "planes/feedback",
            "failure" => $this->config->get("app.url") . "planes/feedback",
            "pending" => $this->config->get("app.url") . "planes/feedback"
        );
        $preference->auto_return = "approved";

        $preference->save();
        return $preference->id;
    }
}

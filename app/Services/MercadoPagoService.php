<?php
declare(strict_types=1);

namespace App\Services;

use App\Auth;
use App\Config;
use MercadoPago\SDK;
use App\Enums\MpStatus;
use MercadoPago\Payment;
use MercadoPago\Preference;
use App\DataObjects\PlanDTO;
use App\Contracts\UserInterface;
use MercadoPago\MerchantOrder;

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
    public function genPreference(PlanDTO $plan): ?string
    {
        if (! $this->user) null;

        $item = new \MercadoPago\Item();
        $item->id          = $plan->id;
        $item->title       = 'Plan - ' . $plan->nombre;
        $item->quantity    = 1;
        $item->unit_price  = $plan->valor;
        $item->currency_id = "COP";

        // Informacion del Payer
        $payer = new \MercadoPago\Payer();
        $payer->email      = $this->user->getData("email");
        $payer->name       = $this->user->getData("nom1");
        $payer->surname    = $this->user->getData("ape1");
        $payer->identification  = [
            "type" => "CC",
            "number" => $this->user->getData("num_histo")
        ];
        $payer->phone           = [
            "area_code" => "57",
            "number" => $this->user->getData("telefono")
        ];

        $preference = new Preference();
        $preference->items = array($item);
        // $preference->auto_return = "approved";
        $preference->notification_url = sprintf(
            "https://intranet.asotrauma.com.co/mpipn/%s/plan/%s",
            $this->user->id(),
            $plan->id
        );
        $preference->payer = $payer;

        // Aqui guardamos los id's que necesitamos, tambien se podria guardar
        // mas informacion.
        $preference->metadata = [
            "plan_id" => $plan->id,
            "user" => $this->user->id()
        ];

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
     * Busca la info de una preferencia.
    */
    public function getPreference(string $prefId)
    {
        return Preference::find_by_id($prefId);
    }

    /**
     * @param string $id El id lo obtenemos cuando se completa el pago,
     * independientemente del estado.
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

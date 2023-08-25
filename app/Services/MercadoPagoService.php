<?php
declare(strict_types=1);

namespace App\Services;

use App\Auth;
use App\Config;
use MercadoPago\SDK;
use MercadoPago\Preference;
use App\DataObjects\PlanDTO;
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
    public function genPreference(PlanDTO $plan): ?string
    {
        if (! $this->user) null;

        $item = new \MercadoPago\Item();
        $item->title = 'Plan - ' . $plan->nombre;
        $item->quantity = 1;
        $item->unit_price = $plan->valor;
        $item->currency_id = "COP";

        $preference = new Preference();
        $preference->items = array($item);
        $preference->auto_return = "approved";

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
}

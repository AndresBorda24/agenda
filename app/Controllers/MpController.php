<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Plan;
use App\Models\Usuario;
use App\Views;
use App\Services\MercadoPagoService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class MpController
{
    function __construct(
        private Views $view,
        private Plan $plan,
        private Usuario $usuario
    ){}

    /**
     * Una vez termina el proceso de compra, independientemente de su estado,
     * se redirecciona a una vista en la que se muestra la info
     * correspondiente.
    */
    public function finish(
        Request $request,
        Response $response,
        MercadoPagoService $mp
    ): Response {
        $data = $request->getQueryParams();
        $pref = $mp->getPreference($data["preference_id"]);

        if ($data["status"] === \App\Enums\MpStatus::APROVADO) {
            $plan = $this->plan->find($pref?->items[0]?->description ?? 0);
            $this->usuario->setPlan(1, $plan);
        }

        return $this
            ->view
            ->render($response, "planes/finished.php", $data);
    }
}

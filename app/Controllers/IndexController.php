<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Auth;
use App\Views;
use App\Enums\MpStatus;
use App\Services\MercadoPagoService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use stdClass;

class IndexController
{
    function __construct(
        private Views $view,
        private Auth $auth
    ){}

    public function home(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "home/index.php");
    }

    public function profile(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "profile/index.php");
    }

    public function agenda(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "agenda/index.php");
    }

    public function registro(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "registro/index.php");
    }

    public function login(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "login/index.php");
    }

    public function beneficiarios(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "beneficiarios/index.php");
    }

    public function planes(Response $response, MercadoPagoService $mps): Response
    {
        /** @var \App\Contracts\UserInterface */
        $user = $this->auth->user();
        $pago = null;

        if ($user->hasPago()) {
            $pago = match($user->pago->status) {
                /* Si es ASO_PENDIENTE, lo que buscamos es la referencia, no el pago */
                \App\Models\Pago::ASO_PENDIENTE => $mps->getPreference($user->pago->payment_id),
                \App\Models\Pago::ASO_NOMINA => null,
                default => $mps->getPayment($user->pago->payment_id)
            };
        }

        $this->view->addAttribute("user", $user);
        return $this
            ->view
            ->render($response, "planes/index.php", [
                "pref" => $pago
            ]);
    }

    public function planesResponse(Request $request, Response $response): Response
    {
        $data = $request->getQueryParams();
        $this->view->setLayout("planes-feedback/layout.php");
        @$data["status"] ??= '';
        $state = MpStatus::tryFrom(@$data["status"]);

        [$view, $title] = match($state) {
            MpStatus::APROVADO   => ["planes-feedback/ok.php", "Compra Aprobada"],
            MpStatus::AUTORIZADO => ["planes-feedback/ok.php", "Compra Autorazada"],

            MpStatus::PENDIENTE, MpStatus::EN_PROCESO => [
                "planes-feedback/pending.php",
                "Compra Pendiente"
            ],

            MpStatus::RECHAZADO, MpStatus::CANCELADO, MpStatus::REEMBOLSO,
            MpStatus::NULO, MpStatus::CHARGED_BACK => [
                "planes-feedback/no-ok.php",
                "Compra Rechazada"
            ],

            default => ["planes-feedback/no-ok.php", "Compra Rechazada~"]
        };

        return $this
            ->view
            ->render($response, $view, [
                "title" => $title,
                "state" => $state,
                ... $data
            ]);
    }
}

<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Auth;
use App\Contracts\UserInterface;
use App\Views;
use App\Models\Plan;
use App\Enums\MpStatus;
use App\Models\Beneficiario;
use Medoo\Medoo;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class IndexController
{
    function __construct(
        private Views $view,
        private Auth $auth
    ){
        $this->view->setLayout('layouts/base.php');
    }

    public function index(Response $response): Response
    {
        $this->view->setLayout('');
        return $this
            ->view
            ->render($response, "index/index.php");
    }

    public function home(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "home/index.php", [
                '_TITLE'  => 'Home',
                '_ASSETS' => 'home/index.js'
            ]);
    }

    public function profile(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "profile/index.php", [
                '_TITLE'  => 'Configuración de Perfil',
                '_ASSETS' => 'profile/index.js'
            ]);
    }

    public function agenda(Response $response, Medoo $db, UserInterface $user): Response
    {
        $beneficiarios = (new Beneficiario($db))->all( $user->id() );

        return $this
            ->view
            ->render($response, "agenda/index.php", [
                "beneficiarios" => $beneficiarios,
                '_TITLE'  => 'Solicitud de Citas',
                '_ASSETS' => 'agenda/index.js',
                '_MODALS' => [
                    $this->view->fetch("./agenda/show-day-hours.php")
                ]
            ]);
    }

    public function citas(
        Response $response,
        Beneficiario $beneficiario,
        UserInterface $user
    ): Response {
        $beneficiarios = $beneficiario->all( $user->id() );
        return $this
            ->view
            ->render($response, "mis-citas/index.php", [
                "beneficiarios" => $beneficiarios,
                '_TITLE'  => 'Mis Citas',
                '_ASSETS' => 'mis-citas/index.js',
                '_MODALS' => [
                    $this->view->fetch("./mis-citas/partials/modal-cancelar.php")
                ]
            ]);
    }

    public function registro(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "registro/index.php", [
                '_TITLE'  => 'Registro Usuarios Fidelizados',
                '_ASSETS' => 'registro/index.js',
                '_WITH_ASIDE' => false
            ]);
    }

    public function login(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "login/index.php", [
                '_TITLE'  => 'Inicio de Sesión',
                '_ASSETS' => 'login/index.js',
                '_WITH_ASIDE' => false
            ]);
    }

    public function resetPasswd(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "forgot/index.php", [
                '_TITLE'  => 'Restablecer Contraseña',
                '_ASSETS' => 'forgot/index.js',
                '_WITH_ASIDE' => false
            ]);
    }

    public function beneficiarios(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "beneficiarios/index.php", [
                '_TITLE'  => 'Gestión de Beneficiarios',
                '_ASSETS' => 'beneficiarios/index.js'
            ]);
    }

    public function activarTarjeta(Response $response): Response
    {
        return $this
            ->view
            ->render($response, "activar-tarjeta/index.php", [
                '_TITLE'  => 'Activar Tarjeta',
                '_ASSETS' => 'activar-tarjeta/index.js'
            ]);
    }

    public function planes( Response $response, Plan $plan): Response
    {
        /** @var \App\Contracts\UserInterface */
        $user = $this->auth->user();
        $this->view->addAttribute("user", $user);
        return $this
            ->view
            ->render($response, "planes/index.php", [
                "planes" => $plan->getAll($user->isFromIntranet()),
                '_TITLE'  => 'Planes',
                '_ASSETS' => 'planes/index.js'
            ]);
    }

    public function planesRegalo(Response $response, UserInterface $user): Response
    {
        $this->view->addAttribute("user", $user);
        return $this
            ->view
            ->render($response, "planes/regalo/index.php", [
                '_TITLE'  => 'Redimir Código de Regalo',
                '_ASSETS' => 'planes/index.js'
            ]);
    }

    public function planesResponse(
        Request $request,
        Response $response,
        UserInterface $user
    ): Response
    {
        $data = $request->getQueryParams();
        $this->view->setLayout("planes-feedback/layout.php");
        @$data["status"] ??= $user->getPago()?->status;
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

        $this->view->setLayout('');
        return $this
            ->view
            ->render($response, $view, [
                "title" => $title,
                "state" => $state,
                ... $data
            ]);
    }
}

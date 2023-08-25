<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Views;
use App\Models\Plan;
use App\Models\Usuario;
use App\Services\PagoService;
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
        PagoService $pagoService
    ): Response {
        try {
            $data = $request->getQueryParams();
            $pagoService->register($data);

            return $this
                ->view
                ->render($response, "planes/finished.php", $data);
        } catch(\Exception) {
            $data = ["status" => "error"];
            return $this
                ->view
                ->render($response, "planes/finished.php", $data);
        }
    }
}

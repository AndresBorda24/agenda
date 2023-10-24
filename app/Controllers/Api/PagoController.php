<?php
declare(strict_types=1);

namespace App\Controllers\Api;

use Slim\App;
use App\Services\UpdatePagoService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use function App\responseJSON;

class PagoController
{
    public function __construct(
        public readonly App $app,
        public readonly UpdatePagoService $updatePagoService
    ) {}

    public function webhook(
        Request $request,
        Response $response,
        int $pagoId
    ): Response {
        try {
            $data = $request->getParsedBody();
            $mpPayId = $data["data"]["id"];

            if (! $mpPayId) {
                throw new \Exception("Mp Payment Id Missing");
            }

            return responseJSON(
                $response,
                $this->updatePagoService->update($pagoId, $mpPayId)
            );
        } catch(\Exception $e) {
            return responseJSON($response, [
                "info" => $e->getMessage()
            ], 422);
        }
    }

    public function development(Request $request, Response $response): Response
    {
        try {
            $data = $request->getQueryParams();
            $pagoId = $data["external_reference"];
            $mpPayId = $data["payment_id"];

            if (
                ($mpPayId != "null" && $pagoId != "null")
                && ($mpPayId && $pagoId)
            ) {
                $this
                    ->updatePagoService
                    ->update((int) $pagoId, $mpPayId);
            }

            $parser = $this->app
                ->getRouteCollector()
                ->getRouteParser();

            return $response
                ->withHeader(
                    "location",
                    $parser->urlFor("planes.feedback", [], $data)
                ) ->withStatus(302);
        } catch(\Exception $e) {
            return responseJSON($response, [
                "info" => $e->getMessage()
            ], 422);
        }
    }

    public function remove(Response $response, int $id): Response
    {
        try {
           return responseJSON($response, $this
                ->updatePagoService
                ->pago
                ->remove($id));
       } catch (\Exception $e) {
            return responseJSON($response, [
                "message" => $e->getMessage()
           ], 422);
       }
    }

    public function nomina(Response $response, int $id): Response
    {
        try {
           return responseJSON($response, $this
                ->updatePagoService
                ->pago
                ->nomina($id));
        } catch (\Exception $e) {
            return responseJSON($response, [
                "message" => $e->getMessage()
           ], 422);
        }
    }
}

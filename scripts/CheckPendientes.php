<?php
declare(strict_types=1);

use App\DataObjects\GatewayReturnData;
use App\Models\Order;
use App\Services\GetOrderHandlerService;
use App\Services\MessageService;

require __DIR__ . "/../vendor/autoload.php";

/* Desactivamos el límite de tiempo, solo por si acaso */
set_time_limit(0);

/* Fecha - Hora | Colombia */
date_default_timezone_set('America/Bogota');

// Se carga la configuracion del .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

$c = new \DI\Container(require __DIR__ . "/../config/ContainerBindings.php");
$app = \DI\Bridge\Slim\Bridge::create($c);

$orderModel = $c->get(Order::class);
$messageService = $c->get(MessageService::class);
$orderHandlerService = $c->get(GetOrderHandlerService::class);

$orders = $orderModel->getPendientes();
foreach ($orders as $order) {
    try {
        $handler = $orderHandlerService->get($order);
        [$order] = $handler->fromReturn(new GatewayReturnData($order->id));
        echo "Estado de Orden Actualizado: {$order->status->name} \n";
    } catch (\Exception $e) {
        $messageService->sendMessage(
            '3209353216',
            'Error en check pendientes: ' . $e->getMessage()
        );
    }
}

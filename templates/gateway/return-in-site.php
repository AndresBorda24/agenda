<?php

use App\Enums\MpStatus;
use App\DataObjects\PlanDTO;

/** @var \App\DataObjects\OrderInfo $order */
/** @var \App\Contracts\PaymentInfoInterface $payment */

$plan = PlanDTO::fromArray(json_decode($order->data, true));
$background = match ($payment->getState()) {
  MpStatus::APROVADO => 'approved',
  MpStatus::RECHAZADO => 'rejected',
  MpStatus::PENDIENTE => 'pending',
  default => ''
};
$cardImage = match (mb_strtolower($plan->nombre)) {
  'amarillo'    => 'amarillo.webp',
  'colaborador' => 'colaborador.webp',
  'celeste',
  'platinum'    => 'celeste.webp',
  default       => 'amarillo.webp'
};
$formatNumber = fn(int|float $number) => number_format($number, 2, ',', '.');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("profile/app") ?>
  <title>Compra Finalizada</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Compra Finalizada"
  ]) ?>

  <div class="d-flex p-1 main-container">
    <?= $this->fetch("./partials/aside.php") ?>
    <main class="flex-grow-1">
      <div class="gateway-background <?= $background ?>"></div>

      <div class="gateway-container">
        <div class="bg-body-tertiary rounded position-relative shadow-lg mb-5">
          <div class="position-absolute plan-img-container rounded shadow overflow-hidden">
            <img
              src="/img/cards/<?= $cardImage ?>"
              alt="Tarjeta plan <?= $cardImage ?>" />
          </div>
          <div class="gap-2 w-100 pt-5">
            <div class="gateway-info d-flex flex-column d-md-grid p-4">
              <div class="p-2 flex-grow-1">
                <span>Artículo:</span> <br />
                <span>Plan - <?= $plan->nombre ?></span>
              </div>
              <div class="d-flex p-2 row-cols-2">
                <div>
                  <span class="d-block">Valor:</span>
                  <span class="d-block">Descuento:</span>
                </div>
                <div class="text-end">
                  <div class="border-bottom pb-2">
                    <span class="d-block number-format"><?= $formatNumber($payment->getAmount()) ?> </span>
                    <span class="d-block number-format"><?= $formatNumber($payment->getDiscount()) ?> </span>
                  </div>
                  <span class="d-block number-format"><?= $formatNumber($payment->getAmount() - $payment->getDiscount()) ?> </span>
                </div>
              </div>
            </div>
            <div class="d-flex align-items-center px-4 bg-gateway <?= $background ?> rounded-bottom">
              <span class="fs-3 ps-2"><?= $this->fetch('./icons/finish.php') ?></span>
              <div class="flex flex-column">
                <div class="p-2 pb-0 fw-bold"><?= $payment->getState()->publicName() ?></div>
                <p class="mb-0 p-2 pt-0"><?= $payment->getMessage() ?></p>
              </div>
            </div>
          </div>
        </div>
        <a
          href="<?= $this->link('home') ?>"
          class="btn btn-success btn-sm">Ir a Home</a>
      </div>
    </main>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>

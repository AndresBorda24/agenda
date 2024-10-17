<?php

use App\Enums\MpStatus;
use App\DataObjects\PlanDTO;

/** @var \App\DataObjects\OrderInfo $order */
/** @var \App\Contracts\PaymentInfoInterface $payment */
/** @var \Exception|null $error */

$plan = $order ? PlanDTO::fromArray(json_decode($order->data, true)) : null;

$background = match ($payment?->getState()) {
  MpStatus::APROVADO => 'approved',
  MpStatus::PENDIENTE => 'pending',
  null, MpStatus::RECHAZADO => 'rejected',
  default => ''
};
$cardImage = match (mb_strtolower($plan?->nombre ?? '')) {
  'amarillo'    => 'amarillo.webp',
  'colaborador' => 'colaborador.webp',
  'celeste',
  'platinum'    => 'celeste.webp',
  default       => 'amarillo.webp'
};
$formatNumber = fn(int|float $number) => number_format($number, 2, ',', '.');
?>

<main class="flex-grow-1">
  <div class="gateway-background <?= $background ?>"></div>

  <div class="gateway-container">
    <div class="bg-body-tertiary rounded position-relative shadow-lg mb-5">
      <?php if(!$error): ?>
        <div class="position-absolute plan-img-container rounded shadow overflow-hidden">
          <img
            src="/img/cards/<?= $cardImage ?>"
            alt="Tarjeta plan <?= $cardImage ?>" />
        </div>
        <div class="gap-2 w-100 pt-5">
          <div class="gateway-info d-flex flex-column d-md-grid p-4">
            <div class="p-2 flex-grow-1">
              <span class="fw-bold d-block">Artículo:</span>
              <span class="d-block">Plan - <?= $plan->nombre ?></span>
              <span class="fw-bold">Fecha:</span>
              <span class="d-block"><?= $order->createdAt ?></span>
              <span class="fw-bold d-block">Ref:</span>
              <span><?= $order->id ?></span>
            </div>
            <div class="d-flex p-2 row-cols-2">
              <div>
                <span class="d-block fw-bold">Valor:</span>
                <span class="d-block fw-bold">Descuento:</span>
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
      <?php else: ?>
        <div class="position-absolute rounded overflow-hidden bottom-[90%] max-w-min left-0 right-0 mx-auto">
          <svg class="flex-shrink-0 inline w-16 h-14 text-red-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
          </svg>
        </div>
        <div class="p-6 rounded">
          <span class="block text-red-700 text-xl mb-6 mt-6 font-bold">Lo sentimos, ha ocurrido un error.</span>
          <p class="mb-7 text-sm text-neutral-700">
            No hemos logrado procesar el pago correctamente. Por favor comunicate al correo <a class="decoration-transparent font-bold" href="mailto:programadefidelizacon@asotrauma.com.co">programadefidelizacon@asotrauma.com.co</a> o a <a class="decoration-transparent font-bold" href="mailto:soporte@asotrauma.com.co">soporte@asotrauma.com.co</a>
          </p>
          <p>
            <span class="font-bold text-red-800">Mensaje de Error:</span> <br />
            <span class="text-sm text-neutral-700"><?= $error->getMessage() ?></span>
          </p>
        </div>
      <?php endif ?>
    </div>
    <a
      href="<?= $this->link('home') ?>"
      class="btn btn-success btn-sm">Ir a Home</a>
  </div>
</main>

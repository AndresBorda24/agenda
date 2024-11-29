<?php
/** @var \App\DataObjects\OrderInfo $order */
/** @var \App\Contracts\PaymentInfoInterface $payment */

$plan = $order
  ? \App\DataObjects\PlanDTO::fromArray(json_decode($order->data, true))
  : null;

$cardImage = match (mb_strtolower($plan?->nombre ?? '')) {
  'amarillo'    => 'amarillo.webp',
  'colaborador' => 'colaborador.webp',
  'celeste',
  'platinum'    => 'celeste.webp',
  default       => 'amarillo.webp'
};
?>


<div class="position-absolute plan-img-container rounded shadow overflow-hidden">
  <img
    src="/img/cards/<?= $cardImage ?>"
    alt="Tarjeta plan <?= $cardImage ?>"
  />
</div>
<div class="gap-2 w-100 pt-8">
  <div class="gateway-info d-flex flex-column d-md-grid p-4">
    <div class="p-2 flex-grow-1">
      <span class="fw-bold d-block">Artículo:</span>
      <span class="d-block">Plan - <?= $plan->nombre ?></span>
      <span class="fw-bold">Fecha:</span>
      <span class="d-block"><?= $order->createdAt ?></span>
      <span class="fw-bold d-block">Ref:</span>
      <span><?= $order->id ?></span>
    </div>
    <div class="grid grid-cols-2 p-2">
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
      <span class="font-bold block leading-none">Moneda:</span>
      <span class="text-right block leading-none">COP</span>
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

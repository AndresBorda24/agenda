<?php
/** @var \App\DataObjects\OrderInfo $order */
/** @var \App\Contracts\PaymentInfoInterface $payment */

$item = $order
  ? \App\DataObjects\OrderItem::fromArray(json_decode($order->data, true))
  : null;
?>
<?php if ($order->status === \App\Enums\MpStatus::RECHAZADO) : ?>
  <div class="absolute max-w-[90%] left-0 right-0 mx-auto !p-5 bg-red-50 rounded text-red-800 text-sm -top-14 !border border-red-200">
    Ha ocurrido un error en la transacción. Por favor intenta nuevamente más tarde.
  </div>
<?php endif ?>

<?php if ($order->status === \App\Enums\MpStatus::PENDIENTE) : ?>
  <div class="absolute max-w-[90%] left-0 right-0 mx-auto !p-5 bg-blue-50 rounded text-blue-800 text-sm -top-14 !border border-blue-200">
    Tu pago se está procesando. Te notificaremos cuando se complete la compra.
  </div>
<?php endif ?>

<?php if ($order->status === \App\Enums\MpStatus::APROVADO) : ?>
  <div class="absolute max-w-[90%] left-0 right-0 mx-auto !p-5 bg-green-50 rounded text-green-800 text-sm -top-14 !border border-green-200">
    Hemos registrado tu pago. En unos minutos recibirás tu <b><?=$item?->name?></b>. Muchas Gracias por tu compra.
  </div>
<?php endif ?>

<div class="gap-2 w-100 !pt-6">
  <div class="gateway-info d-flex flex-column d-md-grid p-4">
    <div class="p-2 flex-grow-1">
      <span class="fw-bold d-block">Artículo:</span>
      <span class="d-block"><?=$item->name?></span>
      <span class="fw-bold">Fecha:</span>
      <span class="d-block"><?=$order->createdAt?></span>
      <span class="fw-bold d-block">Ref:</span>
      <span><?=$order->id?></span>
    </div>
    <div class="grid grid-cols-2 p-2">
      <div>
        <span class="d-block fw-bold">Valor:</span>
        <span class="d-block fw-bold">Descuento:</span>
      </div>
      <div class="text-end">
        <div class="border-bottom pb-2">
          <span class="d-block number-format"><?=$formatNumber($payment->getAmount())?> </span>
          <span class="d-block number-format"><?=$formatNumber($payment->getDiscount())?> </span>
        </div>
        <span class="d-block number-format"><?=$formatNumber($payment->getAmount() - $payment->getDiscount())?> </span>
      </div>
      <span class="font-bold block leading-none">Moneda:</span>
      <span class="text-right block leading-none">COP</span>
    </div>
  </div>
  <div class="d-flex align-items-center px-4 bg-gateway <?=$background?> rounded-bottom">
    <span class="fs-3 ps-2"><?=$this->fetch('./icons/finish.php')?></span>
    <div class="flex flex-column">
      <div class="p-2 pb-0 fw-bold"><?=$payment->getState()->publicName()?></div>
      <p class="mb-0 p-2 pt-0"><?=$payment->getMessage()?></p>
    </div>
  </div>
</div>

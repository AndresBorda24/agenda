<?php
use App\Enums\MpStatus;
use App\Enums\OrderType;

/** @var \App\DataObjects\OrderInfo $order */
/** @var \App\Contracts\PaymentInfoInterface $payment */
/** @var \Exception|null $error */

$background = match ($payment?->getState()) {
    MpStatus::APROVADO => 'approved',
    MpStatus::PENDIENTE => 'pending',
    null, MpStatus::RECHAZADO => 'rejected',
    default => ''
};
$formatNumber = fn (int | float $number) => number_format($number, 2, ',', '.');
?>

<main class="flex-grow-1 !p-4">
  <div class="gateway-background <?=$background?>"></div>

  <div class="gateway-container">
    <div class="bg-body-tertiary rounded position-relative shadow-lg mb-5">
      <?php if (!$error): ?>
        <?=match ($order->type) {
            OrderType::FIDELIZACION => $this->fetch('gateway/order-types/fidelizacion.php', [
                'order' => $order,
                'payment' => $payment,
                'formatNumber' => $formatNumber,
                'background' => $background,
            ]),
            OrderType::CRT_ATENCION => $this->fetch('gateway/order-types/general.php', [
                'order' => $order,
                'payment' => $payment,
                'formatNumber' => $formatNumber,
                'background' => $background,
            ]),
            default => ''
        }?>
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
            <span class="text-sm text-neutral-700"><?=$error->getMessage()?></span>
          </p>
        </div>
      <?php endif?>
    </div>
    <a
      href="<?=$this->link('home')?>"
      class="btn btn-success btn-sm">Ir a Home</a>
  </div>
</main>

<div class="mb-5">
  <p class="text-danger fs-1 text-center">
    <?= $state->publicName() ?>
  </p>
  <img
  alt="Compra Rechazada"
  class="mx-auto d-block"
  src="<?= $this->asset("img/rejected.svg") ?>"
  style="height: 250px;">
</div>

<div class="border-bottom border-danger mb-5"></div>

<p class="small text-center mb-5">
  Lo sentimos, no hemos logrado confirmar tu compra...
</p>

<div class="border-bottom border-danger-subtle mb-5"></div>

<a
style="max-width: 200px;"
class="d-block shadow mx-auto text-bg-danger badge rounded p-2 text-decoration-none"
href="<?= $this->link("planes") ?> ">
  Intenta Nuevamente
</a>

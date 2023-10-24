<div class="mb-5">
  <p class="fs-1 text-dark text-center">
    <?= $state->publicName() ?>...
  </p>
  <img
  class="mx-auto d-block"
  src="<?= $this->asset("img/pending.svg") ?>"
  style="width: 250px;">
</div>

<div class="border-bottom border-dark mb-5"></div>

<p class="small text-center mb-5">
  Estamos esperando a que se confirme el pago~
</p>

<div class="border-bottom border-secondary-subtle mb-5"></div>
<a
style="max-width: 200px;"
class="d-block shadow mx-auto text-bg-secondary badge rounded p-2 text-decoration-none"
href="<?= $this->link("planes") ?> ">
  Ir a Home
</a>

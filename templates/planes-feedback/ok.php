<div class="mb-5">
  <p class="fs-1 text-primary text-center">
    <?= $state->publicName() ?>!
  </p>
  <img
  class="mx-auto d-block"
  src="<?= $this->asset("img/approved.svg") ?>"
  style="height: 250px;">
</div>

<div class="border-bottom border-primary mb-5 "></div>

<?php if($state == \App\Enums\MpStatus::APROVADO): ?>
  <h3 class="text-center text-primary">Informaci&oacute;n sobre tu plan:</h3>
  <div
  class="m-auto p-4 d-md-flex align-items-center mb-5 gap-2">
    <p class="small">
      Si quieres ver informaci&oacute;n acerca de tu plan puedes hacerlo
      desde el men&uacute; en la opci&oacute;n:
      <span class="text-bg-light badge">Mi Perfil</span>
    </p>
    <img
    class="d-block m-auto rounded w-100"
    src="<?= $this->asset("img/verperfil.png") ?>"
    style="max-width: 350px;">
  </div>

  <p class="small mx-auto" style="max-width: 500px;">
    Aqu&iacute; podr&aacute;s ver los beneficios y exclusiones relacionados
    a tu plan, as&iacute; como la fecha de expiraci&oacute;n.
  </p>
  <img
  class="d-block m-auto rounded w-100"
  src="<?= $this->asset("img/planesinfo.png") ?>"
  style="max-width: 400px;">
  <span class="badge d-block small text-bg-light text-center mb-3">
    (Imagen ilustrativa)
  </span>


  <div class="border-bottom border-primary mb-5"></div>
  <h3 class="text-center text-primary mt-5">Tus beneficiarios:</h3>
  <div class="m-auto p-4 d-md-flex align-items-center mb-5 gap-2">
    <p class="small" style="order: 2">
      Nuevamente en el men&uacute;, podr&aacute;s dirigirte a la opcion de
      <span class="badge text-bg-light">Beneficiarios</span>.
    </p>
    <img
    class="d-block m-auto rounded w-100"
    src="<?= $this->asset("img/beneficiario.png") ?>"
    style="max-width: 350px; order: 1;">
  </div>

  <p class="small mx-auto" style="max-width: 300px;">
    Desde este panel podr&aacute;s agregar los beneficiarios que desees.
  </p>
  <img
  class="d-block m-auto rounded w-100"
  src="<?= $this->asset("img/beneficiario-list.png") ?>"
  style="max-width: 400px;">
  <span class="badge d-block small text-bg-light text-center">
    (Imagen ilustrativa)
  </span>

  <div class="border-bottom border-primary-subtle"></div>

  <span class="d-block py-5 text-center text-primary">
    <?= $this->fetch("./icons/arrow-down.php") ?>
  </span>
<?php elseif($state == \App\Enums\MpStatus::AUTORIZADO): ?>
  <p class="small text-center mb-5">
    Tu pago ha sido
    <span class="text-bg-warning badge">Autorizado</span>
    . Estamos esperando a que se
    <span class="text-decoration-underline">Acredite</span>.
  </p>

  <div class="border-bottom border-primary-subtle"></div>
<?php endif ?>

<div class="mt-5 d-flex flex-column flex-sm-row align-items-center justify-content-center
p-4 rounded-5 border border-5 border-info-subtle shadow-lg text-bg-primary">
  <p style="max-width: 200px;" class="text-center">
    <span class="badge text-bg-light">Much&iacute;simas Gracias</span>
    por adquirir el plan y apoyarnos.
  </p>
  <div>
    <img
    class="d-block rounded w-100"
    src="<?= $this->asset("img/dog-thanks.png") ?>"
    style="max-width: 200px;">
    <a
    target="_blank"
    style="font-size: 10px; color: #43aeaf;"
    class="small text-decoration-none d-inline-block text-center"
    href="https://www.flaticon.com/free-icons/thanks"
    title="thanks icons">
      Icon created by Iconriver - Flaticon
    </a>
  </div>
</div>




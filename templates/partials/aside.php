<?php /** @var \App\Views $this */ ?>
<aside
x-data="{ show: false }" @click.outside="show = false"
x-transition.opacity
x-show="show"
class="bg-secondary rounded shadow-lg aside d-md-flex">
  <template x-teleport="#header-nav">
    <!-- Boton de navegacion para telefonos -->
    <button
    class="d-md-none btn btn-outline-light lh-1 btn-small p-1 border-0"
    @click="show = true">
      <?= $this->fetch("./icons/menu.php") ?>
    </button>
  </template>

  <div class="d-flex flex-column gap-3 flex-grow-1">
    <div class="border-bottom border-warning-subtle pb-2">
      <a href="<?= $this->link("perfil") ?>" aside-link
      <?= $this->isRoute("perfil") ? 'class="fs-6 is-active"' : 'class="fs-6"' ?>>
        <div class="bg-warning rounded-circle radio-1 p-2"></div>
        <span>Mi perfil</span>
      </a>
    </div>

    <!-- Botones  -->
    <a href="<?= $this->link("home") ?>" aside-link
    <?= $this->isRoute("home") ? 'class="is-active"' : '' ?>>
      <?= $this->fetch("./icons/home.php") ?> Home
    </a>

    <?php if($this->user()->hasPago()): ?>
      <?php if($this->user()->isTitular() && $this->user()->pago->isValid()): ?>
        <?php if($this->user()->getPago()->tarjeta === null): ?>
          <a href="<?= $this->link("activar-tarjeta") ?>" aside-link
          <?= $this->isRoute("activar-tarjeta") ? 'class="is-active"' : '' ?>>
            <?= $this->fetch("./icons/card-check.php") ?> Activar mi Tarjeta
          </a>
        <?php else: // Si ya activo la tarjeta ?>
          <a
            href="#" aside-link
            class="border border-secondary-subtle pe-none gap-0 flex-column"
            style="border-style: dashed!important;">
            <span>
              <?= $this->fetch("./icons/card-check.php") ?> Tarjeta Activada!
            </span>
            <span class="small fst-italic badge fw-light">
              <?= $this->user()->getPago()->tarjeta ?>
            </span>
          </a>
        <?php endif ?>
      <?php endif ?>
    <?php endif ?>

    <a href="<?= $this->link("beneficiarios") ?>" aside-link
    <?= $this->isRoute("beneficiarios") ? 'class="is-active"' : '' ?>>
      <?= $this->fetch("./icons/users.php") ?> Beneficiarios
    </a>

    <a href="<?= $this->link("tramites") ?>" aside-link
    <?= $this->isRoute("tramites") ? 'class="is-active"' : '' ?>>
      <?= $this->fetch("./icons/users-rounded.php") ?> Trámites
    </a>

    <?php if(! $this->user()->pago?->isValid()): ?>
      <div class="border-top border-warning-subtle">
        <span class="d-block small text-warning p-2"> Planes </span>
        <?php if($this->user()->getOrder()?->status === \App\Enums\MpStatus::PENDIENTE): ?>
          <span
            style="font-size: 12px;"
            class="text-white-50 fw-lighter d-block px-2"
          >Tienes un pago pendiente, para revisar el estado da click en:</span>
          <a aside-link href="<?= $this->link("gateway.returnUrl", ['data' => base64_encode(
            json_encode([ 'ref' => $this->user()->getOrder()->id ])
          )]) ?>"
          <?= $this->isRoute("gateway.returnUrl") ? 'class="is-active"' : '' ?>>
            <?= $this->fetch("./icons/plans.php") ?> Revisar Pendiente
          </a>
        <?php else: ?>
          <div class="ps-4 d-flex flex-column gap-3">
            <a href="<?= $this->link("planes") ?>" aside-link
            <?= $this->isRoute("planes") ? 'class="is-active"' : '' ?>>
              <?= $this->fetch("./icons/plans.php") ?> Ver Planes
            </a>
            <a href="<?= $this->link("planes.regalo") ?>" aside-link
            <?= $this->isRoute("planes.regalo") ? 'class="is-active"' : '' ?>>
              <?= $this->fetch("./icons/plans.php") ?> Código de Regalo
            </a>
          </div>
        <?php endif ?>
      </div>
    <?php endif ?>

    <?php if(true): ?>
      <div class="border-top border-warning-subtle">
        <span class="d-block small text-warning p-2"> Citas </span>
        <div class="ps-4 d-flex flex-column gap-3">
          <a href="<?= $this->link("agenda") ?>" aside-link
          <?= $this->isRoute("agenda") ? 'class="is-active"' : '' ?>>
            <?= $this->fetch("./icons/agenda.php") ?> Solicita Tu Cita
          </a>

          <a href="<?= $this->link("mis-citas") ?>" aside-link
          <?= $this->isRoute("mis-citas") ? 'class="is-active"' : '' ?>>
            <?= $this->fetch("./icons/agenda.php") ?> Mis Citas
          </a>
        </div>
      </div>
    <?php endif ?>
  </div>

  <form action="<?= $this->link("logout") ?>" method="post" id="logout-form" class="sticky-bottom pb-3">
    <button type="submit" class="btn btn-danger border-0 btn-sm w-100">
      Cerrar Sesión!
    </button>
  </form>
</aside>

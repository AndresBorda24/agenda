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

  <div class="d-flex flex-column gap-2 flex-grow-1">
    <div class="border-bottom border-warning-subtle pb-2">
      <a href="<?= $this->link("perfil") ?>"
      <?= $this->isRoute("perfil") ? 'class="fs-6 is-active"' : 'class="fs-6"' ?>>
        <div class="bg-warning rounded-circle radio-1 p-2"></div>
        <span>Mi perfil</span>
      </a>
    </div>

    <!-- Botones  -->
    <a href="<?= $this->link("home") ?>"
    <?= $this->isRoute("home") ? 'class="is-active"' : '' ?>>
      <?= $this->fetch("./icons/home.php") ?> Home
    </a>

    <?php if($this->auth->user()->hasPlan(true)): ?>
      <?php if (false): ?>
        <a href="<?= $this->link("planes") ?>"
        <?= $this->isRoute("planes") ? 'class="is-active"' : '' ?>>
          <?= $this->fetch("./icons/card-check.php") ?> Activar mi Tarjeta
        </a>
      <?php endif ?>

      <?php if($this->auth->user()->isTitular()): ?>
        <a href="<?= $this->link("beneficiarios") ?>"
        <?= $this->isRoute("beneficiarios") ? 'class="is-active"' : '' ?>>
          <?= $this->fetch("./icons/users.php") ?> Beneficiarios
        </a>
      <?php endif ?>
    <?php else: ?>
      <a href="<?= $this->link("planes") ?>"
      <?= $this->isRoute("planes") ? 'class="is-active"' : '' ?>>
        <?= $this->fetch("./icons/plans.php") ?> Planes
      </a>
    <?php endif ?>

    <?php if(false): ?>
      <div class="border-top border-warning-subtle">
        <span class="d-block small text-warning p-2"> Citas </span>
        <div class="ps-4 d-flex flex-column gap-2">
          <a href="<?= $this->link("agenda") ?>"
          <?= $this->isRoute("agenda") ? 'class="is-active"' : '' ?>>
            <?= $this->fetch("./icons/agenda.php") ?> Agendamiento
          </a>
          <a href="<?= $this->link("agenda") ?>"
          <?= $this->isRoute("usuario.citas") ? 'class="is-active"' : '' ?>>
            <?= $this->fetch("./icons/agenda.php") ?> Mis citas
          </a>
        </div>
      </div>
    <?php endif ?>
  </div>

  <form action="/logout" method="post" id="logout-form" class="sticky-bottom pb-3">
    <button type="submit" class="btn btn-danger border-0 btn-sm w-100">
      Cerrar Sesión!
    </button>
  </form>
</aside>

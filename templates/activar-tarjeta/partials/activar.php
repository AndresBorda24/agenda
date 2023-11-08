<section
  class="p-2"
  x-data="ActivarTabs"
  @tarjeta-activada.stop="activateCard"
>
  <h1 class="fs-5 text-primary">Activaci&oacute;n Tarjeta Usuario Fidelizado.</h1>
  <template x-if="! isCardActive">
    <div class="p-3">
      <header class="d-flex align-items-center justify-content-center">
        <nav>
          <button
            @click="tab = 1"
            class="px-4 btn btn-sm btn-outline-success rounded-5"
            :class="{'active': tab == 1}"
          >QR</button>
          <button
            @click="tab = 2"
            class="px-4 btn btn-sm btn-outline-success rounded-5"
            :class="{'active': tab == 2}"
          >Serial</button>
        </nav>
      </header>

      <div class="p-3">
        <?= $this->fetch("./activar-tarjeta/partials/activar-qr.php") ?>
        <?= $this->fetch("./activar-tarjeta/partials/activar-serial.php") ?>
      </div>
    </div>
  </template>

  <template x-if="isCardActive">
    <div class="p-5">
      <div
        style="max-width: 270px;"
        class="mx-auto mb-3"
      >
        <img
          alt="Tarjeta Check"
          class="w-100 object-fit"
          src="<?= $this->asset("img/tarjeta-basic-check.svg") ?>"
        >
      </div>
      <p class="text-center">
        Activaste tu tarjeta con exito!
        <a href="<?= $this->link("home") ?>">Ir a Home</a>.
      </p>

      <p class="text-center">
        Puedes revisar el serial de tu tarjeta desde la opcion de
        <a href="<?= $this->link("perfil") ?>">Mi perfil</a>
      </p>
    </div>
  </template>
</section>

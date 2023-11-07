<section class="p-2" x-data="{ tab: 1 }">
  <h1 class="fs-5 text-primary">Activaci&oacute;n Tarjeta Usuario Fidelizado.</h1>
  <template x-if="true">
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

  <template x-if="false">
    <div class="p-5">
      <div
        style="max-width: 270px;"
        class="mx-auto mb-1 shadow"
      >
        <img
          alt="Tarjeta Check"
          class="w-100 object-fit"
          src="<?= $this->asset("img/tarjeta-basic-check.png") ?>"
        >
      </div>
      <p>
        Ya activaste tu tarjeta con exito!
      </p>
    </div>
  </template>
</section>

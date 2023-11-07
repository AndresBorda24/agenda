<section class="p-2" x-data="{ tab: 1 }">
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
      >C&oacute;digo</button>
    </nav>
  </header>

  <div class="p-3">
    <section x-show="tab == 1" x-transition.opacity>
      <div class="camara-div shadow mx-auto"></div>

      <div
        style="max-width: 270px;"
        class="mx-auto mb-3"
      >
        <img
          alt="Tarjeta"
          class="w-100 object-fit"
          src="<?= $this->asset("img/tarjeta-basic.png") ?>"
        >
      </div>
      <hr>
      <p>
        Recuerda enfocar muy bien el QR que se encuentra en la parte trasera de la tarjeta. El aplicativo registrar&aacute; <span class="fst-italic fw-bold">autom&aacute;ticamente</span> el QR.
      </p>
      <p>
        Si ocurre un problema, intenta
        <span role="button" @click="tab = 2" class="link text-decoration-underline text-primary">
          digitando manualmente el código
        </span>.
      </p>
    </section>

    <section x-show="tab == 2" x-transition.opacity>
      <div
        style="max-width: 270px;"
        class="mx-auto mb-1"
      >
        <img
          alt="Tarjeta Serial"
          class="w-100 object-fit"
          src="<?= $this->asset("img/tarjeta-basic-serial.png") ?>"
        >
      </div>
      <form @submit.prevent class="mb-3 ">
        <input
          type="text"
          required
          minlength="6"
          name="serial-tarjeta"
          style="max-width: 300px;"
          placeholder="Escribe aquí el coódigo de tu tarjeta"
          class="mx-auto d-block form-control form-control-sm mb-4 shadow"
        >
        <button
          type="submit"
          class="btn btn-warning btn-sm d-block mx-auto"
        >Activar</button>
      </form>
      <hr>
      <p>
        Escribe con cuidado el serial de tu tarjeta. Una vez lo tengas listo presiona en  <span class="fst-italic fw-bold">activar</span>.
      </p>
      <p>
        Si ocurre un problema, intenta
        <span role="button" @click="tab = 1" class="link text-decoration-underline text-primary">
          escaneando el QR
        </span>.
      </p>
    </section>
  </div>
</section>

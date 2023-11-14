    <section x-show="tab == 2" x-transition.opacity x-data="ActivarSerial">
      <template x-if="error">
        <span
          x-transition
          x-text="error"
          style="max-width: 300px; border-left: 5px solid;"
          class="d-block text-danger small bg-danger bg-opacity-10 border-dander mb-4 p-2 mx-auto shadow fw-semibold"
        ></span>
      </template>

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
      <form
        @submit.prevent="activar"
        class="mb-3"
      >
        <input
          type="text"
          required
          minlength="6"
          x-model="serial"
          name="serial-tarjeta"
          style="max-width: 300px;"
          placeholder="Escribe aquí el código de tu tarjeta"
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

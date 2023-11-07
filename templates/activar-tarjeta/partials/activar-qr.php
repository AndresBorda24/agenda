    <section
    x-show="tab == 1"
    x-data="ActivarQr"
    x-transition.opacity>
      <template x-if="error">
        <span
          x-transition
          x-text="error"
          style="max-width: 300px; border-left: 5px solid;"
          class="d-block text-danger small bg-danger bg-opacity-10 border-dander mb-4 p-2 mx-auto shadow fw-semibold"
        ></span>
      </template>


      <div class="camara-div d-block shadow mx-auto">
        <video
          id="qr-reader"
          class="object-fit w-100"
        ></video>
      </div>

      <div class="d-flex justify-content-between p-3">
        <button
          @click="startReader"
          class="btn btn-sm btn-outline-success"
        >Iniciar Cámara</button>
        <button
          @click="stopReader"
          class="btn btn-sm btn-outline-danger"
        >Detener</button>
      </div>

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

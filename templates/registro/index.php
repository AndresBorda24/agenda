<div
  class="grid grid-cols-1 lg:grid-cols-2 align-items-baseline my-8 max-w-xl lg:max-w-6xl mx-auto"
>
    <div class="p-3 p-md-5 lg:sticky top-10 z-0">
      <span class="p-2 text-center mt-2 text-muted small d-block">
        Trabajamos por tu bienestar y el bienestar de tu familia, por eso en
        la Cl&iacute;nica Asotrauma trabajamos para ti y para todos.
      </span>
      <div class="w-100 h-100 overflow-hidden rounded shadow registro-usuario-image">
        <img
        x-data="Img"
        x-bind="bindings"
        data-src="<?= $this->asset("img/Derecho-01.jpg") ?>"
        class="object-fit-cover w-100 h-100"
        alt="Cl&iacute;nica Asotrauma Imagen Registro">
      </div>
      <span class="small d-block text-center pt-2">
        ¿Ya tienes una cuenta? Inicia Sesi&oacute;n
        <a
        href="<?= $this->link("login") ?>"
        style="font-size: .75rem;"
        class="btn btn-warning btn-sm m-auto">
          Aqu&iacute;!
        </a>
      </span>
    </div>

    <main class="main-container p-2 p-md-3 p-lg-4">
      <?= $this->fetch("./registro/components/form.php") ?>
    </main>
  </div>

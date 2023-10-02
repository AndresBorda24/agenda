<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("login/app") ?>
  <title>Inicio de Sesi&oacute;n</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Inicio de Sesi&oacute;n"
  ]) ?>

  <div
  class="align-items-center container d-flex flex-wrap gap-5 justify-content-center my-5"
  style="min-height: 60vh;">
    <form
    x-data="form"
    autocomplete="off"
    @submit.prevent="login"
    style="max-width: 400px; min-width: 300px;"
    class="shadow border rounded overflow-hidden bg-body-tertiary">
      <span class="text-muted small d-block p-3 text-bg-primary text-center">
        En la <span class="text-bg-warning badge">Cl&iacute;nica Asotrauma</span>
        trabajamos para ti y para todos, por
        eso buscamos que tu paso por nuestra cl&iacute;nica sea agradable,
        siempre en pro de tu pronta recuperaci&oacute;n.
      </span>

      <div class="bg-white p-1">
        <img
        class="mx-auto d-block my-4"
        src="https://asotrauma.com.co/wp-content/uploads/2021/10/participacion.svg"
        alt="logo-asotrauma-color"
        width="130"
        height="130">
      </div>

      <div class="p-3 border-top">
        <label for="documento" class="form-label small">C&eacute;dula:</label>
        <input
        id="documento"
        x-model="state.documento"
        autofocus
        required
        minlength="4"
        placeholder="123456789"
        type="text"
        class="form-control form-control-sm w-100">
      </div>

      <div class="p-3 mb-3">
        <label for="clave" class="form-label small">Contrase&ntilde;a:</label>
        <input
        id="clave"
        x-model="state.clave"
        minlength="4"
        required
        placeholder="***********"
        type="password"
        class="form-control form-control-sm w-100">
      </div>

      <div class="bg-secondary p-4">
        <button class="btn btn-warning btn-sm d-block m-auto">
          Inicia Sesi&oacute;n
        </button>
      </div>

      <div class="bg-primary py-3 px-2 d-flex justify-content-between small">
        <button
        type="button"
        style="font-size: .75rem;"
        class="btn btn-outline-warning btn-sm d-block m-auto">
          Olvidaste la contrase&ntilde;a?
        </button>
        <a
        href="<?= $this->link("registro") ?>"
        style="font-size: .75rem;"
        class="btn btn-outline-light btn-sm d-block m-auto">
          Reg&iacute;strate
        </a>
      </div>
    </form>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>

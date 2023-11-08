<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("forgot/app") ?>
  <title>Restablecer Contrese&ntilde;a</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Restablecer Contrase&ntilde;a"
  ]) ?>

  <div class="d-flex p-1 main-container">
    <main class="flex-grow-1 mx-auto py-4"  style="max-width: 700px; min-height: 60vh;">
    <form
    x-data="PasswdReset"
    autocomplete="off"
    @submit.prevent="action"
    style="max-width: 400px; min-width: 280px;"
    class="shadow border rounded overflow-hidden bg-body-tertiary mx-auto">
      <span class="text-muted d-block p-3 text-bg-primary" style="font-size: .8em;">
        Se enviar&aacute; un mensaje con código al número de teléfono registrado con el documento de identidad.
      </span>

      <div class="bg-white p-1">
        <img
        class="mx-auto d-block my-4"
        src="<?= $this->asset("img/reset-passwd.svg")  ?>"
        alt="Reset Password Image"
        width="130"
        height="130">
      </div>

      <div class="p-3 border-top">
        <label for="documento" class="form-label small">C&eacute;dula:</label>
        <input
        id="documento"
        x-model="state.doc"
        autofocus
        required
        minlength="4"
        placeholder="123456789"
        type="text"
        class="form-control form-control-sm w-100 mb-2">

        <template x-if="state.tel">
          <div>
            <label for="codigo-super-secreto" class="form-label small">C&oacute;digo:</label>
            <input
            id="codigo-super-secreto"
            x-model="state.cod"
            autofocus
            required
            minlength="4"
            placeholder="Tu codigo secreto"
            type="text"
            class="form-control form-control-sm w-100 mb-2">

            <label for="password" class="form-label small">Nueva Contrase&ntilde;a:</label>
            <input
            id="password"
            x-model="state.password"
            autofocus
            required
            minlength="8"
            placeholder="123456789"
            type="password"
            class="form-control form-control-sm w-100 mb-2">

            <label
              for="confirm_password"
              class="form-label small"
            >Confirmar Contrase&ntilde;a:</label>
            <input
            id="confirm_password"
            x-model="state.confirm_password"
            autofocus
            required
            minlength="8"
            placeholder="123456789"
            type="password"
            class="form-control form-control-sm w-100 mb-3">
          </div>
        </template>
      </div>

      <div class="bg-secondary p-4">
        <button
          type="submit"
          class="btn btn-warning btn-sm d-block m-auto"
        > Continuar </button>
      </div>

      <div class="bg-primary py-3 px-2 d-flex justify-content-between small">
        <a
        href="<?= $this->link("login") ?>"
        style="font-size: .75rem;"
        class="btn btn-outline-warning btn-sm d-block m-auto">
          Inicia Sesi&oacute;n
        </a>
        <a
        href="<?= $this->link("registro") ?>"
        style="font-size: .75rem;"
        class="btn btn-outline-light btn-sm d-block m-auto">
          Reg&iacute;strate
        </a>
      </div>
    </form>
    </main>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>

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
      <section
        x-data="PasswdReset"
        style="max-width: 400px; min-width: 280px;"
        class="shadow border rounded overflow-hidden bg-body-tertiary mx-auto"
      >
        <header class="text-muted d-block p-3 text-bg-primary m-0" style="font-size: .8em;">
          <template x-if="! finished">
            <p class="m-0">
              <span class="d-block mb-2">
                Se enviar&aacute; un mensaje con código al número de teléfono registrado con el documento de identidad.
              </span>
              <span class="d-block fw-bold">
                El c&oacute;digo vence luego de 10 minutos.
              </span>
            </p>
          </template>

          <template x-if="finished">
            <p class="m-0 text-center fw-bold">
              El proceso ha finalizado. Ya puedes iniciar sesi&oacute;n con tu nueva contrase&ntilde;a!
            </p>
          </template>
        </header>

        <div class="bg-white p-1">
          <img
          class="mx-auto d-block my-2"
          src="<?= $this->asset("img/reset-passwd.svg")  ?>"
          alt="Reset Password Image"
          width="130"
          height="130">
        </div>

        <template x-if="! finished">
          <?= $this->fetch("./forgot/partials/form.php") ?>
        </template>

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
      </section>
    </main>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>

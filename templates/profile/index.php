<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("profile/app") ?>
  <title>Perfil</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Configuraci&oacute;n Perfil"
  ]) ?>

  <div class="d-flex p-3 main-container">
    <?= $this->fetch("./partials/aside.php") ?>
    <main class="flex-grow-1 p-3">
      <section class="mx-auto" style="max-width: 700px;">
        <section class="mb-5">
          <?= $this->fetch("./profile/partials/basic.php") ?>
        </section>

        <section>
          <h2 class="fs-6">Contrase&ntilde;a:</h2>
          <form class="p-3 bg-white shadow border rounded border-danger-subtle">
            <div class="small mb-2">
              <label
              class="form-label text-muted small m-0"
              for="_password">Contrase&ntilde;a Actual:</label>
              <input
              id="_password"
              autofocus
              required
              placeholder="Tu contrase&ntilde;a actual."
              type="password"
              minlength="6"
              class="form-control form-control-sm m-1">
            </div>

            <div class="row g-2 mb-3">
              <div class="small col-12 col-md-6">
                <label
                class="form-label text-muted small m-0"
                for="new-password">Nueva Contrase&ntilde;a:</label>
                <input
                id="new-password"
                autofocus
                required
                placeholder="Nueva Contrase&ntilde;a"
                type="password"
                minlength="6"
                class="form-control form-control-sm m-1">
              </div>
              <div class="small col-12 col-md-6">
                <label
                class="form-label text-muted small m-0"
                for="new-password-confirm">Confirma Contrase&ntilde;a:</label>
                <input
                id="new-password-confirm"
                autofocus
                required
                placeholder="Confirma"
                type="password"
                minlength="6"
                class="form-control form-control-sm m-1">
              </div>
            </div>

            <button class="ms-auto d-block btn btn-danger btn-sm">Actualizar Contrase&ntilde;a!</button>
          </form>
        </section>
      </section>
    </main>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>

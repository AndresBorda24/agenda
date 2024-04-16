<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("beneficiarios/app") ?>
  <title>Gesti&oacute;n Beneficiarios</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Mis Beneficiarios"
  ]) ?>

  <div class="d-flex p-1 main-container">
    <?= $this->fetch("./partials/aside.php") ?>
    <main class="flex-grow-1 p-3">
      <section class="mx-auto" style="max-width: 700px;">
        <h1  class="fs-5 text-primary">Listado de beneficiarios</h1>
        <div id="new-beneficiario-container" class="mb-4"> </div>

        <section class="d-flex align-items-center mb-4 gap-3 p-2 small border-start border-5 border-danger rounded-end shadow" style="background-color: #ffdede;">
          <?= $this->fetch("./icons/sign.php", [
            "props" => 'style="min-width: 55px; height:60px;"'
          ]) ?>
          <div>
            <p class="mb-1">
              Una vez agregado el beneficiario <b>no</b> se podrán modificar algunos campos ni tampoco se podrá eliminar del listado.</p>
            <p class="mb-0">
              Para realizar estos cambios debes realizar tu solicitud a <a href="mailto:programadefidelizacion@asotrauma.com.co" class="fw-bold text-decoration-none text-dark">programadefidelizacion@asotrauma.com.co</a>.
            </p>
          </div>
          <span>
          </span>
        </section>

        <?= $this->fetch("./beneficiarios/partials/list.php") ?>
      </section>
    </main>
  </div>


  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>

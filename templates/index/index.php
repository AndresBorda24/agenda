<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("index/app") ?>
  <title>Programa de Fidelización</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", ["title" => false ]) ?>

  <main style="min-height: 70vh;">
    <?= $this->fetch("./index/partials/hero.php") ?>
  <div style="height: 50px;">
    <img
      alt="svg-divisor"
      class="h-100 w-100"
      style="object-fit: fill;"
      src="<?= $this->asset("img/index/arrow.svg") ?>"
    >
  </div>

    <?= $this->fetch("./index/partials/section-beneficios.php") ?>
    <?= $this->fetch("./index/partials/section-capacidad.php") ?>
    <?= $this->fetch("./index/partials/section-adicionales.php") ?>
    <?= $this->fetch("./index/partials/section-videos.php") ?>
    <?= $this->fetch("./index/partials/section-donde.php") ?>
  </main>


  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("home/app") ?>
  <title>Home</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Home"
  ]) ?>

  <div class="d-flex p-1 main-container">
    <?= $this->fetch("./partials/aside.php") ?>

    <main class="flex-grow-1 mx-auto px-4 overflow-auto" style="max-width: 1000px;">
      <section class="pt-5">
        <span class="d-block text-primary fs-1 text-center">Programa de Fidelización</span>
        <div
          class="d-flex d-lg-grid p-4 flex-column gap-4 rounded justify-content-center mx-auto bg-blue-50 shadow-lg align-items-center"
          style="grid-template-columns: 1fr 1fr; max-width: 700px; justify-items: center"
        >
          <span style="font-size: 10rem" class="text-primary flex-1 lh-1"><?= $this->fetch('./icons/heart.php') ?></span>
          <p class="m-0" style="text-wrap: balance"> Es un programa pensado para un momento de la vida, en el que se quiera acceder a nuestros servicios directamente sin intermediarios, de manera oportuna y personalizada brindando una atención segura, efectiva y con calidad. </p>
        </div>
      </section>
      <div class="table-responsive">
        <?= $this->fetch('./index/partials/section-beneficios.php') ?>
      </div>

      <div
          class="d-flex p-2 p-md-4 p-lg-5 flex-column rounded-2 justify-content-center mx-auto align-items-center text-bg-dark shadow"
          style="margin-top: -8rem; width: fit-content;"
        >
          <div class="text-center">
            <span style="font-size: 4rem" class="flex-1 lh-1"><?= $this->fetch('./icons/news.php') ?></span>
            <span class="d-block fw-bold fs-3">Un poco de Información</span>
            <hr>
          </div>
          <?= $this->fetch("./partials/carrusel/index.php", [
            "img" => [
              $this->asset("img/home/Carrusel-Consulta-externa_01.png"),
              $this->asset("img/home/Carrusel-Consulta-externa_02.png"),
              $this->asset("img/home/Carrusel-Consulta-externa_03.png"),
              $this->asset("img/home/Carrusel-Consulta-externa_04.png"),
              $this->asset("img/home/Carrusel-Consulta-externa_05.png"),
            ]
          ]) ?>
        </div>
    </main>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>

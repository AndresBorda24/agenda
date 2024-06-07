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
          class="d-flex d-lg-grid p-4 flex-column gap-4 rounded justify-content-center mx-auto bg-blue-50 shadow-lg align-items-center border border-primary-subtle"
          style="grid-template-columns: 1fr 1fr; max-width: 700px; justify-items: center"
        >
          <span style="font-size: 10rem" class="text-primary flex-1 lh-1"><?= $this->fetch('./icons/heart.php') ?></span>
          <div>
            <p class="text-center text-dark-emphasis" style="text-wrap: balance">
              Es un programa pensado para un momento de la vida, en el que se quiera acceder a nuestros servicios directamente sin intermediarios, de manera oportuna y personalizada brindando una atención segura, efectiva y con calidad.
            </p>

            <?php if(! $this->user()->pago?->isValid()): ?>
              <a
                href="<?= $this->link('planes') ?>"
                class="d-block mx-auto btn btn-primary shadow-lg px-5"
              >Ver los Planes</a>
            <?php else: ?>
              <span class="d-block mx-auto shadow-lg text-center text-bg-primary p-1 rounded">
                Gracias por confiar en el <br>
                Programa de Fidelización ♥.
              </span>
            <?php endif ?>
          </div>
        </div>
      </section>
      <div class="table-responsive">
        <?= $this->fetch('./index/partials/section-beneficios.php') ?>
      </div>

      <div
        class="mx-auto text-bg-dark mb-4 p-4 text-center rounded shadow-lg"
        style="max-width: 400px; margin-top: -8rem;"
      >
        <span class="text-warning" style="font-size: 3rem;">
          <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M15 14h3V9h-5V4H6v16h9z" opacity="0.3"/><path fill="currentColor" d="M15 22H6c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h8l6 6v6h-2V9h-5V4H6v16h9zm4-.34v-2.24l2.95 2.95l1.41-1.41L20.41 18h2.24v-2H17v5.66z"/></svg>
        </span>
        <p class="small"><span class="text-warning fs-5">¿Quieres más Información?</span> <br> <br> Puedes ver el Folleto del <i class="fw-bold">Programa de Fidelización</i> dando click en el siguiente botón:</p>
        <a
          href="<?= $this->asset('Folleto programa de fidelización.pdf') ?>"
          class="d-block mx-auto btn btn-warning shadow-lg px-5"
          target="_blank"
        >
          Folleto programa de fidelización
        </a>
      </div>

      <hr>

      <div
          class="d-flex mb-4 p-2 p-md-4 p-lg-5 gap-2 flex-lg-row flex-column rounded-2 justify-content-center mx-auto align-items-center text-light bg-blue-900 shadow"
          style="width: fit-content;"
        >
          <div class="text-center">
            <span style="font-size: 4rem" class="flex-1 lh-1"><?= $this->fetch('./icons/news.php') ?></span>
            <span class="d-block fw-bold fs-3">Un poco de Información</span>
            <hr>
          </div>
          <?= $this->fetch("./partials/carrusel/index.php", [
            "img" => [
              $this->asset("img/home2/img1.webp"),
              $this->asset("img/home2/img2.webp"),
              $this->asset("img/home2/img3.webp"),
              $this->asset("img/home2/img4.webp"),
              $this->asset("img/home2/img5.webp"),
            ]
          ]) ?>
        </div>
    </main>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>

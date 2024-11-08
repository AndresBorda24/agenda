<?php /** @var Throwable $error */ ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssetsVite('beneficiarios/index.js') ?>
  <title>Ha ocurrido un Error</title>
</head>
  <div class="flex flex-col min-h-screen">
    <header class="bg-sky-900">
      <div class="container p-3 d-flex align-items-center justify-content-between">
        <a href="https://asotrauma.com.co/" target="_blank" class="d-block">
          <img
          class="h-[25px]"
          src="<?= $this->asset("img/logo-blanco-full.png") ?>"
          alt="logo-blanco">
        </a>
        <a
          class="px-3 py-1.5 rounded bg-transparent hover:bg-sky-700 duration-150 transition-colors text-white text-sm"
          href="<?= $this->link("home") ?>"
        >Ir a Home</a>
      </div>
    </header>

    <main class="min-h-[70vh] bg-gradient-to-b from-sky-900 to-neutral-100">
      <div class="max-w-4xl mx-auto">
        <div class="relative text-center pt-20 mb-4 flex flex-col items-center">
          <h1 class="text-[86px] md:text-[100px] lg:text-[120px] text-white font-bold text-center"> OOPS! </h1>
          <span class="px-4 py-2 bg-white text-sky-700 font-bold">Ha ocurrido un error.</span>
          <a
            class="px-3 py-1.5 rounded bg-transparent text-xl text-white underline mt-10"
            href="<?= $this->link("home") ?>"
          >Ir a Home</a>
        </div>

        <?php if($displayError): ?>
          <?php dump($error) ?>
        <?php endif ?>
      </div>
    </main>

    <div class="mt-auto">
      <?= $this->fetch("./partials/footer-white.php") ?>
    </div>
  </div>
</body>
</html>

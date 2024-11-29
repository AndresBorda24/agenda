<?php
$entries ??= [];
$tittle ??= "Asotrauma";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php foreach($entries as $entry) echo $this->loadAssets($entry) ?>
  <title><?= $title ?></title>
</head>
<body>
  <div class="d-flex main-container">
    <?= $this->fetch("./partials/aside-with-header.php") ?>
    <div class="flex-grow-1">
      <div class="bg-body-tertiary border-bottom flex align-items-center justify-content-between px-3 py-2 py-md-3 px-md-3 small sticky-top">
        <span style="font-size: 13px;"><?= $title ?></span>
        <div id="header-nav"></div>
      </div>
      <main class="pt-5 px-4 px-lg-5" style="padding-bottom: 7rem">
        <?= $content ?>
      </main>
    </div>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>

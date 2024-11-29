<?php
$_TITLE  ??= 'Clínica Asotrauma';
$_ASSETS ??= null;
$_MODALS ??= [];
$_WITH_ASIDE ??= true;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssetsVite($_ASSETS) ?>
  <title><?= $_TITLE ?></title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [ "title" => $_TITLE ]) ?>

  <div class="d-flex p-1 main-container">
    <?= $_WITH_ASIDE ? $this->fetch("./partials/aside.php") : '' ?>
    <?= $content ?>
  </div>

  <?php foreach($_MODALS as $modal) echo $modal; ?>
  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>

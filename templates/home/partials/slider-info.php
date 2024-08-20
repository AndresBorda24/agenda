<div class="d-flex mt-3 mt-md-5 gap-2 flex-xl-row flex-column justify-content-center mx-auto align-items-center">
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
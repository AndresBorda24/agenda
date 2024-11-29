<div class="flex gap-2 flex-col justify-content-center mx-auto align-items-center">
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

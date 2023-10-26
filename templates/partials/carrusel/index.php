<article
  x-data="ImgCarousel"
  data-images="<?= $img ? implode(";", $img) : '' ?>"
>
  <template x-if="areThereImages">
    <section>
      <div class="rounded overflow-hidden shadow">
        <div style="min-height: 150px; max-height: 400px; background-color: #fff;">
          <img
            x-transition
            @error="$el.setAttribute('src', '<?= $this->asset("img/logo-color.png")?>')"
            :alt="`carouse-image-${ current }`"
            class="w-100 h-100 object-fit-cover"
            :src="images[ current ]"
          >
        </div>
        <?= $this->fetch("./partials/carrusel/parts/loader.php") ?>
      </div>

      <?= $this->fetch("./partials/carrusel/parts/nav.php") ?>
    </section>
  </template>
</article>

<section
  x-data="Videos"
  class="index-section position-relative mb-5" style="color: #d3f3ff;"
>
  <div class="w-100" style="height: 70px; margin-bottom: -1px">
    <img
      alt="svg-divisor"
      class="h-100 w-100"
      style="object-fit: fill; transform: rotate(180deg);"
      src="<?= $this->asset("img/index/tilt-2.svg") ?>"
    >
  </div>

  <div class="bg-secondary py-5 px-3">
    <h4 class="text-center text-warning fs-3">Videos de Ayuda</h4>
    <hr class="border border-aso-yellow my-4">

    <div class="d-flex align-items-center justify-content-center gap-3 flex-wrap mb-4">
      <template x-for="video in idVideos" :key="video.id">
        <button
          x-text="video.name"
          @click="setVideo(video.id)"
          :class="{
            'btn btn-sm btn-outline-warning': true,
            'active': videoActive == video.id
          }"
        ></button>
      </template>
    </div>

    <div
      class="position-relative container"
      style="aspect-ratio: 16/9; max-width: 900px;"
    >
      <iframe id="iframe-videos" class="position-absolute top-0 start-0 w-100 h-100" width="560" height="315" src="https://www.youtube.com/embed/?enablejsapi=1" title="YouTube video player" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
    </div>
  </div>


  <div class="w-100" style="height: 60px;">
    <img
      alt="svg-divisor"
      class="h-100 w-100"
      style="object-fit: fill;"
      src="<?= $this->asset("img/index/waves.svg") ?>"
    >
  </div>
</section>

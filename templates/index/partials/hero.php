<section id="main-hero" class="d-flex">
  <div class="align-self-end p-2 rounded m-2 m-md-4" style="backdrop-filter: blur(20px);">
    <fieldset class="p-4 pb-5 border border-2 position-relative">
      <legend class="float-none w-auto px-2">Asotrauma</legend>
      <h1>Fidelización</h1>

      <p class="fw-light" style="text-wrap: balance;">
        Es un programa pensado para un momento de la vida, en el que se quiera acceder a nuestros servicios directamente sin intermediarios, de manera oportuna y personalizada brindando una atención segura, efectiva y con calidad.
      </p>

      <button
      x-data
      @click="document.getElementById('section-beneficios')?.scrollIntoView({ behavior: 'smooth'})"
      class="position-absolute btn d-block"
      > Me interesa! </button>
    </fieldset>
  </div>
</section>

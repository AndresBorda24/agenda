<div
  x-data="agendaFiles"
  class="mx-auto border-top p-3"
  style="max-width: 900px;"
>
  <p class="fw-bold mb-0">Por favor sube los siguientes archivos:</p>
  <p class="small">
    Los archivos deben pesar como máximo <span class="fw-bold">5 mb</span> y ser un <span class="fw-bold">PDF</span>.
  </p>
  <section class="d-flex gap-3 agenda-files justify-content-center">
    <label
      for="file-formula"
      :class="['shadow', Boolean(files.formula) && 'filled']"
      :is-required="required"
    >
      <span>Formula Medica</span>
      <span
        class="file-name"
        x-text="files.formula?.name"
      ></span>
      <input
        :required="required"
        id="file-formula"
        type="file"
        @change="onChange($event.target.files[0], 'formula')"
        :accept="acceptedTypes"
        name="formula"
        class="visually-hidden"
      >
    </label>
    <label
      for="file-autotizacion"
      :class="['shadow', Boolean(files.auto) && 'filled']"
      :is-required="required"
    >
      <span>Autorización</span>
      <span
        class="file-name"
        x-text="files.auto?.name"
      ></span>
      <input
        :required="required"
        id="file-autotizacion"
        type="file"
        @change="onChange($event.target.files[0], 'auto')"
        :accept="acceptedTypes"
        name="autorizacion"
        class="visually-hidden"
      >
    </label>
  </section>
</div>

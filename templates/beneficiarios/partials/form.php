<div
x-data="BeneficiarioForm"
x-bind="bindings"
class="vh-100 vw-100 bg-black bg-opacity-50 fixed-top flex overflow-auto pb-5">
  <template x-teleport="#new-beneficiario-container">
    <button
    type="button"
    @click="open"
    class="btn btn-warning btn-sm px-4 shadow">
      Agregar Beneficiario!
    </button>
  </template>

  <form
  id="beneficiario-form"
  @submit.prevent="save"
  style="min-width: 290px; max-width: 400px;"
  class="rounded shadow-lg m-auto form-uppercase bg-opacity-100 w-100 mt-4">
    <header class="d-flex justify-content-between p-2 rounded-top shadow text-bg-primary">
      <h6 class="m-0">Agregar Beneficiario</h6>
      <button
      @click="show = false"
      type="button"
      class="btn btn-close btn-close-white btn-sm"></button>
    </header>

    <section class="p-3 bg-light-subtle small">
      <div class="small mb-2">
        <label
        class="form-label small m-0"
        for="tipo_doc">Tipo de Documento:</label>
        <select
        id="tipo_doc"
        x-model="state.tipo_doc"
        class="form-select form-select-sm">
          <option hidden value="">- Selecciona -</option>
          <option>Tarjeta de Identidad</option>
          <option>C&eacute;dula</option>
          <option>C&eacute;dula Extranjer&iacute;a</option>
        </select>
      </div>

      <div class="small mb-2">
        <label
        class="form-label small m-0"
        for="documento">N° de Documento:</label>
        <input
        id="documento"
        autofocus
        required
        x-model="state.documento"
        placeholder="xxxxxxxxx"
        type="text"
        minlength="6"
        class="form-control form-control-sm">
      </div>

      <div class="small mb-2">
        <label
        class="form-label small m-0"
        for="parentesco">Parentesco:</label>
        <input
        id="parentesco"
        required
        placeholder="Requerido"
        x-model="state.parentesco"
        type="text"
        class="form-control form-control-sm">
      </div>

      <hr>

      <div class="small mb-2">
        <label
        class="form-label small m-0"
        for="nom1">Nombre:</label>
        <input
        id="nom1"
        required
        x-model="state.nom1"
        placeholder="Requerido"
        type="text"
        class="form-control form-control-sm">
      </div>

      <div class="small mb-2">
        <label
        class="form-label small m-0"
        for="nom2">Segundo Nombre:</label>
        <input
        id="nom2"
        x-model="state.nom2"
        placeholder="Opcional"
        type="text"
        class="form-control form-control-sm">
      </div>

      <div class="small mb-2">
        <label
        class="form-label small m-0"
        for="ape1">Apellido:</label>
        <input
        id="ape1"
        required
        x-model="state.ape1"
        placeholder="Requerido"
        type="text"
        class="form-control form-control-sm">
      </div>

      <div class="small mb-">
        <label
        class="form-label small m-0"
        for="ape2">Segundo Apellido:</label>
        <input
        id="ape2"
        x-model="state.ape2"
        placeholder="Opcional"
        type="text"
        class="form-control form-control-sm">
      </div>

      <hr>

      <div class="small mb-2">
        <label
        class="form-label small m-0"
        for="fecha_nac">Fecha nacimiento:</label>
        <input
        id="fecha_nac"
        required
        x-model="state.fecha_nac"
        type="date"
        class="form-control form-control-sm">
      </div>

      <div class="small mb-2">
        <label
        class="form-label small m-0"
        for="sexo">Sexo:</label>
        <select
        id="sexo"
        x-model="state.sexo"
        class="form-select form-select-sm">
          <option hidden value="">- Selecciona -</option>
          <option value="MA">Masculino</option>
          <option value="FE">Femenino</option>
        </select>
      </div>
    </section>

    <footer class="bg-secondary rounded-bottom p-2">
      <button
      type="submit"
      class="btn btn-warning btn-sm d-block  mx-auto px-5">
        Hecho!
      </button>
    </footer>
  </form>
</div>

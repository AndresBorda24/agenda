<h2 class="fs-6">Datos b&aacute;sicos</h2>
<form
x-data="UpdateUser"
@submit.prevent="update"
class="p-3 bg-white shadow border rounded small">
  <div class="small mb-2">
    <label
    class="form-label text-muted small m-0"
    for="num_histo">C&eacute;dula:</label>
    <input
    id="num_histo"
    autofocus
    required
    x-model="state.num_histo"
    placeholder="C&eacute;dula"
    type="text"
    minlength="6"
    class="form-control form-control-sm">
  </div>

  <div class="small p-1 mb-2">
    <div
    class="d-flex d-md-grid gap-2 flex-wrap"
    style="grid-template-columns: repeat(auto-fit, minmax(100px, 1fr))">
      <div class="w-100">
        <label for="apellido-1"
        class="form-label text-muted small m-0">Primer Apellido:</label>
        <input
        @keyup.prevent="$el.value = $el.value.toUpperCase()"
        placeholder="Apellido"
        required id="apellido-1"
        x-model="state.ape1"
        type="text"
        class="form-control form-control-sm text-uppercase">
      </div>
      <div class="w-100">
        <label for="apellido-2"
        class="form-label text-muted small m-0">Segundo Apellido:</label>
        <input
        placeholder="Seg. Apellido"
        x-model="state.ape2"
        type="text" id="apellido-2"
        class="form-control form-control-sm text-uppercase">
      </div>
      <div class="w-100">
        <label for="nombre-1"
        class="form-label text-muted small m-0">Primer Nombre:</label>
        <input
        placeholder="Nombre"
        required id="nombre-1"
        x-model="state.nom1"
        type="text"
        class="form-control form-control-sm text-uppercase">
      </div>
      <div class="w-100">
        <label for="nombre-2"
        class="form-label text-muted small m-0">Segundo Nombre:</label>
        <input
        placeholder="Seg. Nombre"
        x-model="state.nom2"
        type="text" id="nombre-2"
        class="form-control form-control-sm text-uppercase">
      </div>
    </div>
  </div>

  <div class="row g-0 small mb-2">
    <div class="col-md-5 p-1">
      <label
      class="form-label text-muted small m-0"
      for="telefono">Tel&eacute;fono:</label>
      <input
      id="telefono"
      required
      placeholder="3xxxxxxxxx"
      pattern="3[0-9]{9}"
      x-model="state.telefono"
      type="tel"
      class="form-control form-control-sm">
      <small class="text-muted d-block" style="font-size: .67rem;">
        Sin espacios, s&iacute;mbolos o letras
      </small>
    </div>

    <div class="col-md-7 p-1">
      <label
      class="form-label text-muted small m-0"
      for="email">Correo:</label>
      <input
      id="email"
      required
      type="email"
      autocomplete="email"
      x-model="state.email"
      placeholder="correo-usuario@corro.com"
      class="form-control form-control-sm text-uppercase">
    </div>
  </div>

  <div class="row g-0 mb-3 small">
    <div class="col-lg-5 p-1">
      <label
      class="form-label text-muted small m-0"
      for="ciudad">Ciudad:</label>
      <input
      id="ciudad"
      required
      x-model="state.ciudad"
      placeholder="Ciudad"
      type="text"
      class="form-control form-control-sm text-uppercase">
    </div>

    <div class="col-lg-7 p-1">
      <label
      class="form-label text-muted small m-0"
      for="direccion">Direcci&oacute;n:</label>
      <input
      id="direccion"
      required
      x-model="state.direccion"
      placeholder="Cll xx # xx -----"
      type="text"
      class="form-control form-control-sm text-uppercase">
    </div>
  </div>

  <div class="row g-o m-0 mb-3 small w-100">
    <!-- <div class="col-12 col-md-6 p-2 border rounded bg-blue-50 border-primary-subtle small">
      <label
      class="form-label text-muted small m-0"
      for="eps">EPS:</label>
      <select
      id="eps" required
      x-data="SelectAjax"
      x-model="state.eps"
      x-init="setTimeout(() => $el.value = state.eps, 2500)"
      class="form-select form-select form-select-sm">
        <option value="" hidden selected>-- Selecciona --</option>
        <template x-for="option in getOptions()" :key="option.codigo">
          <option
          :value="option.codigo"
          x-text="option.nombre"></option>
        </template>
      </select>
    </div> -->

    <div class="col-12 col-md-5 p-1 p-md-2">
      <label
      for="fech_nac"
      class="form-label text-muted small text-muted m-0">Fecha Nacimiento:</label>
      <input
      id="fech_nac"
      x-model="state.fech_nac"
      type="date"
      class="form-control form-control-sm">
    </div>
  </div>

  <button
  type="submit"
  class="ms-auto d-block btn btn-success btn-sm">Actualizar!</button>
</form>

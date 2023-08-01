<div class="p-3 pt-0 mb-3 small">
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
    class="form-control form-control-sm m-1">
  </div>

  <div class="small p-1 mb-2">
    <label for="nombre"
    class="form-label text-muted small m-0">Apellidos y Nombres:</label>
    <div class="d-flex gap-2 flex-wrap">
      <input
      placeholder="Apellido"
      required
      x-model="state.ape1"
      type="text"
      class="form-control form-control-sm">
      <input
      placeholder="Seg. Apellido"
      x-model="state.ape2"
      type="text"
      class="form-control form-control-sm">
      <input
      placeholder="Nombre"
      required
      x-model="state.nom1"
      type="text"
      class="form-control form-control-sm">
      <input
      placeholder="Seg. Nombre"
      x-model="state.nom2"
      type="text"
      class="form-control form-control-sm">
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
      x-model="state.email"
      required
      placeholder="correo-usuario@corro.com"
      type="email"
      class="form-control form-control-sm">
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
      class="form-control form-control-sm">
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
      class="form-control form-control-sm">
    </div>
  </div>

  <div class="row g-o m-0 mb-3 small w-100">
    <div class="col-12 col-md-6 p-2 border rounded bg-blue-50 border-primary-subtle small">
      <label
      class="form-label text-muted small m-0"
      for="eps">EPS:</label>
      <select
      x-data="SelectAjax"
      @change="state.eps = $el.value"
      data-select-ep="/get-all-eps"
      id="eps" required
      class="form-select form-select form-select-sm">
        <option value="" hidden selected>-- Selecciona --</option>
        <template x-for="option in options" :key="option.codigo">
          <option
          :value="option.codigo"
          x-text="option.nombre"></option>
        </template>
      </select>
    </div>
    <div class="col-12 col-md-6 p-1 p-md-2">
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

  <div class="row g-0 small">
    <div class="col-12 col-md-6 p-1 p-md-2">
      <label
      for="clave"
      class="form-label text-muted small text-muted m-0">Contrase&ntilde;a:</label>
      <input
      required
      min="8"
      id="clave"
      x-model="state.clave"
      type="password"
      class="form-control form-control-sm">
    </div>
    <div class="col-12 col-md-6 p-1 p-md-2">
      <label
      for="clave_confirm"
      class="form-label text-muted small text-muted m-0">Confirma Contrase&ntilde;a:</label>
      <input
      required
      min="8"
      id="clave_confirm"
      x-model="state.clave_confirm"
      type="password"
      class="form-control form-control-sm">
    </div>
  </div>
</div>

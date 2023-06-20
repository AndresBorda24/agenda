<form
x-data="form"
@submit.prevent="save"
class="p-3 shadow border rounded bg-body-tertiary"
autocomplete="off">
  <h2 class="text-center text-primary">Formulario de Registro</h2>
  <div class="p-2">
    <label
    class="form-label small m-1"
    for="cedula">C&eacute;dula:</label>
    <input
    id="cedula"
    autofocus
    required
    x-model="state.cedula"
    placeholder="C&eacute;dula del Usuario"
    type="text"
    minlength="5"
    class="form-control form-control-sm">
  </div>

  <div class="p-2">
    <label for="nombre"
    class="form-label small m-1">Nombre:</label>
    <div class="d-flex gap-2 flex-wrap">
      <input
      placeholder="Apellido"
      required
      x-model="state.apellido"
      type="text"
      class="form-control form-control-sm">
      <input
      placeholder="Seg. Apellido"
      x-model="state.apellido2"
      type="text"
      class="form-control form-control-sm">
      <input
      placeholder="Nombre"
      required
      x-model="state.nombre"
      type="text"
      class="form-control form-control-sm">
      <input
      placeholder="Seg. Nombre"
      x-model="state.nombre2"
      type="text"
      class="form-control form-control-sm">
    </div>
  </div>


  <div class="row g-0">
    <div class="col-md-5 p-1 p-md-2">
      <label
      class="form-label small m-1"
      for="telefono">Tel&eacute;fono:</label>
      <input
      id="telefono"
      required
      placeholder="3xx-xxx-xxxx"
      x-model="state.telefono"
      type="text"
      class="form-control form-control-sm">
    </div>

    <div class="col-md-7 p-1 p-md-2">
      <label
      class="form-label small m-1"
      for="correo">Correo:</label>
      <input
      id="correo"
      x-model="state.correo"
      required
      placeholder="correo-usuario@corro.com"
      type="email"
      class="form-control form-control-sm">
    </div>
  </div>

  <div class="row g-0 mb-3">
    <div class="col-lg-5 p-1 p-md-2">
      <label
      class="form-label small m-1"
      for="ciudad">Ciudad:</label>
      <input
      id="ciudad"
      required
      x-model="state.ciudad"
      placeholder="Ciudad"
      type="text"
      class="form-control form-control-sm">
    </div>

    <div class="col-lg-7 p-1 p-md-2">
      <label
      class="form-label small m-1"
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

  <div class="py-3 px-2 border rounded shadow-sm bg-body-secondary mb-3">
    <label
    class="form-label small m-1"
    for="eps">EPS:</label>
    <select
    id="eps"
    required
    x-model="state.eps"
    class="form-select form-select form-select-sm">
      <option value="" hidden selected>-- Selecciona --</option>
      <option value="EPS001">Nueva EPS</option>
      <option value="EPS002">Sanitas S.A</option>
      <option value="EPS003">Pijaos Salud</option>
    </select>
  </div>

  <div class="pt-3">
    <button class="btn btn-warning btn-sm m-auto d-block">
      Completar registro!
    </button>
  </div>
</form>

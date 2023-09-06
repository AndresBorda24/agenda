<h2 class="fs-6">Contrase&ntilde;a:</h2>
<form
x-data="UpdatePass"
@submit.prevent="update"
autocomplete="off"
class="p-3 bg-white shadow border rounded border-danger-subtle">
  <div class="small mb-2">
    <label
    class="form-label text-muted small m-0"
    for="_password">Contrase&ntilde;a Actual:</label>
    <input
    id="_password"
    autofocus
    required
    placeholder="Tu contrase&ntilde;a actual."
    type="password"
    minlength="6"
    class="form-control form-control-sm m-1">
  </div>

  <div class="row g-2 mb-3">
    <div class="small col-12 col-md-6">
      <label
      class="form-label text-muted small m-0"
      for="new-password">Nueva Contrase&ntilde;a:</label>
      <input
      id="new-password"
      autofocus
      required
      placeholder="Nueva Contrase&ntilde;a"
      type="password"
      minlength="6"
      class="form-control form-control-sm m-1">
    </div>
    <div class="small col-12 col-md-6">
      <label
      class="form-label text-muted small m-0"
      for="new-password-confirm">Confirma Contrase&ntilde;a:</label>
      <input
      id="new-password-confirm"
      autofocus
      required
      placeholder="Confirma"
      type="password"
      minlength="6"
      class="form-control form-control-sm m-1">
    </div>
  </div>

  <button class="ms-auto d-block btn btn-danger btn-sm">Actualizar Contrase&ntilde;a!</button>
</form>

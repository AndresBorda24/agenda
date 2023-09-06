<h2 class="fs-6">Contrase&ntilde;a:</h2>
<form
x-data="UpdatePass"
@submit.prevent="update"
autocomplete="off"
class="p-3 bg-white shadow border rounded border-danger-subtle">
  <div class="text-bg-danger p-2 small bg-opacity-75 rounded-end border-start
  border-5 border-danger shadow-sm mb-3">
    Una vez cambies la contrase&ntilde;a tendr&aacute;s que iniciar sesi&oacute;n nuevamente.
  </div>

  <div class="small mb-2">
    <label
    class="form-label text-muted small m-0"
    for="_password">Contrase&ntilde;a Actual:</label>
    <input
    id="_password"
    x-model="state._password"
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
      for="new_password">Nueva Contrase&ntilde;a:</label>
      <input
      id="new_password"
      required
      x-model="state.new_password"
      placeholder="Nueva Contrase&ntilde;a"
      type="password"
      minlength="8"
      class="form-control form-control-sm m-1">
    </div>
    <div class="small col-12 col-md-6">
      <label
      class="form-label text-muted small m-0"
      for="new_password_confirm">Confirma Contrase&ntilde;a:</label>
      <input
      id="new_password_confirm"
      x-model="state.new_password_confirm"
      required
      placeholder="Confirma"
      type="password"
      minlength="8"
      class="form-control form-control-sm m-1">
    </div>
  </div>

  <button
  type="submit"
  :disabled="! cansubmit"
  class="ms-auto d-block btn btn-danger btn-sm">Actualizar Contrase&ntilde;a!</button>
</form>

<h2 class="fs-6">Contrase&ntilde;a:</h2>
<form
x-data="UpdatePass"
@submit.prevent="update"
autocomplete="off"
class="p-3 bg-white shadow border rounded border-danger-subtle">
  <div class="flex !gap-2 items-center !p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
    <span class="[&>svg]:h-4"><?= $this->fetch('icons/important.php') ?></span>
    <div>
      <span class="font-medium">Importante!</span>
      Una vez cambies la contrase&ntilde;a tendr&aacute;s que iniciar sesi&oacute;n nuevamente.
    </div>
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

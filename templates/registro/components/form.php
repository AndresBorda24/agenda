<form
x-data="Form"
@submit.prevent="save"
class="p-0 shadow border d-flex flex-column rounded bg-body-tertiary overflow-hidden"
autocomplete="off">
  <span class="p-3 text-center text-light bg-primary mb-3 fw-bold">
    Formulario de Registro
  </span>

  <div class="flex-grow overflow-auto">
    <div style="max-width: 550px;" class="m-auto">
      <?= $this->fetch("./registro/components/form-fields.php") ?>
    </div>
  </div>

  <div class="d-flex justify-content-between bg-blue-700 p-2">
    <button
    type="submit"
    class="btn btn-warning btn-sm m-auto d-block">
      Completar registro!
    </button>
  </div>
</form>

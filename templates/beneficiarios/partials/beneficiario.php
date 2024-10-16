<li
  x-data="Beneficiario(ben)"
  class="list-group-item list-group-item-action d-flex align-items-start small beneficiario"
>
  <div class="text-sm flex-grow-1 ps-2">
    <span x-text="nombre.toLowerCase()" class="capitalize text-neutral-600 block"></span>
    <span x-text="data.documento" class="font-light text-xs text-neutral-600"></span>
  </div>
  <span class="badge bg-aso-primary text-sky-50 shadow capitalize" x-text="data.parentesco?.toLowerCase()"></span>
  <button
    @click="edit"
    class="d-inline-block btn btn-sm btn-warning beneficiario-edit-btn mx-2 py-0 px-1 shadow"
  >
    <?= $this->fetch("./icons/edit.php") ?>
  </button>
</li>

<li 
  x-data="Beneficiario(ben)" 
  class="list-group-item list-group-item-action d-flex align-items-start small beneficiario"
>
  <div class="small flex-grow-1 ps-2">
    <p class="m-0">
      <span x-text="nombre" class="text-uppercase"></span>
    </p>
    <span x-text="data.documento" class="badge text-bg-light border"></span>
  </div>
  <span class="badge text-bg-primary shadow" x-text="data.parentesco"></span>
  <button 
    @click="edit"
    class="d-inline-block btn btn-sm btn-warning beneficiario-edit-btn mx-2 py-0 px-1 shadow"
  >
    <?= $this->fetch("./icons/edit.php") ?>
  </button>
</li>
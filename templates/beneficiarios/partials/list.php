<section x-data="BeneficiariosList" x-bind="events" class="shadow rounded-bottom">
  <template x-if="Boolean(error)">
    <p class="p-3 text-bg-light border rounded small m-0">
      No se ha logrado recuperar el listado de beneficiarios. Lo sentimos.
      Por favor, intenta m&aacute;s tarde.
    </p>
  </template>

  <template x-if="isEmpty && fetched">
    <p class="p-3 text-bg-light border rounded small m-0">
      A&uacute;n no has registrado ning&uacute;n beneficiario. Recuerda que
      puedes hacerlo dando clic en el bot&oacute;n
      <span class="bagde px-3 text-bg-warning d-inline-block small rounded shadow-sm">
        Agregar Beneficiarios
      </span> que est&aacute; arriba.
    </p>
  </template>

  <template x-if="! Boolean(error)">
    <ol class="list-group list-group-numbered">
      <template x-for="$i in list" :key="$i.id">
        <?= $this->fetch("./beneficiarios/partials/beneficiario.php") ?> 
      </template>
    </ol>
  </template>

  <?= $this->fetch("./beneficiarios/partials/form.php") ?>
</section>






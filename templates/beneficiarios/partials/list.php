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
      <span class="bagde px-3 text-bg-warning d-inline-block small roudned shadow-sm">
        Agregar Beneficiarios
      </span> que est&aacute; arriba.
    </p>
  </template>

  <template x-if="! Boolean(error)">
    <ol class="list-group list-group-numbered">
      <template x-for="$i in list" :key="$i.id">
      <li class="list-group-item d-flex align-items-start small">
        <div class="small flex-grow-1 ps-2">
          <span x-text="$i.nombre" class="text-uppercase"></span><br>
          <span x-text="$i.documento" class="badge text-bg-light border"></span>
        </div>
        <span class="badge text-bg-primary shadow" x-text="$i.parentesco"></span>
      </li>
      </template>
    </ol>
  </template>
</section>






<div class="p-3 border-bottom">
  <span
  x-text="plan.nombre"
  class="d-block text-center text-primary fs-5"></span>
  <span class="text-secondary d-block text-center fs-1 fw-bold">
    $ <span x-text="plan.valor_formatted"></span>
  </span>
  <span class="d-block text-center small">
    Vigencia:
    <span
    class="text-bg-warning badge"
    x-text="plan.vigencia"></span> (d&iacute;as)
  </span>
</div>

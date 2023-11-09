<form
  autocomplete="off"
  @submit.prevent="action"
>
  <div class="p-3 border-top">
    <label for="documento" class="form-label small">C&eacute;dula:</label>
    <input
    id="documento"
    x-model="state.doc"
    autofocus
    :disabled="state.tel !== null"
    required
    minlength="4"
    placeholder="123456789"
    type="text"
    class="form-control form-control-sm w-100 mb-2">

    <template x-if="state.tel">
      <div>
        <span class="d-block p-3 small text-center text-muted">
          El C&oacute;digo se env&iacute;o al tel&eacute;fono:
          <span class="badge text-bg-primary" x-text="state.tel"></span>
        </span>
        <label for="cod" class="form-label small">C&oacute;digo:</label>
        <input
        id="cod"
        x-model="state.cod"
        autofocus
        required
        minlength="4"
        placeholder="Tu codigo secreto"
        type="text"
        class="form-control form-control-sm w-100 mb-2">

        <label for="password" class="form-label small">Nueva Contrase&ntilde;a:</label>
        <input
        id="password"
        x-model="state.password"
        autofocus
        required
        minlength="8"
        placeholder="123456789"
        type="password"
        class="form-control form-control-sm w-100 mb-2">

        <label
          for="confirm_password"
          class="form-label small"
        >Confirmar Contrase&ntilde;a:</label>
        <input
        id="confirm_password"
        x-model="state.confirm_password"
        autofocus
        required
        minlength="8"
        placeholder="123456789"
        type="password"
        class="form-control form-control-sm w-100 mb-3">
      </div>
    </template>
  </div>

  <div class="bg-secondary p-4">
    <button
      type="submit"
      class="btn btn-warning btn-sm d-block m-auto"
    > Continuar </button>
  </div>
</form>

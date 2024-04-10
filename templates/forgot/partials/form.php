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


        <fieldset id="cod" class="d-flex justify-content-center gap-2 mt-2">
          <template x-for="i in 6">
            <input
              required
              type="tel"
              name="cod"
              maxlength="1"
              minlength="1"
              :value="state.cod[i - 1]"
              @keydown="onkeydown"
              @keyup.left="() => document.querySelector(`[data-index='${i-2}']`)?.focus();"
              @keyup.right="() => document.querySelector(`[data-index='${i}']`)?.focus();"
              :data-index="i - 1"
              autocomplete="off"
              class="input-code input-code-6 mb-3 shadow"
            >
          </template>
        </fieldset>

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

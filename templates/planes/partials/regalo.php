<div x-data="Regalo">
  <form
    class="mb-4"
    @submit.prevent="save"
  >
    <div style="max-width: 300px;" class="mx-auto">
      <fieldset id="gift-code" class="d-flex justify-content-center gap-2 mt-2">
        <input
          required
          type="text"
          name="gift-code"
          maxlength="1"
          minlength="1"
          :value="code[0]"
          @keydown="onkeydown"
          @keyup.left="() => document.querySelector(`[data-index='0']`)?.focus();"
          @keyup.right="() => document.querySelector(`[data-index='1']`)?.focus();"
          :data-index="0"
          autocomplete="off"
          autofocus
          class="input-code input-code-6 mb-3 shadow"
        >
        <template x-for="i in 5">
          <input
            required
            type="text"
            name="gift-code"
            maxlength="1"
            minlength="1"
            :value="code[i]"
            @keydown="onkeydown"
            @keyup.left="() => document.querySelector(`[data-index='${i-1}']`)?.focus();"
            @keyup.right="() => document.querySelector(`[data-index='${i+1}']`)?.focus();"
            :data-index="i"
            autocomplete="off"
            class="input-code input-code-6 mb-3 shadow"
          >
        </template>
      </fieldset>
    </div>
    <button
      type="submit"
      class="btn btn-warning btn-sm d-block mx-auto shadow"
    >
      Redimir
      <span><?= $this->fetch("./icons/prize.php") ?></span>
    </button>
  </form>

  <template x-if="success">
    <div
    class="vh-100 vw-100 fixed-top bg-black bg-opacity-75 flex flex-column"
    style="z-index: 3000;">
      <div class="m-auto rounded p-4 bg-white border border-4" style="max-width: 400px;">
        <p>Has redimido correctamente tu código!</p>
        <p class="m-0">
          Da clic
          <a
            class="badge text-bg-warning shadow text-decoration-none fs-6"
            href="<?= $this->link("activar-tarjeta") ?>"
          >aquí</a>
          para ir a <span class="fst-italic fw-bold">activar tu tarjeta</span>.
        </p>
      </div>
    </div>
  </template>
</div>

<picture class="mx-auto mb-3 d-block" style="max-width: 400px;">
  <img
    class="w-100 h-100 object-fit"
    src="<?= $this->asset("img/gift-card.png") ?>"
    alt="gift-card"
  >
</picture>

<p class="text-center">
  Copia el código que encontrarás en la parte trasera de la tarjeta.
</p>

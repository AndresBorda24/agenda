<div
  x-data="{
    show: false,
    openModal() {
      document.body.classList.add('overflow-hidden');
      this.show = true;
    },
    closeModal() {
      document.body.classList.remove('overflow-hidden');
      this.show = false;
    }
  }"
>
  <button
    @click="openModal"
    class="text-xs rounded bg-amber-400 text-neutral-800 !px-3 py-1.5 xl:hidden hover:outline hover:outline-offset-2 hover:outline-2 hover:outline-amber-500"
  >Preguntas Frecuentes</button>

  <template x-teleport="body">
    <div
      x-cloak
      x-show="show"
      @click.self="closeModal"
      class="min-w-[300px] bg-black/30 w-full fixed top-0 right-0 h-screen z-[1021]"
    >
      <div class="ml-auto p-6 max-w-md bg-white border-l border-neutral-300 text-sm text-neutral-600 relative min-h-full max-h-full overflow-auto">
        <button
          @click="closeModal"
          class="btn btn-close absolute top-0 right-0 m-6 xl:hidden"
        ></button>
        <?= $this->fetch('partials/pasarela-faq.php') ?>
      </div>
    </div>
  </template>
</div>

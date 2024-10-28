<aside
  x-data="OrderList"
  @click.self="closeModal"
  class="min-w-[300px] bg-black/30 w-full fixed top-0 right-0 h-screen z-[1021] transition-transform duration-150 xl:static xl:!translate-x-0 xl:p-3 xl:z-auto xl:max-w-none xl:bg-transparent xl:w-auto"
  :class="{
    'translate-x-0': show,
    'translate-x-full':!show
  }"
>
  <template x-teleport="#tramites-list-button-container">
    <button
      @click="openModal"
      class="text-xs rounded bg-amber-400 text-neutral-800 !px-3 py-1.5 xl:hidden hover:outline hover:outline-offset-2 hover:outline-2 hover:outline-amber-500"
    >Ver Mis Trámites.</button>
  </template>

  <div class="ml-auto !p-6 max-w-sm bg-white border-l border-neutral-300 text-sm text-neutral-600 relative min-h-full xl:min-h-0 xl:sticky xl:top-12 xl:border-none xl:rounded">
    <button
      @click="closeModal"
      class="btn btn-close absolute top-0 right-0 m-2 xl:hidden"
    ></button>
    <span class="font-bold block !mb-2">Listado de Trámites</span>
    <p class="!mb-4">Aquí verás el listado de todos los trámites que hayas comprado.</p>

    <template x-if="orders.length === 0">
      <div class="text-amber-800 bg-amber-50 rounded !p-2">
        Aún no has realizado ninguna compra.
      </div>
    </template>

    <template x-if="orders.length > 0">
      <div class="flex flex-col space-y-3">
        <template x-for="order in orders">
          <div class="flex items-center">
            <div class="relative flex flex-col flex-grow">
              <span x-text="order.name" class="font-bold"></span>
              <span x-text="order.status" class="text-xs"></span>
              <span x-text="order.created_at" class="text-xs text-neutral-400"></span>
            </div>
            <template x-if="order.status_raw === '<?=\App\Enums\MpStatus::PENDIENTE->value ?>'">
              <a
                title="Revisar Estado de Compra"
                :href="getLinkPendiente(order.id)"
                class="bg-sky-50 text-blue-700 hover:bg-blue-700 hover:text-blue-50 transition-colors duration-150 !px-2 !py-1.5 rounded text-xs"
              > Ver Estado </a>
            </template>
            <template x-if="order.file_id">
              <button
                title="Ver Archivo"
                @click="console.log(order.file_id)"
                class="[&>svg]:h-4 [&>svg]:w-4 bg-sky-50 text-blue-700 hover:bg-blue-700 hover:text-blue-50 transition-colors duration-150 !p-2 rounded"
              >
                <?= $this->fetch('icons/file.php') ?>
              </button>
            </template>
          </div>
        </template>
      </div>
    </template>
  </div>
</aside>

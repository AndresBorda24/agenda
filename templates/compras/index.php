<?php
/**
 * @var array<int, array{
 *  id: number,
 *  created_at: string,
 *  updated_at: string,
 *  file_id: number|null,
 *  type: OrderType,
 *  data: PlanDto | OrderItem,
 *  status: App\Enums\MpStatus,
 *  status_raw: number | string
 * }> $orders
*/

$tableHeaers = [
  'Nombre del Producto',
  'Precio',
  'Estado',
  'Fecha Orden',
  'Última Actualización',
  'Acciones',
];

$format = fn (string|float $value) => "$ ".number_format((float) $value, thousands_separator: '.');
function getRowClass(App\Enums\MpStatus $status)
{
    if ($status === App\Enums\MpStatus::RECHAZADO) {
        return "bg-red-50 border-b text-neutral-700 text-xs text-nowrap";
    }
    return "odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 text-neutral-800 text-xs text-nowrap";
}
?>
<main class="flex-grow-1 p-6 overflow-auto">
  <section class="mx-auto max-w-5xl">
    <h1 class="fs-5 text-primary !mb-4">Listado de Compras</h1>

    <?php if(count($orders) === 0): ?>
      <div class="max-w-xl flex items-center !p-4 !mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert" >
        <span class="[&>svg]:h-4 me-3"> <?= $this->fetch('./icons/important.php') ?> </span>
        <div>
          <p> Parece que aún no tienes ninguna compra registrada.  </p>
        </div>
      </div>
    <?php else: ?>
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <?php foreach($tableHeaers as $header): ?>
                <th scope="col" class="px-6 !py-3"><?= $header ?></th>
              <?php endforeach ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach($orders as $order): ?>
              <tr class="<?= getRowClass($order['status']) ?>">
                <th
                  scope="row"
                  class="px-6 !py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                  <?= match(get_class($order['data'])) {
                      \App\DataObjects\PlanDTO::class => "Plan ".$order['data']->nombre,
                      \App\DataObjects\OrderItem::class => $order['data']->name
                  }?>
                </th>
                <td class="px-6 !py-4 text-right text-nowrap">
                  <?= $format(match(get_class($order['data'])) {
                      \App\DataObjects\PlanDTO::class => $order['data']->valor,
                      \App\DataObjects\OrderItem::class => $order['data']->price
                  }) ?>
                </td>
                <td class="px-6 !py-4">
                  <?= $order['status']->publicName() ?>
                </td>
                <td class="px-6 !py-4">
                  <?= $order['created_at'] ?>
                </td>
                <td class="px-6 !py-4">
                  <?= $order['updated_at'] ?>
                </td>
                <td class="px-6 !py-4">
                  <?php if($order['file_id']): ?>
                    <a
                      target="_blank"
                      href="<?= $this->link('files.user', ['fileId' => $order['file_id']]) ?>"
                      class="underline text-aso-primary hover:text-aso-secondary"
                    >Ver Archivo</a>
                  <?php endif ?>
                  <?php if($order['status'] === \App\Enums\MpStatus::PENDIENTE): ?>
                    <a
                      href="<?= $this->link('gateway.returnUrl', ['data' => base64_encode(
                          json_encode([ 'ref' => $order['id'] ])
                      )]) ?>"
                      class="underline text-aso-primary hover:text-aso-secondary"
                    >Revisar Estado</a>
                  <?php endif ?>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    <?php endif ?>

  </section>
</main>

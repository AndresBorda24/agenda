<section class="bg-red-50 text-red-800 p-6 rounded-md flex !gap-2 text-sm">
  <?= $this->fetch("./icons/sign.php", [
    "props" => 'style="width: 48px; height:48px;"'
  ]) ?>
  <div class="ps-2">
    <span class="fw-bold d-block">Importante:</span>
    <ul class="m-0 text-neutral-800">
      <li>Solo puedes cancelar citas con <strong>Máximo 1 día</strong> de anticipación.</li>
      <li>Las fechas pueden cambiar una vez la cita pase a estar <strong>Agendada</strong>.</li>
    </ul>
  </div>
</section>

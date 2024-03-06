<section class="align-items-center bg-white border-2 border-danger border-top d-flex mb-4 ms-auto p-2 rounded-top small">
  <?= $this->fetch("./icons/sign.php", [
    "props" => 'style="width: 48px; height:48px;"'
  ]) ?>
  <div class="ps-2">
    <span class="fw-bold d-block text-danger">Importante:</span>
    <ul class="m-0">
      <li>Solo puedes cancelar citas con <strong>Máximo 1 día</strong> de anticipación.</li>
      <li>Las fechas pueden cambiar una vez la cita pase a estar <strong>Agendada</strong>.</li> 
    </ul>
  </div>
</section>

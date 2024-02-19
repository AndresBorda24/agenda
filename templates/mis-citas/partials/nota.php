<section class="align-items-center bg-white border-2 border-danger border-top d-flex mb-4 ms-auto p-2 rounded-top small">
  <?= $this->fetch("./icons/sign.php", [
    "props" => 'style="width: 48px; height:48px;"'
  ]) ?>
  <p class="m-0 ps-2">
    <span class="fw-bold text-danger">Importante:</span> <br>
    <span>
      Solo puedes cancelar citas con <strong>M&aacute;ximo 1 d&iacute;a</strong> de anticipaci&oacute;n.
    </span>
  </p>
</section>

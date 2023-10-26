<div class="bg-primary border-bottom p-3">
  <span class="d-block fs-5 text-center text-warning">
    <?= $nombre ?>
  </span>
  <span class="d-block fs-1 fw-bold text-center text-light">
    $ <?= $valor ?? "" ?>
  </span>
  <span class="d-block small text-center text-light">
    Vigencia:
    <span class="text-bg-warning badge">
      <?= $vigencia ?? "" ?>
    </span> (d&iacute;as)
  </span>
</div>

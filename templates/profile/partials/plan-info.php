<article class="bg-secondary border border-warning rounded shadow p-3 text-light">
  <header class="d-sm-flex justify-content-between align-items-end mb-2">
    <span class="d-block">
      <span class="text-warning fs-5 mb-2 m-sm-0 d-sm-block">
        Plan: <?= $this->auth()->user()->plan("nombre") ?>
      </span>
      <span class="fw-light small d-sm-block">
        $ <?= number_format(
          (int) $this->auth()->user()->plan("valor"),
          thousands_separator: "."
        ) ?>
      </span>
    </span>

    <?php if( $this->auth()->user()->plan("expires_at") ): ?>
      <span class="fw-bold d-block small">
        <span class="fw-light small">Expira el:</span> <br>
        <?= $this->auth()->user()->plan("expires_at") ?>
      </span>
    <?php endif ?>
  </header>

  <span>Beneficios:</span>
  <ul class="small">
    <?php foreach(
      explode(";", $this->auth()->user()->plan("beneficios"))
      as $beneficio
    ): ?>
      <li class="small fw-light"><?= $beneficio ?>.</li>
    <?php endforeach ?>
  </ul>

  <div class="text-light fw-light">
    <?= $this->fetch("./planes/partials/plan/exclusiones.php") ?>
  </div>
</article>


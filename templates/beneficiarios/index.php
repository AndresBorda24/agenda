<main class="flex-grow-1 p-3">
  <section class="mx-auto" style="max-width: 700px;">
    <h1  class="fs-5 text-primary">Listado de beneficiarios</h1>
    <div id="new-beneficiario-container" class="mb-4"> </div>

    <section class="d-flex align-items-center mb-4 gap-3 p-2 small border-start border-5 border-danger rounded-end shadow" style="background-color: #ffdede;">
      <?= $this->fetch("./icons/sign.php", [
        "props" => 'style="min-width: 55px; height:60px;"'
      ]) ?>
      <div>
        <p class="mb-1 small text-dark-emphasis">
          Una vez agregado el beneficiario <b>no</b> se podrán modificar algunos campos ni tampoco se podrá eliminar del listado.</p>
        <p class="mb-0 small text-dark-emphasis">
          Para realizar estos cambios debes realizar tu solicitud a <a href="mailto:programadefidelizacion@asotrauma.com.co" class="fw-bold text-decoration-none text-dark">programadefidelizacion@asotrauma.com.co</a>.
        </p>
      </div>
      <span>
      </span>
    </section>

    <?= $this->fetch("./beneficiarios/partials/list.php") ?>
  </section>
</main>

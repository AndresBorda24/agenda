<main class="flex-grow-1 p-3">
  <section class="mx-auto" style="max-width: 700px;">
    <h1  class="fs-5 text-primary">Listado de beneficiarios</h1>
    <div id="new-beneficiario-container" class="mb-4"> </div>

    <div class="flex items-center !p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
      <?= $this->fetch('icons/important.php') ?>
      <div>
        <span class="font-medium">Importante!</span>
        <p class="mb-1 small text-dark-emphasis">
          Una vez agregado el beneficiario <b>no</b> se podrán modificar algunos campos ni tampoco se podrá eliminar del listado.
          Para realizar estos cambios debes realizar tu solicitud a <a href="mailto:programadefidelizacion@asotrauma.com.co" class="fw-bold text-decoration-none text-dark">programadefidelizacion@asotrauma.com.co</a>.
        </p>
      </div>
    </div>

    <?= $this->fetch("./beneficiarios/partials/list.php") ?>
  </section>
</main>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("login/app") ?>
  <title>Mis Citas</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Citas Agendadas"
  ]) ?>

  <div class="d-flex p-1 main-container">
    <?= $this->fetch("./partials/aside.php") ?>
    <main class="flex-grow-1 p-3">
      <section class="mx-auto" style="max-width: 700px;" x-data="app">
        <h1  class="fs-5 text-primary">Citas Agendadas</h1>

        <section class="d-flex align-items-center mb-4 bg-danger p-2 bg-opacity-50 small border-start border-5 border-danger rounded-end shadow">
          <?= $this->fetch("./icons/sign.php", [
            "props" => 'style="width: 60px; height:60px;"'
          ]) ?>
          <span>
            Solo puedes cancelar citas con <strong>M&aacute;ximo 1 d&iacute;a</strong> de anticipaci&oacute;n.
          </span>
        </section>

        <ul class="list-group list-group-flush shadow rounded overflow-hidden">
          <template x-for="(cita, index) in citas" :key="cita.id">
            <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
              <div
                class="small d-flex flex-column"
                :class="{ 'opacity-50': vencida(index) }"
              >
                <span x-text="cita.especialidad"></span>
                <span
                  x-text="cita.medico"
                  class="small text-muted fw-bold"
                ></span>
                <span>
                  <span
                    x-text="cita.fecha"
                    class="small text-muted"
                  ></span>
                  <span
                    x-text="cita.hora"
                    class="small text-muted"
                  ></span>
                </span>
              </div>
              <div>
                <button
                  class="btn btn-sm btn-danger px-3 rounded-5"
                  :class="{ 'disabled': vencida(index) }"
                  @click="cancelar( index )"
                >Cancelar</button>
              </div>
            </li>
          </template>
        </ul>
      </section>
    </main>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>

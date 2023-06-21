<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("registro-vip/app") ?>
  <title>Registro Usuarios Fidelizados</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Registro de Pacientes Fidelizados"
  ]) ?>

  <form
  @submit.prevent="save"
  class="align-items-center my-5 container"
  x-data="form">
    <div class="m-auto mb-5 d-md-flex">
      <div class="col-lg-6 p-3 p-md-5">
        <div class="w-100 h-100 overflow-hidden rounded shadow registro-usuario-image">
          <img
          loading="lazy"
          src="https://asotrauma.com.co/wp-content/uploads/2022/05/Derecho-01.jpg"
          class="object-fit-cover w-100 h-100"
          alt="">
        </div>
        <span class="p-2 text-center mt-2 text-muted small d-block">
          Trabajamos por tu bienestar y el bienestar de tu familia, por eso en
          la Cl&iacute;nica Asotrauma trabajamos para ti y para todos.
        </span>
      </div>
      <?= $this->fetch("./registro-vip/components/form.php") ?>
    </div>

    <hr>

    <span class="fs-4 d-block text-center text-primary mb-2">
      Selecciona el Plan!
    </span>
    <div class="d-flex justify-content-center gap-3 flex-wrap">
      <?= $this->fetch("./registro-vip/components/planes.php") ?>
    </div>

    <hr>
    <div class="pt-3">
      <button class="btn btn-warning btn-sm m-auto d-block">
        Completar registro!
      </button>
    </div>
  </form>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>

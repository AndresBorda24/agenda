<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Citas</title>
  <?= $this->loadAssets("registro/app") ?>
</head>
<body>
  <header class="container p-3">
    <img
    src="https://asotrauma.com.co/wp-content/uploads/2021/09/Asotrauma-logo-w.svg"
    alt="aso-logo"
    height="30"
    class="d-block">
    <h2 class="text-center text-light">
      Registro de usuarios <span class="badge text-bg-warning">VIP</span>
    </h2>
  </header>

  <main class="container p-5 pt-4 d-md-flex gap-2 align-items-center">
    <form
    x-data="app()"
    @submit.prevent="send"
    style="max-width: 700px;"
    class="m-auto bg-body-tertiary shadow rounded"
    autocomplete="off">
      <div class="p-4 border-bottom">
        <h5 class="fs-5 text-center">Datos Personales</h5>
        <div class="row g-0">
          <div class="col-3 p-2">
            <label
            class="form-label small m-1"
            for="cedula">C&eacute;dula:</label>
            <input
            id="cedula"
            x-model="state.cedula"
            required
            autofocus
            placeholder="C&eacute;dula del Usuario"
            type="text"
            class="form-control form-control-sm">
          </div>
          <div class="col-9 p-2">
            <label
            class="form-label small m-1"
            for="nombre">Nombre:</label>
            <div class="d-flex gap-1">
              <input
              id="nombre"
              x-model="state.apellido1"
              required
              placeholder="Apellido"
              type="text"
              class="form-control form-control-sm">
              <input
              id="nombre"
              x-model="state.apellido2"
              placeholder="Seg. Apellido"
              type="text"
              class="form-control form-control-sm">
              <input
              id="nombre"
              x-model="state.nombre1"
              required
              placeholder="Nombre"
              type="text"
              class="form-control form-control-sm">
              <input
              id="nombre"
              x-model="state.nombre2"
              placeholder="Seg. Nombre"
              type="text"
              class="form-control form-control-sm">
            </div>
          </div>
        </div>


        <div class="row g-0">
          <div class="col-5 p-2">
            <label
            class="form-label small m-1"
            for="telefono">Tel&eacute;fono:</label>
            <input
            id="telefono"
            x-model="state.telefono"
            required
            placeholder="Tel&eacute;fono del Usuario"
            type="text"
            class="form-control form-control-sm">
          </div>
          <div class="col-7 p-2">
            <label
            class="form-label small m-1"
            for="correo">Correo:</label>
            <input
            id="correo"
            x-model="state.correo"
            required
            placeholder="correo-usuario@corro.com"
            type="email"
            class="form-control form-control-sm">
          </div>
        </div>

        <div class="p-2">
          <label
          class="form-label small m-1"
          for="direccion">Direcci&oacute;n:</label>
          <input
          id="direccion"
          required
          x-model="state.direccion"
          placeholder="Cll xx # xx -----"
          type="text"
          class="form-control form-control-sm">
        </div>
      </div>

      <div class="p-4 py-5 text-bg-primary" style="background-color: rgb(53,163,199) !important;">
        <h5 class="fs-5 text-center">Selecciona el Plan</h5>
        <div class="d-grid gap-2" style="grid-template-columns: repeat(3, 1fr);">
          <div
          :class="{
            'bg-opacity-100 shadow': (state.plan == '1'),
            'bg-opacity-50': true
          }"
          class="card bg-light overflow-hidden">
            <div class="p-3 text-bg-primary">
              <img
              src="https://asotrauma.com.co/wp-content/uploads/2021/09/Asotrauma-logo-w.svg"
              class="card-img-top" alt="...">
            </div>
            <div class="card-body user-select-none">
              <h6 class="card-title">Plan #1</h5>
              <p class="card-text small">Peque&ntilde;o detalle del plan</p>
              <label
              for="plan-1"
              class="btn m-auto d-block btn-sm btn-outline-primary"
              :class="(state.plan == '1') ? 'active' : ''"
              x-text="(state.plan == '1') ? 'Seleccionado !!' : 'Seleccionar'"></label>
              <input
              type="radio"
              class="visually-hidden"
              name="plan"
              x-model="state.plan"
              id="plan-1"
              value="1">
            </div>
          </div>

          <div
          :class="{
            'bg-opacity-100 shadow': (state.plan == '2'),
            'bg-opacity-50': true
          }"
          class="card bg-light overflow-hidden">
            <div class="p-3 text-bg-primary">
              <img
              src="https://asotrauma.com.co/wp-content/uploads/2021/09/Asotrauma-logo-w.svg"
              class="card-img-top" alt="...">
            </div>
            <div class="card-body user-select-none">
              <h6 class="card-title">Plan #2</h5>
              <p class="card-text small">Peque&ntilde;o detalle del plan</p>
              <label
              for="plan-2"
              class="btn m-auto d-block btn-sm btn-outline-primary"
              :class="(state.plan == '2') ? 'active' : ''"
              x-text="(state.plan == '2') ? 'Seleccionado !!' : 'Seleccionar'"></label>
              <input
              type="radio"
              class="visually-hidden"
              name="plan"
              x-model="state.plan"
              id="plan-2"
              value="2">
            </div>
          </div>


          <div
          :class="{
            'bg-opacity-100 shadow': (state.plan == '3'),
            'bg-opacity-50': true
          }"
          class="card bg-light overflow-hidden">
            <div class="p-3 text-bg-primary">
              <img
              src="https://asotrauma.com.co/wp-content/uploads/2021/09/Asotrauma-logo-w.svg"
              class="card-img-top" alt="...">
            </div>
            <div class="card-body user-select-none">
              <h6 class="card-title">Plan #3</h5>
              <p class="card-text small">Peque&ntilde;o detalle del plan</p>
              <label
              for="plan-3"
              class="btn m-auto d-block btn-sm btn-outline-primary"
              :class="(state.plan == '3') ? 'active' : ''"
              x-text="(state.plan == '3') ? 'Seleccionado !!' : 'Seleccionar'"></label>
              <input
              type="radio"
              class="visually-hidden"
              name="plan"
              required
              x-model="state.plan"
              id="plan-3"
              value="3">
            </div>
          </div>
        </div>
      </div>

      <div class="p-4  border-top">
        <button class="btn btn-sm btn-success d-block m-auto">
          Registrar Usuario
        </button>
      </div>
    </form>
  </main>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>

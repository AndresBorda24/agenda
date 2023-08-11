<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("planes/app") ?>
  <title>Planes</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Selecciona tu Plan"
  ]) ?>

  <div
  x-data="{ plan: '' }"
  class="container my-5"
  style="min-height: 60vh;">
    <h1 class="text-center text-primary mb-5">Selecciona tu plan</h1>

    <form @submit.prevent>
      <div class="planes-container row-cols-12 row-cols-md-3 row-cols-lg-4 p-4">
        <template x-for="x in 3">
          <section
          :class="{'planes-item-checked border-primary': plan == x}"
          class="bg-white d-flex flex-column border rounded-1 planes-item overflow-hidden">

            <div class="p-3 border-bottom">
              <span class="d-block text-center text-primary fs-5">
                Nombre del plan
              </span>
              <span class="text-secondary d-block text-center fs-1 fw-bold">
                $ 80.000
              </span>
              <span class="d-block text-center">Vigencia del plan</span>
            </div>

            <ul class="d-flex flex-column my-4 small flex-grow-1 p-0">
              <template x-if="x > 1">
                <li
                class="px-3 py-1 d-flex gap-1 text-muted small">
                  (Incluye todos los beneficios del plan anterior)
                </li>
              </template>
              <template x-for="z in 5">
                <li class="px-3 py-1 d-flex gap-1">
                  <span class="text-primary">
                    <?= $this->fetch("./icons/dbl-check.php") ?>
                  </span>
                  <span class="flex-grow-1">
                    Beneficios # <span x-text="x * z"></span>
                  </span>
                </li>
              </template>
            </ul>

            <div class="p-4 border-top bg-primary">
              <input
              type="radio"
              name="plan"
              x-model="plan"
              :id="x"
              required
              :value="x"
              class="visually-hidden">

              <label
              :for="x"
              role="button"
              class="btn btn-warning btn-sm d-block w-100 mx-auto shadow rounded-5">
                Elegir
              </label>
            </div>
          </section>
        </template>
      </div>

      <div class="mt-5">
        <button
        type="submit"
        class="planes-next-btn">
          Continuar
        </button>
      </div>
    </form>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>

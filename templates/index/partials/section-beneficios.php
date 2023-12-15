<section id="section-beneficios" class="index-section py-5 d-md-flex flex-column container justify-content-center align-items-center px-3 gap-3" style="margin-bottom: 8rem;">
  <div class="text-center text-primary">
    <div class="p-4">
      <span class="d-block mx-auto" style="width: 100px;">
        <?= $this->fetch("./icons/star.php") ?>
      </span>
      <span class="fs-2 text-primary">
        Tus beneficios
      </span>

      <p class="text-dark" style="max-width: 600px;">Hemos diseñado dos planes que atienden las necesidades de pacientes particulares: el <strong>Plan Amarillo</strong> & el <strong>Plan Celeste</strong>.</p>

      <hr>
    </div>
  </div>

  <div class="p-3 bg-white rounded shadow table-responsive" style="order: 1;">
    <table class="small">
      <thead class="border-bottom">
        <tr>
          <th></th>
          <th class="text-center p-2">
            <span class="badge fs-6 text-bg-warning">Amarillo</span>
          </th>
          <th class="text-center text-secondary p-2">
            <span class="badge fs-6 text-bg-primary">Celeste</span>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="fw-bold p-3">
            Consulta Externa Especializada
            <span
              id="beneficios-1"
              class="border d-inline-block ms-2 small px-2 rounded-3 user-select-none"
            >?</span>
          </td>
          <?= $this->fetch("./index/partials/checks.php") ?>
        </tr>
        <template id="beneficios-1-dt">
          <ul class="small m-3 ps-3 py-1">
            <li>Ortopedia</li>
            <li>Medicina Interna</li>
            <li>Cirugía General</li>
            <li>Cirugía Maxilofacial</li>
            <li>Neurocirugía</li>
            <li>Cirugía Plastica</li>
            <li>Oftalmología: Oculoplastia</li>
            <li>Dolor y Cuidados Paliativos</li>
            <li>Medicina Física y Rehabilitación</li>
            <li>Otorrinolaríngologia</li>
            <li>Neurología</li>
            <li>Psicología</li>
          </ul>
        </template>

        <tr>
          <td class="fw-bold p-3">
            Apoyo Diagnóstico y Complementación Terapéutica
            <span
              id="beneficios-2"
              class="border d-inline-block ms-2 small px-2 rounded-3 user-select-none"
            >?</span>
          </td>
          <?= $this->fetch("./index/partials/checks.php") ?>
        </tr>
        <template id="beneficios-2-dt">
          <ul class="small m-3 ps-3 py-1">
            <li>Imágenes Diagnósticas</li>
            <li>Gestión Pretransfusional</li>
            <li>Toma de Muestras de Laboratorio Clínico</li>
            <li>Terapias: Respiratoria, Física & Lenguaje</li>
          </ul>
        </template>

        <tr>
          <td class="fw-bold p-3">
            Internacion
            <span
              id="beneficios-3"
              class="border d-inline-block ms-2 small px-2 rounded-3 user-select-none"
            >?</span>
          </td>
          <?= $this->fetch("./index/partials/checks.php") ?>
        </tr>
        <template id="beneficios-3-dt">
          <ul class="small m-3 ps-3 py-1">
            <li>
              Hospitalización:
              <ul>
                <li>Unidad de Cuidado Intensivo</li>
                <li>Unidad de Cuidado Intermedio Adultos</li>
              </ul>
            </li>
          </ul>
        </template>

        <tr>
          <td class="fw-bold p-3">
            Quirúrgico
            <span
              id="beneficios-4"
              class="border d-inline-block ms-2 small px-2 rounded-3 user-select-none"
            >?</span>
          </td>
          <?= $this->fetch("./index/partials/checks.php") ?>
        </tr>
        <template id="beneficios-4-dt">
          <ul class="small m-3 ps-3 py-1">
            <li>Ortopedia</li>
            <li>Cirugía General</li>
            <li>Cirugía Maxilofacial</li>
            <li>Neurocirugía</li>
            <li>Cirugía Plastica</li>
            <li>Oftalmología: Oculoplastia</li>
            <li>Anestesia</li>
            <li>Transplante de Tejido Osteomuscular</li>
            <li>Otorrinolaríngologia</li>
          </ul>
        </template>

        <tr>
          <td class="fw-bold p-3">
            Atención Inmediata
            <span
              id="beneficios-5"
              class="border d-inline-block ms-2 small px-2 rounded-3 user-select-none"
            >?</span>
          </td>
          <?= $this->fetch("./index/partials/checks.php") ?>
        </tr>
        <template id="beneficios-5-dt">
          <ul class="small m-3 ps-3 py-1">
            <li>Servicio de Uergencias</li>
          </ul>
        </template>

        <tr class="fw-bold">
          <td class="p-3">Cobertura</td>
          <td colspan="2" class="text-center fs-5">8 Afiliados</td>
        </tr>
        <tr class="fw-bold">
          <td class="p-3">Vigencia</td>
          <td colspan="2" class="text-center fs-5">1 Año</td>
        </tr>

        <tr class="border-top">
          <td class="fw-bold p-3">Descuento en la Atención</td>
          <td class="text-center fs-5 p-1">10%</td>
          <td class="text-center fs-5 p-1">15%</td>
        </tr>
        <tr>
          <td class="fw-bold p-3">Costo</td>
          <td class="fw-bold fs-5 p-2">$50.000</td>
          <td class="fw-bold fs-5 p-2">$80.000</td>
        </tr>
      </tbody>
    </table>
  </div>
</section>

<section class="index-section py-5 d-md-flex container px-3 gap-3">
  <div class="text-center text-primary sticky-md-top" style="order: 2;">
    <div class="sticky-md-top p-4">
      <span class="d-block mx-auto" style="width: 100px;">
        <?= $this->fetch("./icons/star.php") ?>
      </span>
      <span class="fs-2 text-primary">
        Tus beneficios
      </span>
      <hr>
    </div>
  </div>

  <div class="p-3 bg-white rounded shadow table-responsive" style="order: 1;">
    <table class="small">
      <thead>
        <tr>
          <th></th>
          <th>Amarillo</th>
          <th>Celeste</th>
        </th>
      </thead>
      <tbody>
        <tr>
          <td class="fw-bold">Consulta Externa Especializada</td>
          <?= $this->fetch("./index/partials/checks.php") ?>
        </tr>
        <tr>
          <td>
            <ul class="small">
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
          </td>
        </tr>
        <tr>
          <td class="fw-bold">Apoyo Diagnóstico y Complementación Terapéutica</td>
          <?= $this->fetch("./index/partials/checks.php") ?>
        </tr>
        <tr>
          <td>
            <ul class="small">
              <li>Imágenes Diagnósticas</li>
              <li>Gestión Pretransfusional</li>
              <li>Toma de Muestras de Laboratorio Clínico</li>
              <li>Terapias: Respiratoria, Física & Lenguaje</li>
            </ul>
          </td>
        </tr>
        <tr>
          <td class="fw-bold">Internacion</td>
          <?= $this->fetch("./index/partials/checks.php") ?>
        </tr>
        <tr>
          <td>
            <ul class="small">
              <li>Hospitalización: Unidad de Cuidado Intensivo, Unidad de Cuidado Intermedio Adultos</li>
            </ul>
          </td>
        </tr>
        <tr>
          <td class="fw-bold">Quirúrgico</td>
          <?= $this->fetch("./index/partials/checks.php") ?>
        </tr>
        <tr>
          <td>
            <ul class="small">
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
          </td>
        </tr>
        <tr>
          <td class="fw-bold">Atención Inmediata</td>
          <?= $this->fetch("./index/partials/checks.php") ?>
        </tr>
        <tr>
          <td>
            <ul class="small">
              <li>Servicio de Uergencias</li>
            </ul>
          </td>
        </tr>
        <tr class="border-top">
          <td class="fw-bold">Descuento en la Atención</td>
          <td class="text-center fs-5 p-1">10%</td>
          <td class="text-center fs-5 p-1">15%</td>
        </tr>
        <tr>
          <td class="fw-bold">Costo</td>
          <td class="fw-bold fs-5 p-2">$50.000</td>
          <td class="fw-bold fs-5 p-2">$80.000</td>
        </tr>
        <tr class="fw-bold">
          <td>Cobertura</td>
          <td colspan="2" class="text-center fs-5">8 Afiliados</td>
        </tr>
        <tr class="fw-bold">
          <td>Vigencia</td>
          <td colspan="2" class="text-center fs-5">1 Año</td>
        </tr>
      </tbody>
    </table>
  </div>
</section>

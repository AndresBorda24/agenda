<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("home/app") ?>
  <title>Home</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Home"
  ]) ?>

  <div class="d-flex p-1 main-container">
    <?= $this->fetch("./partials/aside.php") ?>

    <main class="flex-grow-1 mx-auto" style="max-width: 700px;">
      <section class="mt-3">
        <p class="fw-bold text-primary mb-1">Un poco de informaci&oacute;n:</p>
        <?= $this->fetch("./partials/carrusel/index.php", [
          "img" => [
            $this->asset("img/home/Carrusel-Consulta-externa_01.png"),
            $this->asset("img/home/Carrusel-Consulta-externa_02.png"),
            $this->asset("img/home/Carrusel-Consulta-externa_03.png"),
            $this->asset("img/home/Carrusel-Consulta-externa_04.png"),
            $this->asset("img/home/Carrusel-Consulta-externa_05.png"),
          ]
        ]) ?>
      </section>
      <hr>

      <article class="mx-auto" style="max-width: 500px;">
        <h4 class="text-secondary">Responsabilidad Social Empresarial</h4>
        <p class="p-2 small">Para la Clínica Asotrauma S.A.S el enfoque de la responsabilidad social trasciende desde sus objetivos misionales en contribuir con el desarrollo de la comunidad de la cual hace parte.</p>
        <p class="p-2 small">El mismo quehacer de la medicina y los servicios de salud en general, son una alternativa de vida orientada al servicio de los demás; sin embargo, no es sólo ésta nuestra razón de ser y es por ello que todas nuestras actividades llevan consigo la responsabilidad con el medio ambiente, con nuestros colaboradores y su salud en el trabajo, con la calidad de nuestros servicios como compromiso con el paciente de hacer cada vez mejor nuestra tarea, la responsabilidad con el sistema de salud buscando cada día ser más eficientes y aportar al equilibrio, buscando la sostenibilidad financiera a largo plazo y seguir siendo una alternativa de trabajo para miles de personas.</p>
        <p class="p-2 small">Parece muy ambicioso buscar ser excelentes en tantos aspectos, sin embargo para todos aquellos que hacemos parte de la Clínica Asotrauma es una alternativa de vida buscar la excelencia al servicio de los demás.</p>
        <p class="p-2 small">Así mismo, la clínica busca participar como un ciudadano corporativo en beneficio de la comunidad. Con este enfoque socialmente responsable, apoya de manera especial los programas de fundaciones comprometidas con la desnutrición, el hambre y a mejorar la seguridad alimentaria nutricional de los ibaguereños. También ofrece conjunto de recursos: humanos, técnicos y financieros debidamente dispuestos para atender a las necesidades sociales. Otros aspectos desarrollados en el campo de la responsabilidad social son el cuidado y el compromiso con el medio ambiente y programas de Recursos Humanos dirigidos al bienestar de los colaboradores de la Clínica.</p>
        <p class="p-2 small">Para la Clínica Asotrauma S.A.S el enfoque de la responsabilidad social trasciende desde sus objetivos misionales en contribuir con el desarrollo de la comunidad de la cual hace parte.</p>
        <p class="p-2 small">El mismo quehacer de la medicina y los servicios de salud en general, son una alternativa de vida orientada al servicio de los demás; sin embargo, no es sólo ésta nuestra razón de ser y es por ello que todas nuestras actividades llevan consigo la responsabilidad con el medio ambiente, con nuestros colaboradores y su salud en el trabajo, con la calidad de nuestros servicios como compromiso con el paciente de hacer cada vez mejor nuestra tarea, la responsabilidad con el sistema de salud buscando cada día ser más eficientes y aportar al equilibrio, buscando la sostenibilidad financiera a largo plazo y seguir siendo una alternativa de trabajo para miles de personas.</p>
        <p class="p-2 small">Parece muy ambicioso buscar ser excelentes en tantos aspectos, sin embargo para todos aquellos que hacemos parte de la Clínica Asotrauma es una alternativa de vida buscar la excelencia al servicio de los demás.</p>
        <p class="p-2 small">Así mismo, la clínica busca participar como un ciudadano corporativo en beneficio de la comunidad. Con este enfoque socialmente responsable, apoya de manera especial los programas de fundaciones comprometidas con la desnutrición, el hambre y a mejorar la seguridad alimentaria nutricional de los ibaguereños. También ofrece conjunto de recursos: humanos, técnicos y financieros debidamente dispuestos para atender a las necesidades sociales. Otros aspectos desarrollados en el campo de la responsabilidad social son el cuidado y el compromiso con el medio ambiente y programas de Recursos Humanos dirigidos al bienestar de los colaboradores de la Clínica.</p>
      </article>
    </main>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>

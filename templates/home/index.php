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
      <section class="mt-3 px-3">
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

      <article class="mx-auto py-3 px-4">
        <p class="p-2 small">
          La Clínica Asotrauma, en su compromiso ético y de desarrollo de las personas que atienden y que cuidan, ha construido una política de humanización que alineada con el modelo de atención se centra en el bienestar de los pacientes, entendiendo que en la Clínica trabajan personas que atienden personas; para dar cumplimiento a esta política desarrolla su programa de humanización que cuenta con 4 líneas de trabajo en las cuales se establecen estrategias para el logro de los objetivos trazados.
        </p>

        <p class="p-2 small">
          Las líneas de trabajo en las que se desarrolla el programa de humanización son:
        </p>

        <ul class="small">
          <li>
            <span class="fw-bold">Línea de cultura de la humanización:</span>
            <p>
              Se trata de extender la cultura de la humanización en el conjunto del sistema. Para ello se propone sensibilizar al conjunto de profesionales utilizando la formación como estrategia de sensibilización y la participación como mecanismo de implicación.
            </p>
          </li>
          <li>
            <span class="fw-bold">Línea de calidez del trato:</span>
            <p>
              Responde a la necesidad de dar el mismo trato que nos gustaría recibir, teniendo presente la vulnerabilidad de las personas en sus contactos con el servicio de salud.
            </p>
          </li>
          <li>
            <span class="fw-bold">Línea de información y comunicación:</span>
            <p>
              La mejora de información y comunicación son pasos necesarios para facilitar el empoderamiento para la salud, entendido este como el proceso mediante el que las personas adquieren un mayor control sobre las decisiones y acciones que afectan a su salud.
            </p>
          </li>
          <li>
            <span class="fw-bold">Línea de adecuación del entorno:</span>
            <p>
              El desarrollo de una verdadera cultura de la humanización requiere que se den las condiciones en las que esta pueda desarrollarse, por lo que es necesario construir entornos facilitadores.
            </p>
          </li>
        </ul>


        <p class="p-2 small">
          Entre estos entornos se incluyen los cambios en la infraestructura, los cambios organizativos, los servicios que es preciso contratar y la mejora del ambiente laboral.
        </p>

        <h4 class="text-secondary">Responsabilidad Social Empresarial</h4>
        <p class="p-2 small">
          Para la Clínica Asotrauma
          S.A.S el enfoque de la responsabilidad social trasciende desde sus
          objetivos misionales en contribuir con el desarrollo de la comunidad de
          la cual hace parte.
        </p>
        <p class="p-2 small">
          El mismo quehacer de la
          medicina y los servicios de salud en general, son una alternativa de
          vida orientada al servicio de los demás; sin embargo, no es sólo ésta
          nuestra razón de ser y es por ello que todas nuestras actividades
          llevan consigo la responsabilidad con el medio ambiente, con nuestros
          colaboradores y su salud en el trabajo, con la calidad de nuestros
          servicios como compromiso con el paciente de hacer cada vez mejor
          nuestra tarea, la responsabilidad con el sistema de salud buscando cada
          día ser más eficientes y aportar al equilibrio, buscando la
          sostenibilidad financiera a largo plazo y seguir siendo una alternativa
          de trabajo para miles de personas.
        </p>
        <p class="p-2 small">
          Parece muy ambicioso buscar ser excelentes en tantos aspectos, sin embargo para
          todos aquellos que hacemos parte de la Clínica Asotrauma es una
          alternativa de vida buscar la excelencia al servicio de los demás.
        </p>
        <p class="p-2 small">
          Así mismo, la clínica busca participar como un
          ciudadano corporativo en beneficio de la comunidad. Con este enfoque
          socialmente responsable, apoya de manera especial los programas de
          fundaciones comprometidas con la desnutrición, el hambre y a mejorar la
          seguridad alimentaria nutricional de los ibaguereños. También ofrece
          conjunto de recursos: humanos, técnicos y financieros debidamente
          dispuestos para atender a las necesidades sociales. Otros aspectos
          desarrollados en el campo de la responsabilidad social son el cuidado y
          el compromiso con el medio ambiente y programas de Recursos Humanos
          dirigidos al bienestar de los colaboradores de la Clínica.
        </p>
      </article>
    </main>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>

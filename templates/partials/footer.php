<footer class="bg-secondary overflow-hidden small">
  <div class="grid grid-cols-1 lg:grid-cols-2 max-w-7xl mx-auto py-20 px-7 gap-7">
    <div class="flex flex-col max-w-lg gap-6">
      <div>
        <img
          class="h-[30px] w-auto"
          src="<?= $this->asset("img/logo-blanco-full.png") ?>"
          alt="logo-blanco"
        >
      </div>
      <span class="text-neutral-50 text-sm tracking-wider">
        Trabajamos por tu bienestar y el bienestar de tu familia, por eso en la Clínica Asotrauma trabajamos para ti y para todos.
      </span>
      <div class="flex gap-6 items-center">
        <a
          class="text-decoration-none text-neutral-100 hover:text-neutral-300 [&>svg]:w-6 [&>svg]:h-6"
          href="https://www.facebook.com/Clinicaasotrauma/"
          target="_blank"
          title="Facebook | Clinicaasotrama"
        ><?= $this->fetch('icons/facebook.php') ?></a>
        <a
          class="text-decoration-none text-neutral-100 hover:text-neutral-300 [&>svg]:w-6 [&>svg]:h-6"
          href="https://www.instagram.com/clinicaasotrauma/"
          target="_blank"
          title="Instagram | clinicaasotrauma"
        ><?= $this->fetch('icons/insta.php') ?></a>
        <a
          class="text-decoration-none text-neutral-100 hover:text-neutral-300 [&>svg]:w-6 [&>svg]:h-6"
          href="https://www.youtube.com/c/ClinicaAsotrauma"
          target="_blank"
          title="Youtube |  Cl&iacute;nica Asotrauma"
        ><?= $this->fetch('icons/youtube.php') ?></a>
      </div>
    </div>
  </div>

  <div class="text-neutral-200 flex flex-col lg:flex-row flex-wrap !gap-4 lg:!gap-7 px-7 justify-center py-7 bg-blue-800 text-sm">
    <span class="flex !gap-2 items-center">
      <span class="text-neutral-200 [&>svg]:w-6 [&>svg]:h-6"><?= $this->fetch("./icons/location.php") ?></span>
      Cra. 4D No. 32 - 34 , Ibagu&eacute;, Tolima
    </span>
    <span class="flex !gap-2 items-center">
      <span class="text-neutral-200 [&>svg]:w-6 [&>svg]:h-6"><?= $this->fetch("./icons/mail.php") ?></span>
      <a
        class="text-decoration-none text-white"
        href="mailto:gerencia@asotrauma.com.co"
      > gerencia@asotrauma.com.co </a>
    </span>
    <span class="flex !gap-2 items-center">
      <span class="text-neutral-200 [&>svg]:w-6 [&>svg]:h-6"><?= $this->fetch("./icons/phone.php") ?></span>
      (8) 515 - 3000
    </span>
  </div>

  <div class="bg-blue-900 px-2 py-3 text-center text-white small">
    <p class="my-0 mx-auto" style="max-width: 400px;">
      Si tienes alg&uacute;n problema con la p&aacute;gina o alguna solicitud puedes enviar un correo a
      <a
        href="mailto:soporte@asotrauma.com.co"
        class="fw-bold text-decoration-none text-white"
      >soporte@asotrauma.com.co</a>
    </p>
  </div>
</footer>

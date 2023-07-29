<header class="bg-primary">
  <div class="container p-3 d-flex align-items-center justify-content-between">
    <img
    height="25"
    src="https://asotrauma.com.co/wp-content/uploads/2021/08/logo-asotrauma-w.svg"
    alt="logo-blanco">
    <?php if($this->auth->user() !== null): ?>
      <span class="text-light small fw-bold">
        <span class="small fw-light">Hola:</span>
        <?= $this->auth->user()->fullName() ?>
      </span>
    <?php endif ?>
  </div>
</header>
<div class="bg-secondary text-light shadow sticky-top">
  <div class="container nav-scroller p-1 d-flex container justify-content-between align-items-center">
    <span class="fs-5"><?=  $title ?? "Cl&iacute;nica Asotrauma" ?></span>
    <nav class="nav small gap-1">
      <?php if($this->auth->user() !== null): ?>
        <a
        class="btn btn-outline-light border-0 btn-sm
        <?= $this->isRoute('logout') ? 'active' : '' ?>"
        href="<?= $this->link("logout") ?>">Cerrar Sesi&oacute;n!</a>
      <?php else: ?>
        <a
        class="btn btn-outline-light border-0 btn-sm
        <?= $this->isRoute('login') ? 'active' : '' ?>"
        href="<?= $this->link("login") ?>">Login</a>
        <a
        class="btn btn-outline-light border-0 btn-sm
        <?= $this->isRoute('pacientes.registro') ? 'active' : '' ?>"
        href="<?= $this->link("pacientes.registro") ?>">Registro!</a>
      <?php endif ?>
    </nav>
  </div>
</div>

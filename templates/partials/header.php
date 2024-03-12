<header class="bg-primary">
  <div class="container p-3 d-flex align-items-center justify-content-between">
    <a href="https://asotrauma.com.co/" target="_blank" class="d-block">
      <img
      height="25"
      src="<?= $this->asset("img/logo-blanco-full.png") ?>"
      alt="logo-blanco">
    </a>
    <?php if($this->user() !== null): ?>
      <span class="text-light small fw-bold text-end">
        <span class="small fw-light">Hola:</span>
        <?= $this->user()->fullName() ?>
      </span>
    <?php endif ?>
  </div>
  <div class="p-1 text-bg-warning text-center bg-blue-800">
    <a
    class="fs-6 text-light fst-italic fw-bold text-decoration-none"
    href="<?= $this->link("index") ?>">Programa de Fidelización</a>
  </div>
</header>
<div class="bg-secondary text-light shadow sticky-top">
  <div class="container nav-scroller d-flex container justify-content-between align-items-center">
    <?php if($title !== false): ?>
      <span class="fs-5 p-1"><?=  $title ?? "Cl&iacute;nica Asotrauma" ?></span>
    <?php endif ?>

    <nav class="nav ms-auto small gap-1" id="header-nav">
      <?php if($this->user() == null): ?>
        <a
        class="btn btn-outline-light border-0 btn-sm m-1
        <?= $this->isRoute('login') ? 'active' : '' ?>"
        href="<?= $this->link("login") ?>">Login</a>
        <a
        class="btn btn-outline-light border-0 btn-sm m-1
        <?= $this->isRoute('registro') ? 'active' : '' ?>"
        href="<?= $this->link("registro") ?>">Registro!</a>
      <?php elseif($this->isRoute("index")): ?>
        <a
        class="btn btn-outline-light border-0 btn-sm m-1"
        href="<?= $this->link("home") ?>">Home!</a>
      <?php endif ?>
    </nav>
  </div>
</div>

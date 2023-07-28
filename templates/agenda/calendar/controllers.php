<div class="d-flex gap-1 align-items-center border-bottom p-3">
  <button class="btn btn-outline-dark lh-1 px-1 btn-sm rounded-circle"
  x-data="changeCalendarMonth(true)" @click="ch">
    <?= $this->fetch("./icons/left.php") ?>
  </button>
  <button class="btn btn-outline-dark lh-1 px-1 btn-sm rounded-circle"
  x-data="changeCalendarMonth" @click="ch">
    <?= $this->fetch("./icons/right.php") ?>
  </button>
  <div class="flex-fill" x-data="dateName" x-bind="events">
    <span class="text-muted text-uppercase" x-text="month"></span>
    <span class="text-muted text-uppercase" x-text="year"></span>
  </div>
</div>

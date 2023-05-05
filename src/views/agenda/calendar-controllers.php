<div class="d-flex gap-1 align-items-center border-bottom p-3">
  <button class="btn btn-outline-secondary btn-sm rounded-circle border-0" x-data="changeCalendarMonth(true)" @click="ch">
    <i class="bi bi-caret-left-fill"></i>
  </button>
  <button class="btn btn-outline-secondary btn-sm rounded-circle border-0" x-data="changeCalendarMonth" @click="ch">
    <i class="bi bi-caret-right-fill"></i>
  </button>
  <div class="flex-fill" x-data="dateName" x-bind="events">
    <span class="text-muted text-uppercase" x-text="month"></span>
    <span class="text-muted text-uppercase" x-text="year"></span>
  </div>
</div>

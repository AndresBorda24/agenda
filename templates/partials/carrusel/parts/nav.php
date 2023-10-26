<nav class="mt-2 d-flex">
  <button
    @click="prev"
    class="btn btn-sm btn-primary"
  ><</button>
  <div class="align-items-center d-flex flex-grow-1 gap-1 justify-content-center">
    <template x-for="(x, i) in total" :key="i">
      <span
        role="button"
        @click="setCurrent(i)"
        :class="(current === i) && 'bg-primary'"
        class="ratio-1 border rounded-circle border-secondary"
        style="width: 11px; height: 11px;"
      ></span>
    </template>
  </div>
  <button
    @click="next"
    class="btn btn-sm btn-primary"
  >></button>
</nav>

<nav class="mt-2 flex px-2 py-2 bg-aso-secondary rounded-full">
  <button
    @click="prev"
    class="leading-none bg-aso-primary text-white rounded-full p-2"
  ><?= $this->fetch('icons/left.php') ?></button>
  <div class="align-items-center d-flex flex-grow-1 gap-1 justify-content-center">
    <template x-for="(x, i) in total" :key="i">
      <span
        role="button"
        @click="setCurrent(i)"
        :class="(current === i) && 'bg-primary'"
        class="ratio-1 border rounded-circle"
        style="width: 11px; height: 11px;"
      ></span>
    </template>
  </div>
  <button
    @click="next"
    class="leading-none bg-aso-primary text-white rounded-full p-2"
  ><?= $this->fetch('icons/right.php') ?></button>
</nav>

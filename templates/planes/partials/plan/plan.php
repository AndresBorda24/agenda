<section
:class="{'planes-item-checked border-primary': (selectedPlan == plan.id) }"
class="bg-white d-flex flex-column border rounded-1 planes-item overflow-hidden">
  <?= $this->fetch("./planes/partials/plan/header.php") ?>
  <?= $this->fetch("./planes/partials/plan/beneficios.php") ?>
  <?= $this->fetch("./planes/partials/plan/footer.php") ?>
</section>
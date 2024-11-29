import { createOrder } from "../requests"
import { errorAlert } from "@/partials/alerts";
import { showLoader, hideLoader } from "@/partials/loader";
import Alpine from "alpinejs";

export default () => ({
  /** Valida que este seleccionado uno de los planes. */
  checkSelectedPlan() {
    const { plan } = Alpine.store('SelectedPlanStore');
    if (!Boolean(plan)) return false;

    return plan;
  },

  /**
   * Crea el link y redirecciona al usuario a la vista para terminar el proceso
   * de pago.
   * @returns {boolean}
   */
  async generateLink() {
    const planId = this.checkSelectedPlan();
    if (! planId) {
      errorAlert('Por favor selecciona un plan valido.')
      return false;
    }

    showLoader();
    const url = await this.getLink(planId);
    if (url === false) {
      hideLoader();
      errorAlert('Ha ocurrido un error al generar el link. Intenta más tarde.');
      return false
    }

    window.location.href = url;
  },

  async getLink(planId) {
    const [error, data] = await createOrder( planId );
    if (error) {
      return false;
    }

    return data.url;
  }
})

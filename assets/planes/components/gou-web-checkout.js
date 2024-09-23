import { createOrder } from "../requests"
import { errorAlert } from "@/partials/alerts";
import { showLoader, hideLoader } from "@/partials/loader";

export default () => ({
  /** Valida que este seleccionado uno de los planes. */
  checkSelectedPlan() {
    const v = document.querySelector('input[name="plan"]:checked')?.value;
    return (v === undefined) ? false : v;
  },

  /**
   * Crea el link y redirecciona al usuario a la vista para terminar el proceso
   * de pago.
   * @returns {boolean}
   */
  async generateLink() {
    const planId = this.checkSelectedPlan();
    if (! planId) {
      window.scrollTo({ top: 0, behavior: "smooth" });
      errorAlert('Por favor selecciona un plan.')
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

import { errorAlert } from "@/partials/alerts";
import { getProcessUrl, hasPending } from "../requests";
import { hideLoader, showLoader } from "@/partials/loader";

export default () => ({
  showConfirmation: false,

  /**
   * @returns Retorna true si no Tiene nigun pendiente, false de otra manera.
   */
  async checkPending(orderItemType: string) {
    showLoader();
    const {data} = await hasPending(orderItemType);

    if (data === true) {
      hideLoader();
      this.showConfirmation = true;
      return false;
    }

    return true;
  },

  async startProcess(event: PointerEvent) {
    const button = event.currentTarget as HTMLButtonElement;
    const { orderItemId, orderItemType } = button.dataset;

    if (!Boolean(orderItemId) ||!Boolean(orderItemType)) {
      // Hay que pensar que hacer en estos casos...
      return;
    }
    if (await this.checkPending(orderItemType) === false) {
      return;
    }

    showLoader();
    const {data, error} = await getProcessUrl(orderItemId);

    if (error) {
      hideLoader();
      errorAlert('Ha ocurrido un error al procesar la solicitud, por favor intenta luego.');
      return;
    }

    window.location.href = data.url;
  }
})

import { errorAlert } from "@/partials/alerts";
import { getProcessUrl } from "../requests";
import { hideLoader, showLoader } from "@/partials/loader";

export default () => ({
  async startProcess(event: PointerEvent) {
    const button = event.currentTarget as HTMLButtonElement;
    const { orderItemId } = button.dataset;

    if (!Boolean(orderItemId)) {
      // Hay que pensar que hacer en estos casos...
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

import { errorAlert } from "@/partials/alerts";
import { getUserFiles } from "../requests";

export default () => ({
  show: false,
  orders: [],

  async init() {
    const {data, error} = await getUserFiles()

    if (error) {
      errorAlert("Error al cargar el listado de pagos.");
      return;
    }

    this.orders = data;
  },

  openModal() {
    document.body.classList.add('overflow-hidden');
    this.show = true;
  },

  closeModal() {
    document.body.classList.remove('overflow-hidden');
    this.show = false;
  },

  getLinkPendiente(orderId: string | number) {
    const data = btoa(JSON.stringify({ref:orderId}));
    const url = import.meta.env.VITE_APP_URL + `/gateway/${data}/finished`
    return url;
  },

  buildFileUrl(fileId: string) {
    const url = import.meta.env.VITE_APP_URL + `/files/${fileId}/user-file`
    return url;
  }
});

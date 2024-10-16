import axios, { AxiosError } from "axios";

const ax = axios.create({
  baseURL: import.meta.env.VITE_APP_API
});

ax.interceptors.response.use((response) => {
    return response;
}, /** @param error { AxiosError } */ function (error) {
    if (error.response?.status == 401) {
        window.location.replace( error.response.data.location || "/login" );
    }
    return Promise.reject(error);
});

export default ax;

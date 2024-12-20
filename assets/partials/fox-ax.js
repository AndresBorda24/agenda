import { errorAlert } from "./alerts";
import axios, { AxiosError } from "axios";

const ax = axios.create({
    baseURL: import.meta.env.VITE_FOX_API,
    headers: {
        'Content-Type': "application/json",
    }
});

ax.interceptors.response.use((response) => {
    return response;
}, /** @param error { AxiosError } */ function (error) {
    errorAlert();
    return Promise.reject(error);
});

export default ax;

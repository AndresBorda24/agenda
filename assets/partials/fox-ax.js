import { errorAlert } from "./alerts";
import axios, { AxiosError } from "axios";

const ax = axios.create({
    baseURL: process.env.FOX_API,
    headers: {
        'Content-Type': "application/json",
        "ngrok-skip-browser-warning": "69420"
    }
});

ax.interceptors.response.use((response) => {
    return response;
}, /** @param error { AxiosError } */ function (error) {
    errorAlert();
    return Promise.reject(error);
});

export default ax;

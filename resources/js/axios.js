import axios from "axios";
import router from "@/router";

window.axios = require("axios");
window.axios.defaults.withCredentials = true;

// Add a response interceptor
axios.interceptors.response.use(
    function (response) {
        return response;
    },
    function (error) {
        if (404 === error.response.status) {
            router.push("/404");
        }

        return Promise.reject(error.response);
    }
);

export default axios;

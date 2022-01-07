import axios from "axios";
import router from "@/router";
import i18n from '@/i18n'
import Vue from "vue";

window.axios = require("axios");
window.axios.defaults.withCredentials = true;

// Add a response interceptor
axios.interceptors.response.use(
    response => {
        if (response.config.showToast) {
            const vm = new Vue();
            vm.$bvToast.toast(i18n.t(response.data.message), {
                title: "Success",
                variant: "success",
                toaster: "b-toaster-bottom-right",
                solid: true,
            });
        }
        return response;
    },
    error => {
        if (404 === error.response.status) {
            router.push("/404");
            return Promise.reject(error.response);
        }

        const vm = new Vue();
        vm.$bvToast.toast(i18n.t(error.response.data.message), {
            title: "Error",
            variant: "danger",
            toaster: "b-toaster-bottom-right",
            solid: true,
        });

        return Promise.reject(error.response);
    }
);

export default axios;

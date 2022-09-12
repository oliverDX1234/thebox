import axios from "axios";
import router from "@/router";
import i18n from '@/i18n'
import state from "./state/store"
import Vue from "vue";

window.axios = require("axios");
window.axios.defaults.withCredentials = true;

// Add a response interceptor
axios.interceptors.response.use(
    response => {

        const vm1 = new Vue();

        if (response.config.showToast) {
            vm1.$bvToast.toast(i18n.t(response.data.message), {
                title: "Success",
                variant: "success",
                toaster: "b-toaster-bottom-right",
                solid: true,
            });
        }
        return response;
    }
    ,
    error => {

        const vm2 = new Vue();

        switch (error.response.status) {
            case 419: // Session expired

                if(error.response.message === "Unauthenticated."){
                    state.commit('auth/logout');

                    vm2.$bvToast.toast("Session expired. Please log in again.", {
                        title: "Error",
                        variant: "danger",
                        toaster: "b-toaster-bottom-right",
                        solid: true,
                    });

                    setTimeout(router.push("/admin/login"), 500);
                }

                return Promise.reject(error.response);
            case 404:
                router.push("/404");
                return Promise.reject(error.response);
        }

        vm2.$bvToast.toast(i18n.t(error.response.data.message), {
            title: "Error",
            variant: "danger",
            toaster: "b-toaster-bottom-right",
            solid: true,
        });

        return Promise.reject(error.response);
    }
);

export default axios;

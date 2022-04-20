import Vue from "vue";
import App from "./App.vue";
import BootstrapVue from "bootstrap-vue";
import VueApexCharts from "vue-apexcharts";
import Vuelidate from "vuelidate";
import VueSweetalert2 from "vue-sweetalert2";
import VueNestable from 'vue-nestable'
import axios from "@/axios";
import VueMask from "v-mask";
import * as VueGoogleMaps from "vue2-google-maps";
import VueYoutube from "vue-youtube";
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import '../sass/custom/customStyle.css';

import vco from "v-click-outside";

import router from "./router";
import store from "./state/store";
import i18n from "./i18n";

import imagePlugin from "./plugins/imagePlugin";
import notificationPlugin from "./plugins/notificationPlugin";
const VueScrollTo = require('vue-scrollto')

/*
 * Move to separate file
 * */
window.axios = require("axios");
window.axios.defaults.withCredentials = true;
Vue.prototype.$http = axios;

Vue.config.productionTip = false;
Vue.use(VueYoutube);
Vue.use(BootstrapVue);
Vue.use(vco);
Vue.use(VueScrollTo)
Vue.use(Vuelidate);
Vue.use(VueSweetalert2);
Vue.use(VueMask);
Vue.use(require("vue-chartist"));
Vue.use(imagePlugin);
Vue.use(notificationPlugin);
Vue.use(VueNestable);
Vue.use(VueGoogleMaps, {
    load: {
        key: "AIzaSyAbvyBxmMbFhrzP9Z8moyYr6dCr-pzjhBE",
        libraries: "places",
    },
    installComponents: true,
});

Vue.component("apexchart", VueApexCharts);
Vue.component('v-select', vSelect)

new Vue({
    router,
    store,
    i18n,
    render: (h) => h(App),
}).$mount("#app");

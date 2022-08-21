import Vue from "vue";
import App from "./App.vue";


//Import npm packages
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
import vco from "v-click-outside";
import moment from 'moment'
import CKEditor from '@ckeditor/ckeditor5-vue2';
import Multiselect from "vue-multiselect";

const VueScrollTo = require('vue-scrollto')

//Import styles
import 'vue-select/dist/vue-select.css';

//Import global components
import loadSpinner from "./components/reusable/LoadSpinner";

//Import core vue packages
import router from "./router";
import store from "./state/store";
import i18n from "./i18n";

//Import global plugins
import imagePlugin from "./plugins/imagePlugin";
import notificationPlugin from "./plugins/notificationPlugin";

//Assign prototypes
Vue.prototype.moment = moment
Vue.prototype.$http = axios;

//Attach components to vue instance
Vue.component("load-spinner", loadSpinner);
Vue.component("apexchart", VueApexCharts);
Vue.component('v-select', vSelect)
Vue.component("multiselect", Multiselect)

//Use plugins and packages
Vue.use(VueYoutube);
Vue.use(BootstrapVue);
Vue.use(vco);
Vue.use(VueScrollTo)
Vue.use(Vuelidate);
Vue.use(VueSweetalert2);
Vue.use( CKEditor );
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


//Create vue instance and mount to app id
new Vue({
    router,
    store,
    i18n,
    render: (h) => h(App),
}).$mount("#app");

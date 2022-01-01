export default {
    install(Vue) {
        /**
         * Show Error notificatons  the application
         * @param title
         * @param text
         */
        Vue.prototype.makeToast = function (variant = null, text , title) {
            this.$bvToast.toast(text, {
                title: title,
                variant: variant,
                toaster: "b-toaster-bottom-right",
                solid: true,
            });
        };
    },
};

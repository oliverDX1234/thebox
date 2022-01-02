export default {
    install(Vue) {
        /**
         * Show Error notificatons  the application
         * @param title
         * @param text
         */
        Vue.prototype.makeToast = function (
            variant = null,
            text,
            title = null
        ) {
            if (title === null) {
                switch (variant) {
                    case "success":
                        title = "Success";
                        break;
                    case "danger":
                        title = "Error";
                        break;
                    case "warning":
                        title = "Warning";
                        break;
                    case "primary":
                        title = "Notification";
                        break;
                    case "info":
                        title = "Information";
                        break;
                }
            }

            this.$bvToast.toast(text, {
                title: title,
                variant: variant,
                toaster: "b-toaster-bottom-right",
                solid: true,
            });
        };
    },
};

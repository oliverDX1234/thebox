import moment from "moment";

export default {
    install(Vue) {
        /**
         * Show Error notificatons  the application
         * @param title
         * @param text
         */
        Vue.prototype.hasDiscount = function (price) {

            if (!price.discounted_price) {
                return false;
            }
            const date = new Date();

            let dateUntil = new Date(price.discount_valid_until);
            let dateNow = new Date(moment(new Date().toLocaleString('en-US', {
                hour12: false,
            })).format('YYYY-MM-DD, HH:mm:ss'));

            if (dateUntil < dateNow) {
                return false;
            }

            return true;
        };
    },
};

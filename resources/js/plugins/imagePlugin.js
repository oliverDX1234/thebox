export default {
    install(Vue) {
        /**
         * Show Error notificatons  the application
         * @param title
         * @param text
         */
        Vue.prototype.getImgUrl = function (
            imgName
        ) {
            
            let urlName = imgName.replace(/\s/g, "");
            return require(`@/assets/images/${urlName}`).default;
        };
    },
};

export default {
    install(Vue) {
        /**
         * Show Error notificatons  the application
         * @param title
         * @param text
         */
        Vue.prototype.getImgUrl = function (imgName) {
            let imgSplited = imgName.split(".");
            let imgExtension = imgSplited[imgSplited.length - 1];

            switch (imgExtension) {
                case "jpg":
                    return require(`@assets/images${imgSplited[0]}.jpg`);
                case "jpeg":
                    return require(`@assets/images${imgSplited[0]}.jpeg`);
                case "png":
                    return require(`@assets/images${imgSplited[0]}.png`);
                case "gif":
                    return require(`@assets/images${imgSplited[0]}.gif`);
                case "svg":
                    return require(`@assets/images${imgSplited[0]}.svg`);
            }
        };
    },
};

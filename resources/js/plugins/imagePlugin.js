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
                    return require(`@assets/images${imgSplited[0]}.jpg`)
                        .default;
                case "jpeg":
                    return require(`@assets/images${imgSplited[0]}.jpeg`)
                        .default;
                case "png":
                    return require(`@assets/images${imgSplited[0]}.png`)
                        .default;
                case "gif":
                    return require(`@assets/images${imgSplited[0]}.gif`)
                        .default;
                case "svg":
                    return require(`@assets/images${imgSplited[0]}.svg`)
                        .default;
            }
        };
    },
};

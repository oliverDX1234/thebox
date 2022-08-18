import Vue from "vue";
import VueRouter from "vue-router";
import VueMeta from "vue-meta";

import routes from "./routes";
import { authenticated, admin, guest } from "./middleware";

Vue.use(VueRouter);
Vue.use(VueMeta, {
    keyName: "page",
});

const router = new VueRouter({
    routes,
    mode: "history",
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { x: 0, y: 0 };
        }
    },
});

router.beforeEach((to, from, next) => {
    if (to.meta.authRequired) {
        authenticated(next);
    } else if (to.meta.admin) {
        admin(next);
    } else if (to.meta.guest) {
        guest(next);
    } else {
        next();
    }
});

export default router;

import state from "@/state/store";

function isLoggedIn() {
    return state.getters["auth/isLoggedIn"];
}

function isAdmin() {
    return state.getters["auth/user"].roles === "admin";
}

const authenticated = (next) => {
    if (!isLoggedIn()) {
        next("/login");
        return;
    }
    next();
};

const admin = (next) => {
    if (!isLoggedIn()) {
        next("/admin/login");
        return;
    }

    if (isLoggedIn() && !isAdmin()) {
        next("/404");
        return;
    }

    next();
};

const guest = (next) => {
    if(isLoggedIn() && isAdmin()) {
        next('/admin')
        return
    }

    if (isLoggedIn()) {
        next("/");
        return;
    }

    next();
};

export { authenticated, admin, guest };

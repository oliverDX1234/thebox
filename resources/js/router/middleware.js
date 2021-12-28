import authService from "../services/authService";

const authenticated = next => {
    //TODO replace with auth service wrapper
    if (!authService.auth()) {
        next('/login');
        return
    }
    next()
}

const guest = next => {
    if (authService.auth()) {
        next('/');
        return
    }
    next()
}

export {
    authenticated,
    guest
}


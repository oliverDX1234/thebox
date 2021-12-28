import authService from "../services/authService";

const authenticated = next => {
    // console.log("Checking if user is authenticated")
    if (!authService.auth()) {
        // console.log("User is not authenticated!")
        next('/login');
        return
    }
    next()
}

const guest = next => {
    // console.log("Checking if user is a guest")
    if (authService.auth()) {
        // console.log("User is not a guest!")
        next('/');
        return
    }
    next()
}

export {
    authenticated,
    guest
}


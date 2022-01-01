import authService from "../services/authService";

function isLoggedIn(){
    return localStorage.getItem("loggedSession");
}

const authenticated = next => {
    if (!isLoggedIn()) {
        next('/login');
        return
    }
    next()
}

const guest = next => {
    // console.log("Checking if user is a guest")
    if (isLoggedIn()) {
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


import AuthService from "../../services/authService";

export const state = window.Laravel.user ?
    {user: window.Laravel.user, loggedIn: true} :
    {loggedIn: false};

export const actions = {
    async login({commit}, {email, password}) {
        return AuthService.login(email, password).then(
            user => {
                commit('loginSuccess', user);
            }
        );
    },
    async logout({commit}) {
        AuthService.logout().then(
            () => commit('logout'),
            () => commit('logout')
        );
    },
}
export const mutations = {
    logout(state) {
        state.loggedIn = false;
        state.user = {};
    },
    loginSuccess(state, user) {
        state.loggedIn = true;
        state.user = user;
    },
}

export const getters = {
    user: state => state.user,
    loggedIn: state => state.loggedIn
}


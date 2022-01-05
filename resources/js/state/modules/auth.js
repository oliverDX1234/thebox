import AuthService from "../../services/authService";

export const state = {
    user: window.Laravel.user,
    isLoggedIn: window.Laravel.isLoggedIn,
};

export const actions = {
    async login({commit}, {email, password, rememberMeInput}) {
        let user = await AuthService.login(email, password, rememberMeInput);
        commit("loginSuccess", user);
    },

    async logout({commit}) {
        await AuthService.logout();
        commit("logout");
    },
};

export const mutations = {
    logout(state) {
        state.isLoggedIn = false;
        window.Laravel.user = {};
        window.Laravel.isLoggedIn = false;
        state.user = {};
    },

    loginSuccess(state, user) {
        state.isLoggedIn = true;
        state.user = user;
    },
};

export const getters = {
    user: (state) => state.user,
    isLoggedIn: (state) => state.isLoggedIn,
};

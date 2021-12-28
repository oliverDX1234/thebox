import AuthService from "../../services/authService";

export const state = window.Laravel.user ?
    {user: window.Laravel.user, loggedIn: true} :
    {loggedIn: false};

export const actions = {
    async login({commit}, {email, password}) {
        let user = await AuthService.login(email, password)
        commit('loginSuccess', user)
    },
    async logout({commit}) {
        try {
            await AuthService.logout()
        } catch (e) {
        //    TODO handle logout error
        } finally {
            commit('logout')
        }
    },
}
export const mutations = {
    logout(state) {
        state.loggedIn = false;
        state.user = undefined;
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


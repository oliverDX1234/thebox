import AuthService from "../../services/authService";

export const state = {
    user: {},
    loggedIn: false,
};

export const actions = {
    async login({ commit }, { email, password }) {
        let user = await AuthService.login(email, password);

        commit("loginSuccess", user);
    },



    checkSession({ commit }) {
        if (localStorage.getItem("loggedSession")) {
            let user = {};
            AuthService.getUser().then( (response) =>{
                user = response;

                commit("checkSession", user);
            } );
        }
    },

    async logout({ commit }) {
        try {
            await AuthService.logout();
        } catch (e) {
            //    TODO handle logout error
        } finally {
            commit("logout");
        }
    },
};
export const mutations = {
    logout(state) {
        state.loggedIn = false;
        localStorage.removeItem("loggedSession");
        state.user = {};
    },

    checkSession(state, user) {
        if (localStorage.getItem("loggedSession")) {
            state.loggedIn = true;
            state.user = user.data;
        }
    },

    loginSuccess(state, user) {
        state.loggedIn = true;
        localStorage.setItem("loggedSession", true);
        state.user = user;
    },
};

export const getters = {
    user: (state) => state.user,
    loggedIn: (state) => state.loggedIn,
};

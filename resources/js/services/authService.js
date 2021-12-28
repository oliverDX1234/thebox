import axios from 'axios'
import store from '../state/store'

const AuthService = {

    async login(email, password) {
        let response = await axios.post('login', {email, password});
        return response.data.user;
    },

    async logout() {
        return axios.post('api/logout');
    },

    auth() {
        return store.getters['auth/loggedIn'];
    },

}

export default AuthService

import axios from 'axios'
import store from '../state/store'

const AuthService = {

    login(email, password) {
        return axios.post('login', {email, password}).then(
            response => {
                return Promise.resolve(response.data.user);
            }
        );
    },

    logout() {
        return axios.post('/api/logout');
    },

    auth() {
        console.log("user auth is ", store.getters['auth/loggedIn']);
        return store.getters['auth/loggedIn'];
    },

}

export default AuthService

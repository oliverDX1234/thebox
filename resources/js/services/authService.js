import axios from 'axios'
import store from '../state/store'
import {authGetters} from "@/state/helpers";

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
        console.log("Auth service says user auth is : " + store.getters['auth/loggedIn'])
        return store.getters['auth/loggedIn'];
    },

}

export default AuthService

import axios from 'axios'
import store from '../state/store'

const AuthService = {

    async login(email, password) {
        let response = await axios.post('api/login', {email, password});
            return response.data.user;
    },

    async logout() {
        return axios.post('api/admin/logout');
    },


    getUser() {
        return axios.post('api/admin/me');
    }

}

export default AuthService

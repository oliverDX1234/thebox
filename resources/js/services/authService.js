import axios from 'axios'
import store from '../state/store'

const AuthService = {


    async login(email, password, rememberMeInput) {
        let response = await axios.post('/api/admin/login', {email, password, rememberMeInput});
            return response.data.user;
    },

    async logout() {
        return axios.post('/api/admin/logout');
    },


    
    getUser() {
        return axios.post('/api/admin/me');
    }

}

export default AuthService

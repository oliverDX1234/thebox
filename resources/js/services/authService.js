import axios from 'axios'

const AuthService = {

    async login(email, password, rememberMeInput) {
        let response = await axios.post('/api/admin/login', {email, password, rememberMeInput});
        return response.data.payload.user;
    },

    async forgotPassword(email) {
        return axios.post('/api/password/email', {email},{
            showToast: true
        })
    },

    async resetPassword(email, password, confirm_password, token) {
        return axios.post('/api/password/reset', {email, password, confirm_password, token},{
            showToast: true
        })
    },

    async logout() {
        return axios.post('/api/admin/logout');
    },

}

export default AuthService

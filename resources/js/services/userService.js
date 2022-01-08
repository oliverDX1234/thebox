import router from "@/router"

const UserService = {

    async getUser(id) {
        let response = await axios.get(`/api/users/${id}`);
        return response.data.payload.user;
    },


    async getUsers() {
        let response = await axios.get(`/api/users`);
        return response.data.payload.users;
    },

    async storeUser(formData) {
        await axios.post(`/api/users`, formData, {
            showToast: true
        });
        await router.push("/admin/users");
    },


    async updateUser(id, formData) {
        await axios.post(`/api/users/${id}`, formData, {
            showToast: true
        });
    },


    async deleteUser(id) {
        let response = await axios.delete(`/api/users/${id}`, {
            showToast: true
        });

        return response.data.payload.user;

    }


}

export default UserService

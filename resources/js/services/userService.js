import router from "@/router"

const UserService = {

    async getUser(id) {
        let response = await axios.get(`/api/user/${id}`);
        return response.data.payload.user;
    },

    async storeUser(formData) {
        let response = await axios.post(`/api/user`, formData, {
            showToast: true
        });
        await router.push("/admin/users");
    },


    async updateUser(id, formData) {
        let response = await axios.post(`/api/user/${id}`, formData, {
            showToast: true
        });
    }


}

export default UserService

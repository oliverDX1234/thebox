import router from "@/router"
import store from "@/state/store"

const UserService = {

    async getUser(id) {
        let response = await axios.get(`/api/users/${id}`);
        return response.data.payload.user;
    },


    async getUsers(filters = null) {
        let response = await axios.get(`/api/users`, {
            params: filters
        });
        return response.data.payload.users;
    },

    async storeUser(formData) {
        await axios.post(`/api/users`, formData, {
            showToast: true
        });
        await router.push("/admin/users");
    },


    async updateUser(id, formData) {
        let response = await axios.post(`/api/users/${id}`, formData, {
            showToast: true
        });

        //If the logged in user is updating his information
        if(store.getters["auth/user"].id === response.data.payload.user.id){

            store.commit("auth/updateUser", response.data.payload.user);
        }

    },


    async deleteUser(id) {
        let response = await axios.delete(`/api/users/${id}`, {
            showToast: true
        });

        return response.data.payload.user;

    }


}

export default UserService

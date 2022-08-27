import store from "@/state/store"

const OrderService = {

    async getOrder(id) {
        let response = await axios.get(`/api/orders/${id}`);

        return response.data.payload.order;
    },

    async getOrders(filters = null) {
        let response = await axios.get(`/api/orders`, {
            params: filters
        });

        return response.data.payload.orders;
    },

    async storeOrder(formData) {
        await axios.post(`/api/orders`, formData, {
            showToast: true
        });
    },

    async updateOrder(id, formData) {
        let response = await axios.post(`/api/orders/${id}`, formData, {
            showToast: true
        });

        //If the logged in order is updating his information
        if(store.getters["auth/order"].id === response.data.payload.order.id){

            store.commit("auth/updateOrder", response.data.payload.order);
        }

    },

    async deleteOrder(id) {
        let response = await axios.delete(`/api/orders/${id}`, {
            showToast: true
        });

        return response.data.payload.order;
    }
}

export default OrderService

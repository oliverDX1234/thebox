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

    async storeOrder(payload) {
        await axios.post(`/api/orders`, payload, {
            showToast: true
        });
    },

    async updateOrder(id, payload) {
        await axios.patch(`/api/orders/${id}`, payload, {
            showToast: true
        });

    },

    async deleteOrder(id) {
        let response = await axios.delete(`/api/orders/${id}`, {
            showToast: true
        });

        return response.data.payload.order;
    }
}

export default OrderService

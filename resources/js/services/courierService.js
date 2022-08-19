const CourierService = {

    async getCourier(id) {
        let response = await axios.get(`/api/couriers/${id}`);
        return response.data.payload.courier;
    },

    async getCouriers(filters = null) {
        let response = await axios.get(`/api/couriers`,{
            params: filters
        });

        return response.data.payload.couriers;
    },

    async storeCourier(payload) {
        await axios.post(`/api/couriers`, payload, {
            showToast: true
        });
    },

    async updateCourier(id, payload) {
        await axios.patch(`/api/couriers/${id}`, payload, {
            showToast: true
        });
    },

    async deleteCourier(id) {
        let response = await axios.delete(`/api/couriers/${id}`, {
            showToast: true
        });

        return response.data.payload;
    }
}

export default CourierService

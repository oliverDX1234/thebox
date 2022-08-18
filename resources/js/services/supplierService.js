const SupplierService = {

    async getSupplier(id) {
        let response = await axios.get(`/api/suppliers/${id}`);
        return response.data.payload.supplier;
    },

    async getSuppliers(filters = null) {
        let response = await axios.get(`/api/suppliers`,{
            params: filters
        });

        return response.data.payload.suppliers;
    },

    async storeSupplier(formData) {
        await axios.post(`/api/suppliers`, formData, {
            showToast: true
        });
    },

    async updateSupplier(id, formData) {
        await axios.post(`/api/suppliers/${id}`, formData, {
            showToast: true
        });
    },

    async deleteSupplier(id) {
        let response = await axios.delete(`/api/suppliers/${id}`, {
            showToast: true
        });

        return response.data.payload.supplier;
    }
}

export default SupplierService

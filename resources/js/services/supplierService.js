import router from "@/router"

const SupplierService = {

    async getSupplier(id) {
        let response = await axios.get(`/api/suppliers/${id}`);
        return response.data.payload.supplier;
    },


    async getSuppliers() {
        let response = await axios.get(`/api/suppliers`);
        return response.data.payload.suppliers;
    },

    async storeSupplier(formData) {
        await axios.post(`/api/suppliers`, formData, {
            showToast: true
        });
        await router.push("/admin/suppliers");
    },


    async updateSupplier(id, formData) {
        await axios.post(`/api/suppliers/${id}`, formData, {
            showToast: true
        });
    },


    async deleteSupplier(id) {
        let response = await axios.delete(`/api/supplier/${id}`, {
            showToast: true
        });

        return response.data.payload.suppliers;

    }


}

export default SupplierService

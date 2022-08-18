import router from "@/router"

const DiscountService = {

    async getDiscounts(filters = null) {
        let response = await axios.get(`/api/discounts`,{
            params: filters
        });
        return response.data.payload.discounts;
    },

    async storeDiscount(payload) {
        await axios.post(`/api/discounts`, payload, {
            showToast: true
        });
        await router.push("/admin/discounts");
    },

    async deleteDiscount(id) {
        let response = await axios.delete(`/api/discounts/${id}`, {
            showToast: true
        });

        return response.data.payload.discount;
    },

    async getProductsForDiscount(id){
        let response = await axios.get(`/api/discounts/show-products/${id}`);

        return response.data.payload.products;
    },

    async updateStatus(id) {
        await axios.get(`/api/discounts/update-status/${id}`, {
            showToast: true
        });
    }
}

export default DiscountService

import router from "@/router"

const DiscountService = {

    async getDiscounts(filters = null) {
        let response = await axios.get(`/api/discounts`,{
            params: filters
        });
        return response.data.payload.discounts;
    },

    async storeDiscount(formData) {
        await axios.post(`/api/discounts`, formData, {
            showToast: true
        });
        await router.push("/admin/discounts");
    },

    async updateDiscount(id, formData) {
        await axios.post(`/api/discounts/${id}`, formData, {
            showToast: true
        });
        await router.push("/admin/discounts");
    },

    async deleteDiscount(id) {
        let response = await axios.delete(`/api/discounts/${id}`, {
            showToast: true
        });

        return response.data.payload.discount;

    }


}

export default DiscountService

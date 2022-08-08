import router from "@/router"

const ProductService = {

    async getProduct(id) {
        let response = await axios.get(`/api/products/${id}`);
        return response.data.payload.product;
    },


    async getProducts(filters = null) {
        let response = await axios.get(`/api/products`, {
            params: filters
        });
        return response.data.payload.products;
    },

    async storeProduct(formData) {
        await axios.post(`/api/products`, formData, {
            showToast: true
        });
        await router.push("/admin/products");
    },


    async updateProduct(id, formData) {
        await axios.post(`/api/products/${id}`, formData, {
            showToast: true
        });

        await router.push("/admin/products");
    },


    async deleteProduct(id) {
        let response = await axios.delete(`/api/products/${id}`, {
            showToast: true
        });

        return response.data.payload.product;

    }


}

export default ProductService

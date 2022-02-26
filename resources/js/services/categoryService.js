const CategoryService = {

    async getCategory(id) {
        let response = await axios.get(`/api/categories/${id}`);
        return response.data.payload.category;
    },

    async saveCategories(categories) {
        await axios.post(`/api/saveCategories`, {tree: categories}, {
            showToast: true
        });
    },

    async getCategories(){

        let response = await axios.get(`/api/categories`);

        return response.data.payload.categories;

    },


    async getCategoriesTree() {
        let response = await axios.get(`/api/categoriesTree`);
        return response.data.payload.categories;
    },

    async storeCategory(formData) {
        let response  = await axios.post(`/api/categories`, formData, {
            showToast: true
        });
        return response.data.payload.category;
    },


    async updateCategory(id, formData) {
        let response = await axios.patch(`/api/categories/${id}`, formData, {
            showToast: true
        });
        return response.data.payload.category;
    },


    async deleteCategory(id) {
        let response = await axios.delete(`/api/categories/${id}`, {
            showToast: true
        });

        return response.data.payload.category;

    },

}

export default CategoryService

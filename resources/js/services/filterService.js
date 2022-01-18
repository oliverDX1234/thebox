import router from "@/router"

const FilterService = {

    async getFilter(id) {
        let response = await axios.get(`/api/filters/${id}`);
        return response.data.payload.filter;
    },


    async getFilters() {
        let response = await axios.get(`/api/filters`);
        return response.data.payload.filters;
    },

    async storeFilter(formData) {
        await axios.post(`/api/filters`, formData, {
            showToast: true
        });
        await router.push("/admin/filters");
    },

    async updateFilter(id, filter) {
        let response = await axios.patch(`/api/filters/${id}`, filter, {
            showToast: true
        });
        return response.data.payload.filter;

    },


    async deleteFilter(id) {
        let response = await axios.delete(`/api/filters/${id}`, {
            showToast: true
        });

        return response.data.payload.filter;

    }


}

export default FilterService

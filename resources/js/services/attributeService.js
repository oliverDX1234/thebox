import router from "@/router"

const AttributeService = {

    async getAttribute(id) {
        let response = await axios.get(`/api/attributes/${id}`);
        return response.data.payload.attribute;
    },


    async getAttributes(id) {
        let response = await axios.get(`/api/attributes/`);
        return response.data.payload.attributes;
    },

    async storeAttribute(formData) {
        await axios.post(`/api/attributes`, formData, {
            showToast: true
        });
        await router.push("/admin/attributes");
    },

    async updateAttribute(id, attribute) {
        let response = await axios.patch(`/api/attributes/${id}`, attribute, {
            showToast: true
        });
        return response.data.payload.attribute;
    },


    async deleteAttribute(id) {
        let response = await axios.delete(`/api/attributes/${id}`, {
            showToast: true
        });

        return response.data.payload.attribute;

    }


}

export default AttributeService

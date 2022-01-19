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


    async storeAttribute(attribute) {
        let response = await axios.post(`/api/attributes`, attribute, {
            showToast: true
        });
        return response.data.payload.attribute;
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

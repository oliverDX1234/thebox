const PackageService = {

    async getPackage(id) {
        let response = await axios.get(`/api/packages/${id}`);

        return response.data.payload.package;
    },

    async getPackages(filters = null) {
        let response = await axios.get(`/api/packages`, {
            params: filters
        });

        return response.data.payload.packages;
    },

    async storePackage(formData) {
        await axios.post(`/api/packages`, formData, {
            showToast: true
        });
    },

    async updatePackage(id, formData) {
        await axios.post(`/api/packages/${id}`, formData, {
            showToast: true
        });
    },

    async deletePackage(id) {
        let response = await axios.delete(`/api/packages/${id}`, {
            showToast: true
        });

        return response.data.payload.package;
    },

    async removePackageDiscount(id) {
        await axios.get(`/api/packages/remove-discount/${id}`, {
            showToast: true
        });
    },

    async updateProductQuantity(package_id, product_id, value) {
        await axios.post(`/api/packages/update-quantity`, {
            package_id: package_id,
            product_id: product_id,
            quantity: value
        }, {
            showToast: true
        });
    }
}

export default PackageService

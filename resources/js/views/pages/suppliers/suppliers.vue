<script>
import PageHeader from "@/components/page-header";
import CustomTable from "@/components/CustomTable";
import SupplierService from "@/services/supplierService";


/**
 * Customers Component
 */
export default {
    components: {
        CustomTable,
        PageHeader
    },
    data() {
        return {
            title: "Suppliers",
            items: [
                {
                    text: "Suppliers",
                    active: true

                }
            ],
            suppliers: [],
            fields: [
                {key: "id", sortable: true, label: "ID"},
                {key: "name", sortable: true, label: "Name"},
                {key: "email", sortable: true, label: "Email"},
                {key: "phone", sortable: true, label: "Phone"},
                {key: "city", sortable: true, label: "City"},
                {key: "address", sortable: true, label: "Address"},
                {key: "action"}
            ]
        };
    },

    created() {
        this.getSuppliers();
    },
    methods: {
        editSupplier(id) {
            this.$router.push('/admin/supplier/' + id);
        },
        async deleteSupplier(id) {
            let response = await SupplierService.deleteSupplier(id);
            let index = this.suppliers.findIndex(supplier => supplier.id === parseInt(response))
            // find the post index
            if (~index) // if the post exists in array
                this.suppliers.splice(index, 1) //delete the post
        },
        async getSuppliers() {
            const suppliers = await SupplierService.getSuppliers();
            this.suppliers = suppliers.map(x => {
                x.city = x.city.city_name_en;
                return x;
            })
        },
    }
};
</script>

<template>
    <div>
        <PageHeader
            :title="title"
            :items="items"
        />
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <a
                                href="javascript:void(0);"
                                class="btn btn-success mb-2"
                                @click="$router.push('/admin/supplier/')"
                            >
                                <i class="mdi mdi-plus mr-2"></i> New supplier
                            </a>
                        </div>
                        <custom-table @edit-item="editSupplier" @delete-item="deleteSupplier" :items="suppliers" :fields="fields"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
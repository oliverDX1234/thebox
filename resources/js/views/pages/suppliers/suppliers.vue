<template>
    <Layout>
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
                        <custom-table @edit-item="editSupplier" :busy="busy" @delete-item="deleteSupplier" :search="true"
                                      :items="suppliers" :fields="fields"/>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import PageHeader from "@/components/custom/page-header";
import CustomTable from "@/components/reusable/tables/CustomTable";
import SupplierService from "@/services/supplierService";
import Layout from "../../layouts/main";


/**
 * Customers Component
 */
export default {
    components: {
        CustomTable,
        Layout,
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
            busy: false,
            fields: [
                {key: "id", sortable: true, label: "ID"},
                {key: "name", sortable: true, label: "Name"},
                {key: "email", sortable: true, label: "Email"},
                {key: "phone", sortable: true, label: "Phone"},
                {key: "city", sortable: true, label: "City"},
                {key: "address", sortable: true, label: "Address"},
                {key: "active", sortable: true, label: "Active"},
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

            this.$swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Yes, delete it!"
            }).then(async result => {
                if (result.value) {
                    let response = await SupplierService.deleteSupplier(id);
                    let index = this.suppliers.findIndex(supplier => supplier.id === parseInt(response))
                    // find the post index
                    if (~index) // if the post exists in array
                        this.suppliers.splice(index, 1) //delete the post
                }
            });

        },
        async getSuppliers() {
            this.busy = true;

            const suppliers = await SupplierService.getSuppliers();
            this.suppliers = suppliers.map(x => {
                x.city = x.city.city_name_en;
                return x;
            })

            this.busy = false;
        },
    }
};
</script>

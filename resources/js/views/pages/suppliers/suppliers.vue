<script>
import PageHeader from "@/components/page-header";
import CustomTable from "@/components/CustomTable";
import SuppliersService from "@/services/supplierService";


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
            title: "suppliers",
            items: [
                {
                    text: "suppliers",
                    active: true

                }
            ],
            suppliers: [],
            fields: [
                {key: "id", sortable: true, label: "ID"},
                {key: "first_name", sortable: true, label: "First Name"},
                {key: "last_name", sortable: true, label: "Last Name"},
                {key: "email", sortable: true, label: "Email"},
                {key: "phone", sortable: true, label: "Phone"},
                {key: "address", sortable: true, label: "Address"},
                {key: "city", sortable: true, label: "City"},
                {key: "gender", sortable: true, label: "Gender"},
                {key: "dob", sortable: true, label: "Date of birth"},
                {key: "roles", sortable: true, label: "Roles"},
                {key: "action"}


            ]
        };
    },

    created() {
        this.getsuppliers();
    },
    methods: {
        editsuppliers(id) {
            this.$router.push('/admin/supplier/' + id);
        },
        async deletesuppliers(id) {
            let response = await suppliersService.deletesuppliers(id);
            let index = this.suppliers.findIndex(supplier => supplier.id === parseInt(response))   // find the post index
            if (~index) // if the post exists in array
                this.suppliers.splice(index, 1) //delete the post
        },
        async getsuppliers() {
            var suppliers = await suppliersService.getsuppliers();
            this.suppliers = suppliers.map(x => {
                x.city = x.city.city_name_en;
                return x;
            })
            console.log(this.suppliers);
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
                        <custom-table @edit-supplier="editsuppliers" @delete-supplier="deletesuppliers" :suppliers="suppliers" :fields="fields"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<template>
    <Layout>
        <PageHeader
            :title="title"
        />
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <a
                                href="javascript:void(0);"
                                class="btn btn-success mb-2"
                                @click="$router.push('/admin/package/')"
                            >
                                <i class="mdi mdi-plus mr-2"></i> New package
                            </a>
                        </div>
                        <custom-table @edit-item="editPackage"
                                      @delete-item="deletePackage"
                                      :search="true"
                                      :items="packages"
                                      :fields="fields"
                                      :filteringOptions="['categories', 'statuses', 'discounts']"
                                      :busy="busy"
                                      :filters="filters"
                                      :actions="['delete', 'edit']"
                                      @filters-updated="filtersUpdated"
                        />
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import PageHeader from "@/components/custom/page-header";
import CustomTable from "@/components/reusable/tables/CustomTable";
import PackageService from "@/services/packageService";
import Layout from "../../layouts/main";

export default {
    components: {
        CustomTable,
        Layout,
        PageHeader
    },
    data() {
        return {
            title: "Packages",
            packages: [],
            filters: null,
            busy: false,
            fields: [
                {key: "id", sortable: true, label: "ID"},
                {key: "thumb", sortable: true, label: "Image"},
                {key: "active", sortable: true, label: "Active"},
                {key: "name", sortable: true, label: "Name"},
                {key: "unit_code", sortable: true, label: "Unit Code"},
                {key: "vat", sortable: true, label: "Vat"},
                {key: "weight", sortable: true, label: "Weight"},
                {key: "dimensions", sortable: true, label: "Dimensions"},
                {key: "price", sortable: true, label: "Price"},
                {key: "categories", sortable: true, label: "Categories"},
                {key: "action"}
            ]
        };
    },
    watch: {
        'filters': {
            deep: true,
            handler(filter) {

                this.$router.replace({
                    ...this.$route,
                    query: filter,
                }).catch(()=>{});

                this.getPackages();
            },
        },
    },
    created() {
        this.filters = this.$route.query;
    },
    methods: {
        editPackage(id) {
            this.$router.push('/admin/package/' + id);
        },

        async deletePackage(id) {
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
                    let response = await PackageService.deletePackage(id);
                    let index = this.packages.findIndex(p => p.id === parseInt(response))
                    // find the post index
                    if (~index) // if the post exists in array
                        this.packages.splice(index, 1) //delete the post
                }
            });
        },

        async getPackages() {
            this.busy = true;

            this.packages = await PackageService.getPackages(this.filters);

            this.busy = false;
        },

        filtersUpdated(value){
            this.filters = value;
        }
    }
};
</script>

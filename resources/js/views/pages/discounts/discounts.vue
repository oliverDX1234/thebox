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
                                @click="$router.push('/admin/discount/new')"
                            >
                                <i class="mdi mdi-plus mr-2"></i> New discount
                            </a>
                        </div>
                        <custom-table
                            @edit-item="editDiscount"
                            :busy="busy"
                            @delete-item="deleteDiscount"
                            :search="true"
                            @toggle-item="toggleItem"
                            :items="discounts"
                            :filters="filters"
                            :fields="fields"
                            :filteringOptions="['statuses', 'discountTypes']"
                            :actions="['delete', 'switch', 'show-products']"
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
import DiscountService from "../../../services/discountService";
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
            title: "Discounts",
            discounts: [],
            filters: null,
            busy: false,
            fields: [
                {key: "id", sortable: true, label: "ID"},
                {key: "value", sortable: true, label: "Value"},
                {key: "type", sortable: true, label: "Type"},
                {key: "start_date", sortable: true, label: "Start Date"},
                {key: "end_date", sortable: true, label: "End Date"},
                {key: "active", sortable: true, label: "Active"},
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

                this.getDiscounts();

            },
        },
    },

    created() {
        this.filters = this.$route.query;
    },
    methods: {
        editDiscount(id) {
            this.$router.push('/admin/discounts/new' + id);
        },
        async deleteDiscount(id) {

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
                    let response = await DiscountService.deleteDiscount(id);
                    let index = this.discounts.findIndex(discount => discount.id === parseInt(response))
                    // find the post index
                    if (~index) // if the post exists in array
                        this.discounts.splice(index, 1) //delete the post
                }
            });

        },

        async toggleItem(id){
            this.busy = true;

            await DiscountService.updateStatus(id);

            let index = this.discounts.findIndex(x => x.id === id);

            this.busy = false;

        },
        async getDiscounts() {
            this.busy = true;

            this.discounts = await DiscountService.getDiscounts(this.filters);

            this.busy = false;
        },

        filtersUpdated(value){
            this.filters = value;
        }
    }
};
</script>

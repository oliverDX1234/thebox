<template>
    <Layout>
        <PageHeader
            :title="title"
        />
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <custom-table
                            :busy="busy"
                            :search="true"
                            @delete-item="removeProduct"
                            :items="discountProducts"
                            :fields="fields"
                            :actions="['remove-product']"
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
import productService from "../../../services/productService";
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
            discountProducts: [],
            filters: null,
            busy: false,
            fields: [
                {key: "id", sortable: true, label: "Product ID"},
                {key: "thumb", sortable: true, label: "Image"},
                {key: "name", sortable: true, label: "Name"},
                {key: "unit_code", sortable: true, label: "Unit Code"},
                {key: "price", sortable: true, label: "Price"},
                {key: "price_supplier", sortable: true, label: "Supplier Price"},
                {key: "action"}
            ]
        };
    },

    computed:{
        title(){
            return "Discount Products for Discount ID - " + this.$route.params.id
        }
    },

    created() {
        this.getProductsForDiscount();
    },
    methods: {
        async getProductsForDiscount() {
            this.busy = true;

            this.discountProducts = await DiscountService.getProductsForDiscount(this.$route.params.id);

            this.busy = false;
        },

        async removeProduct(id){
            await productService.removeProductDiscount(id);

            let index = this.discountProducts.findIndex(x => x.id === id);

            if(index !== -1){
                this.discountProducts.splice(index, 1);
            }
        },

        filtersUpdated(value) {
            this.filters = value;
        }
    }
};
</script>

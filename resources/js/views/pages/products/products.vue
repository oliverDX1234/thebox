<script>
import PageHeader from "@/components/page-header";
import CustomTable from "@/components/CustomTable";
import ProductService from "@/services/productService";
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
            title: "Products",
            items: [
                {
                    text: "Products",
                    active: true

                }
            ],
            products: [],
            fields: [
                {key: "id", sortable: true, label: "ID"},
                {key: "name", sortable: true, label: "Name"},
                {key: "unit_code", sortable: true, label: "Unit Code"},
                {key: "supplier_id", sortable: true, label: "Supplier"},
                {key: "vat", sortable: true, label: "Vat"},
                {key: "weight", sortable: true, label: "Weight"},
                {key: "dimensions", sortable: true, label: "Dimensions"},
                {key: "price", sortable: true, label: "Price"},
                {key: "price_supplier", sortable: true, label: "Supplier Price"},
                {key: "active", sortable: true, label: "Active"},
                {key: "action"}
            ]
        };
    },

    created() {
        this.getProducts();
    },
    methods: {
        editProduct(id) {
            this.$router.push('/admin/product/' + id);
        },
        async deleteProduct(id) {
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
                    let response = await ProductService.deleteProduct(id);
                    let index = this.products.findIndex(product => product.id === parseInt(response))
                    // find the post index
                    if (~index) // if the post exists in array
                        this.products.splice(index, 1) //delete the post
                }
            });

        },
        async getProducts() {
            const products = await ProductService.getProducts();
            this.products = products.map(x => {
                x.city = x.city.city_name_en;
                return x;
            })
        },
    }
};
</script>

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
                                @click="$router.push('/admin/product/')"
                            >
                                <i class="mdi mdi-plus mr-2"></i> New product
                            </a>
                        </div>
                        <custom-table @edit-item="editProduct" @delete-item="deleteProduct" :search="true" :items="products" :fields="fields"/>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

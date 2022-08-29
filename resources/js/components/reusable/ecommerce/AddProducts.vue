<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="add-product-wrapper">
                    <multiselect
                        :options="filteredProducts"
                        class="add-product-select"
                        v-model="selectedProducts"
                        label="name"
                        track-by="id"
                        :show-labels="false"
                        multiple
                    >
                        <template slot="singleLabel" slot-scope="props">
                            <img width="20" class="option__image"
                                 :src="props.option.main_image.sm"
                                 alt="">
                            <span class="option__desc">
                                                            <span class="option__title text-capitalize ml-3">
                                                                {{ props.option.name }}
                                                            </span>
                                                        </span>
                        </template>
                        <template slot="option" slot-scope="props">
                            <div class="d-flex">
                                <img width="50"
                                     class="option__image"
                                     :src="props.option.main_image.sm" alt="">
                                <div
                                    class="option__desc d-flex align-items-center">
                                                            <span
                                                                class="option__title text-capitalize ml-3">
                                                                {{ props.option.name }}
                                                            </span>
                                </div>
                            </div>
                        </template>
                    </multiselect>

                    <b-button variant="success" @click="addProducts" class="ml-2">
                        Add Products
                    </b-button>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">

                <h4 class="card-title mb-3">Selected products</h4>

                <basic-table
                    @delete-item="removeProduct"
                    @quantity-updated="quantityUpdated"
                    :items="addedProducts"
                    :fields="fields"
                    :actions="['delete']">
                </basic-table>
            </div>
        </div>
    </div>
</template>

<script>
import basicTable from "../tables/BasicTable";
import productService from "../../../services/productService";
import packageService from "../../../services/packageService";
import _ from "lodash/fp";

export default {
    name: "AddProducts",
    components: {basicTable},
    props:{
      alreadyAddedProducts:{
          required: false,
          type: Array,
          default: function(){
              return [];
          }
      }
    },
    data() {
        return {
            products: [],
            selectedProducts: [],
            addedProducts: [],
            fields: [
                {key: "thumb", sortable: true, label: "Image"},
                {key: "name", sortable: true, label: "Name"},
                {key: "unit_code", sortable: true, label: "Unit Code"},
                {key: "price", sortable: true, label: "Price"},
                {key: "quantity", sortable: true, label: "Quantity"},
                {key: "action"}
            ],
        }
    },
    computed: {
        filteredProducts() {
            return this.products.filter(x => {
                return !this.addedProducts.map(z => z.id).includes(x.id);
            });
        }
    },
    watch:{
        alreadyAddedProducts(value){
            this.addedProducts = value;
        },

        addedProducts(){
            this.$emit("added-products", this.addedProducts)
        }
    },
    mounted(){

        this.loadProducts();
    },
    methods:{
        async loadProducts(){
            this.products = await productService.getProducts();
        },

        addProducts() {
            this.addedProducts.push(...this.selectedProducts);

            this.selectedProducts = [];
        },

        async quantityUpdated(value, id){
            await packageService.updateProductQuantity(this.$route.params.id, id, value);
        },


        removeProduct(id) {

            let index = this.addedProducts.findIndex(x => x.id === id);

            if (index !== -1) {
                this.addedProducts.splice(index, 1);
            }
        },
    }
}
</script>

<style scoped>

</style>

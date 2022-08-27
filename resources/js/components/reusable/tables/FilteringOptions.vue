<template>
    <div class="row py-3">
        <div class="col-12">
            <div class="filtering-options-wrapper">
                <multiselect placeholder="Select a category" v-if="options.includes('categories')" v-model="categoriesValue" :options="categories" label="name" track-by="id" @input="filtersSelected"/>
                <multiselect placeholder="Select a supplier" v-if="options.includes('suppliers')" v-model="suppliersValue" :options="suppliers" label="name" track-by="id" @input="filtersSelected"/>
                <multiselect placeholder="Select a product" v-if="options.includes('products')" v-model="productsValue" :options="products" label="name" track-by="id" @input="filtersSelected"/>
                <multiselect placeholder="Select a status" v-if="options.includes('statuses')" v-model="statusesValue" :options="statuses" @input="filtersSelected"/>
                <multiselect placeholder="Select a role" v-if="options.includes('roles')" v-model="rolesValue" :options="roles" @input="filtersSelected"/>
                <multiselect placeholder="Select discount status" v-if="options.includes('discounts')" v-model="discountsValue" :options="discounts" @input="filtersSelected"/>
                <multiselect placeholder="Select discount type" v-if="options.includes('discountTypes')" v-model="discountTypesValue" :options="discountTypes" @input="filtersSelected"/>
                <multiselect placeholder="Select Premade status" v-if="options.includes('preMadeStatuses')" v-model="preMadeStatusesValue" :options="preMadeStatuses" @input="filtersSelected"/>
            </div>
        </div>
    </div>
</template>

<script>
import categoryService from "../../../services/categoryService";
import supplierService from "../../../services/supplierService";
import productService from "../../../services/productService";

export default {
    name: "FilteringOptions",
    props:{
        options:{
            required: true,
            type: Array
        },
        filters:{
            required: false,
            type: Object,
            default: function(){
                return {};
            }
        }
    },
    data(){
        return {
            statuses:[
              "Active",
              "Inactive"
            ],
            roles:[
                "Admin",
                "User"
            ],
            discounts:[
              "Discount",
              "No Discount"
            ],
            discountTypes: [
              "Fixed",
              "Percent"
            ],
            preMadeStatuses:[
                "Premade",
                "Ordered"
            ],
            categories: [],
            suppliers: [],
            products: [],
            categoriesValue: null,
            suppliersValue: null,
            statusesValue: null,
            rolesValue: null,
            productsValue: null,
            discountsValue: null,
            discountTypesValue: null,
            preMadeStatusesValue: null
        }
    },
    mounted(){

        if(this.options.includes("categories")){
            this.getCategories();
        }

        if(this.options.includes("suppliers")){
            this.getSuppliers();
        }

        if(this.options.includes("products")){
            this.getProducts();
        }

        if(this.filters.statuses){
            this.statusesValue = this.filters.statuses;
        }

        if(this.filters.preMadeStatuses){
            this.preMadeStatusesValue = this.filters.preMadeStatuses;
        }

        if(this.filters.roles){
            this.rolesValue = this.filters.roles;
        }

        if(this.filters.discounts){
            this.discountsValue = this.filters.discounts;
        }

        if(this.filters.products){
            this.productsValue = this.filters.products;
        }

        if(this.filters.discountTypes){
            this.discountTypesValue = this.filters.discountTypes;
        }
    },
    methods:{

        async getCategories(){

            this.categories = await categoryService.getCategories();

            if(this.filters.categories){
                this.categoriesValue = this.categories.find(x => x.id === +this.filters.categories);
            }
        },

        async getSuppliers(){

            this.suppliers = await supplierService.getSuppliers();

            if(this.filters.suppliers){
                this.suppliersValue = this.suppliers.find(x => x.id === +this.filters.suppliers);
            }
        },
        async getProducts(){

            this.products = await productService.getProducts();

            if(this.filters.products){
                this.productsValue = this.products.find(x => x.id === +this.filters.products);
            }
        },


        filtersSelected(){

            let data = {};

            this.options.forEach(x => {

                if(this.getValue(x)){
                    let filterObj = {};

                    filterObj[x] = this.getValue(x);

                    Object.assign(data, filterObj);
                }
            })

            this.$emit("filters-updated", data);
        },

        getValue(x){
            let fullValueName = x + "Value";

            if(!this.$data[fullValueName]){
                return null;
            } else if(this.$data[fullValueName].id){
                return this.$data[fullValueName]?.id;
            }else{
                return this.$data[fullValueName];
            }

        }
    }
}
</script>

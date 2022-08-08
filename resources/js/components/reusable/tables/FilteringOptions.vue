<template>
    <div class="row py-3">
        <div class="col-12">
            <div class="d-flex">
                <multiselect placeholder="Select a category" v-if="options.includes('categories')" v-model="categoriesValue" :options="categories" label="name" track-by="id" @input="filtersSelected"/>
                <multiselect placeholder="Select a supplier" v-if="options.includes('suppliers')" v-model="suppliersValue" :options="suppliers" label="name" track-by="id" @input="filtersSelected"/>
                <multiselect placeholder="Select a status" v-if="options.includes('statuses')" v-model="statusesValue" :options="statuses" @input="filtersSelected"/>
            </div>
        </div>
    </div>
</template>

<script>
import categoryService from "../../../services/categoryService";
import supplierService from "../../../services/supplierService";
import Multiselect from "vue-multiselect";
export default {
    name: "FilteringOptions",
    components:{
        Multiselect
    },
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
            categories: [],
            suppliers: [],
            categoriesValue: null,
            suppliersValue: null,
            statusesValue: null,
        }
    },
    mounted(){

        if(this.options.includes("categories")){
            this.getCategories();
        }

        if(this.options.includes("suppliers")){
            this.getSuppliers();
        }

        if(this.filters.statuses){
            this.statusesValue = this.filters.statuses;
        }
    },
    methods:{

        async getCategories(){

            this.categories = await categoryService.getCategories();

            if(this.filters.categories){
                this.categoriesValue = this.categories.find(x => x.id === +this.filters.categories);
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

        },

        async getSuppliers(){

            this.suppliers = await supplierService.getSuppliers();

            if(this.filters.suppliers){
                this.suppliersValue = this.suppliers.find(x => x.id === +this.filters.suppliers);
            }
        }
    }
}
</script>

<style scoped>
.multiselect{
    max-width: 300px;
}
.multiselect:not(:first-child){
    margin-left: 20px;
}
</style>

<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="add-product-wrapper">
                    <multiselect
                        :options="filteredPackages"
                        class="add-product-select"
                        v-model="selectedPackages"
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

                    <b-button variant="success" @click="addPackages" class="ml-2">
                        Add Packages
                    </b-button>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">

                <h4 class="card-title mb-3">Selected packages</h4>

                <basic-table
                    @delete-item="removePackage"
                    @quantity-updated="quantityUpdated"
                    :items="addedPackages"
                    :fields="fields"
                    :actions="['delete']">
                </basic-table>
            </div>
        </div>
    </div>
</template>

<script>
import basicTable from "../tables/BasicTable";
import packageService from "../../../services/packageService";

export default {
    name: "AddPackages",
    components: {basicTable},
    props:{
        alreadyAddedPackages:{
            required: false,
            type: Array,
            default: function(){
                return [];
            }
        }
    },
    data() {
        return {
            packages: [],
            selectedPackages: [],
            addedPackages: [],
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
        filteredPackages() {
            return this.packages.filter(x => {
                return !this.addedPackages.map(z => z.id).includes(x.id);
            });
        }
    },
    watch:{
        alreadyAddedPackages(value){
            this.addedPackages = value;
        },

        addedPackages(){
            this.$emit("added-packages", this.addedPackages)
        }
    },
    mounted(){

        this.loadPackages();
    },
    methods:{
        async loadPackages(){
            this.packages = await packageService.getPackages().then( response => response.map(obj => ({...obj, "quantity": 1})));
        },

        addPackages() {
            this.addedPackages.push(...this.selectedPackages);

            this.selectedPackages = [];
        },

        quantityUpdated(value, id){
            let index = this.addedPackages.findIndex(x => x.id === id);

            if(index !== -1){
                this.addedPackages[index].quantity = value;
            }
        },

        removePackage(id) {

            let index = this.addedPackages.findIndex(x => x.id === id);

            if (index !== -1) {
                this.addedPackages.splice(index, 1);
            }
        },
    }
}
</script>

<style scoped>

</style>

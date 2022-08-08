<template>
    <Layout>
        <PageHeader :title="title" :items="items"/>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <div class="row mt-3">
                                <div class="col-lg-6 mb-sm-5">
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <h5 class="float-left">Filters</h5>
                                            <b-button class="float-right" @click="addItem('filter')" variant="success">
                                                Add new
                                            </b-button>
                                        </div>
                                        <div class="col-12">
                                            <custom-table :attributes="true" @edit-item="editFilter"
                                                          @load-attributes="loadAttributes" @delete-item="deleteFilter"
                                                          :search="true" :items="filters" :fields="fieldsFilters"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <h5 class="float-left">Attributes</h5>
                                            <b-button v-if="loadedFilterLists !== null" class="float-right" @click="addItem('attributes')"
                                                      variant="success">Add new
                                            </b-button>
                                        </div>
                                        <div class="col-12">
                                            <custom-table id="scrolling" @edit-item="editAttribute"
                                                          :search="true" @delete-item="deleteAttribute"
                                                          :items="attributes" :fields="fieldsAttributes"/>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <filter-popup-modal @closed="resetModal" :modal="modal" @update-items="updateItems"/>

    </Layout>
</template>

<script>
import PageHeader from "@/components/custom/page-header";


import CustomTable from "@/components/reusable/CustomTable";
import Layout from "../../layouts/main";
import FilterService from "@/services/filterService"
import AttributeService from "@/services/attributeService"
import FilterPopupModal from "./FilterPopupModal";

export default {
    page: {
        title: "Filters And Attributes",
    },
    components: {FilterPopupModal, PageHeader, Layout, CustomTable},
    data() {
        return {
            title: "Filters And Attributes",
            items: [
                {
                    text: "Filters And Attributes",
                    href: "/"
                },
            ],
            filters: [],
            attributes: [],
            fieldsFilters: [
                {key: "id", sortable: true, label: "ID"},
                {key: "filter", sortable: true, label: "Filter"},
                {key: "name", sortable: true, label: "Name"},
                {key: "active", sortable: true, label: "Active"},
                {key: "action"}
            ],
            fieldsAttributes: [
                {key: "id", sortable: true, label: "ID"},
                {key: "attribute", sortable: true, label: "Attribute"},
                {key: "name", sortable: true, label: "Name"},
                {key: "action"}
            ],
            loadedFilterLists: null,
            modal: {
                title: null,
                type: null,
                name: null,
                active: false,
                showModal: false

            }
        };
    },

    mounted() {

        this.loadFilters();
    },
    methods: {
        async loadFilters() {
            this.filters = await FilterService.getFilters();
        },
        loadAttributes(id) {
            let index = this.findItemIndex(id, "filters");

            if (window.innerWidth <= 767) {
                this.$scrollTo('#scrolling', 1500)
            }

            if(this.filters[index].attributes){
                this.attributes = this.filters[index].attributes;
            }else{
                this.attributes = [];
            }

            this.loadedFilterLists = id;
        },
        addItem(item) {
            if (item === "filter") {
                this.modal.showModal = true;
                this.modal.type = "filter";
                this.modal.title = "Add Filter";
            } else {
                this.modal.showModal = true;
                this.modal.type = "attribute";
                this.modal.title = "Add Attribute";
            }
        },
        editFilter(id) {

            let filter = this.filters.find(index => {
                return index.id === id;
            });

            this.modal.type = "filter";
            this.modal.id = id;
            this.modal.name = filter.name;
            this.modal.title = "Edit Filter";
            this.modal.type_value = filter.filter;
            this.modal.active = filter.active;
            this.modal.showModal = true;

        },
        editAttribute(id) {
            let filter = this.filters.find(index => {
                return index.id === this.loadedFilterLists;
            });

            let attribute = filter.attributes.find(index => {
                return index.id === id;
            });

            let modal = this.modal.type = "attribute";
            this.modal.id = id;
            this.modal.name = attribute.name;
            this.modal.title = "Edit Attribute";
            this.modal.type_value = attribute[modal];
            this.modal.active = filter.active ? filter.active : null;
            this.modal.showModal = true;
        },
        async updateItems(modal) {

            this.modal.showModal = false;
            if (modal.id) {
                if (modal.type === "filter") {
                    this.modal.showModal = false;
                    modal[modal.type] = modal.type_value;
                    let response = await FilterService.updateFilter(modal.id, modal);
                    this.resetModal();

                    let index = this.findItemIndex(response.id, "filters");

                    this.filters[index] = response;
                    let filters = this.filters;
                    this.filters = [];
                    this.$nextTick(() => {
                        this.filters = filters
                    });
                } else {
                    this.modal.showModal = false;
                    modal[modal.type] = modal.type_value;
                    let response = await AttributeService.updateAttribute(modal.id, modal);
                    this.resetModal();

                    let index = this.findItemIndex(response.id, "attributes");

                    this.attributes[index] = response;
                    let attributes = this.attributes;
                    this.attributes = [];
                    this.$nextTick(() => {
                        this.attributes = attributes
                    });
                }
            }else{
                if (modal.type === "filter") {
                    this.modal.showModal = false;
                    modal[modal.type] = modal.type_value;
                    let response = await FilterService.storeFilter(modal);
                    this.resetModal();
                    this.filters.push(response);
                    let filters = this.filters;
                    this.filters = [];
                    this.$nextTick(() => {
                        this.filters = filters
                    });
                } else {
                    this.modal.showModal = false;
                    modal[modal.type] = modal.type_value;
                    modal["filter_id"] = this.loadedFilterLists;
                    let response = await AttributeService.storeAttribute(modal);
                    this.resetModal();
                    this.attributes.push(response);
                    let attributes = this.attributes;
                    this.attributes = [];
                    this.$nextTick(() => {
                        this.attributes = attributes
                    });
                }
            }

        },
        findItemIndex(id, isFor){
            let index;
            if(isFor === "filters"){
                index = this.filters.findIndex(x => {
                    return x.id === id;
                })
            }else{
                index = this.attributes.findIndex(x => {
                    return x.id === id;
                })
            }


            if (index === -1) {
                this.makeToast("danger", "Oops, there was an error");
            }

            return index;
        },
        async deleteFilter(id) {

            await this.$swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Yes, delete it!"
            }).then(async result => {
                if (result.value) {
                    let response = await FilterService.deleteFilter(id);

                    let index = this.findItemIndex(response, "filters");

                    this.filters.splice(index, 1);
                    let filters = this.filters;
                    this.filters = [];
                    this.$nextTick(() => {
                        this.filters = filters;
                    });
                }
            });

        },
        async deleteAttribute(id) {
            await this.$swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Yes, delete it!"
            }).then(async result => {
                if (result.value) {
                    let response = await AttributeService.deleteAttribute(id);

                    let index = this.findItemIndex(response, "attributes");

                    this.attributes.splice(index, 1);
                    let attributes = this.attributes;
                    this.attributes = [];
                    this.$nextTick(() => {
                        this.attributes = attributes;
                    });
                }
            });

        },

        resetModal() {
            this.modal.showModal = false;
            this.modal.active = false;
            this.modal.id = null;
            this.modal.type_value = null;
            this.modal.name = null;
            this.modal.type = null;
            this.modal.title = null;
        }
    }
};
</script>

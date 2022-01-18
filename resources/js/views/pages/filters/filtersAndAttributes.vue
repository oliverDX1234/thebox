<script>
import PageHeader from "@/components/page-header";


import CustomTable from "@/components/CustomTable";
import Layout from "../../layouts/main";
import Swal from "sweetalert2";
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
            this.attributes = this.filters[id - 1].attributes;
            this.loadedFilterLists = id;
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
            if (modal.type === "filter") {
                modal[modal.type] = modal.type_value;
                let response = await FilterService.updateFilter(modal.id, modal);

                this.filters[response.id - 1] = response;
                let filters = this.filters;
                this.filters = [];
                this.$nextTick(() => {
                    this.filters = filters
                });
            } else {
                this.modal.showModal = false;
                modal[modal.type] = modal.type_value;
                let response = await AttributeService.updateAttribute(modal.id, modal);

                this.attributes[response.id - 1] = response;
                let attributes = this.attributes;
                this.attributes = [];
                this.$nextTick(() => {
                    this.attributes = attributes
                });
            }
        },
        async deleteFilter(id) {

            await Swal.fire({
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

                    let index = this.filters.findIndex(i => {
                        return i.id === response;
                    })

                    if (index === -1) {
                        this.makeToast("danger", "Oops, there was an error");
                    }
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
            await Swal.fire({
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

                    let index = this.attributes.findIndex(i => {
                        return i.id === response;
                    })

                    if (index === -1) {
                        this.makeToast("danger", "Oops, there was an error");
                    }
                    this.attributes.splice(index, 1);
                    let attributes = this.attributes;
                    this.attributes = [];
                    this.$nextTick(() => {
                        this.attributes = attributes;
                    });
                }
            });

        }

    }
};
</script>

<template>
    <Layout>
        <PageHeader :title="title" :items="items"/>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <h5>Filters</h5>
                                        </div>
                                        <div class="col-12">
                                            <custom-table :attributes="true" @edit-item="editFilter"
                                                          @load-attributes="loadAttributes" @delete-item="deleteFilter"
                                                          :search="true" :items="filters" :fields="fieldsFilters"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <h5>Attributes</h5>
                                        </div>
                                        <div class="col-12">
                                            <custom-table @edit-item="editAttribute" @delete-item="deleteAttribute"
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

        <filter-popup-modal :modal="modal" @update-items="updateItems"/>

    </Layout>
</template>

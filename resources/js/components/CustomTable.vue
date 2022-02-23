<template>
    <div>


        <div class="row mt-4">
            <div class="col-sm-12 col-md-6">
                <div id="tickets-table_length" class="dataTables_length">
                    <label class="d-inline-flex align-items-center">
                        Show&nbsp;
                        <b-form-select v-model="perPage" size="sm" :options="pageOptions"></b-form-select>&nbsp;entries
                    </label>
                </div>
            </div>
            <!-- Search -->
            <div v-if="search" class="col-sm-12 col-md-6">
                <div id="tickets-table_filter" class="dataTables_filter text-md-right">
                    <label class="d-inline-flex align-items-center">
                        Search:
                        <b-form-input
                            v-model="filter"
                            type="search"
                            class="form-control form-control-sm ml-2"
                        ></b-form-input>
                    </label>
                </div>
            </div>
            <!-- End search -->
        </div>


        <div class="table-responsive">
            <b-table
                class="table-centered"
                :items="items"
                :fields="fields"
                responsive="sm"
                :per-page="perPage"
                :current-page="currentPage"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
                :filter="filter"
                :filter-included-fields="filterOn"
                @filtered="onFiltered"
            >
                <template v-slot:cell(thumb)="row">
                    <img width="80px" :src="row.value" alt="product-image-thumbnail">
                </template>
                <template v-slot:cell(weight)="row">
                    {{row.value}} kg
                </template>
                <template v-slot:cell(vat)="row">
                    {{row.value}}%
                </template>
                <template v-slot:cell(supplier_id)="row">
                    {{row.value.name}}
                </template>
                <template v-slot:cell(dimensions)="row">
                    <div><strong>Width:</strong> {{ row.value.width }} cm</div>
                    <div><strong>Height:</strong> {{ row.value.height }} cm</div>
                    <div><strong>Length:</strong> {{ row.value.length }} cm</div>
                </template>
                <template v-slot:cell(price)="row">
                    {{row.value}} MKD
                </template>
                <template v-slot:cell(price_supplier)="row">
                    {{row.value}} MKD
                </template>
                <template v-slot:cell(active)="row">
                    <div
                        class="badge font-size-12"
                        :class="{'badge-soft-danger': `${row.value}` === 'false',
                            'badge-soft-success': `${row.value}` === 'true',
                            }"
                    >{{ row.value === false ? "Inactive" : "Active" }}
                    </div>
                </template>
                <template v-slot:cell(action)="row">
                    <a
                        @click="$emit('load-attributes', row.item.id)"
                        class="mr-3 text-success"
                        role="button"
                        v-b-tooltip.hover
                        title="Attributes"
                        v-if="attributes"
                    >
                        <span class="success font-weight-bold font-size-18">A</span>
                    </a>
                    <a
                        @click="$emit('edit-item', row.item.id)"
                        class="mr-3 text-primary"
                        role="button"
                        v-b-tooltip.hover
                        title="Edit"
                    >
                        <i class="mdi mdi-pencil font-size-18"></i>
                    </a>
                    <a
                        class="text-danger"
                        role="button"
                        v-b-tooltip.hover

                        @click="$emit('delete-item', row.item.id)"


                        title="Delete"
                    >
                        <i class="mdi mdi-trash-can font-size-18"></i>
                    </a>
                </template>
            </b-table>
        </div>
        <div class="row">
            <div class="col">
                <div class="dataTables_paginate paging_simple_numbers float-right">
                    <ul class="pagination pagination-rounded mb-0">
                        <!-- pagination -->
                        <b-pagination v-model="currentPage" :total-rows="rows" :per-page="perPage"></b-pagination>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    name: 'custom-table',
    props: ["items", "attributes", "search", "fields"],
    computed: {
        /**
         * Total no. of records
         */
        rows() {
            return this.items.length;
        }
    },
    data() {
        return {
            totalRows: 1,
            currentPage: 1,
            perPage: 10,
            pageOptions: [10, 25, 50, 100],
            filter: null,
            filterOn: [],
            sortBy: "id",
            sortDesc: false
        }
    },
    mounted() {
        // Set the initial number of items
        this.totalRows = this.items.length;
    },
    methods: {

        onFiltered(filteredItems) {
            // Trigger pagination to update the number of buttons/pages due to filtering
            this.totalRows = filteredItems.length;
            this.currentPage = 1;
        }
    }
}
</script>


<style>

.table td:last-child {
    min-width: 150px;
}

</style>

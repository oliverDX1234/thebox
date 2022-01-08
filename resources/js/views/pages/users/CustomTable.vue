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
            <div class="col-sm-12 col-md-6">
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
                :items="users"
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
                <template v-slot:cell(action)="row">
                    <a
                        @click="$emit('edit-user', row.item.id)"
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

                        @click="$emit('delete-user', row.item.id)"


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

import UserService from "@/services/userService";


export default {
    name: 'custom-table',
    props: ["users", "fields"],
    computed: {
        /**
         * Total no. of records
         */
        rows() {
            return this.users.length;
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
        this.totalRows = this.users.length;
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

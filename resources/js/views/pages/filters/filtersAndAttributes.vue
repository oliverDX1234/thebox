<script>
import PageHeader from "@/components/page-header";


import CustomTable from "@/components/CustomTable";
import Layout from "../../layouts/main";
export default {
    page: {
        title: "Filters And Attributes",
    },
    components: {PageHeader, Layout, CustomTable},
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

            fieldsFilters:[
                {key: "id", sortable: true, label: "ID"},
                {key: "name", sortable: true, label: "First Name"},
                {key: "active", sortable: true, label: "Active"},
                {key: "action"}
            ],
            fieldsAttributes:[
                {key: "id", sortable: true, label: "ID"},
                {key: "name", sortable: true, label: "First Name"},
                {key: "action"}
            ]

        };
    },

    methods:{
        editFilter(){
        },
        editAttribute(){
        },
        deleteFilter(){
        },
        deleteAttribute(){
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
                            <div class="row">
                                <div class="col-md-6">
                                    <custom-table @edit-item="editFilter" @delete-item="deleteFilter" :items="filters" :fields="fieldsFilters"/>


                                </div>
                                <div class="col-md-6">
                                    <custom-table @edit-item="editAttribute" @delete-item="deleteAttribute" :items="attributes" :fields="fieldsAttributes"/>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

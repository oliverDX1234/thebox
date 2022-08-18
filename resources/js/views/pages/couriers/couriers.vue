<template>
    <Layout>
        <PageHeader
            :title="title"
        />
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <a
                                href="javascript:void(0);"
                                class="btn btn-success mb-2"
                                @click="$router.push('/admin/courier/new')"
                            >
                                <i class="mdi mdi-plus mr-2"></i> New courier
                            </a>
                        </div>
                        <custom-table
                            @edit-item="editCourier"
                            :busy="busy"
                            @delete-item="deleteCourier"
                            :search="true"
                            :items="couriers"
                            :fields="fields"
                            :actions="['delete', 'edit']"
                        />
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import PageHeader from "@/components/custom/page-header";
import CustomTable from "@/components/reusable/tables/CustomTable";
import CourierService from "@/services/courierService";
import Layout from "../../layouts/main";

export default {
    components: {
        CustomTable,
        Layout,
        PageHeader
    },
    data() {
        return {
            title: "Couriers",
            couriers: [],
            filters: null,
            busy: false,
            fields: [
                {key: "id", sortable: true, label: "ID"},
                {key: "name", sortable: true, label: "Name"},
                {key: "email", sortable: true, label: "Email"},
                {key: "price", sortable: true, label: "Price"},
                {key: "active", sortable: true, label: "Active"},
                {key: "action"}
            ]
        };
    },
    created() {
        this.getCouriers();
    },
    methods: {
        editCourier(id) {
            this.$router.push('/admin/courier/' + id);
        },

        async deleteCourier(id) {

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
                    let response = await CourierService.deleteCourier(id);

                    let index = this.couriers.findIndex(courier => courier.id === parseInt(response))
                    // find the post index
                    if (~index) // if the post exists in array
                        this.couriers.splice(index, 1) //delete the post
                }
            });
        },

        async getCouriers() {
            this.busy = true;

            this.couriers = await CourierService.getCouriers(this.filters);

            this.busy = false;
        }
    }
};
</script>

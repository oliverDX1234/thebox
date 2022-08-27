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
                                @click="$router.push('/admin/orders/new')"
                            >
                                <i class="mdi mdi-plus mr-2"></i> New Order
                            </a>
                        </div>
                        <custom-table @edit-item="editOrder"
                                      @delete-item="deleteOrder"
                                      :search="true"
                                      :items="orders"
                                      :filteringOptions="['statuses']"
                                      :busy="busy"
                                      :filters="filters"
                                      :fields="fields"
                                      :actions="['delete', 'edit']"
                                      @filters-updated="filtersUpdated"
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
import OrderService from "@/services/orderService";
import Layout from "../../layouts/main";

export default {
    components: {
        CustomTable,
        Layout,
        PageHeader
    },
    data() {
        return {
            title: "Orders",
            orders: [],
            filters: null,
            busy: false,
            fields: [
                {key: "id", sortable: true, label: "ID"},
                {key: "order_number", sortable: true, label: "Order Number"},
                {key: "user_id", sortable: true, label: "User"},
                {key: "payment_type", sortable: true, label: "Payment Type"},
                {key: "paid", sortable: true, label: "Paid"},
                {key: "total_price", sortable: true, label: "Total Price"},
                {key: "delivery_price", sortable: true, label: "Delivery Price"},
                {key: "order_shipping_email", sortable: true, label: "User Email"},
                {key: "order_shipping_first_name", sortable: true, label: "User First Name"},
                {key: "order_shipping_last_name", sortable: true, label: "User Last Name"},
                {key: "order_shipping_phone", sortable: true, label: "User Phone"},
                {key: "order_shipping_address", sortable: true, label: "User Address"},
                {key: "comment", sortable: true, label: "Comment"},
                {key: "order_sent_at", sortable: true, label: "Order Sent At"},
                {key: "order_delivered_at", sortable: true, label: "Order Delivered At"},
                {key: "tracking_code", sortable: true, label: "Tracking Code"},
                {key: "action"}
            ]
        };
    },
    watch: {
        'filters': {
            deep: true,
            handler(filter) {

                this.$router.replace({
                    ...this.$route,
                    query: filter,
                }).catch(()=>{});

                this.getOrders();

            },
        },
    },
    created() {
        this.filters = this.$route.query;
    },
    methods: {
        editOrder(id) {
            this.$router.push('/admin/order/' + id);
        },

        async deleteOrder(id) {
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
                    let response = await OrderService.deleteOrder(id);
                    let index = this.orders.findIndex(order => order.id === parseInt(response))   // find the post index
                    if (~index) // if the post exists in array
                        this.orders.splice(index, 1) //delete the post
                }
            });

        },

        async getOrders() {
            this.busy = true;

            this.orders = await OrderService.getOrders(this.filters);

            this.busy = false;
        },

        filtersUpdated(value){
            this.filters = value;
        }
    }
};
</script>

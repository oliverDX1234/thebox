<template>
    <Layout>
        <PageHeader
            :title="title"
        />
        <load-spinner :show="loading" variant="white">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <form
                                        class="needs-validation"
                                        @submit.prevent=""
                                    >
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>User <span
                                                        class="required">*</span></label>
                                                    <multiselect
                                                        v-model="order.user"
                                                        :class="{ 'is-invalid': submitted && $v.order.user.$error }"
                                                        placeholder="Select User"
                                                        :options="users"
                                                        @input="userChanged"
                                                    >
                                                        <template slot="singleLabel" slot-scope="props">
                                                            {{ props.option.first_name }} {{ props.option.last_name }}
                                                        </template>
                                                        <template slot="option" slot-scope="props">
                                                            {{ props.option.first_name }} {{ props.option.last_name }}
                                                        </template>
                                                    </multiselect>
                                                    <div
                                                        v-if="submitted && $v.order.user.$error"
                                                        class="invalid-feedback"
                                                    >
                                                    <span
                                                        v-if="!$v.order.user.required">This value is required.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Courier</label>
                                                    <multiselect
                                                        v-model="order.courier"
                                                        placeholder="Enter Courier"
                                                        :options="couriers"
                                                        label="name"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Payment Type <span
                                                        class="required">*</span></label>
                                                    <multiselect
                                                        v-model="order.payment_type"
                                                        :class="{ 'is-invalid': submitted && $v.order.payment_type.$error }"
                                                        placeholder="Select Payment Type"
                                                        type="text"
                                                        :options="paymentOptions"
                                                    />
                                                    <div
                                                        v-if="submitted && $v.order.payment_type.$error"
                                                        class="invalid-feedback"
                                                    >
                                                        <span
                                                            v-if="!$v.order.payment_type.required">This value is required.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Payment Status <span
                                                        class="required">*</span></label>
                                                    <multiselect
                                                        v-model="order.paid"
                                                        :class="{ 'is-invalid': submitted && $v.order.paid.$error }"
                                                        placeholder="Select Payment Status"
                                                        type="text"
                                                        :options="paymentStatuses"
                                                    />
                                                    <div
                                                        v-if="submitted && $v.order.paid.$error"
                                                        class="invalid-feedback"
                                                    >
                                                        <span
                                                            v-if="!$v.order.paid.required">This value is required.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email <span
                                                        class="required">*</span></label>
                                                    <input
                                                        v-model="order.user_shipping_details.email"
                                                        :class="{ 'is-invalid': submitted && $v.order.user_shipping_details.email.$error }"
                                                        class="form-control"
                                                        placeholder="Enter User Email"
                                                    >
                                                    <div
                                                        v-if="submitted && $v.order.user_shipping_details.email.$error"
                                                        class="invalid-feedback"
                                                    >
                                                        <span
                                                            v-if="!$v.order.user_shipping_details.email.required">This value is required.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>First Name <span
                                                        class="required">*</span></label>
                                                    <input
                                                        v-model="order.user_shipping_details.first_name"
                                                        :class="{ 'is-invalid': submitted && $v.order.user_shipping_details.first_name.$error }"
                                                        class="form-control"
                                                        placeholder="Enter User First Name"
                                                    >
                                                    <div
                                                        v-if="submitted && $v.order.user_shipping_details.first_name.$error"
                                                        class="invalid-feedback"
                                                    >
                                                        <span
                                                            v-if="!$v.order.user_shipping_details.first_name.required">This value is required.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Last Name <span
                                                        class="required">*</span></label>
                                                    <input
                                                        v-model="order.user_shipping_details.last_name"
                                                        :class="{ 'is-invalid': submitted && $v.order.user_shipping_details.last_name.$error }"
                                                        class="form-control"
                                                        placeholder="Enter User Last Name"
                                                    >
                                                    <div
                                                        v-if="submitted && $v.order.user_shipping_details.last_name.$error"
                                                        class="invalid-feedback"
                                                    >
                                                        <span
                                                            v-if="!$v.order.user_shipping_details.last_name.required">This value is required.</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone <span
                                                        class="required">*</span></label>
                                                    <input
                                                        v-model="order.user_shipping_details.phone"
                                                        :class="{ 'is-invalid': submitted && $v.order.user_shipping_details.phone.$error }"
                                                        class="form-control"
                                                        placeholder="Enter User Phone"
                                                    >
                                                    <div
                                                        v-if="submitted && $v.order.user_shipping_details.phone.$error"
                                                        class="invalid-feedback"
                                                    >
                                                        <span
                                                            v-if="!$v.order.user_shipping_details.phone.required">This value is required.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Address <span
                                                        class="required">*</span></label>
                                                    <input
                                                        v-model="order.user_shipping_details.address"
                                                        :class="{ 'is-invalid': submitted && $v.order.user_shipping_details.address.$error }"
                                                        class="form-control"
                                                        placeholder="Enter User Address"
                                                    >
                                                    <div
                                                        v-if="submitted && $v.order.user_shipping_details.address.$error"
                                                        class="invalid-feedback"
                                                    >
                                                        <span
                                                            v-if="!$v.order.user_shipping_details.address.required">This value is required.</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>City <span
                                                        class="required">*</span></label>
                                                    <multiselect
                                                        v-model="order.user_shipping_details.city"
                                                        :class="{ 'is-invalid': submitted && $v.order.user_shipping_details.city.$error }"
                                                        placeholder="Enter User City"
                                                        label="city_name_en"
                                                        :options="cities"
                                                    >
                                                    </multiselect>

                                                    <div
                                                        v-if="submitted && $v.order.user_shipping_details.city.$error"
                                                        class="invalid-feedback"
                                                    >
                                                        <span
                                                            v-if="!$v.order.user_shipping_details.city.required">This value is required.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email Sent At </label>
                                                    <date-picker
                                                        v-model="order.order_sent_at"
                                                        confirm
                                                        placeholder="Enter Sent Date"
                                                    >
                                                    </date-picker>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email Delivered At </label>
                                                    <date-picker
                                                        v-model="order.order_delivered_at"
                                                        confirm
                                                        placeholder="Enter Delivery Date"
                                                    >
                                                    </date-picker>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div v-if="!$route.params.id" class="col-12">
                                                <b-tabs content-class="p-3 text-muted" @activate-tab="tabChanged">
                                                    <b-tab active class="border-0">
                                                        <template v-slot:title>
                                                          <span class="d-inline-block d-sm-none">
                                                            <i class="fas fa-home"></i>
                                                          </span>
                                                            <span class="d-none d-sm-inline-block">Products</span>
                                                        </template>
                                                        <add-products :already-added-products="addedProducts"
                                                                      @added-products="addProducts"></add-products>
                                                    </b-tab>
                                                    <b-tab>
                                                        <template v-slot:title>
                                                          <span class="d-inline-block d-sm-none">
                                                            <i class="far fa-user"></i>
                                                          </span>
                                                            <span class="d-none d-sm-inline-block">Packages</span>
                                                        </template>
                                                        <add-packages :already-added-packages="addedPackages"
                                                                      @added-packages="addPackages"></add-packages>
                                                    </b-tab>
                                                </b-tabs>
                                            </div>
                                            <div v-else class="col-12">
                                                <basic-table :items="addedPackages"
                                                             :fields="fields">

                                                </basic-table>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <hr>
                                                <div class="py-3 float-right">

                                                    <div class="form-group">
                                                        <label class="control-label">Total Price:<span
                                                            class="required">*</span></label>
                                                        <b-input placeholder="Enter Price"
                                                                 :disabled="!addedProducts.length && !addedPackages.length"
                                                                 :class="{ 'is-invalid': this.submitted && $v.order.total_price.$invalid }"
                                                                 v-model="order.total_price"></b-input>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Total Price Without Vat:</label>
                                                        <b-input
                                                            disabled
                                                            v-model="order.total_price_no_vat"></b-input>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Delivery Price:</label>
                                                        <b-input
                                                            v-model="order.delivery_price"></b-input>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <a
                                            class="btn btn-danger mt-2 float-left"
                                            v-if="$route.params.id"
                                            @click="deleteOrder"
                                        >Delete Order
                                        </a>
                                        <button
                                            class="btn btn-primary mt-2 float-right"
                                            type="submit"
                                            @click="formSubmit"
                                        >Save Order
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </load-spinner>
    </Layout>
</template>

<script>
import {email, helpers, minLength, required, sameAs} from "vuelidate/lib/validators";

import PageHeader from '@/components/custom/page-header';
import FileUpload from '@/components/reusable/FileUpload.vue'
import DatePicker from "vue2-datepicker";
import Layout from "../../layouts/main";
import OrderService from "@/services/orderService";
import addProducts from "../../../components/reusable/ecommerce/AddProducts";
import addPackages from "../../../components/reusable/ecommerce/AddPackages";
import userService from "../../../services/userService";
import courierService from "../../../services/courierService";
import basicTable from "../../../components/reusable/tables/BasicTable";

const numbers = helpers.regex('numbers', /^[+\d0-9]*$/i);

export default {
    page: {
        title: "Order",
        meta: [{name: "New/Edit Order", content: "Create or edit a order"}],
    },
    components: {PageHeader, FileUpload, DatePicker, Layout, addProducts, addPackages, basicTable},
    data() {
        return {
            title: "New Order",
            loading: false,
            paymentOptions: ["cash", "card"],
            couriers: [],
            paymentStatuses: ["Paid", "Unpaid"],
            addedProducts: [],
            addedPackages: [],
            users: [],
            cities: [],
            fields: [
                {key: "thumb", sortable: true, label: "Image"},
                {key: "name", sortable: true, label: "Name"},
                {key: "unit_code", sortable: true, label: "Unit Code"},
                {key: "price", sortable: true, label: "Price"}
            ],
            order: {
                user: null,
                courier: null,
                payment_type: null,
                paid: "Paid",
                total_price: null,
                total_price_no_vat: null,
                delivery_price: 0,
                order_sent_at: null,
                order_delivered_at: null,
                user_shipping_details: {
                    email: null,
                    first_name: null,
                    last_name: null,
                    phone: null,
                    address: null,
                    city: null
                }
            },
            submitted: false,
        };
    },
    validations: {
        order: {
            user: {required},
            payment_type: {required},
            paid: {required},
            user_shipping_details: {
                email: {required},
                first_name: {required},
                last_name: {required},
                phone: {required},
                address: {required},
                city: {required}
            },
            total_price: {required}
        },
    },
    watch: {

        addedProducts() {

            if (!this.addedProducts.length) {
                this.order.total_price = null;
                this.order.total_price_no_vat = null;
            } else if (this.addedProducts.length === 1) {
                this.order.total_price = this.addedProducts[0].price_discount ? this.addedProducts[0].price_discount : this.addedProducts[0].price;
                this.order.total_price_no_vat = this.addedProducts[0].price_no_vat;
            } else {
                this.order.total_price = this.addedProducts.reduce((total, current) => {
                    return total + (current.price_discount ? current.price_discount : current.price)
                }, 0)

                this.order.total_price_no_vat = this.addedProducts.reduce((total, current) => {
                    return total + (current.price_no_vat)
                }, 0)
            }

        },

        addedPackages() {

            if(this.$route.params.id){
                return;
            }

            if (!this.addedPackages.length) {
                this.order.total_price = null;
                this.order.total_price_no_vat = null;
            } else if (this.addedPackages.length === 1) {
                this.order.total_price = this.addedPackages[0].price_discount ? this.addedPackages[0].price_discount : this.addedPackages[0].price;
                this.order.total_price_no_vat = this.addedPackages[0].price_no_vat;
            } else {
                this.order.total_price = this.addedPackages.reduce((total, current) => {
                    return total + (current.price_discount ? current.price_discount : current.price)
                }, 0)

                this.order.total_price_no_vat = this.addedPackages.reduce((total, current) => {
                    return total + (current.price_no_vat)
                }, 0)
            }

        }
    },
    methods: {

        userChanged(value) {
            this.order.user_shipping_details.email = value.email;
            this.order.user_shipping_details.first_name = value.first_name;
            this.order.user_shipping_details.last_name = value.last_name;
            this.order.user_shipping_details.phone = value.phone;
            this.order.user_shipping_details.address = value.address;
            this.order.user_shipping_details.city = value.city;
        },

        async loadCities() {
            try {
                let response = await this.$http.get('/api/cities');
                this.cities = response.data.payload.cities;
            } catch (e) {
            }
        },

        async loadUsers() {
            this.users = await userService.getUsers();
        },

        async loadCouriers() {
            this.couriers = await courierService.getCouriers();
        },

        tabChanged() {
            this.order.total_price = null;
            this.order.total_price_no_vat = null;

            this.addedProducts = [];
            this.addedPackages = [];
        },

        addProducts(products) {
            this.addedProducts = products;
        },

        addPackages(packages) {
            this.addedPackages = packages;
        },

        async formSubmit() {

            this.submitted = true;

            // stop here if form is invalid
            this.$v.$touch();

            if (!this.$v.$invalid) {

                let payload = this.preparePayload();

                if (this.$route.params.id) {
                    await OrderService.updateOrder(this.$route.params.id, payload);

                    await this.$router.push("/admin/orders");
                } else {
                    await OrderService.storeOrder(payload);

                    await this.$router.push("/admin/orders");
                }
            }
        },

        async loadOrder() {

            let tempOrder = await OrderService.getOrder(this.$route.params.id);

            this.order.user = tempOrder.user;
            this.order.courier = tempOrder.courier;
            this.order.total_price = tempOrder.total_price;
            this.order.total_price_no_vat = tempOrder.total_price_no_vat;
            this.order.order_sent_at = new Date(tempOrder.order_sent_at);
            this.order.order_delivered_at = new Date(tempOrder.order_delivered_at);
            this.order.paid = tempOrder.paid ? "Paid" : "Unpaid";
            this.order.payment_type = tempOrder.payment_type;
            this.order.user_shipping_details = tempOrder.user_shipping_details;
            this.order.delivery_price = tempOrder.delivery_price;
            this.addedPackages = tempOrder.packages.map(obj => ({...obj, "quantity": obj.pivot.quantity}));

            this.loading = false;
        },

        async deleteOrder() {
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
                    await OrderService.deleteOrder(this.$route.params.id);
                    await this.$router.push('/admin/orders');
                }
            });
        },

        preparePayload() {
            let payload = {};

            payload.id = this.$route.params.id;
            payload.user_id = this.order.user.id;
            payload.courier_id = this.order.courier?.id;
            payload.payment_type = this.order.payment_type;
            payload.paid = this.order.paid === "Paid";
            payload.total_price = this.order.total_price;
            payload.total_price_no_vat = this.order.total_price_no_vat;
            payload.delivery_price = this.order.delivery_price;
            payload.order_sent_at = this.order.order_sent_at ? this.moment(this.order.order_sent_at).format("YYYY-MM-DD") : null;
            payload.order_delivered_at = this.order.order_delivered_at ? this.moment(this.order.order_delivered_at).format("YYYY-MM-DD") : null;

            payload.user_shipping_details = Object.assign({}, this.order.user_shipping_details);
            payload.user_shipping_details.city = this.order.user_shipping_details.city.id;

            if(!this.$route.params.id){
                payload.products = this.addedProducts;
                payload.packages = this.addedPackages;
            }

            return payload;
        }
    },
    created() {

        this.loadCouriers();

        this.loadCities();

        this.loadUsers();

        if (this.$route.params.id) {
            this.loading = true;

            this.title = "Edit Order";

            this.loadOrder();
        }
    }
};
</script>

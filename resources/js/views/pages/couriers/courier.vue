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
                                <div class="col-lg-12 mt-5">
                                    <form
                                        class="needs-validation"
                                        @submit.prevent="formSubmit"
                                    >
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="validationCustom01">Name<span
                                                        class="required">*</span></label>
                                                    <input
                                                        id="validationCustom01"
                                                        v-model="courier.name"
                                                        :class="{ 'is-invalid': submitted && $v.courier.name.$error }"
                                                        class="form-control"
                                                        placeholder="First name"
                                                        type="text"
                                                        value="Mark"
                                                    />
                                                    <div
                                                        v-if="submitted && $v.courier.name.$error"
                                                        class="invalid-feedback"
                                                    >
                                                    <span
                                                        v-if="!$v.courier.name.required">This value is required.</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="validationCustom03">Email <span
                                                        class="required">*</span></label>
                                                    <input
                                                        id="validationCustom03"
                                                        v-model="courier.email"
                                                        :class="{ 'is-invalid': submitted && $v.courier.email.$error }"
                                                        class="form-control"
                                                        placeholder="Email"
                                                        type="text"
                                                    />
                                                    <div
                                                        v-if="submitted && $v.courier.email.$error"
                                                        class="invalid-feedback"
                                                    >
                                                    <span
                                                        v-if="!$v.courier.email.required">This value is required.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="validationCustom04">Price <span
                                                        class="required">*</span></label>
                                                    <input
                                                        id="validationCustom04"
                                                        v-model="courier.price"
                                                        :class="{ 'is-invalid': submitted && $v.courier.price.$error }"
                                                        class="form-control"
                                                        placeholder="Price"
                                                        type="text"
                                                    />
                                                    <div
                                                        v-if="submitted && $v.courier.price.$error"
                                                        class="invalid-feedback"
                                                    >
                                                    <span
                                                        v-if="!$v.courier.price.required">This value is required.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-12">
                                                <b-form-checkbox v-model="courier.active" size="lg" switch class="mb-1 mt-2">
                                                    <label>Active</label>
                                                </b-form-checkbox>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                        </div>

                                        <a
                                            class="btn btn-danger mt-2 float-left"
                                            v-if="$route.params.id"
                                            @click="deleteCourier"
                                        >Delete courier
                                        </a>
                                        <button
                                            class="btn btn-primary mt-2 float-right"
                                            type="submit"
                                        >Save courier
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
import {email, required, numeric} from "vuelidate/lib/validators";

import PageHeader from '@/components/custom/page-header';
import CourierService from "@/services/courierService";
import Layout from "../../layouts/main";

export default {
    page: {
        title: "Courier",
    },
    components: {PageHeader, Layout},
    data() {
        return {
            title: "New Courier",
            loading: false,
            cities: [],
            courier: {
                name: null,
                email: null,
                price: null,
                active: true,
            },
            submitted: false,
        };
    },

    validations: {
        courier: {
            name: {required},
            price: {required, numeric},
            email: {required, email},
        },
    },
    methods: {
        async formSubmit() {
            this.submitted = true;

            // stop here if form is invalid
            this.$v.$touch();

            if (!this.$v.$invalid) {

                if (this.$route.params.id) {
                    await CourierService.updateCourier(this.$route.params.id, this.courier);

                    await this.$router.push("/admin/couriers");

                } else {
                    await CourierService.storeCourier(this.$route.params.id, this.courier);

                    await this.$router.push("/admin/couriers");
                }
            }
        },

        async loadCourier() {
            this.courier = await CourierService.getCourier(this.$route.params.id);

            this.loading = false;
        },

        async deleteCourier() {

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
                    await CourierService.deleteCourier(this.$route.params.id);

                    await this.$router.push('/admin/couriers');
                }
            });
        },
    },
    created() {

        if (this.$route.params.id) {

            this.loading = true;

            this.title = "Edit courier";

            this.loadCourier();
        }
    }
};
</script>

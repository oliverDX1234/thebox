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
                                                    v-model="supplier.name"
                                                    :class="{ 'is-invalid': submitted && $v.supplier.name.$error }"
                                                    class="form-control"
                                                    placeholder="First name"
                                                    type="text"
                                                    value="Mark"
                                                />
                                                <div
                                                    v-if="submitted && $v.supplier.name.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.supplier.name.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustom03">Email <span
                                                    class="required">*</span></label>
                                                <input
                                                    id="validationCustom03"
                                                    v-model="supplier.email"
                                                    :class="{ 'is-invalid': submitted && $v.supplier.email.$error }"
                                                    class="form-control"
                                                    placeholder="Email"
                                                    :disabled="$route.params.id"
                                                    type="text"
                                                />
                                                <div
                                                    v-if="submitted && $v.supplier.email.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.supplier.email.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustom04">Phone <span
                                                    class="required">*</span></label>
                                                <input
                                                    id="validationCustom04"
                                                    v-model="supplier.phone"
                                                    :class="{ 'is-invalid': submitted && $v.supplier.phone.$error }"
                                                    class="form-control"
                                                    placeholder="Phone"
                                                    type="text"
                                                />
                                                <div
                                                    v-if="submitted && $v.supplier.phone.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.supplier.phone.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustom05">Address <span class="required">*</span></label>
                                                <input
                                                    id="validationCustom05"
                                                    v-model="supplier.address"
                                                    :class="{ 'is-invalid': submitted && $v.supplier.address.$error }"
                                                    class="form-control"
                                                    placeholder="Address"
                                                    type="text"
                                                />
                                                <div
                                                    v-if="submitted && $v.supplier.address.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.supplier.address.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustom03">City <span
                                                    class="required">*</span></label>
                                                <multiselect
                                                    v-model="supplier.city"
                                                    :class="{ 'is-invalid': submitted && $v.supplier.city.$error }"
                                                    :options="cities"
                                                    label="city_name_en"
                                                    track-by="id"
                                                    class="text-capitalize"
                                                >
                                                </multiselect>
                                                <div
                                                    v-if="submitted && $v.supplier.city.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.supplier.city.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <b-form-checkbox v-model="supplier.active" size="lg" switch class="mb-1 mt-2">
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
                                        @click="deleteSupplier"
                                    >Delete supplier
                                    </a>
                                    <button
                                        class="btn btn-primary mt-2 float-right"
                                        type="submit"
                                    >Save supplier
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
import {email, required} from "vuelidate/lib/validators";

import PageHeader from '@/components/custom/page-header';
import SupplierService from "@/services/supplierService";
import Layout from "../../layouts/main";

export default {
    page: {
        title: "Supplier",
    },
    components: {PageHeader, Layout},
    data() {
        return {
            title: "New Supplier",
            loading: false,
            cities: [],
            supplier: {
                name: null,
                email: null,
                city: null,
                phone: null,
                active: false,
                address: null
            },
            submitted: false,
        };
    },

    validations: {
        supplier: {
            name: {required},
            city: {required},
            phone: {required},
            email: {required, email},
            address: {required},
        },
    },
    methods: {
        async formSubmit() {
            this.submitted = true;

            // stop here if form is invalid
            this.$v.$touch();

            let formData = new FormData();

            this.supplier.city_id = this.supplier.city.id;

            Object.keys(this.supplier).forEach(key => formData.append(key, this.supplier[key]));

            formData.delete("city");

            if (!this.$v.$invalid) {

                if (this.$route.params.id) {
                    formData.append('_method', "patch");

                    await SupplierService.updateSupplier(this.$route.params.id, formData);

                    await this.$router.push("/admin/suppliers");

                } else {
                    await SupplierService.storeSupplier(formData);

                    await this.$router.push("/admin/suppliers");
                }
            }
        },

        async loadSuppliers() {
            this.supplier = await SupplierService.getSupplier(this.$route.params.id);

            this.loading = false;
        },

        async deleteSupplier() {

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
                    await SupplierService.deleteSupplier(this.$route.params.id);

                    await this.$router.push('/admin/suppliers');
                }
            });
        },

        async loadCities() {
            let response = await this.$http.get('/api/cities');

            this.cities = response.data.payload.cities;
        },
    },
    created() {

        if (this.$route.params.id) {

            this.loading = true;

            this.title = "Edit supplier";

            this.loadSuppliers();
        }

        this.loadCities();
    }
};
</script>

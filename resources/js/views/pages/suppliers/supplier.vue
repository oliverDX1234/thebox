<template>
    <div>

        <PageHeader
            :items="items"
            :title="title"
        />
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="mt-2">
                                    <FileUpload @image-uploaded="imageUploaded"
                                                :imageData="supplier.image"/>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-12 mt-lg-0 mt-5">
                                <form
                                    class="needs-validation"
                                    @submit.prevent="formSubmit"
                                >
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustom01">First name <span
                                                    class="required">*</span></label>
                                                <input
                                                    id="validationCustom01"
                                                    v-model="supplier.first_name"
                                                    :class="{ 'is-invalid': submitted && $v.supplier.first_name.$error }"
                                                    class="form-control"
                                                    placeholder="First name"
                                                    type="text"
                                                    value="Mark"
                                                />
                                                <div
                                                    v-if="submitted && $v.supplier.first_name.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.supplier.first_name.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustom02">Last name <span
                                                    class="required">*</span></label>
                                                <input
                                                    id="validationCustom02"
                                                    v-model="supplier.last_name"
                                                    :class="{ 'is-invalid': submitted && $v.supplier.last_name.$error }"
                                                    class="form-control"
                                                    placeholder="Last name"
                                                    type="text"
                                                    value="Otto"
                                                />
                                                <div
                                                    v-if="submitted && $v.supplier.last_name.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.supplier.last_name.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
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
                                                    <span v-if="!$v.supplier.email.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>
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
                                                    <span v-if="!$v.supplier.phone.required">This value is required.</span>
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
                                                    <span v-if="!$v.supplier.city.required">This value is required.</span>
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
                                                <label for="validationCustom04">Gender <span
                                                    class="required">*</span></label>

                                                <multiselect
                                                    v-model="supplier.gender"
                                                    :class="{ 'is-invalid': submitted && $v.supplier.gender.$error }"
                                                    :options="genderOptions"
                                                    class="text-capitalize"
                                                ></multiselect>
                                                <div
                                                    v-if="submitted && $v.supplier.gender.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span v-if="!$v.supplier.gender.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustom04">Date of birth <span
                                                    class="required">*</span></label>
                                                <date-picker
                                                    v-model="supplier.dob"
                                                    :class="{ 'is-invalid': submitted && $v.supplier.dob.$error }"
                                                    :first-day-of-week="1"
                                                    confirm
                                                    format='YYYY-MM-DD'
                                                    placeholder="Select Date"
                                                    value-type="format"
                                                ></date-picker>

                                                <div
                                                    v-if="submitted && $v.supplier.dob.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span v-if="!$v.supplier.dob.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustom04">Role <span
                                                    class="required">*</span></label>

                                                <multiselect
                                                    v-model="supplier.roles"
                                                    :class="{ 'is-invalid': submitted && $v.supplier.roles.$error }"
                                                    :options="rolesOptions"
                                                    class="text-capitalize"
                                                ></multiselect>
                                                <div
                                                    v-if="submitted && $v.supplier.roles.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span v-if="!$v.supplier.roles.required">This value is required.</span>
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
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label v-if="$route.params.id">Change password <em
                                                    class="font-weight-normal">( you can leave
                                                    fields blank )</em></label>
                                                <label v-else>Password <span class="required">*</span> </label>
                                                <div>
                                                    <input
                                                        v-model="supplier.password"
                                                        :class="{ 'is-invalid': submitted && $v.supplier.password.$error }"
                                                        class="form-control"
                                                        name="password"
                                                        placeholder="Password"
                                                        type="password"
                                                    />
                                                    <div
                                                        v-if="submitted && $v.supplier.password.$error"
                                                        class="invalid-feedback"
                                                    >
                                                        <span
                                                            v-if="!$v.supplier.password.required">This value is required.</span>

                                                        <span v-if="!$v.supplier.password.minLength">Password must be at least 6 characters.</span>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <input
                                                        v-model="supplier.confirmPassword"
                                                        :class="{ 'is-invalid': submitted && $v.supplier.confirmPassword.$error }"
                                                        class="form-control"
                                                        name="confirmPassword"
                                                        placeholder="Re-Type Password"
                                                        type="password"
                                                    />
                                                    <div
                                                        v-if="submitted && $v.supplier.confirmPassword.$error"
                                                        class="invalid-feedback"
                                                    >
                                                        <span v-if="!$v.supplier.confirmPassword.required">This value is required.</span>

                                                        <span v-if="!$v.supplier.confirmPassword.sameAsPassword">This value should be the same.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a
                                        class="btn btn-danger mt-2 float-left"
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

    </div>
</template>

<script>
import {email, minLength, required, sameAs} from "vuelidate/lib/validators";

import PageHeader from '@/components/page-header';
import FileUpload from '@/components/file-upload.vue'
import DatePicker from "vue2-datepicker";
import Multiselect from "vue-multiselect";
import SupplierService from "@/services/supplierService";

export default {
    page: {
        title: "supplier",
        meta: [{name: "New/Edit supplier", content: "Create or edit a supplier"}],
    },
    components: {PageHeader, FileUpload, DatePicker, Multiselect},
    data() {

        return {
            title: "New supplier",
            items: [
                {
                    text: "suppliers",
                    to: "/admin/suppliers"
                },
                {
                    text: "New supplier",
                    active: true
                }
            ],
            genderOptions: ["male", "female"],
            rolesOptions: ["supplier", "admin"],
            cities: [],
            imageInput: null,
            supplier: {
                first_name: null,
                last_name: null,
                email: null,
                city: null,
                phone: null,
                address: null,
                gender: null,
                dob: null,
                password: null,
                roles: null,
                confirmPassword: null,
                image: null
            },
            submitted: false,
        };
    },
    validations: {
        supplier: {
            first_name: {required},
            last_name: {required},
            city: {required},
            phone: {required},
            email: {required, email},
            address: {required},
            roles: {required},
            gender: {required},
            dob: {required},
            password: {
                required: function () {
                    if (this.$route.params.id) {
                        return true;
                    } else {
                        return (this.supplier.password !== null);
                    }
                },
                minLength: minLength(7)
            },
            confirmPassword: {
                required: function () {
                    if (this.$route.params.id) {
                        return true;
                    } else {
                        return (this.supplier.password !== null);
                    }
                }, sameAsPassword: sameAs("password")
            },
        },
    },
    methods: {
        async formSubmit() {

            this.submitted = true;
            let id = this.$route.params.id;
            // stop here if form is invalid
            this.$v.$touch();

            let fullCity = this.supplier.city;
            this.supplier.city = this.supplier.city.id;
            let formData = new FormData();

            Object.keys(this.supplier).forEach(key => formData.append(key, this.supplier[key]));
            formData.append("imageInput", this.imageInput);
            this.supplier.city = fullCity;

            if (!this.$v.$invalid) {

                if (id) {
                    formData.append('_method', "patch");
                    await suppliersService.updatesuppliers(id, formData);

                } else {
                    await suppliersService.storesuppliers(formData);
                }
            }
        },
        async loadsuppliers() {

            this.supplier = await suppliersService.getsuppliers(this.$route.params.id);
        },


        async deletesuppliers() {

            await suppliersService.deletesuppliers(this.$route.params.id);

            await this.$router.push('/admin/suppliers');

        },

        async loadCities() {

            try {
                let response = await this.$http.get('/api/cities');
                this.cities = response.data.payload.cities;
            } catch (e) {
            }
        },
        imageUploaded(file) {
            this.imageInput = file;
        }

    },

    created() {

        if (this.$route.params.id) {
            this.title = "Edit supplier";
            this.items[1].text = "Edit supplier";
            this.loadsuppliers();
        } else {
            this.supplier.image = "http://127.0.0.1:8000/images/upload.png"
        }
        this.loadCities();
    }
};
</script>

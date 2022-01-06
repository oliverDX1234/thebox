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
                                    <FileUpload :imageData="user.image"/>
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
                                                    v-model="user.first_name"
                                                    :class="{ 'is-invalid': submitted && $v.user.first_name.$error }"
                                                    class="form-control"
                                                    placeholder="First name"
                                                    type="text"
                                                    value="Mark"
                                                />
                                                <div
                                                    v-if="submitted && $v.user.first_name.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.user.first_name.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustom02">Last name <span
                                                    class="required">*</span></label>
                                                <input
                                                    id="validationCustom02"
                                                    v-model="user.last_name"
                                                    :class="{ 'is-invalid': submitted && $v.user.last_name.$error }"
                                                    class="form-control"
                                                    placeholder="Last name"
                                                    type="text"
                                                    value="Otto"
                                                />
                                                <div
                                                    v-if="submitted && $v.user.last_name.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.user.last_name.required">This value is required.</span>
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
                                                    v-model="user.email"
                                                    :class="{ 'is-invalid': submitted && $v.user.email.$error }"
                                                    class="form-control"
                                                    placeholder="Email"
                                                    type="text"
                                                />
                                                <div
                                                    v-if="submitted && $v.user.email.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span v-if="!$v.user.email.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustom04">Phone <span
                                                    class="required">*</span></label>
                                                <input
                                                    id="validationCustom04"
                                                    v-model="user.phone"
                                                    :class="{ 'is-invalid': submitted && $v.user.phone.$error }"
                                                    class="form-control"
                                                    placeholder="Phone"
                                                    type="text"
                                                />
                                                <div
                                                    v-if="submitted && $v.user.phone.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span v-if="!$v.user.phone.required">This value is required.</span>
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
                                                    v-model="user.city"
                                                    :class="{ 'is-invalid': submitted && $v.user.city.$error }"
                                                    :options="cities"
                                                    class="text-capitalize"
                                                ></multiselect>
                                                <div
                                                    v-if="submitted && $v.user.city.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span v-if="!$v.user.city.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustom05">Address <span class="required">*</span></label>
                                                <input
                                                    id="validationCustom05"
                                                    v-model="user.address"
                                                    :class="{ 'is-invalid': submitted && $v.user.address.$error }"
                                                    class="form-control"
                                                    placeholder="Address"
                                                    type="text"
                                                />
                                                <div
                                                    v-if="submitted && $v.user.address.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.user.address.required">This value is required.</span>
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
                                                    v-model="user.gender"
                                                    :class="{ 'is-invalid': submitted && $v.user.gender.$error }"
                                                    :options="genderOptions"
                                                    class="text-capitalize"
                                                ></multiselect>
                                                <div
                                                    v-if="submitted && $v.user.gender.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span v-if="!$v.user.gender.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustom04">Date of birth <span
                                                    class="required">*</span></label>
                                                <date-picker
                                                    v-model="user.dob"
                                                    :class="{ 'is-invalid': submitted && $v.user.dob.$error }"
                                                    :first-day-of-week="1"
                                                    confirm
                                                    format='YYYY-MM-DD'
                                                    value-type="format"
                                                ></date-picker>

                                                <div
                                                    v-if="submitted && $v.user.dob.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span v-if="!$v.user.dob.required">This value is required.</span>
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
                                                <label>Change password <em class="font-weight-normal">( you can leave
                                                    fields blank )</em></label>
                                                <div>
                                                    <input
                                                        v-model="user.password"
                                                        :class="{ 'is-invalid': submitted && $v.user.password.$error }"
                                                        class="form-control"
                                                        name="password"
                                                        placeholder="Password"
                                                        type="password"
                                                    />
                                                    <div
                                                        v-if="submitted && $v.user.password.$error"
                                                        class="invalid-feedback"
                                                    >
                                                        <span v-if="!$v.user.password.minLength">Password must be at least 6 characters.</span>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <input
                                                        v-model="user.confirmPassword"
                                                        :class="{ 'is-invalid': submitted && $v.user.confirmPassword.$error }"
                                                        class="form-control"
                                                        name="confirmPassword"
                                                        placeholder="Re-Type Password"
                                                        type="password"
                                                    />
                                                    <div
                                                        v-if="submitted && $v.user.confirmPassword.$error"
                                                        class="invalid-feedback"
                                                    >
                                                        <span v-if="!$v.user.confirmPassword.sameAsPassword">This value should be the same.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button
                                        class="btn btn-primary mt-2 float-right"
                                        type="submit"
                                    >Save User
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

import PageHeader from "@/components/page-header";
import FileUpload from '@/components/file-upload.vue'
import DatePicker from "vue2-datepicker";
import Multiselect from "vue-multiselect";

export default {
    page: {
        title: "User",
        meta: [{name: "New/Edit User", content: "Create or edit a user"}],
    },
    components: {PageHeader, FileUpload, DatePicker, Multiselect},
    data() {
        return {
            title: "New User",
            items: [
                {
                    text: "Users",
                    to: "/admin/users"
                },
                {
                    text: "New User",
                    active: true
                }
            ],
            genderOptions: ["Male", "Female"],
            cities: null,

            user: {
                first_name: null,
                last_name: null,
                email: null,
                city: null,
                phone: null,
                role: null,
                address: null,
                gender: null,
                dob: null,
                password: null,
                confirmPassword: null,
                image: null
            },
            submitted: false,
        };
    },
    validations: {
        user: {
            first_name: {required},
            last_name: {required},
            city: {required},
            phone: {required},
            email: {required, email},
            address: {required},
            role: {required},
            gender: {required},
            dob: {required},
            password: {minLength: minLength(7)},
            confirmPassword: {sameAsPassword: sameAs("password")},
        },
    },
    methods: {
        formSubmit(e) {
            this.submitted = true;
            // stop here if form is invalid
            this.$v.$touch();

            console.log(this.user);
        },

        async loadUser() {

            let id = this.$route.params.id;

            try {
                let response = await this.$http.get(`/api/user/${id}`);
                this.user = response.data.data;
            } catch (e) {
            }

        },
        async loadCities() {

            try {
                let response = await this.$http.get('/api/cities');
                this.cities = response.data.data;
            } catch (e) {
            }

        }

    },

    created() {

        if (this.$route.params.id) {
            this.title = "Edit User";
            this.items[1].text = "Edit User";
            this.loadUser();
        }
        this.loadCities();
    }
};
</script>

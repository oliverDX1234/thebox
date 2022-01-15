<template>
    <Layout>

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
                                                :imageData="user.image"/>
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
                                                    :disabled="$route.params.id"
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
                                                    label="city_name_en"
                                                    track-by="id"
                                                    class="text-capitalize"
                                                >
                                                </multiselect>
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
                                                    placeholder="Select Date"
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustom04">Role <span
                                                    class="required">*</span></label>

                                                <multiselect
                                                    v-model="user.roles"
                                                    :class="{ 'is-invalid': submitted && $v.user.roles.$error }"
                                                    :options="rolesOptions"
                                                    class="text-capitalize"
                                                ></multiselect>
                                                <div
                                                    v-if="submitted && $v.user.roles.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span v-if="!$v.user.roles.required">This value is required.</span>
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
                                                        <span
                                                            v-if="!$v.user.password.required">This value is required.</span>

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
                                                        <span v-if="!$v.user.confirmPassword.required">This value is required.</span>

                                                        <span v-if="!$v.user.confirmPassword.sameAsPassword">This value should be the same.</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <b-form-checkbox v-model="user.active" size="lg" switch class="mb-1 mt-2">
                                                <label>Active</label>
                                            </b-form-checkbox>
                                        </div>
                                    </div>
                                    <a
                                        class="btn btn-danger mt-2 float-left"
                                        @click="deleteUser"
                                    >Delete User
                                    </a>
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

    </Layout>
</template>

<script>
import {email, minLength, required, sameAs} from "vuelidate/lib/validators";

import PageHeader from '@/components/page-header';
import FileUpload from '@/components/file-upload.vue'
import DatePicker from "vue2-datepicker";
import Multiselect from "vue-multiselect";
import Layout from "../../layouts/main";
import UserService from "@/services/userService";

export default {
    page: {
        title: "User",
        meta: [{name: "New/Edit User", content: "Create or edit a user"}],
    },
    components: {PageHeader, FileUpload, DatePicker, Multiselect, Layout},
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
            genderOptions: ["male", "female"],
            rolesOptions: ["user", "admin"],
            cities: [],
            imageInput: null,
            user: {
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
                active: false,
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
            roles: {required},
            gender: {required},
            dob: {required},
            password: {
                required: function () {
                    if (this.$route.params.id) {
                        return true;
                    } else {
                        return (this.user.password !== null);
                    }
                },
                minLength: minLength(7)
            },
            confirmPassword: {
                required: function () {
                    if (this.$route.params.id) {
                        return true;
                    } else {
                        return (this.user.password !== null);
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

            let fullCity = this.user.city;
            this.user.city = this.user.city.id;
            let formData = new FormData();

            Object.keys(this.user).forEach(key => formData.append(key, this.user[key]));
            formData.append("imageInput", this.imageInput);
            this.user.city = fullCity;

            if (!this.$v.$invalid) {

                if (id) {
                    formData.append('_method', "patch");
                    await UserService.updateUser(id, formData);

                } else {
                    await UserService.storeUser(formData);
                }
            }
        },
        async loadUser() {

            this.user = await UserService.getUser(this.$route.params.id);
        },


        async deleteUser() {

            await UserService.deleteUser(this.$route.params.id);

            await this.$router.push('/admin/users');

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
            this.title = "Edit User";
            this.items[1].text = "Edit User";
            this.loadUser();
        } else {
            this.user.image = "http://127.0.0.1:8000/images/upload.png"
        }
        this.loadCities();
    }
};
</script>

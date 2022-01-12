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
                                                    v-model="category.name"
                                                    :class="{ 'is-invalid': submitted && $v.category.name.$error }"
                                                    class="form-control"
                                                    placeholder="First name"
                                                    type="text"
                                                    value="Mark"
                                                />
                                                <div
                                                    v-if="submitted && $v.category.name.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.category.name.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustom03">Email <span
                                                    class="required">*</span></label>
                                                <input
                                                    id="validationCustom03"
                                                    v-model="category.email"
                                                    :class="{ 'is-invalid': submitted && $v.category.email.$error }"
                                                    class="form-control"
                                                    placeholder="Email"
                                                    :disabled="$route.params.id"
                                                    type="text"
                                                />
                                                <div
                                                    v-if="submitted && $v.category.email.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.category.email.required">This value is required.</span>
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
                                                    v-model="category.phone"
                                                    :class="{ 'is-invalid': submitted && $v.category.phone.$error }"
                                                    class="form-control"
                                                    placeholder="Phone"
                                                    type="text"
                                                />
                                                <div
                                                    v-if="submitted && $v.category.phone.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.category.phone.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustom05">Address <span class="required">*</span></label>
                                                <input
                                                    id="validationCustom05"
                                                    v-model="category.address"
                                                    :class="{ 'is-invalid': submitted && $v.category.address.$error }"
                                                    class="form-control"
                                                    placeholder="Address"
                                                    type="text"
                                                />
                                                <div
                                                    v-if="submitted && $v.category.address.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.category.address.required">This value is required.</span>
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
                                                    v-model="category.city"
                                                    :class="{ 'is-invalid': submitted && $v.category.city.$error }"
                                                    :options="cities"
                                                    label="city_name_en"
                                                    track-by="id"
                                                    class="text-capitalize"
                                                >
                                                </multiselect>
                                                <div
                                                    v-if="submitted && $v.category.city.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.category.city.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                    </div>

                                    <a
                                        class="btn btn-danger mt-2 float-left"
                                        @click="deleteCategory"
                                    >Delete category
                                    </a>
                                    <button
                                        class="btn btn-primary mt-2 float-right"
                                        type="submit"
                                    >Save category
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
import {email, required} from "vuelidate/lib/validators";

import PageHeader from '@/components/page-header';
import Multiselect from "vue-multiselect";
import CategoryService from "@/services/categoryService";

export default {
    page: {
        title: "Category",
        meta: [{name: "New/Edit Category", content: "Create or edit a category"}],
    },
    components: {PageHeader,  Multiselect},
    data() {

        return {
            title: "New Category",
            items: [
                {
                    text: "Category",
                    to: "/admin/categories"
                },
                {
                    text: "New Category",
                    active: true
                }
            ],
            cities: [],
            category: {
                name: null,
                email: null,
                city: null,
                phone: null,
                address: null
            },
            submitted: false,
        };
    },
    validations: {
        category: {
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
            let id = this.$route.params.id;
            // stop here if form is invalid
            this.$v.$touch();

            let fullCity = this.category.city;
            this.category.city = this.category.city.id;
            let formData = new FormData();

            Object.keys(this.category).forEach(key => formData.append(key, this.category[key]));
            this.category.city = fullCity;

            if (!this.$v.$invalid) {

                if (id) {
                    formData.append('_method', "patch");
                    await CategoryService.updateCategory(id, formData);

                } else {
                    await CategoryService.storeCategory(formData);
                }
            }
        },
        async loadCategory() {


            this.category = await CategoryService.getCategory(this.$route.params.id);
        },


        async deleteCategory() {

            await CategoryService.deleteCategory(this.$route.params.id);

            await this.$router.push('/admin/categories');

        },

        async loadCities() {

            try {
                let response = await this.$http.get('/api/cities');
                this.cities = response.data.payload.cities;
            } catch (e) {
            }
        },
    },

    created() {

        if (this.$route.params.id) {
            this.title = "Edit category";
            this.items[1].text = "Edit category";
            this.loadCategory();
        }
        this.loadCities();
    }
};
</script>

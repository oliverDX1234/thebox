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
                            <div>
                                <div class="row mt-2">
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="row">
                                            <div class="col-12 mt-3 mb-2">
                                                <h5>List of Categories</h5>
                                            </div>
                                        </div>

                                        <nestable @nestable-updated="updateItems" @delete-item="deleteCategory"
                                                  @edit-item="editCategory"
                                                  :itemsForNesting="categories"></nestable>

                                        <div class="row mt-3 mb-3 d-md-none">
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="row">
                                            <div class="col-12 mt-3 ml-3">
                                                <h5>{{ inputHeading }}</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mt-1">
                                                <div class="card-box-shadow">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <form
                                                                    class="needs-validation"
                                                                    @submit.prevent="formSubmit"
                                                                >
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="validationCustom01">Name<span
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
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>Description
                                                                                    <span
                                                                                        class="required">*</span></label>
                                                                                <textarea
                                                                                    id="validationCustom02"
                                                                                    rows="5"
                                                                                    v-model="category.description"
                                                                                    :class="{ 'is-invalid': submitted && $v.category.description.$error }"
                                                                                    class="form-control"
                                                                                    placeholder="Description"
                                                                                    :disabled="$route.params.id"
                                                                                    type="text"
                                                                                />
                                                                                <div
                                                                                    v-if="submitted && $v.category.description.$error"
                                                                                    class="invalid-feedback"
                                                                                >
                                                                                <span
                                                                                    v-if="!$v.category.description.required">This value is required.</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="validationCustom03">SEO
                                                                                    keywords
                                                                                    <span
                                                                                        class="required">*</span></label>
                                                                                <input
                                                                                    id="validationCustom03"
                                                                                    v-model="category.seo_keywords"
                                                                                    :class="{ 'is-invalid': submitted && $v.category.seo_keywords.$error }"
                                                                                    class="form-control"
                                                                                    placeholder="SEO keywords"
                                                                                    type="text"
                                                                                />
                                                                                <div
                                                                                    v-if="submitted && $v.category.seo_keywords.$error"
                                                                                    class="invalid-feedback"
                                                                                >
                                                                                <span
                                                                                    v-if="!$v.category.seo_keywords.required">This value is required.</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label>SEO description
                                                                                    <span
                                                                                        class="required">*</span></label>
                                                                                <textarea
                                                                                    rows="5"
                                                                                    v-model="category.seo_description"
                                                                                    :class="{ 'is-invalid': submitted && $v.category.seo_description.$error }"
                                                                                    class="form-control"
                                                                                    placeholder="SEO description"
                                                                                    :disabled="$route.params.id"
                                                                                    type="text"
                                                                                />
                                                                                <div
                                                                                    v-if="submitted && $v.category.seo_description.$error"
                                                                                    class="invalid-feedback"
                                                                                >
                                                                                <span
                                                                                    v-if="!$v.category.seo_description.required">This value is required.</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label
                                                                                    for="validationCustom03">Filters</label>
                                                                                <multiselect
                                                                                    v-model="category.filters"
                                                                                    :options="filters"
                                                                                    label="name"
                                                                                    multiple=""
                                                                                    track-by="id"
                                                                                    class="text-capitalize"
                                                                                >
                                                                                </multiselect>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <b-form-checkbox v-model="category.active"
                                                                                             size="lg" switch
                                                                                             class="mb-1 mt-2">
                                                                                <label>Active</label>
                                                                            </b-form-checkbox>
                                                                        </div>
                                                                    </div>

                                                                    <a
                                                                        class="btn btn-success mt-2 float-left"
                                                                        @click="newCategory"
                                                                        v-if="editableId"
                                                                    >New category
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </load-spinner>
    </Layout>
</template>

<script>
import PageHeader from "@/components/custom/page-header";
import CustomTable from "@/components/reusable/tables/CustomTable";
import Nestable from "@/components/custom/Nestable";
import CategoryService from "@/services/categoryService";
import {required} from "vuelidate/lib/validators";
import FilterService from "../../../services/filterService";
import Layout from "../../layouts/main";

/**
 * Customers Component
 */
export default {
    components: {
        CustomTable,
        PageHeader,
        Layout,
        Nestable
    },
    watch: {
        categories(newValue, oldValue) {
            if (newValue.length && oldValue.length) {
                this.saveChanges();
            }
        }
    },
    data() {
        return {
            title: "Category",
            index: null,
            loading: false,
            categories: [],
            category: {
                name: null,
                description: null,
                city: null,
                seo_keywords: null,
                active: false,
                filters: []
            },
            editableId: null,
            filters: [],
            submitted: false,
        };
    },
    validations: {
        category: {
            name: {required},
            seo_description: {required},
            seo_keywords: {required},
            description: {required},
        },
    },
    computed: {
        inputHeading() {
            return this.editableId ? "Edit Category" : "New Category";
        }
    },
    created() {
        this.loading = true;

        this.getCategoriesTree();
        this.getFilters();
    },
    methods: {
        editCategory(id) {
            if (window.innerWidth <= 767) {
                this.$scrollTo('.needs-validation', 1500)
            }
            this.editableId = id;

            this.loading = true;

            this.loadCategory(id)
        },
        async updateCategory(value) {
            await this.updateIndexFunction(this.categories, value)
            this.index = null;
        },
        async storeCategory(value) {
            this.categories.push({
                id: value.id,
                name: value.name,
                description: value.description,
                seo_keywords: value.seo_keywords,
                active: value.active,
                seo_description: value.seo_description,
            });

            await this.newCategory();
        },
        async deleteCategory(id) {
            let response;
            await this.$swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Yes, delete it!"
            }).then(async result => {
                if (result.value) {
                    response = await CategoryService.deleteCategory(id);

                    await this.deleteIndexFunction(this.categories, parseInt(response));
                    this.index = null;
                    await this.newCategory();
                }
            });
        },

        async formSubmit() {
            this.submitted = true;
            // stop here if form is invalid
            this.$v.$touch();

            if (!this.$v.$invalid) {

                let response = [];

                if (this.editableId) {
                    response = await CategoryService.updateCategory(this.editableId, this.category);
                    await this.updateCategory(response);
                } else {
                    response = await CategoryService.storeCategory(this.category);
                    await this.storeCategory(response);
                }
            }
        },

        newCategory() {
            this.editableId = false;
            const keys = Object.keys(this.category);
            keys.forEach((key, index) => {
                this.category[key] = null;
            });
            this.$v.$reset()
        },

        async loadCategory(id) {
            this.category = await CategoryService.getCategory(id);

            this.loading = false;
        },

        deleteIndexFunction(category, id, previous = null) {
            if (!!this.index) {
                return;
            }
            for (var i = 0; i < category.length; i++) {
                if (category[i].id === id) {
                    this.index = id;
                    if (this.categories === category) {
                        this.categories.splice(i, 1)
                    } else {
                        previous.children = [];
                    }
                    return;
                } else {
                    if (category[i].children.length !== 0) {
                        this.deleteIndexFunction(category[i].children, id, category[i]);
                    }
                }
            }
        },

        updateIndexFunction(category, value, previous = null) {
            if (!!this.index) {
                return;
            }
            for (var i = 0; i < category.length; i++) {
                if (category[i].id === value.id) {
                    this.index = value.id;
                    if (this.categories === category) {
                        this.categories[i].name = value.name;
                        this.categories[i].description = value.description;
                        this.categories[i].seo_keywords = value.seo_keywords;
                        this.categories[i].active = value.active;
                        this.categories[i].seo_description = value.seo_description;
                    } else {
                        previous.children = [];
                    }
                    return;
                } else {
                    if (category[i].children.length !== 0) {
                        this.updateIndexFunction(category[i].children, value, category[i]);
                    }
                }
            }
        },

        updateItems(items) {
            this.categories = items;
        },

        async saveChanges() {
            await CategoryService.saveCategories(this.categories);
        },

        async getCategoriesTree() {
            const categories = await CategoryService.getCategoriesTree();

            this.categories = categories.map(x => {
                x.parent = x.parent != null ? x.parent.name : "/";
                return x;
            })

            this.loading = false;
        },

        async getFilters() {
            this.filters = await FilterService.getFilters();
        }
    }
};
</script>



<script>
import PageHeader from "@/components/page-header";
import CustomTable from "@/components/CustomTable";
import Nestable from "@/components/Nestable";
import CategoryService from "@/services/categoryService";
import Swal from "sweetalert2";
import {required} from "vuelidate/lib/validators";


/**
 * Customers Component
 */
export default {
    components: {
        CustomTable,
        PageHeader,
        Nestable
    },
    data() {
        return {
            title: "Category",
            index: null,
            items: [
                {
                    text: "Category",
                    active: true

                }
            ],
            categories: [],
            cities: [],
            category: {
                name: null,
                description: null,
                city: null,
                seo_keywords: null,
                address: null
            },
            editableId: null,
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
        this.getCategoriesTree();
    },
    methods: {
        editCategory(id) {
            this.editableId = id;
            this.input
            this.loadCategory(id)
        },
        async deleteCategory(id) {
            let response;

            await Swal.fire({
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
                }
            });
        },

        async formSubmit() {
            this.submitted = true;
            // stop here if form is invalid
            this.$v.$touch();

            if (!this.$v.$invalid) {

                if (this.editableId) {
                    await CategoryService.updateCategory(this.editableId, this.category);

                } else {
                    await CategoryService.storeCategory(this.category);
                }
            }
        },


        newCategory() {

            this.editableId = false;

            const keys = Object.keys(this.category);

            keys.forEach((key, index) => {
                this.category[key] = null;
            });
        },

        async loadCategory(id) {
            this.category = await CategoryService.getCategory(id);
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
        },
    }
};
</script>

<template>
    <div>
        <PageHeader
            :title="title"
            :items="items"
        />
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
                                    <div class="row">
                                        <div class="col-12">
                                            <a
                                                href="javascript:void(0);"
                                                class="btn btn-primary mb-2"
                                                v-if="categories.length !== 0"
                                                @click="saveChanges"
                                            >
                                                Save changes
                                            </a>
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
                                        <div class="col-lg-12">
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
                                                                            <label for="validationCustom03">SEO keywords <span
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
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <hr>
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
    </div>
</template>



<template>
    <Layout>
        <PageHeader
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
                                                <label>Name<span
                                                    class="required">*</span></label>
                                                <input
                                                    v-model="discount.name"
                                                    :class="{ 'is-invalid': submitted && $v.discount.name.$error }"
                                                    class="form-control"
                                                    placeholder="Enter Discount Name"
                                                    type="text"
                                                />
                                                <div
                                                    v-if="submitted && $v.discount.value.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.discount.name.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="validationCustom01">Value<span
                                                    class="required">*</span></label>
                                                <input
                                                    id="validationCustom01"
                                                    v-model="discount.value"
                                                    :class="{ 'is-invalid': submitted && $v.discount.value.$error }"
                                                    class="form-control"
                                                    placeholder="Enter Discount Value"
                                                    type="text"
                                                />
                                                <div
                                                    v-if="submitted && $v.discount.value.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.discount.value.required">This value is required.</span>
                                                    <span
                                                        v-if="!$v.discount.value.numeric">This value needs to be numeric.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Type <span
                                                    class="required">*</span></label>
                                                <multiselect
                                                    :options="options"
                                                    v-model="discount.type"
                                                    :class="{ 'is-invalid': submitted && $v.discount.type.$error }"
                                                    placeholder="Select Discount Type"
                                                >

                                                </multiselect>
                                                <div
                                                    v-if="submitted && $v.discount.type.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.discount.type.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Start Date <span
                                                    class="required">*</span></label>
                                                <br/>
                                                <date-picker v-model="discount.start_date" type="datetime" lang="en"
                                                             :class="{ 'is-invalid': submitted && $v.discount.start_date.$error }"
                                                             placeholder="Select Start Date"
                                                             confirm></date-picker>
                                                <div
                                                    v-if="submitted && $v.discount.start_date.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.discount.start_date.required">This value is required.</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>End Date <span class="font-size-11 text-warning">(Leave blank for no limit)</span></label>
                                                <date-picker v-model="discount.end_date" type="datetime" lang="en"
                                                             placeholder="Select End Date"
                                                             confirm></date-picker>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Products</label>
                                                <multiselect
                                                    v-model="discount.product_ids"
                                                    :class="{ 'is-invalid': submitted && $v.discount.product_ids.$error }"
                                                    :options="products"
                                                    label="name"
                                                    track-by="id"
                                                    class="text-capitalize"
                                                    multiple
                                                    placeholder="Select Products"
                                                >
                                                </multiselect>
                                                <div
                                                    v-if="submitted && $v.discount.product_ids.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.discount.product_ids.required">Select this field or categories.</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Categories</label>
                                                <multiselect
                                                    v-model="discount.category_ids"
                                                    :options="categories"
                                                    label="name"
                                                    multiple
                                                    track-by="id"
                                                    class="text-capitalize"
                                                    :class="{ 'is-invalid': submitted && $v.discount.category_ids.$error }"
                                                    placeholder="Select Categories"
                                                >
                                                </multiselect>
                                                <div
                                                    v-if="submitted && $v.discount.category_ids.$error"
                                                    class="invalid-feedback"
                                                >
                                                    <span
                                                        v-if="!$v.discount.category_ids.required">Select this field or products.</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="ro">

                                        <div class="col-md-12">
                                            <b-form-checkbox v-model="discount.active" size="lg" switch
                                                             class="mb-1 mt-2">
                                                <label>Active</label>
                                            </b-form-checkbox>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                    </div>

                                    <button
                                        class="btn btn-primary mt-2 float-right"
                                        type="submit"
                                    >Save discount
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
import {required, requiredIf, numeric} from "vuelidate/lib/validators";
import PageHeader from '@/components/custom/page-header';
import DiscountService from "@/services/discountService";
import ProductService from "../../../services/productService";
import CategoryService from "../../../services/categoryService";
import Layout from "../../layouts/main";
import DatePicker from "vue2-datepicker";

export default {
    page: {
        title: "Discount"
    },
    components: {PageHeader, DatePicker, Layout},
    data() {
        return {
            title: "New Discount",
            options: [
                "fixed",
                "percent"
            ],
            products: [],
            categories: [],
            discount: {
                value: null,
                name: null,
                type: null,
                start_date: null,
                end_date: null,
                active: true,
                product_ids: [],
                category_ids: []
            },
            submitted: false,
        };
    },
    validations: {
        discount: {
            value: {required, numeric},
            type: {required},
            name: {required},
            start_date: {required},
            product_ids: {
                required: requiredIf(function (items) {
                    return !items.product_ids.length && !items.category_ids.length
                })
            },
            category_ids: {
                required: requiredIf(function (items) {
                    return !items.product_ids.length && !items.category_ids.length
                })
            }
        },
    },
    methods: {
        async formSubmit() {

            this.submitted = true;
            // stop here if form is invalid
            this.$v.$touch();

            if (!this.$v.$invalid) {

                let product_ids = this.discount.product_ids.map(x => x.id);
                let category_ids = this.discount.category_ids.map(x => x.id);

                let payload = {
                    value: this.discount.value,
                    type: this.discount.type,
                    name: this.discount.name,
                    start_date: this.moment(this.discount.start_date).format("YYYY-MM-DD HH:mm:ss"),
                    end_date: this.discount.end_date ? this.moment(this.discount.end_date).format("YYYY-MM-DD HH:mm:ss") : null,
                    active: this.discount.active,
                    product_ids: product_ids,
                    category_ids: category_ids
                }

                await DiscountService.storeDiscount(payload);

            }
        },

        async loadProducts() {
            this.products = await ProductService.getProducts();
        },

        async loadCategories() {
            this.categories = await CategoryService.getCategories();
        }
    },
    created() {
        this.loadProducts();
        this.loadCategories();
    }
};
</script>

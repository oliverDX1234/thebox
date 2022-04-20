<script>
import Multiselect from "vue-multiselect";
import vue2Dropzone from "vue2-dropzone";
import SupplierService from "@/services/supplierService";
import CategoryService from "@/services/categoryService";
import {FormWizard, TabContent} from "vue-form-wizard";
import Layout from "../../layouts/main";
import PageHeader from "@/components/page-header";
import productService from "../../../services/productService";

import {
    required,
    minLength,
    helpers,
    numeric
} from "vuelidate/lib/validators";

const keywords = helpers.regex('keywords', /^[a-zA-Z\s]+,?[a-zA-Z\s]+$/);

/**
 * Add Product Component
 */
export default {
    components: {
        vueDropzone: vue2Dropzone,
        Layout,
        PageHeader,
        FormWizard,
        TabContent,
        Multiselect
    },
    data() {
        return {
            title: "Add Product",
            items: [
                {
                    text: "Ecommerce"
                },
                {
                    text: "Add Product",
                    active: true
                }
            ],
            product: {
                basic_information:{
                    name: null,
                    supplier_id: null,
                    unit_code: null,
                    weight: null,
                    width: null,
                    height: null,
                    length: null,
                    category_id: null,
                    description: null,
                    selectedCategories: null
                },
                suppliers: [],
                galleryImages: [],
                selectedAttributes: {},
                meta: {
                    title: null,
                    keywords: [],
                    description: null
                }
            },
            categories: [],
            filters: [],
            dropzoneOptions: {
                url: "#",
                thumbnailWidth: 200,
                maxFilesize: 0.5,
                addRemoveLinks: true,
                autoProcessQueue: false
            },
            submitted: false
        };
    },
    validations: {
        product: {
            basic_information:{
                name: {required},
                unit_code: {required},
                weight: {required, numeric},
                width: {required, numeric},
                height: {required, numeric},
                length: {required, numeric},
                selectedCategories: {required, minLength: minLength(1)},
            },
            meta:{
                title: {required},
                keywords: {required, keywords},
                description: {required}
            }
        },

    },
    methods: {
        async getSupplier() {
            this.product.suppliers = await SupplierService.getSuppliers();
        },

        async getCategories() {
            this.categories = await CategoryService.getCategories();
        },

        async categoriesChanged() {
            let response = await CategoryService.getFiltersForCategories(this.product.selectedCategories);

            this.filters = response.filtersAndCategories;
        },

        imageAdded(file) {
            if (!this.product.galleryImages.some(x => x.name === file.name)) {
                this.product.galleryImages.push(file);
            }
        },
        imageDeleted(file) {
            let index = this.product.galleryImages.findIndex(x => x.name === file.name)

            if (index !== -1) {
                this.galleryImages.splice(index, 1);
            }
        },
        validateStep1() {
            this.submitted = true;

            return new Promise((resolve, reject) => {

                if (this.$v.product.basic_information.$invalid) {

                    reject("Enter all the required fields");
                    this.makeToast("danger", "Please properly enter all the required fields", "Error");
                } else {

                    this.submitted = false;
                    resolve(true);
                }
            });
        },
        validateStep2() {
            return new Promise((resolve, reject) => {
                resolve(true);
            })
        },
        validateStep3() {
            return new Promise((resolve, reject) => {
                if(this.product.galleryImages.length === 0){
                    reject("Upload at least one image")

                    this.makeToast("danger", "Please upload at least one image", "Error");
                }else{
                    resolve(true);
                }
            })
        },
        validateStep4() {
            this.submitted = true;

            return new Promise((resolve, reject) => {

                if(this.$v.product.meta.$invalid){
                    reject("Enter all the required fields");
                    this.makeToast("danger", "Please properly enter all the required fields", "Error");
                }
                resolve(true);
            })
        },
        async finishSteps(){
            let response = await productService.storeProduct(this.product)
        }
    },
    mounted() {
        this.getSupplier();
        this.getCategories();
    }
};
</script>

<template>
    <Layout>
        <PageHeader :title="title" :items="items"/>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form-wizard ref="formWizard" color="#5664d2" @on-complete="finishSteps">
                            <tab-content title="Basic Info" :before-change="validateStep1">
                                <div class="tab-pane" id="basic-info">
                                    <h4 class="card-title mb-3">Basic Information</h4>
                                    <form>
                                        <div class="form-group">
                                            <label>Product Name <span class="required">*</span> </label>
                                            <input placeholder="Product Name" v-model="product.basic_information.name" type="text"
                                                   class="form-control"
                                                   :class="{ 'is-invalid': this.submitted && $v.product.basic_information.name.$invalid }"/>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Supplier</label>
                                                    <multiselect
                                                        label="name"
                                                        v-model="product.basic_information.supplier_id"
                                                        :options="product.suppliers"
                                                    ></multiselect>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Weight <span class="required">*</span></label>
                                                    <input
                                                        placeholder="Weight"
                                                        type="text"
                                                        v-model="product.basic_information.weight"
                                                        class="form-control"
                                                        :class="{ 'is-invalid': this.submitted && $v.product.basic_information.weight.$invalid }"
                                                    />
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Unit Code <span class="required">*</span></label>
                                                    <input placeholder="Unit Code" v-model="product.basic_information.unit_code"
                                                           type="text" class="form-control"
                                                           :class="{ 'is-invalid': this.submitted && $v.product.basic_information.unit_code.$invalid }"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Width <span
                                                        class="required">*</span></label>
                                                    <input type="text" v-model="product.basic_information.width"
                                                           placeholder="Enter width in cm"
                                                           class="form-control"
                                                           :class="{ 'is-invalid': this.submitted && $v.product.basic_information.width.$invalid }">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Height <span class="required">*</span></label>
                                                    <input type="text" v-model="product.basic_information.height"
                                                           placeholder="Enter height in cm"
                                                           class="form-control"
                                                           :class="{ 'is-invalid': this.submitted && $v.product.basic_information.height.$invalid }">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Length <span class="required">*</span></label>
                                                    <input type="text" v-model="product.basic_information.length"
                                                           placeholder="Enter length in cm"
                                                           class="form-control"
                                                           :class="{ 'is-invalid': this.submitted && $v.product.basic_information.length.$invalid }">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Categories <span
                                                        class="required">*</span></label>
                                                    <multiselect
                                                        v-model="product.basic_information.selectedCategories"
                                                        :options="categories"
                                                        track-by="id"
                                                        @input="categoriesChanged"
                                                        multiple
                                                        label="name"
                                                        :class="{ 'is-invalid': this.submitted && $v.product.basic_information.selectedCategories.$invalid }"
                                                    ></multiselect>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="productdesc">Product Description</label>
                                            <textarea class="form-control" v-model="product.description"
                                                      id="productdesc" rows="5"></textarea>
                                        </div>
                                    </form>
                                </div>
                            </tab-content>
                            <tab-content title="Filters and Attributes" :before-change="validateStep2">
                                <div class="tab-pane">
                                    <h4 class="card-title mb-3">Filters and Attributes</h4>

                                    <div class="row">
                                        <div v-for="filter in filters" class="col-6">
                                            <label class="control-label">{{ filter.name }}</label>
                                            <v-select
                                                label="name"
                                                placeholder="Select option"
                                                class="mb-3"
                                                :options="filter.attributes"
                                                v-model="product.selectedAttributes[filter.name]"
                                                multiple
                                            ></v-select>
                                        </div>
                                    </div>
                                </div>
                            </tab-content>
                            <tab-content title="Product Img" :before-change="validateStep3">
                                <div class="tab-pane" id="product-img">
                                    <h4 class="card-title">Product Images</h4>
                                    <p class="card-title-desc">Upload product image</p>
                                    <vue-dropzone
                                        id="dropzone"
                                        ref="myVueDropzone"
                                        :use-custom-slot="true"
                                        :options="dropzoneOptions"
                                        :duplicateCheck="true"
                                        @vdropzone-file-added="imageAdded"
                                        @vdropzone-removed-file="imageDeleted"
                                    >
                                        <div class="dropzone-custom-content">
                                            <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                            <h4>Drop files here or click to upload.</h4>
                                        </div>
                                    </vue-dropzone>
                                </div>
                            </tab-content>
                            <tab-content title="Meta Data" :before-change="validateStep4">
                                <div class="tab-pane" id="metadata">
                                    <h4 class="card-title">Meta Data</h4>
                                    <p class="card-title-desc">Fill all information below</p>

                                    <form>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="metatitle">Meta title</label>
                                                    <input id="metatitle" v-model="product.meta.title" name="metatitle"
                                                           type="text"
                                                           class="form-control"
                                                           :class="{ 'is-invalid': this.submitted && $v.product.meta.title.$invalid }"/>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="metakeywords">Meta Keywords</label>
                                                    <input
                                                        id="metakeywords"
                                                        v-model="product.meta.keywords"
                                                        name="metakeywords"
                                                        placeholder="exp: big, blue, expensive"
                                                        type="text"
                                                        class="form-control"
                                                        :class="{ 'is-invalid': this.submitted && $v.product.meta.keywords.$invalid }"
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="metadescription">Meta Description</label>
                                            <textarea class="form-control" v-model="product.meta.description"
                                                      id="metadescription" rows="5"
                                                      :class="{ 'is-invalid': this.submitted && $v.product.meta.description.$invalid }"></textarea>
                                        </div>
                                    </form>
                                </div>
                            </tab-content>
                        </form-wizard>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

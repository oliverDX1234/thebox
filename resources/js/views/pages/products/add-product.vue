<template>
    <Layout>
        <PageHeader :title="title" :items="items"/>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form-wizard ref="formWizard" color="#5664d2" @on-complete="finishSteps">

                            <!-- Step 1 - Basic Information -->
                            <tab-content title="Basic Info" :before-change="validateStep1">
                                <div class="tab-pane" id="basic-info">
                                    <h4 class="card-title mb-3">Basic Information</h4>
                                    <form>
                                        <div class="form-group">
                                            <label>Product Name <span class="required">*</span> </label>
                                            <input placeholder="Product Name" v-model="product.basic_information.name"
                                                   type="text"
                                                   class="form-control"
                                                   :class="{ 'is-invalid': this.submitted && $v.product.basic_information.name.$invalid }"/>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Supplier</label>
                                                    <multiselect
                                                        label="name"
                                                        v-model="product.basic_information.selectedSuppliers"
                                                        :options="suppliers"
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
                                                    <input placeholder="Unit Code"
                                                           v-model="product.basic_information.unit_code"
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
                                            <label for="productdesc">Product Short Description</label>
                                            <textarea class="form-control" v-model="product.short_description"
                                                      id="productdesc" rows="5"></textarea>
                                        </div>
                                    </form>
                                </div>
                            </tab-content>

                            <!-- Step 2 - Product Price -->
                            <tab-content title="Price" :before-change="validateStep2">
                                <div class="tab-pane">
                                    <h4 class="card-title mb-3">Price</h4>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="control-label">Price <span
                                                    class="required">*</span></label>
                                                <input type="text" v-model="product.pricing.price"
                                                       class="form-control"
                                                       :class="{ 'is-invalid': this.submitted && $v.product.pricing.price.$invalid }">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="control-label">Supplier Price <span
                                                    class="required">*</span></label>
                                                <input type="text" v-model="product.pricing.supplier_price"
                                                       class="form-control"
                                                       :class="{ 'is-invalid': this.submitted && $v.product.pricing.supplier_price.$invalid }">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="control-label">Vat (%)<span
                                                    class="required">*</span></label>
                                                <multiselect
                                                    v-model="product.pricing.vat"
                                                    placeholder="Enter vat for this product"
                                                    :options="[5,10,18]"
                                                    :class="{ 'is-invalid': this.submitted && $v.product.pricing.vat.$invalid }"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tab-content>

                            <!-- Step 3 - Filters and Attributes -->
                            <tab-content title="Filters and Attributes" :before-change="validateStep3">
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

                            <!-- Step 4 - Product Gallery -->
                            <tab-content title="Product Img" :before-change="validateStep4">
                                <div class="tab-pane" id="product-img">
                                    <h4 class="card-title">Product Images</h4>
                                    <p class="card-title-desc">Upload product images</p>
                                    <div class="row mb-5">
                                        <div class="col-sm-12 col-lg-6 mb-5 mb-lg-0">
                                            <h5 class="mb-3 text-center">Main Product Image</h5>
                                            <file-upload @image-uploaded="imageUploaded"
                                                         :imageData="product.basic_information.image"/>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <h5 class="mb-3 text-center">Gallery Product Images</h5>
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
                                    </div>
                                </div>
                            </tab-content>

                            <!-- Step 5 - Meta Information -->
                            <tab-content title="Meta Information" :before-change="validateStep5">
                                <div class="tab-pane" id="metadata">
                                    <h4 class="card-title">Meta Information</h4>
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

                            <tab-content title="Preview">
                                <div class="tab-pane" id="preview">
                                    <h4 class="card-title">Preview Information</h4>
                                    <p class="card-title-desc">Check all information below</p>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <h6>Product Name</h6>
                                        <p class="mt-1 mb-3">{{ product.basic_information.name }}</p>
                                    </div>
                                    <div class="col-4">
                                        <h6>Unit Code</h6>
                                        <p class="mt-1 mb-3">{{ product.basic_information.unit_code }}</p>
                                    </div>
                                    <div class="col-4">
                                        <h6>Weight</h6>
                                        <p class="mt-1 mb-3">{{ product.basic_information.weight }}</p>
                                    </div>
                                    <div class="col-4">
                                        <h6>Width</h6>
                                        <p class="mt-1 mb-3">{{ product.basic_information.width }}</p>
                                    </div>
                                    <div class="col-4">
                                        <h6>Length</h6>
                                        <p class="mt-1 mb-3">{{ product.basic_information.length }}</p>
                                    </div>
                                    <div class="col-4">
                                        <h6>Height</h6>
                                        <p class="mt-1 mb-3">{{ product.basic_information.height }}</p>
                                    </div>
                                    <div class="col-4">
                                        <h6>Length</h6>
                                        <p class="mt-1 mb-3">{{ product.basic_information.length }}</p>
                                    </div>
                                    <div class="col-4">
                                        <h6>Categories</h6>
                                        <div class="mt-1 mb-3">
                                            <template
                                                v-for="(category, index) in product.basic_information.selectedCategories">
                                                <template
                                                    v-if="index !== product.basic_information.selectedCategories.length - 1">
                                                    {{ category.name }},
                                                </template>
                                                <template v-else>
                                                    {{ category.name }}
                                                </template>
                                            </template>
                                        </div>
                                    </div>
                                    <div v-if="product.basic_information.selectedSuppliers.length" class="col-4">
                                        <h6>Supplier</h6>
                                        <p class="mt-1 mb-3">{{ product.basic_information.selectedSuppliers.name }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">

                                    <div class="col-4">
                                        <h6>Price</h6>
                                        <p class="mt-1 mb-3">{{ product.pricing.price }}</p>
                                    </div>
                                    <div class="col-4">
                                        <h6>Supplier Price</h6>
                                        <p class="mt-1 mb-3">{{ product.pricing.supplier_price }}</p>
                                    </div>
                                    <div class="col-4">
                                        <h6>Vat</h6>
                                        <p class="mt-1 mb-3">{{ product.pricing.vat }}</p>
                                    </div>
                                </div>
                                <template v-if="Object.keys(product.selectedAttributes).length">
                                    <hr>
                                    <div class="row">
                                        <div v-for="(filter, index) in product.selectedAttributes" class="col-4">
                                            <h6>{{ index }}</h6>
                                            <div class="mt-1 mb-3">
                                                <span v-for="(attribute, index) in filter">
                                                    <template v-if="index !== filter.length - 1">
                                                        {{ attribute.name }},
                                                    </template>
                                                    <template v-else>
                                                       {{ attribute.name }}
                                                    </template>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <hr>

                                <div class="row">
                                    <div class="col-4">
                                        <h6>Meta Title</h6>
                                        <p class="mt-1 mb-3">{{ product.meta.title }}</p>
                                    </div>
                                    <div class="col-4">
                                        <h6>Meta Keywords</h6>
                                        <p class="mt-1 mb-3">{{ product.meta.keywords }}</p>
                                    </div>
                                    <div class="col-4">
                                        <h6>Meta Description</h6>
                                        <p class="mt-1 mb-3">{{ product.meta.description }}</p>
                                    </div>

                                </div>
                            </tab-content>

                        </form-wizard>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
<script>
import Multiselect from "vue-multiselect";
import vue2Dropzone from "vue2-dropzone";
import SupplierService from "@/services/supplierService";
import CategoryService from "@/services/categoryService";
import {FormWizard, TabContent} from "vue-form-wizard";
import Layout from "../../layouts/main";
import PageHeader from "@/components/page-header";
import productService from "../../../services/productService";
import fileUpload from "../../../components/file-upload";

import {
    required,
    minLength,
    helpers,
    decimal
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
        Multiselect,
        fileUpload
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
                basic_information: {
                    name: null,
                    unit_code: null,
                    weight: null,
                    width: null,
                    height: null,
                    length: null,
                    category_id: null,
                    short_description: null,
                    selectedSuppliers: [],
                    selectedCategories: [],
                    image: null
                },
                pricing: {
                    price: null,
                    supplier_price: null,
                    vat: null
                },
                galleryImages: [],
                selectedAttributes: {},
                meta: {
                    title: null,
                    keywords: [],
                    description: null
                }
            },
            suppliers: [],
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
            basic_information: {
                name: {required},
                unit_code: {required},
                weight: {required, decimal},
                width: {required, decimal},
                height: {required, decimal},
                length: {required, decimal},
                selectedCategories: {required, minLength: minLength(1)},
            },
            pricing: {
                price: {required, decimal},
                supplier_price: {required, decimal},
                vat: {required}
            },
            meta: {
                title: {required},
                keywords: {required, keywords},
                description: {required}
            }
        },

    },
    methods: {
        async getSupplier() {
            this.suppliers = await SupplierService.getSuppliers();
        },

        async getCategories() {
            this.categories = await CategoryService.getCategories();
        },

        async categoriesChanged() {
            let response = await CategoryService.getFiltersForCategories(this.product.basic_information.selectedCategories);

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
                this.product.galleryImages.splice(index, 1);
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
            this.submitted = true;

            return new Promise((resolve, reject) => {
                if (this.$v.product.pricing.$invalid) {

                    reject("Enter all the required fields");
                    this.makeToast("danger", "Please properly enter all the required fields", "Error");
                } else {

                    this.submitted = false;
                    resolve(true);
                }
            })
        },
        validateStep3() {
            return new Promise((resolve, reject) => {
                resolve(true);
            })
        },
        validateStep4() {
            return new Promise((resolve, reject) => {
                resolve(true);
            })
        },
        validateStep5() {
            this.submitted = true;

            return new Promise((resolve, reject) => {

                if (this.$v.product.meta.$invalid) {
                    reject("Enter all the required fields");
                    this.makeToast("danger", "Please properly enter all the required fields", "Error");
                }

                resolve(true);
            })
        },
        async finishSteps() {

            let formData = new FormData();

            //Basic Information
            formData.append("name", this.product.basic_information.name);
            formData.append("supplier", JSON.stringify(this.product.basic_information.selectedSuppliers));
            formData.append("weight", this.product.basic_information.weight);
            formData.append("height", this.product.basic_information.height);
            formData.append("width", this.product.basic_information.width);
            formData.append("length", this.product.basic_information.length);
            formData.append("unit_code", this.product.basic_information.unit_code);
            formData.append("short_description", this.product.basic_information.description);
            formData.append("categories", JSON.stringify(this.product.basic_information.selectedCategories));

            //Price
            formData.append("price", this.product.pricing.price);
            formData.append("supplier_price", this.product.pricing.supplier_price);
            formData.append("vat", this.product.pricing.vat);

            //Filters and attributes
            formData.append("attributes", JSON.stringify(this.product.selectedAttributes));

            //Image and gallery
            formData.append("main_image", this.product.basic_information.image);
            if (this.product.galleryImages) {
                this.product.galleryImages.forEach((x, index) => formData.append(`gallery_image_${index}`, x))
            }

            //SEO Information
            formData.append("seo_title", this.product.meta.title);
            formData.append("seo_keywords", this.product.meta.keywords);
            formData.append("seo_description", this.product.meta.description);

            let response = await productService.storeProduct(formData)
        },
        imageUploaded(file) {
            this.product.basic_information.image = file;
        }
    },
    mounted() {
        this.getSupplier();
        this.getCategories();
    }
};
</script>

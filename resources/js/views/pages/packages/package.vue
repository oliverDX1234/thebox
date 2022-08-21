<template>
    <Layout>
        <PageHeader :title="title"/>
        <load-spinner :show="loading" variant="white">
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
                                                <label>Package Name <span class="required">*</span> </label>
                                                <input placeholder="Package Name"
                                                       v-model="package.basic_information.name"
                                                       type="text"
                                                       class="form-control"
                                                       :class="{ 'is-invalid': this.submitted && $v.package.basic_information.name.$invalid }"/>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Weight <span class="required">*</span></label>
                                                        <input
                                                            placeholder="Weight"
                                                            type="text"
                                                            v-model="package.basic_information.weight"
                                                            class="form-control"
                                                            :class="{ 'is-invalid': this.submitted && $v.package.basic_information.weight.$invalid }"
                                                        />
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Unit Code <span class="required">*</span></label>
                                                        <input placeholder="Unit Code"
                                                               v-model="package.basic_information.unit_code"
                                                               type="text" class="form-control"
                                                               :class="{ 'is-invalid': this.submitted && $v.package.basic_information.unit_code.$invalid }"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Width <span
                                                            class="required">*</span></label>
                                                        <input type="text" v-model="package.basic_information.width"
                                                               placeholder="Enter width in cm"
                                                               class="form-control"
                                                               :class="{ 'is-invalid': this.submitted && $v.package.basic_information.width.$invalid }">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Height <span
                                                            class="required">*</span></label>
                                                        <input type="text" v-model="package.basic_information.height"
                                                               placeholder="Enter height in cm"
                                                               class="form-control"
                                                               :class="{ 'is-invalid': this.submitted && $v.package.basic_information.height.$invalid }">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="control-label">Length <span
                                                            class="required">*</span></label>
                                                        <input type="text" v-model="package.basic_information.length"
                                                               placeholder="Enter length in cm"
                                                               class="form-control"
                                                               :class="{ 'is-invalid': this.submitted && $v.package.basic_information.length.$invalid }">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">Categories <span
                                                            class="required">*</span></label>
                                                        <multiselect
                                                            v-model="package.basic_information.selectedCategories"
                                                            :options="categories"
                                                            track-by="id"
                                                            @input="categoriesChanged"
                                                            multiple
                                                            label="name"
                                                            :class="{ 'is-invalid': this.submitted && $v.package.basic_information.selectedCategories.$invalid }"
                                                        ></multiselect>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="packagedesc">Package Short Description</label>
                                                <textarea placeholder="Enter short description for package"
                                                          class="form-control"
                                                          v-model="package.basic_information.short_description"
                                                          id="packagedesc" rows="5"></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Package Description</label>
                                                <c-k-editor ref="editor"></c-k-editor>
                                            </div>

                                            <div class="form-group">
                                                <b-form-checkbox v-model="package.basic_information.active" size="lg"
                                                                 switch
                                                                 class="mb-1">
                                                    <label>Active</label>
                                                </b-form-checkbox>
                                            </div>

                                        </form>
                                    </div>
                                </tab-content>


                                <!-- Step 2 - Products -->
                                <tab-content title="Products" :before-change="validateStep2">
                                    <div class="tab-pane">
                                        <h4 class="card-title mb-3">Add new products</h4>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="add-product-wrapper">
                                                    <multiselect
                                                        :options="filteredProducts"
                                                        class="add-product-select"
                                                        v-model="selectedProducts"
                                                        label="name"
                                                        track-by="id"
                                                        :show-labels="false"
                                                        multiple
                                                    >
                                                        <template slot="singleLabel" slot-scope="props">
                                                            <img width="20" class="option__image"
                                                                 :src="props.option.main_image.sm"
                                                                 alt="">
                                                            <span class="option__desc">
                                                            <span class="option__title text-capitalize ml-3">
                                                                {{ props.option.name }}
                                                            </span>
                                                        </span>
                                                        </template>
                                                        <template slot="option" slot-scope="props">
                                                            <div class="d-flex">
                                                                <img width="50"
                                                                     class="option__image"
                                                                     :src="props.option.main_image.sm" alt="">
                                                                <div
                                                                    class="option__desc d-flex align-items-center">
                                                            <span
                                                                class="option__title text-capitalize ml-3">
                                                                {{ props.option.name }}
                                                            </span>
                                                                </div>
                                                            </div>
                                                        </template>
                                                    </multiselect>

                                                    <b-button variant="success" @click="addProducts" class="ml-2">
                                                        Add Products
                                                    </b-button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-5">
                                            <div class="col-12">

                                                <h4 class="card-title mb-3">Selected products</h4>

                                                <basic-table
                                                    @delete-item="removeProduct"
                                                    :items="addedProducts"
                                                    :fields="fields"
                                                    :actions="['delete']">
                                                </basic-table>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <hr>
                                                <div class="py-3 float-right">

                                                    <div class="form-group">
                                                        <label class="control-label">Package Price:<span
                                                            class="required">*</span></label>
                                                        <b-input placeholder="Enter Price"
                                                                 v-model="package.pricing.price"></b-input>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Discount Price:<span
                                                            class="required">*</span></label>
                                                        <b-input placeholder="Enter Discount"
                                                                 v-model="package.pricing.price_discount"></b-input>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Vat (%)<span
                                                            class="required">*</span></label>
                                                        <multiselect
                                                            v-model="package.pricing.vat"
                                                            placeholder="Enter vat for this package"
                                                            :options="[5,10,18]"
                                                            :class="{ 'is-invalid': this.submitted && $v.package.pricing.vat.$invalid }"/>
                                                    </div>
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
                                                    v-model="package.selectedAttributes[filter.name]"
                                                    multiple
                                                ></v-select>
                                            </div>
                                        </div>
                                    </div>
                                </tab-content>

                                <!-- Step 4 - Package Gallery -->
                                <tab-content title="Package Img" :before-change="validateStep4">
                                    <div class="tab-pane" id="package-img">
                                        <h4 class="card-title">Package Images</h4>
                                        <p class="card-title-desc">Upload package images</p>
                                        <div class="row mb-5">
                                            <div class="col-sm-12 col-lg-6 mb-5 mb-lg-0">
                                                <h5 class="mb-3 text-center">Main Package Image</h5>
                                                <file-upload @image-uploaded="imageUploaded"
                                                             :imageData="package.basic_information.image"/>
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
                                                <h5 class="mb-3 text-center">Gallery Package Images</h5>
                                                <vue-dropzone
                                                    id="dropzone"
                                                    ref="galleryImagesDropzone"
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
                                                        <input id="metatitle" v-model="package.meta.title"
                                                               name="metatitle"
                                                               type="text"
                                                               class="form-control"
                                                               :class="{ 'is-invalid': this.submitted && $v.package.meta.title.$invalid }"/>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="metakeywords">Meta Keywords</label>
                                                        <input
                                                            id="metakeywords"
                                                            v-model="package.meta.keywords"
                                                            name="metakeywords"
                                                            placeholder="exp: big, blue, expensive"
                                                            type="text"
                                                            class="form-control"
                                                            :class="{ 'is-invalid': this.submitted && $v.package.meta.keywords.$invalid }"
                                                        />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="metadescription">Meta Description</label>
                                                <textarea class="form-control" v-model="package.meta.description"
                                                          id="metadescription" rows="5"
                                                          :class="{ 'is-invalid': this.submitted && $v.package.meta.description.$invalid }"></textarea>
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
                                            <h6>Package Name</h6>
                                            <p class="mt-1 mb-3">{{ package.basic_information.name }}</p>
                                        </div>
                                        <div class="col-4">
                                            <h6>Unit Code</h6>
                                            <p class="mt-1 mb-3">{{ package.basic_information.unit_code }}</p>
                                        </div>
                                        <div class="col-4">
                                            <h6>Weight</h6>
                                            <p class="mt-1 mb-3">{{ package.basic_information.weight }}</p>
                                        </div>
                                        <div class="col-4">
                                            <h6>Width</h6>
                                            <p class="mt-1 mb-3">{{ package.basic_information.width }}</p>
                                        </div>
                                        <div class="col-4">
                                            <h6>Length</h6>
                                            <p class="mt-1 mb-3">{{ package.basic_information.length }}</p>
                                        </div>
                                        <div class="col-4">
                                            <h6>Height</h6>
                                            <p class="mt-1 mb-3">{{ package.basic_information.height }}</p>
                                        </div>
                                        <div class="col-4">
                                            <h6>Length</h6>
                                            <p class="mt-1 mb-3">{{ package.basic_information.length }}</p>
                                        </div>
                                        <div class="col-4">
                                            <h6>Categories</h6>
                                            <div class="mt-1 mb-3">
                                                <template
                                                    v-for="(category, index) in package.basic_information.selectedCategories">
                                                    <template
                                                        v-if="index !== package.basic_information.selectedCategories.length - 1">
                                                        {{ category.name }},
                                                    </template>
                                                    <template v-else>
                                                        {{ category.name }}
                                                    </template>
                                                </template>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <h6>Active</h6>
                                            <p class="mt-1 mb-3">{{ package.basic_information.active }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">

                                        <div class="col-4">
                                            <h6>Price</h6>
                                            <p class="mt-1 mb-3">{{ package.pricing.price }}</p>
                                        </div>
                                        <div v-if="package.pricing.price_discount" class="col-4">
                                            <h6>Discounted Price</h6>
                                            <p class="mt-1 mb-3">{{ package.pricing.price_discount }}</p>
                                        </div>
                                        <div class="col-4">
                                            <h6>Vat</h6>
                                            <p class="mt-1 mb-3">{{ package.pricing.vat }}</p>
                                        </div>
                                    </div>
                                    <template v-if="Object.keys(package.selectedAttributes).length">
                                        <hr>
                                        <div class="row">
                                            <div v-for="(filter, index) in package.selectedAttributes" class="col-4">
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
                                            <p class="mt-1 mb-3">{{ package.meta.title }}</p>
                                        </div>
                                        <div class="col-4">
                                            <h6>Meta Keywords</h6>
                                            <p class="mt-1 mb-3">{{ package.meta.keywords }}</p>
                                        </div>
                                        <div class="col-4">
                                            <h6>Meta Description</h6>
                                            <p class="mt-1 mb-3">{{ package.meta.description }}</p>
                                        </div>

                                    </div>
                                </tab-content>
                            </form-wizard>
                        </div>
                    </div>
                </div>
            </div>
        </load-spinner>
    </Layout>
</template>
<script>
import vue2Dropzone from "vue2-dropzone";
import productService from "../../../services/productService";
import CategoryService from "@/services/categoryService";
import {FormWizard, TabContent} from "vue-form-wizard";
import Layout from "../../layouts/main";
import PageHeader from "@/components/custom/page-header";
import packageService from "../../../services/packageService";
import fileUpload from "../../../components/reusable/FileUpload";
import CKEditor from "../../../components/reusable/CKEditor";
import basicTable from "../../../components/reusable/tables/BasicTable";

import {
    required,
    minLength,
    helpers,
    decimal
} from "vuelidate/lib/validators";

const keywords = helpers.regex('keywords', /,?[a-zA-Z][a-zA-Z0-9]*,?/);

/**
 * Add Package Component
 */
export default {
    components: {
        vueDropzone: vue2Dropzone,
        Layout,
        PageHeader,
        FormWizard,
        TabContent,
        fileUpload,
        CKEditor,
        basicTable
    },
    data() {
        return {
            title: "Add Package",
            loading: false,
            package: {
                basic_information: {
                    name: null,
                    unit_code: null,
                    weight: null,
                    width: null,
                    height: null,
                    length: null,
                    short_description: null,
                    selectedCategories: [],
                    active: true,
                    image: null,
                },
                pricing: {
                    price: null,
                    price_discount: null,
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
            categories: [],
            filters: [],
            products: [],
            selectedProducts: [],
            addedProducts: [],
            fields: [
                {key: "thumb", sortable: true, label: "Image"},
                {key: "name", sortable: true, label: "Name"},
                {key: "unit_code", sortable: true, label: "Unit Code"},
                {key: "price", sortable: true, label: "Price"},
                {key: "action"}
            ],
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
    watch:{
        addedProducts(){

            if(!this.addedProducts.length){
                this.package.pricing.price = null;
            }else if(this.addedProducts.length === 1){
                this.package.pricing.price = this.addedProducts[0].price_discount ? this.addedProducts[0].price_discount : this.addedProducts[0].price;
            }else{
                this.package.pricing.price = this.addedProducts.reduce((total, current) => {
                    return total + (current.price_discount ? current.price_discount : current.price)
                }, 0)
            }

        }
    },
    computed: {
        filteredProducts() {
            return this.products.filter(x => {
                return !this.addedProducts.map(z => z.id).includes(x.id);
            });
        }
    },
    validations: {
        package: {
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
        async getProducts() {
            this.products = await productService.getProducts();
        },

        addProducts() {
            this.addedProducts.push(...this.selectedProducts);

            this.selectedProducts = [];
        },

        removeProduct(id) {

            let index = this.addedProducts.findIndex(x => x.id === id);

            if (index !== -1) {
                this.addedProducts.splice(index, 1);
            }
        },

        async getCategories() {
            this.categories = await CategoryService.getCategoriesForProduct();
        },

        async categoriesChanged() {
            let response = await CategoryService.getFiltersForCategories(this.package.basic_information.selectedCategories);

            this.filters = response.filtersAndCategories;

            for (const [key, value] of Object.entries(this.package.selectedAttributes)) {
                if (!response.filters.includes(key)) {
                    delete this.package.selectedAttributes[key];
                }
            }
        },

        imageAdded(file) {
            if (!this.package.galleryImages.some(x => x.name === file.name)) {
                this.package.galleryImages.push(file);
            }
        },

        imageDeleted(file) {
            let index = this.package.galleryImages.findIndex(x => x.name === file.name)
            if (index !== -1) {
                this.package.galleryImages.splice(index, 1);
            }
        },

        validateStep1() {
            this.submitted = true;

            return new Promise((resolve, reject) => {

                if (this.$v.package.basic_information.$invalid) {

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
                if (this.$v.package.pricing.$invalid) {

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

                if (this.$v.package.meta.$invalid) {
                    reject("Enter all the required fields");
                    this.makeToast("danger", "Please properly enter all the required fields", "Error");
                }

                resolve(true);
            })
        },

        async finishSteps() {

            let formData = new FormData();

            //Basic Information
            formData.append("name", this.package.basic_information.name);
            formData.append("weight", this.package.basic_information.weight);
            formData.append("height", this.package.basic_information.height);
            formData.append("width", this.package.basic_information.width);
            formData.append("length", this.package.basic_information.length);
            formData.append("unit_code", this.package.basic_information.unit_code);
            formData.append("short_description", this.package.basic_information.short_description);
            formData.append("description", this.$refs.editor.editorData);
            formData.append("active", this.package.basic_information.active);
            formData.append("categories", JSON.stringify(this.package.basic_information.selectedCategories));

            //Price
            formData.append("price", this.package.pricing.price);
            formData.append("price_discount", this.package.pricing.price_discount);
            formData.append("vat", this.package.pricing.vat);

            //Filters and attributes
            formData.append("attributes", JSON.stringify(this.package.selectedAttributes));

            //Image and gallery
            formData.append("main_image", this.package.basic_information.image);
            if (this.package.galleryImages) {

                this.package.galleryImages.forEach((x, index) => formData.append(`gallery_image_${index}`, !(x instanceof File) ? JSON.stringify(x) : x))
            }

            //SEO Information
            formData.append("seo_title", this.package.meta.title);
            formData.append("seo_keywords", this.package.meta.keywords);
            formData.append("seo_description", this.package.meta.description);

            if (this.$route.params.id) {
                formData.append('_method', "patch");
                formData.append('id', this.$route.params.id);
                await packageService.updatePackage(this.$route.params.id, formData)
                await this.$router.push("/admin/packages");
            } else {
                await packageService.storePackage(formData)

                await this.$router.push("/admin/packages");
            }
        },

        imageUploaded(file) {
            this.package.basic_information.image = file;
        },

        async loadPackage() {
            let tempPackage = await packageService.getPackage(this.$route.params.id);

            this.package.basic_information.name = tempPackage.name
            this.package.basic_information.width = tempPackage.dimensions.width;
            this.package.basic_information.height = tempPackage.dimensions.height;
            this.package.basic_information.length = tempPackage.dimensions.length;
            this.package.basic_information.weight = tempPackage.weight;
            this.package.basic_information.unit_code = tempPackage.unit_code;
            this.package.basic_information.short_description = tempPackage.short_description;
            this.$refs.editor.editorData = tempPackage.description ?? "";
            this.package.basic_information.selectedCategories = tempPackage.categories;
            this.package.basic_information.image = tempPackage.main_image.md;

            this.package.pricing.price = tempPackage.price
            this.package.pricing.price_discount = tempPackage.price_discount
            this.package.pricing.vat = tempPackage.vat

            this.package.meta.title = tempPackage.seo_title;
            this.package.meta.keywords = tempPackage.seo_keywords;
            this.package.meta.description = tempPackage.seo_description;

            tempPackage.gallery.forEach(x => {
                var file = {
                    size: x.infos.size,
                    name: x.infos.name,
                    type: x.infos.extension,
                    model_id: x.infos.model_id,
                    id: x.infos.id
                };
                this.$refs.galleryImagesDropzone.manuallyAddFile(file, x.md);
            });

            await this.categoriesChanged();

            this.package.selectedAttributes = tempPackage.filters;

            this.loading = false;
        }
    },
    mounted() {
        this.getProducts();

        this.getCategories();

        if (this.$route.params.id) {
            this.$refs.formWizard.activateAll();

            this.loading = true;

            this.loadPackage();
        }
    }
};
</script>

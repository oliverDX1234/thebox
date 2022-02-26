<script>
import Multiselect from "vue-multiselect";
import vue2Dropzone from "vue2-dropzone";
import SupplierService from "@/services/supplierService";
import CategoryService from "@/services/categoryService";

import {FormWizard, TabContent} from "vue-form-wizard";

import Layout from "../../layouts/main";
import PageHeader from "@/components/page-header";

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
                name: null,
                supplier_id: null,
                unit_code: null,
                weight: null,
                width: null,
                height: null,
                length: null,
                category_id: null
            },
            suppliers: [],
            categories: [],
            value: null,
            value1: null,
            dropzoneOptions: {
                url: "https://httpbin.org/post",
                thumbnailWidth: 150,
                maxFilesize: 0.5,
                headers: {"My-Awesome-Header": "header value"}
            }
        };
    },
    methods: {
        async getSupplier() {
            this.suppliers = await SupplierService.getSuppliers();
        },

        async getCategories() {
            this.categories = await CategoryService.getCategories();
        }
    },
    mounted() {
        this.$refs.formWizard.activateAll();
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
                        <form-wizard ref="formWizard" color="#5664d2">
                            <tab-content title="Basic Info">
                                <div class="tab-pane" id="basic-info">
                                    <h4 class="card-title mb-3">Basic Information</h4>
                                    <form>
                                        <div class="form-group">
                                            <label>Product Name <span class="required">*</span> </label>
                                            <input placeholder="Product Name" type="text" class="form-control"/>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Supplier</label>
                                                    <multiselect
                                                        label="name"
                                                        v-model="product.supplier_id"
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
                                                        class="form-control"
                                                    />
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Unit Code <span class="required">*</span></label>
                                                    <input placeholder="Unit Code" type="text" class="form-control"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Width <span
                                                        class="required">*</span></label>
                                                    <input type="text" placeholder="Enter width in cm"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Height <span class="required">*</span></label>
                                                    <input type="text" placeholder="Enter height in cm"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Length <span class="required">*</span></label>
                                                    <input type="text" placeholder="Enter length in cm"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">Categories <span
                                                        class="required">*</span></label>
                                                    <multiselect
                                                        v-model="value"
                                                        :options="['Electronic', 'Fashion', 'Fitness']"
                                                    ></multiselect>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="productdesc">Product Description</label>
                                            <textarea class="form-control" id="productdesc" rows="5"></textarea>
                                        </div>
                                    </form>
                                </div>
                            </tab-content>
                            <tab-content title="Product Img">
                                <div class="tab-pane" id="product-img">
                                    <h4 class="card-title">Product Images</h4>
                                    <p class="card-title-desc">Upload product image</p>
                                    <vue-dropzone
                                        id="dropzone"
                                        ref="myVueDropzone"
                                        :use-custom-slot="true"
                                        :options="dropzoneOptions"
                                    >
                                        <div class="dropzone-custom-content">
                                            <i class="display-4 text-muted bx bxs-cloud-upload"></i>
                                            <h4>Drop files here or click to upload.</h4>
                                        </div>
                                    </vue-dropzone>
                                </div>
                            </tab-content>
                            <tab-content title="Meta Data">
                                <div class="tab-pane" id="metadata">
                                    <h4 class="card-title">Meta Data</h4>
                                    <p class="card-title-desc">Fill all information below</p>

                                    <form>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="metatitle">Meta title</label>
                                                    <input id="metatitle" name="metatitle" type="text"
                                                           class="form-control"/>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="metakeywords">Meta Keywords</label>
                                                    <input
                                                        id="metakeywords"
                                                        name="metakeywords"
                                                        type="text"
                                                        class="form-control"
                                                    />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="metadescription">Meta Description</label>
                                            <textarea class="form-control" id="metadescription" rows="5"></textarea>
                                        </div>
                                    </form>

                                    <div class="text-center mt-4">
                                        <button
                                            type="submit"
                                            class="btn btn-primary mr-2 waves-effect waves-light"
                                        >Save Changes
                                        </button>
                                        <button type="submit" class="btn btn-light waves-effect">Cancel</button>
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

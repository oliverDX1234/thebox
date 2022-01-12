<script>
import PageHeader from "@/components/page-header";
import CustomTable from "@/components/CustomTable";
import Nestable from "@/components/Nestable";
import CategoryService from "@/services/categoryService";

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
        };
    },
    created() {
        this.getCategoriesTree();
    },
    methods: {
        editCategory(id) {
            this.$router.push('/admin/category/' + id);
        },
        async deleteCategory(id) {

            let response = await CategoryService.deleteCategory(id);

            this.findIndexFunction(this.categories, parseInt(response));
            this.index = null;
        },
        findIndexFunction(category, id, previous = null) {
            if(!!this.index){
                return;
            }
            for (var i = 0; i < category.length; i++) {
                if(category[i].id === id){
                    this.index = id;
                    if(this.categories === category){
                        this.categories.splice(id - 1, 1)
                    }else{
                        previous.children = [];
                    }
                    return;
                }else{
                    if(category[i].children.length !== 0){
                        this.findIndexFunction(category[i].children, id, category[i]);
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
                                    <nestable @nestable-updated="updateItems" @delete-item="deleteCategory"
                                              :itemsForNesting="categories"></nestable>
                                    <div class="row">
                                        <div class="col-12">
                                            <a
                                                href="javascript:void(0);"
                                                class="btn btn-primary mb-2"
                                                @click="saveChanges"
                                            >
                                                Save changes
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-md-6 col-12">

                                </div>
                            </div>


                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</template>



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
            items: [
                {
                    text: "Category",
                    active: true

                }
            ],
            categories: [],
            fields: [
                {key: "id", sortable: true, label: "ID"},
                {key: "name", sortable: true, label: "Name"},
                {key: "parent", sortable: true, label: "Parent"},
                {key: "active", sortable: true, label: "Active"},
                {key: "action"}
            ]
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
            let index = this.categories.findIndex(category => category.id === parseInt(response))
            // find the post index
            if (~index) // if the post exists in array
                this.categories.splice(index, 1) //delete the post
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
                            <a
                                href="javascript:void(0);"
                                class="btn btn-success mb-2"
                                @click="$router.push('/admin/category/')"
                            >
                                <i class="mdi mdi-plus mr-2"></i> New category
                            </a>
                            <div class="row mt-2">


                                <div class="col-xl-5 col-md-8 col-12">
                                    <nestable :itemsForNesting="categories"></nestable>
                                </div>


                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</template>

<style scoped>
.card {
    background: unset;
    box-shadow: none;
}
</style>

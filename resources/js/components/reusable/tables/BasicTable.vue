<template>
    <div class="table-responsive">
        <b-table-lite
            class="table-centered b-basic-table"
            :items="items"
            :fields="fields"
            responsive="sm"
            striped
            bordered
        >
            <template v-slot:cell(thumb)="row">
                <img width="80px" class="d-block m-auto" :src="row.item.main_image.sm" alt="product-image-thumbnail">
            </template>

            <template v-slot:cell(price)="row">

                <div style="min-width: 80px;">
                    <div v-if="!row.item.price_discount">{{ row.item.price }} MKD</div>
                    <div v-else>
                        <span>{{ row.item.price_discount }} MKD</span>
                        <br>
                        <span class="text-strike text-danger">{{ row.item.price }} MKD</span>
                    </div>

                </div>
            </template>

            <template v-slot:cell(unit_code)="row">
                {{ row.value ? row.value : "/" }}
            </template>

            <template v-slot:cell(show_quantity)="row">
                {{ row.item.quantity }}
            </template>

            <template v-slot:cell(products)="row">
                <b-badge variant="success" class="mr-1" v-for="product in row.item.products" :key="Math.random()">
                    {{ product.name }}
                </b-badge>
            </template>

            <template v-slot:cell(quantity)="row">
                <div class="position-relative" style="min-width: 100px;">
                    <NumberInputSpinner
                        :min="1"
                        :max="1000"
                        :step="1"
                        :value="row.item.quantity ?? 1"
                        :integerOnly="true"
                        @input="quantityUpdated($event, row.item.id)"
                    />
                </div>
            </template>

            <template v-slot:cell(action)="row">
                <div class="d-flex">

                    <b-form-checkbox
                        v-model="row.item.active"
                        class="mr-2"
                        style="margin-top: 3.5px;"
                        switch
                        @change="$emit('toggle-item', row.item.id)"
                        v-if="actions.includes('switch')"
                    >
                    </b-form-checkbox>

                    <a
                        @click="$emit('load-attributes', row.item.id)"
                        class="mr-3 text-success"
                        role="button"
                        v-b-tooltip.hover
                        title="Attributes"
                        v-if="actions.includes('attributes')"
                    >
                        <span class="success font-weight-bold font-size-18">A</span>
                    </a>

                    <a
                        @click="$router.push('/admin/discount/show-products/' + row.item.id)"
                        class="mr-3 text-success"
                        role="button"
                        v-b-tooltip.hover
                        title="Show Products"
                        v-if="actions.includes('show-products')"
                    >
                        <i class="mdi mdi-eye font-size-18"></i>
                    </a>

                    <a
                        @click="$emit('edit-item', row.item.id)"
                        class="mr-3 text-primary"
                        role="button"
                        v-b-tooltip.hover
                        title="Edit"
                        v-if="actions.includes('edit')"
                    >
                        <i class="mdi mdi-pencil font-size-18"></i>
                    </a>
                    <a
                        class="text-danger mr-3"
                        role="button"
                        v-b-tooltip.hover
                        @click="$emit('delete-item', row.item.id)"
                        title="Delete"
                        v-if="actions.includes('delete')"
                    >
                        <i class="mdi mdi-trash-can font-size-18"></i>
                    </a>

                    <a
                        class="text-danger mr-3"
                        role="button"
                        v-b-tooltip.hover
                        v-if="actions.includes('remove-product')"
                        @click="$emit('delete-item', row.item.id)"

                        title="Delete"
                    >
                        <i class="fas fa-times font-size-18"></i>
                    </a>
                </div>
            </template>
        </b-table-lite>
    </div>
</template>

<script>
import NumberInputSpinner from "vue-number-input-spinner";
import _ from "lodash";

export default {
    name: "BasicTable",
    components:{
        NumberInputSpinner
    },
    props: {
        items: {
            required: true,
            type: Array
        },
        fields: {
            required: true,
            type: Array,
        },
        actions: {
            required: false,
            type: Array,
            default: function () {
                return [];
            }
        }
    },
    methods:{
        quantityUpdated(value, id){
            if (this.timeout)
                clearTimeout(this.timeout);

            this.timeout = setTimeout(() => {
                this.$emit('quantity-updated', value, id)
            }, 500)
        }
    }
}
</script>

<style scoped>

</style>

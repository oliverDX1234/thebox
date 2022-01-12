<template>



    <vue-nestable v-model="nestableItems">
        <vue-nestable-handle
            slot-scope="{ item }"
            :item="item">
            <i class="ri-menu-fill position-relative pr-1" style="top: 1.5px;"></i> {{ item.name }}
            <i class="ri-delete-bin-fill float-right text-danger delete-list-button font-size-15" role="button" @click.once="$emit('delete-item', item.id)"></i>
            <i class="ri-pencil-fill float-right text-success delete-list-button mr-1 font-size-15" role="button" @click="$emit('edit-item', item.id)"></i>
        </vue-nestable-handle>
    </vue-nestable>



</template>

<script>

import {VueNestable, VueNestableHandle} from 'vue-nestable';

export default {

    props: ["itemsForNesting"],
    components: {
        VueNestable,
        VueNestableHandle
    },
    data() {
        return {
            nestableItems: []
        }
    },
    watch: {
        itemsForNesting(value) {
            this.nestableItems = this.itemsForNesting;
        },
        nestableItems(){
            this.$emit("nestable-updated", this.nestableItems);
        }

    }
}
</script>

<style>


/*
* Style for nestable
*/
.nestable {
    position: relative;
}
.nestable-rtl {
    direction: rtl;
}
.nestable .nestable-list {
    margin: 0;
    padding: 0 0 0 40px;
    list-style-type: none;
}
.nestable-rtl .nestable-list {
    padding: 0 40px 0 0;
}
.nestable > .nestable-list {
    padding: 0;
}
.nestable-item,
.nestable-item-copy {
    margin: 10px 0 0;
}
.nestable-item:first-child,
.nestable-item-copy:first-child {
    margin-top: 0;
}
.nestable-item .nestable-list,
.nestable-item-copy .nestable-list {
    margin-top: 10px;
}
.nestable-item {
    position: relative;
    background: #e8f8f5;
    padding: 10px;
    border-radius: 10px;
    margin: 0 10px 15px 0;
    box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;
}
.nestable-item.is-dragging .nestable-list {
    pointer-events: none;
}
.nestable-item.is-dragging * {
    opacity: 0;
    filter: alpha(opacity=0);
}
.nestable-item.is-dragging:before {
    content: ' ';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(106, 127, 233, 0.274);
    border: 1px dashed rgb(73, 100, 241);
    -webkit-border-radius: 5px;
    border-radius: 5px;
}
.nestable-drag-layer {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 100;
    pointer-events: none;
}
.nestable-rtl .nestable-drag-layer {
    left: auto;
    right: 0;
}
.nestable-drag-layer > .nestable-list {
    position: absolute;
    top: 0;
    left: 0;
    padding: 0;
    background-color: rgba(106, 127, 233, 0.274);
}
.nestable-rtl .nestable-drag-layer > .nestable-list {
    padding: 0;
}
.nestable [draggable="true"] {
    cursor: move;
}
.nestable-handle {
    display: inline;
}
</style>

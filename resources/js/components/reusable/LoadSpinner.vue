<template>
    <b-overlay
        :variant="variant"
        opacity="0.85"
        :show="show"
        blur="5px"
        spinner-variant="primary"
        class="m-auto"
        no-center
        rounded="sm"
    >

        <slot></slot>

    </b-overlay>
</template>

<script>
export default {
    name: "LoadSpinner",
    props: {
        show: {
            type: Boolean,
            required: true
        },
        variant: {
            type: String,
            required: false,
            default: "white"
        }
    }
}
</script>


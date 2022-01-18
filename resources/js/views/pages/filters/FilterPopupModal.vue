<template>
    <b-modal v-model="innerModal.showModal" :title="innerModal.title" centered>
        <form>
            <div class="form-group">

                <label class="text-capitalize">{{ innerModal.type }}</label>
                <input type="text" v-model="innerModal.type_value" class="form-control" :placeholder="innerModal.type_value"/>
            </div>

            <div class="form-group">
                <label>Name</label>
                <input type="text" v-model="innerModal.name" class="form-control" placeholder="Name"/>
            </div>

            <div class="form-group" v-if="innerModal.type === 'filter'">
                <b-form-checkbox v-model="innerModal.active" size="lg" switch class="mb-1 mt-2">
                    <label>Active</label>
                </b-form-checkbox>
            </div>

        </form>
        <template v-slot:modal-footer>
            <b-button variant="secondary" @click="innerModal.showModal = false">
                Close
            </b-button>
            <b-button variant="primary" @click="$emit('update-items', innerModal)">
                Save
            </b-button>
        </template>
    </b-modal>
</template>
<script>
export default {
    name: 'filter-popup-modal',
    props: ["modal"],
    data(){
        return {
            innerModal: {}
        }
    },

    mounted() {
      this.innerModal = this.modal;
    }
}
</script>

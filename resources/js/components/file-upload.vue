<template>
    <div>
        <div
            class="image-input"
            :style="{ 'background-image': `url(${localImageData})` }"
            @click="chooseImage"
        >
      <span
          v-if="!localImageData"
          class="placeholder"
      >
        Choose an Image
      </span>
            <input
                class="file-input"
                ref="fileInput"
                type="file"
                @input="onSelectFile"
            >
        </div>
    </div>
</template>
<script>
export default {
    props: ["imageData"],
    data() {
        return {
            localImageData: ""
        }
    },
    mounted() {
        this.localImageData = this.imageData;
    },
    methods: {
        chooseImage() {
            this.$refs.fileInput.click()
        },
        onSelectFile() {
            let input = this.$refs.fileInput
            let file = input.files
            if (file && file[0]) {
                let reader = new FileReader
                reader.onload = e => {
                    this.localImageData = e.target.result
                }
                reader.readAsDataURL(file[0])
                this.$emit('image-uploaded', file[0]);
            }
        }
    },
}
</script>

<style scoped>
.image-input {
    display: block;
    margin: auto;
    cursor: pointer;
    border-radius: 50%;
    background-size: cover;
    background-position: center center;
}

@media (max-width: 991px) {
    .image-input {
        width: 235px;
        height: 235px;
    }
}

@media (min-width: 992px) {
    .image-input {
        width: 200px;
        height: 200px;
    }
}

@media (min-width: 1200px) {
    .image-input {
        width: 250px;
        height: 250px;
    }
}

@media (min-width: 1500px) {
    .image-input {
        width: 300px;
        height: 300px;
    }
}

@media (min-width: 1900px) {
    .image-input {
        width: 400px;
        height: 400px;
    }
}

.placeholder {
    background: #f0f0f0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #333;
    font-size: 18px;
    font-family: Helvetica;
}

.placeholder:hover {
    background: #e0e0e0;
}

.file-input {
    display: none;
}
</style>

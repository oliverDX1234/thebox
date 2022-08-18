<template>
    <ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
    name: "CKEditor",
    data() {
        return {
            editor: ClassicEditor,
            editorData: "",
            editorConfig: {
                // The configuration of the editor.
            }
        }
    }
}
</script>

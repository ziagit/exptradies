<template>
  <div class="container">
    <b-card class="shadow   mt-5 mb-5 p-4">
      <b-button variant="light" class="add-btn" @click="$emit('close-dialog')">
        <b-icon icon="x"></b-icon>
      </b-button>
      <textEditor
        :initTitle="title"
        :initBody="initValue"
        :initPath="path"
        method="put"
        v-on:close-me="$emit('close-dialog')"
      >
      </textEditor>
    </b-card>
  </div>
</template>
<script>
import TextEditor from "../../sub/TextEditor.vue";
export default {
  props: ["privacy"],
  components: { textEditor: TextEditor },
  data() {
    return {
      title: null,
      initValue: null,
      path: null,
    };
  },
  created() {
    this.title = this.privacy.title;
    this.initValue = this.privacy.body;
    this.path = "admin/privacy/" + this.privacy.id;
  },
};
</script>
<style>
  .add-btn {
    position: absolute;
    top: 0;
    right: 0;
  }
</style>

<template>
  <div>
    <b-card class="shadow   mt-5 mb-5">
      <textEditor :initTitle="title" :initBody="initValue" :initPath="path" method="put"
        v-on:close-me="$emit('close-dialog')">
      </textEditor>
    </b-card>
  </div>
</template>
<script>
import TextEditor from "../../../shared/TextEditor.vue";
export default {
  props: ["carrier"],
  components: { textEditor: TextEditor },
  data() {
    return {
      title: null,
      initValue: null,
      path: null,
    };
  },
  created() {
    this.title = this.carrier.title;
    this.initValue = this.carrier.body;
    this.path = "admin/carrier-page/" + this.carrier.id;
  },
};
</script>

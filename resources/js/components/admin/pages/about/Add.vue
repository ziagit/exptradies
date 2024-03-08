<template>
  <div>
    <textEditor :initTitle="title" :initBody="initValue" :initPath="path" method="post"
      v-on:close-me="$emit('close-dialog')">
    </textEditor>
  </div>
</template>
<script>
import TextEditor from "../../sub/TextEditor.vue";
export default {
  components: { textEditor: TextEditor },
  data() {
    return {
      title: null,
      initValue: null,
      path: null,
    };
  },
  created() {
    this.path = "admin/about";
  },
};
</script>
<style lang="scss" scoped>
.add-btn {
  position: absolute;
  top: 0;
  right: 0;
}

.close-btn {
  position: absolute;
  top: 5px;
  right: 5px;
  background-color: transparent;
}
</style>

<template>
  <div>
    <form @submit.prevent="submit">
      <b-form-group>
        <b-form-input v-model="title" placeholder="Title"></b-form-input>
      </b-form-group>
      <b-spinner v-if="isLoading"></b-spinner>
      <editor v-else :apiKey="key" :initialValue="initValue" v-model="body" :init="config"></editor>
      <div class="text-right mt-3">
        <b-spinner v-if="isSubmitting" />
        <div v-else>
          <b-button @click="$emit('close-me')" variant="light ">Cancel</b-button>
          <b-button type="submit" variant="light">Submit</b-button>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
import axios from "axios";
import Editor from "@tinymce/tinymce-vue";
export default {
  props: ["initTitle", "initBody", "initPath", "method"],
  components: { editor: Editor },
  data() {
    return {
      title: null,
      body: null,
      initValue: null,
      path: null,
      isSubmitting: false,
      isLoading: true,

      key: "0509filtyc6kx0mc2h15cbduztivsp8ztpjh5y739pkx5qh0",
      config: {
        height: 500,
        menubar: false,
        ontent_style: "body {font-size: 14pt;}",
        plugins: [
          "advlist autolink lists link image charmap",
          "searchreplace visualblocks code fullscreen",
          "print preview anchor insertdatetime media",
          "paste code help wordcount table textcolor colorpicker",
        ],
        toolbar:
          "undo redo | styleselect | fontsizeselect | formatselect | bold italic | \
        alignleft aligncenter alignright | \
        bullist numlist outdent indent | help | forecolor | backcolor",
      },
    };
  },
  created() {
    this.init()
  },

  methods: {
    init() {
      setTimeout(() => {
        this.title = this.initTitle;
        this.initValue = this.initBody;
        this.path = this.initPath;
        this.isLoading = false;
      }, 5000)

    },
    submit() {
      this.isSubmitting = true;
      if (this.method == "put") {
        axios
          .put(this.path, {
            body: this.body,
            title: this.title,
          })
          .then((res) => {
            this.isSubmitting = false;
            this.$emit("close-me");
          })
          .catch((err) => console.log("error: ", err));
      } else {
        axios
          .post(this.path, {
            body: this.body,
            title: this.title,
          })
          .then((res) => {
            this.isSubmitting = false;
            this.$emit("close-me");
          })
          .catch((err) => console.log("error: ", err));
      }
    },
  },
};
</script>

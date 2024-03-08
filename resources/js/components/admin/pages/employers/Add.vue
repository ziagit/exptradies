<template>
  <div>
    <form @submit.prevent="save"></form>
    <md-field class="">
      <label>Pate title</label>
      <md-input v-model="form.title"></md-input>
    </md-field>
    <editor :apiKey="key" :initialValue="initValue" v-model="body" :init="config"></editor>
    <md-button type="submit" variant="primary">Save</md-button>
  </div>
</template>
<script>
import axios from "axios";
import Editor from "@tinymce/tinymce-vue";
export default {
  components: { editor: Editor },
  data() {
    return {
      title: null,
      body: null,
      initValue: null,
      isSubmitting: false,
      key: "0509filtyc6kx0mc2h15cbduztivsp8ztpjh5y739pkx5qh0",
      config: {
        height: 500,
        menubar: false,
        plugins: [
          "advlist autolink lists link image charmap",
          "searchreplace visualblocks code fullscreen",
          "print preview anchor insertdatetime media",
          "paste code help wordcount table",
        ],
        toolbar:
          "undo redo | formatselect | bold italic | \
        alignleft aligncenter alignright | \
        bullist numlist outdent indent | help",
      },
    };
  },

  methods: {
    save() {
      axios
        .post("admin/carrier-page", {
          body: this.body,
          title: this.title,
        })
        .then((res) => {
          console.log("saved: ", res.data);
        })
        .catch((err) => console.log("error: ", err));
    },
  },
};
</script>

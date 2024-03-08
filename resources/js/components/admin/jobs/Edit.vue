<template>
  <div>
    <b-form @submit.prevent="submit">
      <b-form-group>
        <b-form-input v-model="form.note" placeholder="Details" />
      </b-form-group>
      <b-form-group>
        <b-form-input v-model="form.status" placeholder="Status" />
      </b-form-group>
      
      <div class="mt-3 text-right">
        <b-button variant="primary" type="submit">Submit</b-button>
      </div>
    </b-form>
  </div>
</template>
<script>
import axios from "axios";
export default {
  props: ["post"],
  data() {
    return {
      form: {
        note: null,
        status: null,
      },
    };
  },
  created() {
    this.init();
  },
  methods: {
    init() {
      this.form.note = this.post.note;
      this.form.status = this.post.status;
    },
    submit() {
      axios
        .put("admin/posts/" + this.post.id, this.form)
        .then((res) => {
          this.$emit("close-dialog");
        });
    },
  },
};
</script>

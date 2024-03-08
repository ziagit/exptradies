<template>
  <div>
    <b-form @submit.prevent="submit">
      <b-form-group>
        <b-form-input v-model="form.title" placeholder="Title"></b-form-input>
      </b-form-group>
      <b-form-group>
        <b-form-textarea rows="12" v-model="form.body" placeholder="Details..."></b-form-textarea>
      </b-form-group>
      <div class="text-right mt-3">
        <b-button variant="light" @click="$emit('close-dialog')">Cancel</b-button>
        <b-button variant="light" type="submit">Submit</b-button>
      </div>
    </b-form>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      form: {
        title: null,
        body: null,
      },
    };
  },
  methods: {
    submit() {
      axios.post("admin/faq", this.form).then(res => {
        console.log("updated:", res.data)
        this.$emit('close-dialog');
      }).catch(err => console.log(err.response))
    }
  },
};
</script>

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
        <b-button variant="light" type="submit">Update</b-button>
      </div>
    </b-form>
  </div>
</template>
<script>
import axios from "axios";
export default {
  props: ["faq"],
  data() {
    return {
      form: {
        title: this.faq.title,
        body: this.faq.body,
      },
    };
  },
  methods: {
    submit() {
      axios.put("admin/faq/" + this.faq.id, this.form).then(res => {
        console.log("updated:", res.data)
        this.$emit('close-dialog');
      }).catch(err => console.log(err.response))
    }
  },
};
</script>

<template>
  <div>
    <b-form @submit.prevent="submit">
      <b-form-group>
        <b-form-input id="input-1" v-model="form.name" placeholder="Name" required></b-form-input>
      </b-form-group>
      <b-form-group>
        <b-form-textarea id="textarea" v-model="form.details" placeholder="Details" rows="3" max-rows="6">
        </b-form-textarea>
      </b-form-group>
      <div class="text-right">
        <b-spinner v-if="isSubmitting" variant="primary"></b-spinner>
        <div v-else>
          <b-button @click="$emit('close-dialog')" variant="light">Cancel</b-button>
          <b-button type="submit" variant="light">Submit</b-button>
        </div>
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
        name: null,
        details: null,
      },
      isSubmitting:false,
    };
  },
  methods: {
    submit() {
      this.isSubmitting=true;
      axios.post("admin/cities", this.form)
        .then((res) => {
          this.isSubmitting=false;
          console.log("Saved");
          this.$emit('close-dialog')
      })
      .catch((err) => console.log(err));
      },
  },
  created() { },
};
</script>

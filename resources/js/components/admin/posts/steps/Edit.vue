<template>
  <div>
    <b-form @submit.prevent="update">
      <b-form-group>
        <b-form-input id="input-1" v-model="form.title" placeholder="Title" required></b-form-input>
      </b-form-group>
      <b-form-group>
        <b-form-textarea id="textarea" v-model="form.details" placeholder="Details" rows="3" max-rows="6">
        </b-form-textarea>
      </b-form-group>
      <div class="text-right mt-3">
        <b-button @click="$emit('close-dialog')" variant="light">Cancel</b-button>
        <b-button type="submit" variant="light">Submit</b-button>
      </div>
    </b-form>
  </div>
</template>
<script>
import axios from "axios";
export default {
  props: ['step'],
  data() {
    return {
      services: null,
      selected: null,
      form: {
        title: this.step.title,
        details: this.step.details,
        service_id: null,
      },
    };
  },
  created(){
    this.form.service_id = this.$route.params.id;
  },
  methods: {
    update() {
      axios
        .put("admin/steps/" + this.step.id, this.form)
        .then((res) => {
          console.log("updated");
          this.$emit('close-dialog')
        })
        .catch((err) => console.log(err));
    },
  },

};
</script>

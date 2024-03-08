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
        <b-button type="submit" variant="light">Update</b-button>
      </div>
    </b-form>
  </div>
</template>
<script>
import axios from "axios";
export default {
  props: ['option'],
  data() {
    return {
      steps: null,
      selected: null,
      form: {
        title: this.option.title,
        details: this.option.details,
        step_id: null,
      },
    };
  },
  created(){
    this.form.step_id = this.$route.params.id;
  },
  methods: {
    update() {
      axios
        .put("admin/options/" + this.option.id, this.form)
        .then((res) => {
          this.$emit('close-dialog')
        })
        .catch((err) => console.log(err));
    },
  },

};
</script>

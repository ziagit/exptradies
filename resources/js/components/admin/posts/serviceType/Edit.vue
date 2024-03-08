<template>
  <div>
    <b-form @submit.prevent="update">
      <b-form-group>
        <b-form-input id="input-1" v-model="form.name" placeholder="Name" required></b-form-input>
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
        name: null,
      },
    };
  },
  created(){
    this.form.name  = this.option.name;
  },
  methods: {
    update() {
      axios
        .put("admin/service-type/" + this.option.id, this.form)
        .then((res) => {
          this.$emit('close-dialog')
        })
        .catch((err) => console.log(err));
    },
  },

};
</script>

<template>
  <div>
    <b-form @submit.prevent="submit">
      <b-form-group>
        <b-form-input id="input-1" v-model="form.name" placeholder="Name" required></b-form-input>
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
  data() {
    return {
      form: {
        name:null,
      },
    };
  },
  methods: {
    submit() {
      axios
        .post("admin/service-type", this.form)
        .then((res) => {
          console.log("Saved");
          this.$emit('close-dialog')

        })
        .catch((err) => console.log(err));
    },
  },
  created() {
    this.form.option_id = this.$route.params.id;
  },
};
</script>

<template>
  <div>
    <form @submit.prevent="submit">
      <b-form-group>
        <b-form-input
          v-model="form.name"
          type="text"
          required
          placeholder="Name"
        ></b-form-input>
      </b-form-group>
      <b-form-group>
        <b-form-input
          v-model="form.email"
          type="text"
          required
          placeholder="Email"
        ></b-form-input>
      </b-form-group>

      <b-form-group>
        <b-form-textarea
          v-model="form.message"
          required
          placeholder="Message"
        ></b-form-textarea>
      </b-form-group>
      <div class="text-right">
        <b-spinner variant="warning" v-if="isSubmitting"></b-spinner>
        <b-button v-else type="submit" variant="warning" pill class="pr-5 pl-5"
          >Send</b-button
        >
      </div>
    </form>

    <Toaster ref="toaster" />
  </div>
</template>
<script>
import Toaster from "./Toaster.vue";

export default {
  components: {
    Toaster,
  },
  data: () => ({
    form: {
      name: null,
      email: null,
      message: null,
    },
    isSubmitting: false,
  }),
  methods: {
    submit() {
      this.isSubmitting = true;
      axios
        .post("about-form", this.form)
        .then((res) => {
          this.$refs.toaster.show(
            "success",
            "b-toaster-top-right",
            "Thanks,",
            "For contacting us, we will reply within a day!"
          );
          this.isSubmitting = false;
          this.$emit("close-dialog");
        })
        .catch((err) => {
          this.$refs.toaster.show(
            "danger",
            "b-toaster-top-center",
            "Error",
            "There is something wrong, please try again!"
          );
          this.$emit("close-dialog");
        });
    },
  },
};
</script>
<style scoped></style>

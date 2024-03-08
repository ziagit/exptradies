<template>
  <div class="auth-page">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="container">
      <div class=" mx-auto ">
        <img src="images/home/logo.png" alt="Logo" width="60" class="mb-2" />

        <form @submit.prevent="submit">
          <b-form-group class="my-3">
            <div class="break"></div>
            <p>Do you forget your password?</p>
            <b-form-input type="email"  v-model="form.email" required placeholder="Enter your email"></b-form-input>
          </b-form-group>
          <div class="mt-3">
            <b-button @click="$router.back()" variant="light" pill>
              <b-icon icon="arrow-left"></b-icon>
            </b-button>
            <b-spinner variant="primary" v-if="isSubmitting" />
            <b-button v-else type="submit" pill class="px-4" variant="primary">Send reset link</b-button>
          </div>
        </form>
      </div>
    </div>
    <Footer />
    <Toaster ref="toaster" />
  </div>
</template>

<script>
import axio from "axios";
import { mapActions, mapGetters } from "vuex";
import Toaster from "../sub/Toaster.vue";
import Header from "../sub/Header.vue";
import Footer from "../sub/Footer.vue";
import localData from "../../shared/services/localData";

export default {
  name: "Login",
  data: () => ({
    form: {
      email: null,
    },
    isSubmitting: false,
  }),
  methods: {
    submit() {
      this.isSubmitting = true;
      axio
        .post("password/forget", this.form)
        .then((res) => {
          localData.save("temp",{email:res.data.email});
          this.isSubmitting = false;
          this.$router.push("/reset-password");
        })
        .catch((err) => {
          this.$refs.toaster.show(
            "danger",
            "b-toaster-top-center",
            "Error",
            err.response.data.message
          );
          this.isSubmitting = false;
          console.log(err.response);
        });
    },
  },
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },
  created() { },
  components: {
    Toaster,
    Header,
    Footer,
  },
};
</script>

<style lang="scss" scoped>
</style>

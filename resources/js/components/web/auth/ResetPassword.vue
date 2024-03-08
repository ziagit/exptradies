<template>
  <div class="auth-page">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="container">
      <div  class="  mx-auto">
        <img src="images/home/logo.png" alt="Logo" width="60" class="mb-2" />
        <form @submit.prevent="verify">
          <p class="mt-2">Enter the verification code</p>
          <div class="text-center">
            <CodeInput :isSubmitting="false" class="input mx-auto" :fields="4" :fieldWidth="80" v-on:change="onChange"
              v-on:complete="verify" />
          </div>
          <small >We texted a code to your email!</small>
          <p style="color: red" v-if="invalidCode">{{ invalidCode }}</p>

          <div class="mt-3 d-flex justify-content-center align-items-center">
          <b-button variant="light" pill @click="$router.back()">
            <b-icon icon="arrow-left"></b-icon>
          </b-button>
          <b-spinner variant="primary" v-if="isSubmitting"></b-spinner>
          <b-button v-else variant="primary" size="sm" pill class="px-3" @click="resend()">Resend the code</b-button>
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
import CodeInput from "vue-verification-code-input";
import Toaster from "../sub/Toaster";
import Header from "../sub/Header";
import Footer from "../sub/Footer";
import localData from "../../shared/services/localData";
export default {
  name: "ResetPassword",
  components: {
    Toaster,
    Header,
    Footer,
    CodeInput,
  },
  data: () => ({
    form: {
      email: localData.read("temp").email,
      password: null,
      password_confirmation: null,
    },
    isSubmitting: false,
    invalidCode: null,
  }),
  methods: {
    onChange() { },

    verify(v) {
      this.isSubmitting = true;
      axio
        .post("password/verify", { code: v, email: localData.read("temp").email })
        .then((res) => {
          localData.save("temp",{email:res.data.email,id:res.data.id});
          this.isSubmitting = false;
          this.$router.push("/new-password")
        })
        .catch((err) => {
          this.isSubmitting = false;
          this.resend = true;
          this.invalidCode = err.response.data.error;
          this.$refs.toaster.show(
            "danger",
            "b-toaster-top-center",
            "Faild",
            err.response.data
          );
        });
    },
    resend() {
      this.isSubmitting = true;
      axios
        .post("password/forget", {
          email:localData.read("temp").email
        })
        .then((res) => {
          this.isSubmitting = false;
        })
        .catch((err) => {
          this.isSubmitting = false;
          this.$refs.toaster.show(
            "danger",
            "b-toaster-top-center",
            "Error",
            err.response.data
          );
        });
    },
  },

};
</script>

<style lang="scss" scoped>


</style>

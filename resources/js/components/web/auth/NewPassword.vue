<template>
    <div class="auth-page">
      <Header v-on:togal-menu="$emit('togal-menu')" />
      <div class="container">
        <div class=" mx-auto">
            <img src="images/home/logo.png" alt="Logo" width="60" class="mb-2" />
          <form @submit.prevent="submit">

            <p class="mt-2">Enter new password</p>
            <b-form-group>
              <b-form-input type="password"  v-model="form.password" required placeholder="New password"></b-form-input>
            </b-form-group>
            <b-form-group>
              <b-form-input type="password"  v-model="form.password_confirmation" required placeholder="Confirm password">
              </b-form-input>
            </b-form-group>

            <div class="mt-3 d-flex justify-content-center align-items-center">
                <b-button variant="light" pill @click="$router.back()">
                    <b-icon icon="arrow-left"></b-icon>
                </b-button>
                <b-spinner variant="primary" v-if="isSubmitting"></b-spinner>
                <b-button v-else type="submit" variant="primary" class="pr-5 pl-5" pill>Submit</b-button>
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
    name: "NewPassword",
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
    }),
    methods: {
      submit() {
        this.isSubmitting = true;
        axio
          .post("password/reset", this.form)
          .then((res) => {
            this.isSubmitting = false;
            this.$router.push("/password");
          })
          .catch((err) => {
            this.isSubmitting = false;
            this.$refs.toaster.show(
              "danger",
              "b-toaster-top-center",
              "Faild",
              err.response.data.error.password_confirmation
            );
            console.log(err.response);
          });
      },
    },
 
  };
  </script>
  
  <style lang="scss" scoped>

  </style>
  
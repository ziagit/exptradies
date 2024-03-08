<template>
  <div class="auth-page">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="container">
      <div class="mx-auto ">
        <img src="images/home/logo.png" alt="Logo" width="60" class="mb-2" />
        
        <form @submit.prevent="submit">
          <b-form-group class="my-3">
            <b-form-input ref='focusMe' v-model="form.email" required placeholder="Enter email">
            </b-form-input>
          </b-form-group>

          <div>
            <b-spinner variant="primary" v-if="isSubmitting" />
            <b-button v-else type="submit" pill variant="primary" class="px-5">
              Log in
            </b-button>
          </div>

        </form>
        <div class="mt-3 d-flex justify-content-center align-items-center">
          <b-button variant="light" size="sm" pill class="px-3" @click="$router.push('/become-employee')">Sign up</b-button>
        </div>
        <!-- <div class="mt-3 d-flex justify-content-center align-items-center">
          <small>Continue with: </small>
          <b-link variant="outline-danger" @click="login('google')" class="ml-3 text-danger">Gmail</b-link>
          <b-link variant="outline-primary" @click="login('facebook')" class="ml-3 text-primary">Facebook</b-link>
        </div> -->
      </div>
    </div>
    <Footer />
    <Toaster ref="toaster" />
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import Toaster from "../sub/Toaster";
import Header from "../sub/Header";
import Footer from "../sub/Footer";
import localData from "../../shared/services/localData";
import validator from "../../shared/services/validator";
import axios from "axios";
export default {
  name: "Login",
  data: () => ({
    form: {
      email: null,
    },
    inputTogal: false,
    isSubmitting: false,
    scrollValue: 0,
    isPhone: false,
  }),

  methods: {
    ...mapActions({
      signIn: "auth/signIn",
      socialLogin: "auth/socialLogin",
    }),
    submit() {
      if (!this.authenticated) {
        if (!validator.emailValidator(this.form.email)) {
          if (!validator.phoneValidator(this.form.email)) {
            this.$refs.toaster.show(
              "danger",
              "b-toaster-top-center",
              "Faild",
              "Please enter a valid email/phone!"
            );
            return;
          } else {
            this.isPhone = true;
          }
        }
        this.isSubmitting = true;
       
        axios
          .post("auth/check-email", {
            email: this.isPhone?validator.addCountryCode(this.form.email):this.form.email
          })
          .then((res) => {
            this.isSubmitting = false;
            localData.save("temp",{email:this.form.email,id:res.data.id});

            if (res.data.status == "email") {
              this.$router.push("/password");
              return;
            }
            if(res.data.status=="unverified"){
              this.$router.push("/verify-email")
              return;
            }
            this.$router.push("/verify");
          })
          .catch((err) => {
            console.log("err",err.response)
            this.isSubmitting = false;
            this.$refs.toaster.show(
              "danger",
              "b-toaster-top-center",
              "Faild",
              err.response.data
            );
          });
      }
    },

    login(provider) {
      this.socialLogin(provider)
        .then((res) => {
          if (res.data) {
            window.location.href = res.data.url;
          }
        })
        .catch((err) => console.log(err));
    },
  },
  mounted() {
    this.$refs.focusMe.focus();
  },

  components: {
    Toaster,
    Header,
    Footer,
  },
};
</script>

<style lang="scss" scoped>


</style>

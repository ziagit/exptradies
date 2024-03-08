<template>
  <div class="auth-page">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="container">
      <div class="mx-auto ">
        <img src="images/home/logo.png" alt="Logo" width="60" class="mb-2" />
        <form @submit.prevent="submit">
          <b-form-group class="my-3">
            <b-form-input ref='focusMe'  type="password" v-model="form.password" required placeholder="Password">
            </b-form-input>
          </b-form-group>

          <div class="">
            <b-spinner variant="primary" v-if="isSubmitting" />
            <b-button v-else type="submit" variant="primary" pill class="pr-5 pl-5">
              Log in
            </b-button>
          </div>
        </form>
        <div class="mt-3 d-flex justify-content-center align-items-center">
          <b-button variant="light" pill @click="$router.back()">
            <b-icon icon="arrow-left"></b-icon>
          </b-button>
          <b-button variant="light" size="sm" pill class="px-3" @click="$router.push('/forget-password')">Forget
            Password</b-button>
        </div>
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
import axios from "axios";
export default {
  name: "Login",
  data: () => ({
    form: {
      password: null,
      me: localData.read("temp").id,
    },
    isSubmitting: false,
  }),
  mounted() {
    this.$refs.focusMe.focus();
  },
  methods: {
    ...mapActions({
      signIn: "auth/signIn",
    }),

    submit() {
      this.isSubmitting = true;
      this.signIn(this.form)
        .then((_) => {
          switch (this.user.role.name) {
            case "Admin":
              this.$router.push("/admin");
              break;
            case "Support":
              this.$router.push("/admin");
              break;
            case "Employee":
              axios.get("employee/profile").then((res) => {
                res.data.first_name == undefined
                  ? this.$router.push("/employee/profile/add")
                  : this.$router.push(
                    this.$route.query.redirect || "/employee/leads"
                  )
              });
              break;
           
            default:
              this.$router.push("/");
          }
        })
        .catch((err) => {
          console.log("errrr", err.response.data);
          this.$refs.toaster.show(
            "danger",
            "b-toaster-top-center",
            "Faild",
            err.response.data.message
          );
          this.isSubmitting = false;
        });
    },

  },
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
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

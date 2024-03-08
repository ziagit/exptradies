<template>
  <div class="auth-page">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="container">
      <div class="  shadow-none mx-auto  border-0">

        <img src="images/home/logo.png" alt="Logo" width="60" class="mb-2" />
        <div class="text-center">
          <CodeInput :loading="false" class="input mx-auto" :fields="4" :fieldWidth="60" v-on:change="onChange"
            v-on:complete="verify" />
        </div>
        <small>Enter the verification code we sent your email</small>
        <div class="break"></div>
        <p style="color: red" v-if="invalidCode">{{ invalidCode }}</p>

        <b-spinner variant="primary" v-if="isSubmitting"></b-spinner>

        <div class="mt-3">
          <b-button variant="light" @click="$router.back()" pill>
            <b-icon icon="arrow-left"></b-icon>
          </b-button>
          <b-button v-if="temp!=null" variant="primary" size="sm" pill class="pr-4 pl-4" @click="resend()">Resend
          </b-button>
        </div>
      </div>
    </div>
    <Footer />
    <Toaster ref="toaster" />
  </div>
</template>

<script>
import CodeInput from "vue-verification-code-input";
import { mapActions, mapGetters } from "vuex";
import Toaster from "../sub/Toaster.vue";
import Header from "../sub/Header.vue";
import Footer from "../sub/Footer.vue";
import localData from "../../shared/services/localData";
import validator from "../../shared/services/validator";
export default {
  name: "SignUp",
  components: {
    Toaster,
    Header,
    Footer,
    CodeInput,
  },
  data: () => ({
    temp: null,
    isSubmitting: false,
    invalidCode: null,
   
  }),

  mounted() {
    this.temp = localData.read("temp");
  },
  computed:{
      ...mapGetters({
        authenticated: "auth/authenticated",
        user: "auth/user"
      })
  }, 
  methods: {
    ...mapActions({
      signIn: "auth/signIn",
    }),
    onChange(v) {
      //
    },                                                                                                                                                                                          

    verify(v) {                                                                                                                                                                                                                   
      this.isSubmitting = true;
      this.invalidCode = null;                                                                                                                                                                                    

      console.log("xxx temp: ", this.temp)
      this.signIn({ code: v, me: this.temp.id })
        .then((res) => {
          this.isSubmitting = false;                                                                  
          switch (this.user.role.name) {
            case "Employee":
              axios.get("employee/profile").then((res) => {
                console.log("response from ", res.data)
                this.$router.push("/employee");
                 res.data.first_name === undefined
                 ?this.$router.push("/employee/profile/add"):
                  this.$router.push(this.$route.query.redirect || "/employee")
              });                                                           
              break;
            case "Employer":
              this.$router.push("/employer");
              break;
            case "Admin":
              this.$router.push("/admin");
              break;
            case "Support":
              this.$router.push("/admin");
              break;
            default:
              console.log("not found..................")
              this.$router.push("/");
          }
        })
        .catch((error) => {
          this.invalidCode = v + " is not valid, please check your phone/email!";
          console.log("err: ", error);
          this.isSubmitting = false;
          this.$refs.toaster.show(
            "danger",
            "b-toaster-top-center",
            "Faild",
            error.response.data
          );
        });
    },
    resend() {
      this.isSubmitting = true;
      axios
        .post("auth/resend", {
          email: validator.emailValidator(this.temp.email) ? this.temp.email : "+1" + this.temp.email,
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

<template>
  <div class="auth-page">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="container">
      <div class="   mx-auto ">

        <img src="images/home/logo.png" alt="Logo" width="60" class="mb-2" />
        <div class="text-center my-2">
          <CodeInput :loading="false" class="input mx-auto" :fields="4" :fieldWidth="60" v-on:change="onChange"
            v-on:complete="verify" />
        </div>
        <small>Enter the verification code we sent to your email</small>
        <div class="break"></div>
        <p style="color: red" v-if="invalidCode">{{ invalidCode }}</p>

        <b-spinner variant="primary" v-if="isSubmitting"></b-spinner>

        <div class="mt-3">
          <b-button variant="light" @click="$router.back()" pill>
            <b-icon icon="arrow-left"></b-icon>
          </b-button>
          <b-button v-if="temp.email != undefined" variant="primary" size="sm" pill class="pr-4 pl-4" @click="resend()">Resend
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
import Toaster from "../sub/Toaster.vue";
import Header from "../sub/Header.vue";
import Footer from "../sub/Footer.vue";
import localData from "../../shared/services/localData";
export default {
  name: "SignUp",
  components: {
    Toaster,
    Header,
    Footer,
    CodeInput,
  },
  data: () => ({
    isSubmitting: false,
    invalidCode: null,
    temp:null,
  }),

  created() {
    this.temp = localData.read("temp");
  },

  methods: {
    onChange(v) {
      //
    },

    verify(v) {
      this.isSubmitting = true;
      this.invalidCode = null;
      axios.post("password/verify", {
        email: this.temp.email,
        code: v
      }).then(res=>{
        this.$router.push("/new-password")
      }).catch(err=>{
        this.isSubmitting = false;
        this.$refs.toaster.show(
            "danger",
            "b-toaster-top-center",
            "Faild",
            err.response.data
          );
        console.log(err)
      })
 
    },
    resend() {
      this.isSubmitting = true;
      axios
        .post("auth/resend", {
          email: this.temp.email,
        })
        .then((res) => {
          this.isSubmitting = false;
        })
        .catch((err) => {
          this.isSubmitting = false;
         
        });
    },
  },
};
</script>

<style lang="scss" scoped>

</style>

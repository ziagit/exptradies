<template>
  <div>
      <form @submit.prevent="submit">
          <b-form-group >
            <b-form-input   type="email" v-model="form.email" placeholder="Email" required ref="focusable">
            </b-form-input>
          </b-form-group>

          <b-form-group >
            <b-form-input  type="password" v-model="form.password" placeholder="Password" required>
            </b-form-input>
          </b-form-group>

          <b-form-group >
            <b-form-input  type="password" v-model="form.password_confirmation"
              placeholder="Confirm password" required>
            </b-form-input>
          </b-form-group>

          <div class="mt-3">
            <p>
              <small>
                By clicking on “Get started”, you agree to our
                <a @click="$router.push('/terms')" class="text-primary"><b>Terms</b></a> &
                <a @click="$router.push('/privacy')" class="text-primary">
                  <b>Privacy</b></a>.
              </small>
            </p>
           <div class="text-right">
            <b-spinner v-if="isSubmitting" variant="primary"></b-spinner>
            <b-button  v-else type="submit" variant="primary" pill class="px-5">Get started
            </b-button>
           </div>
          </div>
      </form>
    <Toaster ref="toaster" />
  </div>
</template>

<script>
import { mapActions } from "vuex";
import Toaster from "../sub/Toaster";
import Header from "../sub/Header";
import Footer from "../sub/Footer";
import axios from "axios";
import localData from "../../shared/services/localData";
import validator from "../../shared/services/validator";
export default {
  name: "SignUp",
  data: () => ({
    form: {
      name: "Employee",
      email: null,
      password: null,
      password_confirmation: null,
      type: "Employee",
    },
    isSubmitting: false,
    agreement: false,
    isPhone: false,
  }),
  methods: {
    ...mapActions({
      signUp: "auth/signUp",
    }),
    submit() {
      if (this.form.password !== this.form.password_confirmation) {
        this.$refs.toaster.show(
          "danger",
          "b-toaster-top-right",
          "Faild",
          "Passwords do not match."
        );
        return;
      }
      if (!validator.emailValidator(this.form.email)) {
        this.$refs.toaster.show(
          "danger",
          "b-toaster-top-right",
          "Faild",
          "Please enter a valid email/phone!"
        );
        return;
      }
      this.isSubmitting = true;
      axios
        .post("auth/verify-email", this.form)
        .then((res) => {
          this.isSubmitting = false;
          if (res.status == 203) {
            this.$refs.toaster.show("danger", "b-toaster-top-center", "Faild", res.data);
            return;
          }
            localData.save("temp",{email:this.form.email,id:res.data});
            this.$router.push("/verify");
          
        })
        .catch((err) => {
          this.isSubmitting = false;
          if (err.response.status == 409) {
            this.$refs.toaster.show(
              "danger",
              "b-toaster-top-center",
              "Conflict",
              err.response.data.email[0]
            ); 
            return;
          } 
            this.$refs.toaster.show(
              "danger",
              "b-toaster-top-center",
              "Faild",
              err.response.data
            );
          
        });
    },
  },
  mounted() {
    this.$refs.focusable.focus();
  },
  components: {
    Header,
    Footer,
    Toaster,
  },
};
</script>
<style scoped>

small{
  font-size: 11px !important;
}
input,button{
  min-height: 48px !important;
}

</style>


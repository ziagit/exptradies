<template>
  <div>

    <b-form @submit.prevent="update">
      <b-form-group>
        <b-form-input placeholder="Email" v-model="form.email" disabled>
        </b-form-input>
      </b-form-group>

      <b-form-group>
        <b-input-group>
          <VuePhoneNumberInput default-country-code="AU" v-model="form.formatted" :no-country-selector="false"
            :required="true" error-color="#e3342f" v-on:update="updatePhone" :border-radius="5" />
        </b-input-group>
      </b-form-group>

      <b-form-group>
        <b-form-checkbox id="checkbox-1" v-model="passwordTogal" name="checkbox-1">
          Change my password
        </b-form-checkbox>
      </b-form-group>
      <b-form-group v-if="passwordTogal">
        <label for="">New Password</label>
        <b-form-input type="password" v-model="form.password" :required="passwordTogal" placeholder="Password">
        </b-form-input>
      </b-form-group>
      <b-form-group v-if="passwordTogal">
        <b-form-input type="password" v-model="form.password_confirmation" :required="passwordTogal"
          placeholder="Confirm password"></b-form-input>
      </b-form-group>

      <div class="text-right mt-5">
        <b-spinner v-if="isSubmitting" variant="primary"></b-spinner>
        <div v-else>
          <b-button variant="light" @click="cancel()">
            Cancel
          </b-button>
          <b-button type="submit" variant="primary">Update</b-button>
        </div>
      </div>
    </b-form>
    <Toaster ref="toaster" />
  </div>
</template>
<script>
import axios from "axios";
import VuePhoneNumberInput from "vue-phone-number-input";
import GoogleAddress from "../../sub/GoogleAddress.vue";
import validator from "../../../shared/services/validator";
import Toaster from "../../sub/Toaster.vue";
export default {
  props:['user'],
  components: {
    GoogleAddress,
    Toaster, VuePhoneNumberInput
  },
  data: () => ({
    form: {
      email: null,
      phone: null,
      formatted: null,
      password: null,
      password_confirmation: null,
    },
    passwordTogal: false,
    isSubmitting: false,
  }),
  created() {
    this.init();
  },
  methods: {
    cancel() {
      this.$parent.accountTogal = false;
    },
    update() {
      if (this.form.phone == null) {
        this.$refs.toaster.show(
          "danger",
          "b-toaster-top-center",
          "Faild",
          "Please provide a valid phone number"
        );
        return;
      }
      if (!validator.emailValidator(this.form.email)) {
        this.$refs.toaster.show(
          "danger",
          "b-toaster-top-center",
          "Faild",
          "Please provide a valid email"
        );
        return;
      }

      if (this.form.password != this.form.password_confirmation) {
        this.$refs.toaster.show(
          "danger",
          "b-toaster-top-center",
          "Faild",
          "Password and password confirmation not matching!"
        );
        return;
      }

      this.isSubmitting = true;
      axios
        .put("employee/account/" + this.user.id, this.form)
        .then((res) => {
          this.isSubmitting = false;
          this.$refs.toaster.show(
            "success",
            "b-toaster-top-center",
            "Succeed",
            "Your account successfully updated!"
          );
          this.$parent.get()
        })
        .catch((err) => console.log(err.response));
    },

    init() {
          this.form.email = this.user.email;
          this.form.phone = this.user.phone;
          this.form.formatted = this.user.phone;
      
    },

    updatePhone(v) {
      this.form.phone = v.isValid ? v.formattedNumber : null;
    },
  },
};
</script>
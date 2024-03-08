<template>
  <div>
    <b-form @submit.prevent="submit">
      <b-form-group>
        <b-form-input v-model="form.name" placeholder="Name" required/>
      </b-form-group>
      <b-form-group>
        <b-form-input v-model="form.email" placeholder="Email" required/>
      </b-form-group>
      <b-form-group>
        <b-form-input v-model="form.phone" placeholder="Phone" required/>
      </b-form-group>
      <b-form-group>
        <b-form-checkbox value="orange" v-model="changePassword">Change password</b-form-checkbox>
      </b-form-group>
      <div v-if="changePassword">
        <b-form-group>
              <b-form-input v-model="form.password" placeholder="New password" required/>
            </b-form-group>
            <b-form-group>
              <b-form-input v-model="form.password_confirmation" placeholder="Confirm password" required/>
            </b-form-group>
      </div>
      <div class="mt-3 text-right">
        <b-button variant="primary" type="submit">Update</b-button>
      </div>
    </b-form>
    <Toaster ref="toaster" />
  </div>
</template>
<script>
import axios from "axios";
import Toaster from "../../web/sub/Toaster.vue";
import validator from "../../shared/services/validator";
export default {
  props: ["user"],
  components: {
    Toaster,
  },
  data() {
    return {
      changePassword:false,
      form: {
        name: null,
        email: null,
        phone: null,
        password: null,
        password_confirmation: null,
      },
    };
  },
  created() {
    this.init();
  },
  methods: {
    init() {
      this.form.name = this.user.name;
      this.form.email = this.user.email;
      this.form.phone = this.user.phone;
      var ph = this.user.phone.substring(3);
      this.form.phone = "0" + ph;
    },
    submit() {
      if (!validator.emailValidator(this.form.email)) {
        this.$refs.toaster.show(
          "danger",
          "b-toaster-top-center",
          "Faild",
          "Please provide a valid email!"
        );
        return;
      }
      if (!validator.phoneValidator(this.form.phone)) {
        this.$refs.toaster.show(
          "danger",
          "b-toaster-top-center",
          "Faild",
          "Please provide a valid phone!"
        );
        return;
      }
      if (this.form.password != this.form.password_confirmation) {
        this.$refs.toaster.show(
          "danger",
          "b-toaster-top-center",
          "Faild",
          "Passwords not matching!"
        );
        return;
      }
      
      var ph = this.form.phone.substring(1);
      axios
        .put("admin/users/" + this.user.id, {
          name: this.form.name,
          email: this.form.email,
          phone: "+61" + ph,
          password: this.form.password,
          password_confirmation: this.form.password_confirmation,
        })
        .then((res) => {
          this.$emit("close-dialog");
        });
    },
  },
};
</script>

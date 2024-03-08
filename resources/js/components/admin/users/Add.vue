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
        <b-form-input v-model="form.phone" placeholder="Phone number" required/>
      </b-form-group>
      <b-form-group>
        <b-form-select v-model="form.role" :options="options" required></b-form-select>
      </b-form-group>
      <b-form-group>
        <b-form-input v-model="form.password" placeholder="Password" required/>
      </b-form-group>
      <b-form-group>
        <b-form-input v-model="form.password_confirmation" placeholder="Confirm password" required/>
      </b-form-group>
      <div class="mt-3 text-right">
        <b-button variant="primary" type="submit">Submit</b-button>
      </div>
    </b-form>
  </div>
</template>
<script>
import axios from "axios";
import validator from "../../shared/services/validator";
export default {
  data() {
    return {
      form:{
        name:null,
        email:null,
        phone:null,
        role:null,
        password:null,
        password_confirmation:null,
      },
      selected: null,
      options: [
          { value: null, text: 'Please role' },
          { value: 'Admin', text: 'Admin' },
          { value: 'Support', text: 'Support' },
        ]
    };
  },
  created() {
  },
  methods:{
    submit(){
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
      axios.post("admin/users",this.form).then(res=>{
        this.$emit('close-dialog');
      }).catch(e=>{
        console.log(e.data);
      })
    }
  }
};
</script>

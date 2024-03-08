<template>
  <div>
    <h2>What is your contact information?</h2>
    <b-form @submit.prevent="next">
     <b-card class="  shadow-none">
          <b-form-group>
            <b-form-input v-model="form.name" placeholder="Name" required></b-form-input>
        </b-form-group>
        <b-form-group class="mb-0">
          <b-form-input :disabled="isLogedIn" v-model="form.email" placeholder="Email" type="email" required></b-form-input>
        </b-form-group>
        <div class="text-left text-secondary"><small>If you are registered with us as a business please use a different email.</small></div>
       
       <PhoneNumber v-on:number="onPhoneNumber" :initialNumber="form.phone"/>

       <b-form-textarea v-model="form.message" placeholder="Tell more about your job"></b-form-textarea>
      </b-card>
      <UploadFile />
      <br /> 
     <div class="d-flex justify-content-end align-items-center"> 

        <div class="actions" >
            <b-button @click="back()" variant="light">
              <b-icon icon="arrow-left"></b-icon>
            </b-button>
            <div class="tab"></div>
          </div>
          <b-spinner  v-if="isSubmitting"  variant="primary"></b-spinner>
          <b-button v-else type="submit" pill variant="primary" class="px-5 py-3">
              Submit
          </b-button>
       </div>
      
    </b-form>
    <Toaster ref="toaster" />
  </div>
</template>
<script >
import VuePhoneNumberInput from "vue-phone-number-input";
import localData from "../../shared/services/localData";
import validator from "../../shared/services/validator";
import UploadFile from "./UploadFile.vue";
import Toaster from "../sub/Toaster.vue";
import PhoneNumber from "../sub/PhoneNumber.vue";
import { mapGetters,mapActions } from "vuex";
export default {
  components: {
    Toaster,UploadFile,VuePhoneNumberInput,PhoneNumber
  },
  data: () => ({
    form: {
      name: null,
      email: null,
      phone: null,
      formatted: null,
      message: null,
      password: "123",
      password_confirmation: "123",
      type: "Employee",
    },
    isSubmitting:false,
    isLogedIn:false,
  }),
   computed:{
     ...mapGetters({
       authenticated:"auth/authenticated",
       user:"auth/user"
     })
   },
   created(){
     if(this.authenticated && this.user.role.name =='Employee'){
       this.isLogedIn=true;
       this.form.name = this.user.name;
       this.form.email = this.user.email;
       this.form.phone = this.user.phone;
       this.form.formatted = this.user.phone;
     }else{
       var data = localData.read('contact');
       if(data){
         this.form.phone = data.phone;
         this.form.name = data.name;
         this.form.formatted = data.formatted;
         this.form.message = data.message;
       }
     }
   },
  methods: {
    ...mapActions({
      signIn: "auth/signIn",
      signOut: "auth/signOut"
    }),

    onPhoneNumber(value){
      this.form.phone=value;
    },
     next() {
       if (!validator.emailValidator(this.form.email)) {
         this.$refs.toaster.show(
           "danger",
           "b-toaster-top-center",
           "Faild",
           "Please provide a valid email!"
         );
         return;
       }

       if (this.form.phone == null) {
         this.$refs.toaster.show(
           "danger",
           "b-toaster-top-center",
           "Faild",
           "Please provide a valid phone number (0423456789)"
         );
         return;
       }
       
       this.isSubmitting=true;
       localData.save("contact", this.form);

       if(this.authenticated && this.user.role.name == 'Employee'){
          this.$router.push("confirm");
          this.isSubmitting=false;
          return;
       }
       this.signUp();
     },
    back() {
      localData.save("prev-route","contact");
      this.$router.go(-1);
    },

    updatePhone(v) {
      console.log("phone: ",v.isValid)
      this.form.phone = v.isValid ? v.formattedNumber : null;
    },

    signUp(){
      axios
        .post("auth/verify-email", this.form)
        .then((res) => {
          if (res.status == 203) {
            this.$refs.toaster.show("danger", "b-toaster-top-center", "Faild", res.data);
            return;
          }
          this.login(res.data);
        })
        .catch((err) => {
          this.isSubmitting = false;
          if (err.response.status == 409) {
            this.$refs.toaster.show(
              "danger",
              "b-toaster-top-center",
              "Conflict",
              err.response.data.email==undefined?err.response.data.phone[0]:err.response.data.email[0]
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
    login(user){
      this.signIn({password:"123",me:user}).then(()=>{
          this.isSubmitting=false;
          this.$router.push("confirm");
      })
    }
  },
};
</script>
<style scoped lang="scss">
.actions {
  display: flex;
  justify-content: center;
  .btn {
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    width: 58px;
    height: 58px;
    text-align: center;
    box-shadow: 0 3px 1px -2px rgb(0 0 0 / 20%), 0 2px 2px 0 rgb(0 0 0 / 14%),
      0 1px 5px 0 rgb(0 0 0 / 12%);
  }
}

</style>

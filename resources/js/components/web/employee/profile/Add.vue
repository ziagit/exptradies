<template>
  <div>
   <b-card>
    <b-form @submit.prevent="submit">
      <b-form-group>
          <b-input-group>
            <b-form-input placeholder="First name" v-model="form.first_name" required>
          </b-form-input>
          <b-form-input placeholder="Last name" v-model="form.last_name"  required>
          </b-form-input>
          </b-input-group>
        </b-form-group>
        <b-form-group>

        <b-input-group>
          <VuePhoneNumberInput default-country-code="AU" v-model="form.formatted" :no-country-selector="false"
            :required="true" error-color="#e3342f" v-on:update="updatePhone" :border-radius="5" />
        </b-input-group>
      </b-form-group>

        <b-form-group>
          <GoogleAddress v-on:google-valid-address="googleAddress" :initialData="profile" :label="'Personal address'"/>
        </b-form-group>

        <b-form-group>
          <multiselect v-model="form.services" tag-placeholder="Add this as new profession"
            placeholder="Search or add a Profession" label="name" track-by="id" :options="services" :multiple="true"
             @tag="addTag">
          </multiselect>
        </b-form-group>

        <b-form-group>
         <b-input-group>
          <BusinessAddress v-on:google-valid-address="addBusinessAddress"  :label="'Business address'" ref="businessAddress"/>
         </b-input-group>
        </b-form-group>
        <div>
          <Distance v-for="(add, index) in form.service_area" :key="index" :distance="add" v-on:cancel="remove(index)"></Distance>
        </div>
        <b-form-group class="mt-3">
          <b-form-input placeholder="Business name"   v-model="form.business_name" required>
          </b-form-input>
        </b-form-group>

        <b-form-group class="mb-0">
          <b-form-input placeholder="Business ABN" :state="(form.business_abn && form.business_abn.length==11)?true:false" :max="11" step="1" :min="11" v-model="form.business_abn"  required>
          </b-form-input>
        </b-form-group >
          <small>Business ABN is elevent digit number</small>
        <div class="text-left d-flex align-items-center mb-3">
          <small class="m-0">Don't have it on hand? <a href="https://www.abr.business.gov.au/" target="_blank">&nbsp; Lookup
            your ABN</a></small>
        </div>
        <div>
          <small>
            Business address is a list of addresses you pick where you want to work. Once you chose an address you can specify how many km arround that address you work. Please add your current address to the list of business address if you want to work where you live.
          </small>
        </div>
        <br />
        <div class="text-right">
          <b-spinner v-if="isSubmitting" variant="primary"></b-spinner>
         <div v-else>
          <b-button  variant="light" @click="cancel()">Cancel</b-button>
          <b-button type="submit" variant="primary">Submit</b-button>
         </div>
        </div>
       
      </b-form>
   </b-card>
   <Toaster ref="toaster" />

  </div>
</template>
<script>
import axios from "axios";
import GoogleAddress from "../../sub/GoogleAddress.vue";
import BusinessAddress from "../../sub/BusinessAddress.vue";
import Multiselect from 'vue-multiselect'
import Toaster from "../../sub/Toaster.vue";
import VuePhoneNumberInput from "vue-phone-number-input";
import Distance from "./Distance.vue";

export default {
  components: {
    GoogleAddress,
    BusinessAddress,
    Multiselect,
    Toaster,
    VuePhoneNumberInput,
    Distance
},
  data: () => ({
    initAddress:null,
    business_address:null,
    form: {
      first_name: null,
      last_name: null,
      phone:null,
      formatted: null,
      business_name:null,
      services: [],
      service_area:[],
      liscence: null,
      business_abn: null,
      city: null,
      country: null,
      formatted_address: null,
      state: null,
      street: null,
      street_number: null,
      zip: null,
    },
    trader: null,
    profile: null,
    services: [],
    service_area:[],
    isSubmitting: false,
  }),
  created() {
    this.getServices();
  },
  methods: {
    addTag(newTag) {
      const tag = {
        name: newTag,
        id: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
      }
      this.services.push(tag)
      this.form.skills.push(tag)
    },
    addBusinessAddress(address) {
      this.form.service_area.push({'address':address.formatted_address,'range':'50'});
    },
    remove(index) {
      this.form.service_area.splice(index, 1);
    },
    getServices() {
      axios
        .get("services")
        .then((res) => {
          this.services = res.data;
          console.log("ser", this.services)
        })
        .catch((err) => console.log(err.response));
    },
  
    googleAddress(address) {
      this.form.country = address.country;
      this.form.state = address.state;
      this.form.city = address.city;
      this.form.zip = address.zip;
      this.form.street = address.street;
      this.form.street_number = address.street_number;
      this.form.formatted_address = address.formatted_address;
    },
    submit() {
      if(this.form.phone === null){
        this.$refs.toaster.show(
            "danger",
            "b-toaster-top-center",
            "Faild",
            "Please enter a valid phone."
          );
          return;
      }
      if(this.form.business_abn.length != 11){
        this.$refs.toaster.show(
            "danger",
            "b-toaster-top-center",
            "Faild",
            "Please enter a valid 11 digits ABN."
          );
          return;
      }
      if(this.form.service_area.length ==0){
        this.$refs.toaster.show(
            "danger",
            "b-toaster-top-center",
            "Faild",
            "Please add your business addresses."
          );
          return;
      }
      this.isSubmitting = true;
     
      axios
        .post("employee/profile", this.form)
        .then((res) => {
          this.isSubmitting = false;
          console.log("saved>>>>>: ", res.data)
          this.$parent.get();
          this.$router.push("/employee");
        })
        .catch((err) => {
          console.log(err.response.data)
          this.isSubmitting = false;
          if(err.response.data && err.response.data.phone){
            this.$refs.toaster.show(
              "danger",
              "b-toaster-top-center",
              "Faild",
              err.response.data.phone
            );
            return;
          }
          this.$refs.toaster.show(
            "danger",
            "b-toaster-top-center",
            "Faild",
            "Please provide valid data"
          );
        });

    },
    cacnel(){
      this.$parent.addTogal=false;
    },
    updatePhone(v) {
      this.form.phone = v.isValid ? v.formattedNumber : null;
    },
  },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css">
</style>
<style scoped lang="scss">
.card{
  max-width: 600px;
  margin: auto;
}
ul{
  padding: 0 !important;
  li{
    list-style-type: none !important;
    padding: 10px;
    border-radius: 10px;
    border: 1px solid #f8f8f8;
    background: #f8f8f8;
    position: relative;
    margin-bottom: 5px;
    .b-icon{
      position: absolute;
      top: 0;
      right: 0;
    }
    .b-icon:hover{
      cursor: pointer;
      color: rgb(74, 74, 221);
    }
  }
}
a{
  text-decoration: underline;
  color: #3490dc;

}
</style>
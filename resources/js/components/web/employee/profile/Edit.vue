<template>
  <div>
      <b-form @submit.prevent="update">
        <b-form-group>
          <b-input-group>
            <b-form-input placeholder="First name" v-model="form.first_name">
          </b-form-input>
          <b-form-input placeholder="Last name" v-model="form.last_name">
          </b-form-input>
          </b-input-group>
        </b-form-group>
       
        <b-form-group>
          <GoogleAddress v-on:google-valid-address="googleAddress" :initialData="address" />
        </b-form-group>
        
        <b-form-group>
          <multiselect v-model="form.services" tag-placeholder="Add this as new Profession"
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

        <b-form-group>
          <b-form-input placeholder="Business name" v-model="form.business_name">
          </b-form-input>
        </b-form-group>

        <b-form-group>
          <b-form-textarea placeholder="Tell more about your business"  rows="3" max-rows="6" v-model="form.business_details">
          </b-form-textarea>
        </b-form-group>

        <b-form-group class="mt-3 mb-0">
         <b-input-group>
          <b-form-input placeholder="Business ABN" v-model="form.business_abn">
          </b-form-input>
          <b-form-input placeholder="License number(optional)" v-model="form.license_number">
          </b-form-input>
         </b-input-group>
        </b-form-group>

        <small>Business ABN is elevent digit number</small>
        <div class="text-left d-flex align-items-center mb-3">
          <small class="m-0">Don't have it on hand? <a href="https://www.abr.business.gov.au/" target="_blank" >&nbsp; Lookup
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
            <b-button  type="submit" variant="primary">Update</b-button>
          </div>
        </div>
      </b-form>
    <Toaster ref="toaster" />
  </div>
</template>
<script>
import axios from "axios";
import GoogleAddress from "../../sub/GoogleAddress.vue";
import Multiselect from 'vue-multiselect'
import Toaster from "../../sub/Toaster.vue";
import BusinessAddress from "../../sub/BusinessAddress.vue";
import Distance from "./Distance.vue";

export default {
  props: ['profile'],
  components: {
    GoogleAddress, Multiselect,Toaster,BusinessAddress,Distance
  },
  data: () => ({
    form: {
      first_name: null,
      last_name: null,
      services: [],
      service_area:[],
      business_abn: null,
      license_number:null,
      business_name:null,
      business_details:null,
      city: null,
      country: null,
      formatted_address: null,
      state: null,
      street: null,
      street_number: null,
      zip: null,
    },
    trader: null,
    address: null,
    isSubmitting: false,
    services: [],
    service_area: [],
  }),

  created() {
    this.init();
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
    update() {
      this.isSubmitting = true;
      axios
        .put("employee/profile/" + this.profile.id, this.form)
        .then((res) => {
          this.isSubmitting = false;
          this.$parent.get();
        })
        .catch((err) => {
          this.$refs.toaster.show(
            "danger",
            "b-toaster-top-center",
            "Faild",
            err.response.data.message
          );
          console.log("error",err.response)});
    },
    cancel(){
      this.$parent.editTogal=false;
    },  
    init() {
      console.log("profile ", this.profile)
      this.trader = this.profile;
      this.form.business_abn = this.trader.business_abn;
      this.form.license_number = this.trader.license_number;
      this.form.business_name = this.trader.business_name;
      this.form.business_details = this.trader.business_details;
      this.form.services = this.trader.services;
      this.form.service_area = this.trader.business_addresses;
      this.form.first_name = this.trader.first_name;
      this.form.last_name = this.trader.last_name;
      this.form.country = this.trader.address.country;
      this.form.state = this.trader.address.state;
      this.form.city = this.trader.address.city;
      this.form.zip = this.trader.address.zip;
      this.form.street = this.trader.address.street;
      this.form.street_number = this.trader.address.street_number;
      this.form.formatted_address = this.trader.address.formatted_address;
      this.address = this.trader.address;
    },
  },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css">
</style>
<style scoped>
a{
  text-decoration: underline;
  color: #3490dc;
}
</style>
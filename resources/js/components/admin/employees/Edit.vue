<template>
  <div >
     <b-card>
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
          <b-input-group>
            <b-form-input placeholder="Phone" v-model="form.phone">
          </b-form-input>
          <b-form-input placeholder="Email" v-model="form.email">
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
            <b-button  type="submit" variant="primary">Update</b-button>
          </div>
        </div>
      </b-form>
     </b-card>
    <Toaster ref="toaster" />
  </div>
</template>
<script>
import axios from "axios";
import GoogleAddress from "../../web/sub/GoogleAddress.vue";
import Multiselect from 'vue-multiselect'
import Toaster from "../../web/sub/Toaster.vue";
import BusinessAddress from "../../web/sub/BusinessAddress.vue";
import Distance from "../../web/employee/profile/Distance.vue";

export default {
  props: ['emp'],
  components: {
    GoogleAddress, Multiselect,Toaster,BusinessAddress,Distance
  },
  data: () => ({
    form: {
      first_name: null,
      last_name: null,
      email:null,
      phone:null,
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
        .put("admin/employees/" + this.emp.id, this.form)
        .then((res) => {
          this.isSubmitting = false;
          this.$emit('update')
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
      this.$emit('close')
    },  
    init() {
      this.form.business_abn = this.emp.business_abn;
      this.form.license_number = this.emp.license_number;
      this.form.business_name = this.emp.business_name;
      this.form.business_details = this.emp.business_details;
      this.form.services = this.emp.services;
      this.form.service_area = this.emp.business_addresses;
      this.form.first_name = this.emp.first_name;
      this.form.last_name = this.emp.last_name;
      this.form.email = this.emp.user.email;
      this.form.phone = this.emp.user.phone;
      this.form.country = this.emp.address.country;
      this.form.state = this.emp.address.state;
      this.form.city = this.emp.address.city;
      this.form.zip = this.emp.address.zip;
      this.form.street = this.emp.address.street;
      this.form.street_number = this.emp.address.street_number;
      this.form.formatted_address = this.emp.address.formatted_address;
      this.address = this.emp.address;
    },
  },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css">
</style>
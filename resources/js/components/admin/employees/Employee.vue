<template>
  <div class="mb-5">
     <b-modal id="review-modal" size="lg" hide-header hide-footer><Reviews :emp="profile" v-on:close="close()"/></b-modal>
    <b-modal id="galery-modal" size="xl" title="Background" hide-footer><Galery :emp="profile"  v-on:close="close()"/></b-modal>
    
    <Edit v-if="editTogal" :emp="profile"  v-on:update="update()" v-on:close="close()"/>
    <div v-else>
    <b-card v-if="profile" title="Profile details" class="text-left shadow-none  ">
      <div >
      <div class="row mb-2">
        <div class="col-4">
          First name:
        </div>
        <div class="col-8">
          {{ profile.first_name }}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-4">
          Last name:
        </div>
        <div class="col-8">
          {{ profile.last_name }}
        </div>
      </div>
     <div class="row mb-2">
        <div class="col-4">
          Last name:
        </div>
        <div class="col-8">
          {{ profile.user.phone }}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-4">
          Last name:
        </div>
        <div class="col-8">
          {{ profile.user.email }}
        </div>
       </div>
        <div class="row mb-2">
        <div class="col-4">
          Address:
        </div>
        <div class="col-8">
          <!-- {{ profile.address?.formatted_address }} -->cc
        </div>
      </div>  
       <div class="row mb-2">
        <div class="col-4">
          Professions:
        </div>
        <div class="col-8 d-flex">
          <div class="" v-for="(service, index) in profile.services" :key="index">
            <b-badge class="mr-2"  variant="secondary">{{ service.name }}</b-badge>
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-4">
          Work area:
        </div>
        <div class="col-8">
          <div class="" v-for="(area, index) in profile.business_addresses" :key="index">
              <span  variant="secondary">{{ area.address }}: <b-badge>{{ area.range }}km</b-badge></span>
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-4">
          Business ABN:
        </div>
        <div class="col-8">
          {{ profile.business_abn }}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-4">
          License number:
        </div>
        <div class="col-8">
          {{ profile.license_number }}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-4">
          Business name:
        </div>
        <div class="col-8">
          {{ profile.business_name }}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-4">
          Business details:
        </div>
        <div class="col-8">
          {{ profile.business_details }}
        </div>
      </div> 
     
      <div class="text-right mt-5">
        <b-button variant="light" @click="editTogal=!editTogal">Edit</b-button>
          <b-button v-b-modal.review-modal variant="light" class="review" v-b-tooltip.hover title="Rate and review this business">Reviews</b-button>
          <b-button  v-b-modal.galery-modal variant="light" v-b-tooltip.hover title="Background and experiences">Galery</b-button>
      </div>
    </div>
    </b-card>
    </div>
    <div v-else class="text-center">
      <b-spinner variant="primary"></b-spinner>
    </div> 
    <div>
      <b-button variant="light" @click="$router.go(-1)"><b-icon icon="arrow-left"></b-icon></b-button>
    </div>
  </div>
</template>
<script >
import Edit from "./Edit.vue";
import Galery from "./Galery.vue";
import Reviews from "./Reviews.vue";
import axios from "axios";

export default {
  components: {Edit,Galery,Reviews},  
  data:()=>({
    profile:null,
    editTogal:false,
  }),
  created(){
    this.get()
  },
  
  methods:{
    get() {
      axios
        .get("admin/employees/"+this.$route.params.id)
        .then((res) => {
          this.profile = res.data;
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
    update(){
      this.editTogal=false;
      this.get();
    },
   close(){
    this.$bvModal.hide('review-modal')
    this.$bvModal.hide('galery-modal')
    this.editTogal=false;
   }
  }
};
</script> 
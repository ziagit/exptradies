<template>
  <div>
    <b-modal id="review-modal" size="lg" hide-header hide-footer><Reviews :emp="employee" v-on:close="$bvModal.hide('review-modal')"/></b-modal>
    <b-modal id="galery-modal" size="xl" title="Background" hide-footer><Galery :emp="employee"/></b-modal>

    <b-modal id="modal-image" hide-backdrop hide-header hide-footer content-class="shadow" title="Item Image">
      <b-img :src="'/storage/images/posts/' + imageToView" fluid alt="Item Image"></b-img>
    </b-modal>

      <b-modal id="bv-modal-close" hide-header hide-footer >
        <ClosePost :post="post" v-on:closed="closedPost()"/>
      </b-modal>
        
        <div >
          <p><b>Businesses accepted your job request</b></p>
          <div v-if="post && post.employees.length>0">
            <BusinessDetails v-for="(emp,index) in post.employees" :key="index" :emp="emp" v-on:review="review(emp)" v-on:galery="openGalery(emp)" :index="index"></BusinessDetails>
          </div>
          <div v-else>
            <p>No one accepted this job yet.</p>
          </div>
        </div>
        <br>
       
        <p><b>Post details</b></p>
        <b-card v-if="post" class="text-left shadow-none ">
          <b-badge :variant="post.status=='active'?'success':'danger'" >{{ post.status }}</b-badge>
          <ul>
              <li class="row">
                <p class="col-6 text-secondary"><b>{{post.service.name}}</b></p>
              </li>
              <li class="row">
                <p class="col-6"><b>Created at:</b> </p><p class="col-6">{{ buildDate(post.created_at) }}</p>
              </li>
              <li class="row">
                <p class="col-6"><b>Address:</b> </p><p class="col-6">{{ post.address.formatted_address }}</p>
              </li>
              <li class="row">
                <p class="col-6"><b>post description:</b> </p><p class="col-6">{{ post.note }}</p>
              </li>
          </ul>
         <ul>
          <li class="row" v-for="(step,index) in steps" :key="index">
            <p class="col-6"><b>{{ step.qus }}:</b> </p><p class="col-6">{{ step.ans }}</p>
          </li>
         </ul>
         <div v-if="post.images.length > 0" class="d-flex justify-content-between align-items-center mt-5">
              <div class="d-flex flex-wrap">
                <div v-for="(img, index) in post.images" :key="index" class="m-2 avatar-container">
                    <b-avatar @click="viewImage('modal-image-'+index, img)" square href="#" :src="'/storage/images/posts/' + img.name" size="4.5rem" variant="light">
                    </b-avatar>
                </div>
              </div>
            </div>
          <div class="text-right">
            <b-button v-if="post.status=='active'" variant="danger" @click="closePost()">Close</b-button>
            <b-button v-else variant="primary" @click="repost()">Repost</b-button>
          </div>
        </b-card>
    <Toaster ref="toaster" />
    <b-button variant="light" @click="$router.back()"><b-icon icon="arrow-left"></b-icon></b-button>
 </div>
</template>
<script>

import axios from "axios";
import BusinessDetails from "./BusinessDetails.vue";
import formatter from "../../../shared/services/dateFormatter";
import stepOptionBuilder from "../../../shared/services/stepOptionBuilder"
import Toaster from "../../sub/Toaster.vue";
import ClosePost from "./ClosePost.vue";
import Galery from './Galery.vue';
import Reviews from './Reviews.vue';
export default {
  components: {
    Toaster,
    BusinessDetails,
    ClosePost,Galery,Reviews
},
  data: () => ({
    post: null,
    steps: [],
    isSubmitting: false,
    togal: false,
    imageToView:null,
    postId:null,
    employee:null,
  }),
  created() {
    this.get();
  },
  methods: {
    get() {
      axios
        .get("employee/posts/"+this.$route.params.id)
        .then((res) => {
          this.post= res.data;
          this.getSteps(res.data.service.id,res.data.options)
        })
        .catch((err) => console.log(err));
    },
    repost(){
      this.$router.push("/")
    },
     closePost() {
      this.$bvModal.show("bv-modal-close");
    },
    closedPost() {
      this.$bvModal.hide("bv-modal-close");
      this.get();
    },
   review(emp){
    this.employee=emp;
    this.$bvModal.show('review-modal');
   },

   openGalery(emp){
    this.employee=emp;
    this.$bvModal.show('galery-modal');
   },

    buildDate(date) {
      return formatter.format(date);
    },

    getSteps(id, options) {
      this.togal = !this.togal
      if (this.steps.length == 0)
        stepOptionBuilder.get("employee/steps/" + id, options).then(res => {
          this.steps = res;
        })
    },
 
    viewImage(id, img){
      this.imageToView = img.name;
      this.$bvModal.show('modal-image');
    },
  },
};
</script>

<style scoped lang="scss">
.badge {
  position: absolute;
  top: 10px;
  right: 10px;
}

ul {
  padding-left: 16px;

  li {
    list-style-type: none;
    
  }
}

</style>

<template>
  <div>
    <b-modal id="modal-image" hide-backdrop hide-header hide-footer content-class="shadow" title="Item Image">
      <b-img :src="'/storage/images/posts/' + imageToView" fluid alt="Item Image"></b-img>
    </b-modal>

      <h3>Job details</h3>
      <div v-if="post">

      
      <b-card  class="shadow-none mt-3">
          <div class="badges">
            <b-badge variant="success" >{{post.status}}</b-badge>
          </div>
          <ul>
            <li><p class="text-secondary"><b>{{ post.service.name }}</b></p></li>
            <li class="row">
              <p class="col-6">Posted on: </p><p class="col-6">{{ buildDate(post.created_at) }}</p>
            </li>
            <li class="row"  v-if="post.employees[0].pivot.status">
              <p class="col-6">Address: </p><p class="col-6">{{ post.address.formatted_address }}</p>
            </li>
            <li class="row"  v-else>
              <p class="col-6">Location: </p><p class="col-6">{{ post.address.city }}</p>
            </li>
            <li class="row">
              <p class="col-6">Post description: </p><p class="col-6">{{ post.note?post.note:"Details not provided by the customer." }}</p>
            </li>
          </ul>
          <ul v-if="steps">
            <li class="row" v-for="(step,index) in steps" :key="index">
              <p class="col-6">{{ step.qus }}: </p><p class="col-6">{{ step.ans }}</p>
            </li>
         </ul>

          <a class="ml-3" v-bind:href="
            'https://www.google.com/maps/place/' +
            post.address.city
          " target="_blank">View on Google Maps</a>

           <div v-if="post.images.length > 0" class="d-flex justify-content-between align-items-center mt-5">
              <div class="d-flex flex-wrap">
                <div v-for="(img, index) in post.images" :key="index" class="m-2 avatar-container">
                    <b-avatar @click="viewImage('modal-image-'+index, img)" square href="#" :src="'/storage/images/posts/' + img.name" size="4.5rem" variant="light">
                    </b-avatar>
                </div>
              </div>
            </div>
           
      </b-card>
      <b-card class="shadow-none mt-2" sub-title="Customer">
        <ul>
            <li class="row">
              <p class="col-4">First name:</p><p class="col-8"> {{ post.employee_with_user.first_name }}</p>
            </li>
            <li class="row">
              <p class="col-4">Last name:</p><p class="col-8"> {{ post.employee_with_user.last_name }}</p>
            </li>
          </ul>
      </b-card>
      <b-card class="shadow-none mt-2" sub-title="Businesses">
        <ul>
            <li class="row" v-for="(emp,index) in post.employees" :key="index">
              <p class="col-4">Name:</p><p class="col-4"> {{ emp.business_name }}</p><p class="col-4"> {{ emp.pivot.status }}</p>
            </li>
          </ul>
      </b-card>
    </div>
    <div v-else class="text-center">
      <b-spinner variant="primary"></b-spinner>
    </div>
    <b-button variant="light" @click="$router.back()"><b-icon icon="arrow-left"></b-icon></b-button>
    <Toaster ref="toaster" />
  </div>
</template>
<script>
  import formatter from "../../shared/services/dateFormatter";
  import stepOptionBuilder from "../../shared/services/stepOptionBuilder"
  import Toaster from "../../web/sub/Toaster.vue";
  import { mapActions, mapGetters } from "vuex";

export default {
  name: "Tabs",
  components:{Toaster},
  data: () => ({
    post:null,
    steps:null,
    imageToView:null,
    isSubmitting: false,

  }),
  created() { 
    this.get()
  },
  methods: {
    get() {
      this.all=null;
        axios
          .get("admin/posts/"+this.$route.params.id)
          .then((res) => {
            console.log("post:: ",res.data)
            this.post = res.data;
            this.getSteps(res.data.service.id,res.data.options)
          })
          .catch((err) => console.log(err));
      },
      getSteps(id, options) {
          stepOptionBuilder.get("admin/posts/steps/" + id, options).then(res => {
            this.steps = res;
          })
      },
      accept(id) {
        this.postId=id;
        this.$bvModal.show("bv-modal-example");
      },
     
      openChat(post) {
        this.chat({ route: "employee", listener: post.employee_with_user.user_id, post: post });
        this.$router.push({
          name: "employee-chat",
        });
      },
      review(post){
        //
      },
      viewImage(id, img){
        this.imageToView = img.name;
        this.$bvModal.show('modal-image');
      },
      buildDate(date) {
        return formatter.formatDate(date);
      },
  
      ...mapActions({
        chat: "shared/chat",
      }),
  }
};
</script>
  
<style scoped lang="scss">
.card {
  background: #fff !important;
}

ul {
  padding-left: 16px;

  li {
    list-style-type: none;
  }
}
.badges {
  position: absolute;
  top: 10px;
  right: 10px;
}
</style>

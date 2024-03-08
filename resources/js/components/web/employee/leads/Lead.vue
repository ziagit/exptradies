<template>
  <div>
    <b-modal id="modal-image" hide-backdrop hide-header hide-footer content-class="shadow" title="Item Image">
      <b-img :src="'/storage/images/posts/' + imageToView" fluid alt="Item Image"></b-img>
    </b-modal>

    <b-modal id="bv-modal-accept" hide-header hide-footer size="md">
      <div class="mb-5">
        <p v-if="paymentMethodError">{{ paymentMethodError }}</p>
        <p v-else>Do you want to accept this job?</p>
      </div>
       <div class="mt-5 text-right">
        <b-spinner v-if="isSubmitting" variant="primary"></b-spinner>
        <div v-else>
          <div v-if="paymentMethodError">
            <b-button  variant="light" @click="$router.push('/employee/payment-methods')">Payment method</b-button>
            <b-button variant="light" @click="$bvModal.hide('bv-modal-accept')">Close</b-button>
          </div>
          <div v-else>
            <b-button variant="light" @click="$bvModal.hide('bv-modal-accept')">No</b-button>
            <b-button variant="primary" @click="confirm()">Yes</b-button>
          </div>
        </div>
       </div>
    </b-modal>

      <h4>Job details</h4>
      <div v-if="post">
      <b-card  class="shadow-none mt-3">
          <div class="badges">
            <b-badge variant="light" v-if="post.status!='closed'">Credit: ${{post.employees[0].pivot.commission.toFixed(2)}}</b-badge>

            <b-badge variant="danger" v-if="post.status=='closed'">Closed</b-badge>
            <b-badge variant="success" v-else >Active</b-badge>
          </div>
          <ul>
            <li><p class="text-secondary"><b>{{ post.service.name }}</b></p></li>
            <li class="row">
              <p class="col-6"><b>Posted on:</b> </p><p class="col-6">{{ buildDate(post.created_at) }}</p>
            </li>
            <li class="row"  v-if="post.employees[0].pivot.status">
              <p class="col-6"><b>Address:</b> </p><p class="col-6">{{ post.address.formatted_address }}</p>
            </li>
            <li class="row"  v-else>
              <p class="col-6"><b>Location:</b> </p><p class="col-6">{{ post.address.city }}</p>
            </li>
            <li class="row">
              <p class="col-6"><b>Post description:</b> </p><p class="col-6">{{ post.note?post.note:"Details not provided by the customer." }}</p>
            </li>
          </ul>
          <ul v-if="steps">
            <li class="row" v-for="(step,index) in steps" :key="index">
              <p class="col-6"><b>{{ step.qus }}:</b> </p><p class="col-6">{{ step.ans }}</p>
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
            <div class="text-right">
              <small v-if="!post.is_acceptable && post.employees[0].pivot.status==null" class="text-secondary mt-5">Unfortunately, another individual has accepted this job. To avoid missing out on future opportunities, please accept jobs as soon as you receive notification.</small>
              <div v-else>
                <b-button v-if="post.employees[0].pivot.status === null && post.status!='closed'" variant="primary" @click="accept(post.id)">Accept</b-button>
              </div>
            </div>
      </b-card>
      <b-card class="mt-2" >
        <ul>
            <li><p><b>Customer details</b></p></li>
            <li class="row">
              <p class="col-6"><b>Name:</b></p><p class="col-6"> {{post.employee_with_user && post.employee_with_user.first_name }}</p>
            </li>
            <li class="row" v-if="post.employees[0].pivot.status">
              <p class="col-6"><b>Email:</b></p><p class="col-6">{{post.employee_with_user && post.employee_with_user.user.email }}</p>
            </li>
            <li class="row" v-if="post.employees[0].pivot.status">
              <p class="col-6"><b>Phone:</b></p><p class="col-6"> {{post.employee_with_user && post.employee_with_user.user.phone }}</p>
            </li>
          </ul>
          <div class="text-right">
                <b-button  v-if="post.employees[0].pivot.status" variant="light" @click="openChat(post)">Message</b-button>
          </div>
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
  import formatter from "../../../shared/services/dateFormatter";
  import stepOptionBuilder from "../../../shared/services/stepOptionBuilder"
  import Toaster from "../../sub/Toaster.vue";
  import { mapActions, mapGetters } from "vuex";

export default {
  name: "Tabs",
  components:{Toaster},
  data: () => ({
    post:null,
    steps:null,
    imageToView:null,
    isSubmitting: false,
    paymentMethodError:null,
  }),
  created() { 
    this.get()
  },
  methods: {
    get() {
      this.all=null;
        axios
          .get("employee/leads/"+this.$route.params.id)
          .then((res) => {
            this.post = res.data;
            this.getSteps(res.data.service.id,res.data.options)
          })
          .catch((err) => console.log(err));
      },
      getSteps(id, options) {
          stepOptionBuilder.get("employee/steps/" + id, options).then(res => {
            this.steps = res;
          })
      },
      accept(id) {
        this.postId=id;
        this.$bvModal.show("bv-modal-accept");
      },
      confirm(){
        this.isSubmitting = !this.isSubmitting;
        axios
          .get("employee/leads/accept/" + this.postId)
          .then((res) => {
            this.isSubmitting = !this.isSubmitting;
            this.get();
            this.$bvModal.hide("bv-modal-accept");
            this.$refs.toaster.show(
              "success",
              "b-toaster-top-center",
              "Success",
              "Your offer sent to customer. Send a message or wait to contact you."
            );
          })
          .catch((err) => {
            this.isSubmitting = !this.isSubmitting;
            if (err.response.status == 404) {
              this.paymentMethodError=err.response.data;
            }
          });
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

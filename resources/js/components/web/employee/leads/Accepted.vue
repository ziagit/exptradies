<template>
    <div>
      <div class="mt-3">
            <b-form-input placeholder="Search..." type="search" v-model="keywords"></b-form-input>
        </div> 
      <div v-if="posts">
        <b-card  no-body v-for="(post, index) in posts.data" :key="index" class="overflow-hidden shadow-none my-3 " >
          <b-badge variant="danger" v-if="post.status=='closed'">Closed</b-badge>
          <b-badge variant="success" v-else>Active</b-badge>
          <b-row no-gutters>
              <b-col md="2">
                <b-card-img v-if="post.service.image" :src="'/storage/images/services/' + post.service.image" alt="Image" class="rounded-0 in-phone-d-none"></b-card-img>
                <b-card-img v-else src="/images/placeholder.png" alt="Image" class="rounded-0 in-phone-d-none"></b-card-img>
              </b-col>
              <b-col md="10">
                <b-card-body :title="post.employee?post.employee.last_name:''" :sub-title="buildTitle(post)">
                  <b-card-text>
                    {{ post.note?post.note:"No more details provided by the customer." }}
                  </b-card-text>
                </b-card-body>
                <div class="text-right action">
                  <b-button  variant="light" @click="$router.push('/employee/leads/'+post.id)">Details</b-button>
                </div>
              </b-col>
          </b-row>
        </b-card>
      </div>
      <div v-else>
        <b-spinner variant="primary"></b-spinner>
      </div>
      <Toaster ref="toaster" />
    <pagination v-if="posts" :limit="4" :data="posts" @pagination-change-page="get"></pagination>
    </div>
  </template>
  <script >
  import formatter from "../../../shared/services/dateFormatter";
  import Toaster from "../../sub/Toaster.vue";
  import { mapActions, mapGetters } from "vuex";
  export default {
    components: {
      Toaster,
    },
    data: () => ({
      posts:null,
      keywords:null,
    }),
    watch: {
      keywords(after, before) {
        this.search();
      },
    },
    computed: {
      ...mapGetters({
        authenticated: "auth/authenticated",
        user: "auth/user"
      })
    },
    created(){
      this.get()
    },
    methods: {
      search() {
        axios
          .get("employee/leads/search", {
            params: {
              keywords: this.keywords,
              type:'accepted'
            },
          })
          .then((res) => {
            this.posts = res.data;
          })
          .catch((err) => {
            console.log(err);
          });
      },
      get(page=1){
          axios
            .get("employee/leads/accepted?page="+page)
            .then((res) => {
              this.posts = res.data;
            })
            .catch((err) => console.log(err));
      },
      buildTitle(post){
        return "Need "+post.service.name+" at "+post.address.city;
      }
    },
  };
  </script>
  
  <style scoped lang="scss">
   .card {
    background: #fff !important;
    max-height: 250px !important;
  }
 
.action{
  position: absolute;
  right: 10px;
  bottom: 20px;
}
  .badge {
  position: absolute;
  top: 10px;
  right: 10px;
}
  </style>
  
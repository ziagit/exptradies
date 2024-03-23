<template>
  <div>
    <div v-if="isLoading" class="text-center">
      <b-spinner variant="primary"></b-spinner>
    </div>
    <div v-else class="d-flex justify-content-center text-center align-items-center">
      <div class="text-center">
        <b-spinner variant="primary"></b-spinner>
        <h3>Please wait !</h3>
        <p>Your job is posting.</p>
      </div>
    </div>
    <Toaster ref="toaster" />
  </div>
</template>
<script>
import axios from "axios";
import localData from "../../shared/services/localData";
import Toaster from "../sub/Toaster.vue";
import { mapActions, mapGetters } from "vuex";

export default {
  data: () => ({
    isLoading: true,
    post: {
      service: null,
      address: null,
      contact: null,
      images:[],
      options: [],
      suboptions:[],
      emp_id:null,
    },
  }),
  components:{Toaster},
  created() {
    this.init();
  },
  computed:{
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user"
    })
  },

  methods: {
    ...mapActions({
      signIn: "auth/signIn",
      signOut: "auth/signOut"
    }),

    init() {
      this.post.service = localData.read("service");
      this.post.contact = localData.read("contact");
      this.post.address = localData.read("address");
      this.post.images = localData.read("item-images")
      this.post.emp_id = localData.read('emp_id');

      var opts = localData.read("optionArray");
      opts.forEach((element) => {
        this.post.options.push(element.value);
      });

      var sub = localData.read("suboptionArray");
      if(sub){
        sub.forEach((element) => {
          this.post.suboptions.push(element.value);
        }); 
      }
      this.submit();
    },
    submit() {
      axios
        .post("posts", this.post)
        .then((res) => {
          if(this.authenticated && this.user.role.name == 'Employee'){
            localData.removeAll();
            this.$router.push("/employee/posts");
            return;
          }
          console.log("after posted:  ", res.data)
          this.login(res.data.me)
        })
        .catch((err) =>{
            this.$refs.toaster.show(
            "danger",
            "b-toaster-top-center",
            "Faild",
            err.response.data
          );
          setTimeout(() => {
            this.$router.push("/post/step");
          }, 5000);
        });
    },
 
  },
};
</script>
<style scoped lang="scss">
.content {
  min-height: calc(100vh - 100px);
  display: flex;
  justify-content: space-between;

  .left {
    padding: 50px;
    flex: 5;
    background: #ddd;
    border-radius: 4px;

    ul {
      padding-left: 10px;

      li {
        font-size: 14px;
      }
    }
  }

  .right {
    flex: 3;

    ul {
      margin-left: 3px;
      padding: 0;

      li {
        font-size: 12px;
      }
    }
  }
}

@media only screen and (max-width: 576px) {
  .content {
    flex-direction: column;

    .left {
      flex: 100%;
      margin-bottom: 30px;
    }

    .right {
      flex: 100%;
    }
  }
}
</style>

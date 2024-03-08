<template>
  <div class="posts-page">
    <Header v-on:togal-menu="$emit('togal-menu')" />

    <div class="container my-5">
      <h1 class="in-phone-d-none">Jobs posted</h1>
      <h3 class="in-phone-d">Jobs posted</h3>
      <p>
        Embark on a fulfilling career path that perfectly aligns with your unique skills, passions, and interests. Discover a multitude of exciting opportunities tailored to your individual preferences. We are here to guide you in exploring and pursuing a career that brings you both professional success and personal fulfillment.
      </p>
      <br>
      <b-form-group class="search ">
          <b-input-group size="lg">
            <b-form-input type="search" placeholder="Search by service or postal code..." v-model="keywords"></b-form-input>
            <b-input-group-append>
              <b-input-group-text>
                <b-icon icon="search" />
              </b-input-group-text>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>

      <b-card-group columns v-if="posts">
        <b-card v-for="(post, index) in posts.data" :key="index" :title="post.service.name"
          :img-src="imageUrl(post)" img-alt="Image" img-top>
          <b-card-text>
            <span v-if="post.note">{{post.note.substring(0,300)}}</span>
            <span v-else>I will provide further work details either during our conversations or through direct contact. I look for expert who can deliver exceptionally high-quality services, free from any flaws or shortcomings.</span>
          </b-card-text>

          <div class="text-right mt-3">
            <b-button @click="readMore(post)" variant="light">Read more </b-button>
          </div>
        </b-card>
      </b-card-group>

      <pagination v-if="posts" :limit="4" :data="posts" @pagination-change-page="get"></pagination>
    </div>

    <b-sidebar v-model="isSidebarOpen"  width="500px" right  backdrop>
      <Details :post="selectedPost" :steps="steps"></Details>
    </b-sidebar>
    
    <Footer />
  </div>
</template>

<script>
import axios from "axios";
import Footer from "./sub/Footer";
import Header from "./sub/Header";
import Details from "./PostDeatails.vue";
import dateFormatter from "../shared/services/dateFormatter";
import localData from "../shared/services/localData";
import stepOptionBuilder from "../shared/services/stepOptionBuilder"

export default {
  name: "Posts",
  data: () => ({
    posts: null,
    steps: [],
    selectedPost:null,
    selectedIndex:0,
    isSidebarOpen:false,
    keywords:null,
  }),
  watch: {
    keywords(after, before) {
      this.search();
    },
  },
  methods: {
    search() {
      axios
        .get("search/posts", {
          params: {
            keywords: this.keywords,
          },
        })
        .then((res) => {
          this.posts = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    get(page=1) {
      axios.get("posts/all?page="+page).then((res) => {
        this.posts = res.data;
      });
    },
    readMore(post) {
        this.isSidebarOpen=true;
        this.selectedPost = post;
        if (this.steps.length == 0)
          stepOptionBuilder.get("posts/steps/" + post.service.id, post.options).then(res => {
            this.steps = res;
          })
    },
    bookNow(service){
      localData.save("service", service);
      this.$router.push("/post");
    },
    formatDate(post){
      return dateFormatter.format(post.created_at)+' ('+post.address.city+')';
    },
    imageUrl(post){
      if(post.service.image){
        return '/storage/images/services/' + post.service.image;
      }else{
        return "/images/placeholder.png";
      }
    }
  },

  created() {
    this.get();
  },
  components: {
    Footer,
    Header,
    Details,
  },
};
</script>

<style lang="scss" scoped>
@import "../../../sass/responsive.scss";
.in-phone-d{
  display: none;
}
.posts-page {
  background: #f9f8f7;
  .container{
    min-height: calc(100vh - 100px);
  }
  
  .read-more{
    position: absolute;
    bottom: 10px;
    right: 10px;
   }
  
}
</style>

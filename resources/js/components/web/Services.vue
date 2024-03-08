<template>
  <div class="services-page">
    <Header v-on:togal-menu="$emit('togal-menu')" />

    <div>
      <div class="section0">
      <div class="container">
          <h1 v-if="name">{{name}}</h1>
            <p><em>Job Available </em> <b-icon icon="exclamation-circle-fill" variant="light"></b-icon></p>
      </div>
      </div>
      <div class="container">
        <div v-if="details">
          <div v-html="details"></div>
        </div>
      </div>
    </div>

    <div style="height: 100px"></div>
    <div class="container">
      <h2 class="mb-5">Available Works In This Category</h2>
      <b-card-group columns >
          <b-card v-for="(post, index) in posts" :key="index">
            <b-card-title>{{post.service.name}}</b-card-title>
            <b-card-text>
              {{post.note}}
            </b-card-text>
            <b-card-text class="small text-muted">Last updated 3 mins ago</b-card-text>
          </b-card>
        </b-card-group>
    </div>
    <div style="height: 200px"></div>
    <Footer />
  </div>
</template>

<script lang="js">
import axios from "axios";
import Footer from "./sub/Footer";
import Header from "./sub/Header";
export default {
  name: "Services",
  data: () => ({
    name:null,
    details:null,
    posts:[],
  }),
  methods: {
    get() {
      axios.get("categories/"+this.$route.params.id).then((res) => {
        this.name = res.data.name;
        this.details = res.data.details;
        this.search(res.data.type);
      });
    },
    search(type) {
      axios
        .get("categories/posts", {
          params: {
            keywords: type,
          },
        })
        .then((res) => {
          this.posts = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  created() {
    this.get();
  },
  components: {
    Footer,
    Header,
  },
};
</script>

<style lang="scss" scoped>
@import "../../../sass/responsive.scss";

.section0 {
    height: 100px;
    background-image: url('/images/about/about.png');
    padding:200px 0;
    background-size: cover;
    background-position: center;
    height: 100vh;
    color: #fff !important;
    h1{
      color: #fff !important;
    }
  }
.services-page {
  background: #f9f8f7;
  height: 100vh;
  overflow-y: auto;
  .container{
    margin-top: 100px;
  }
}
</style>

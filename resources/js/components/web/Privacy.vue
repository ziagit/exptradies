<template>
  <div class="privacy">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="container">
      <div v-html="body"></div>
    </div>
    <Footer />
  </div>
</template>

<script>
import Footer from "./sub/Footer";
import Header from "./sub/Header";
import axio from "axios";
export default {
  name: "Privacy",
  data: () => ({
    title: null,
    body: null,
  }),
  components: {
    Footer,
    Header,
  },
  methods: {
    get() {
      axios.get("privacy-page").then((res) => {
        this.title = res.data.title;
        this.body = res.data.body;
      });
    },
  },
  created() {
    this.get();
  },
};
</script>

<style lang="scss" scoped>
.privacy {
  background: #f9f8f7;
  height: 100vh !important;
  overflow-y: auto;

  .container {
    padding-top: 100px;
    margin: 100px auto;
  }
}

/* 
@media only screen and (max-width: 600px) {
  .services {
    .section0 {
      text-align: center;

      .md-display-1 {
        line-height: 36px;
        font-size: 30px;
      }
    }

    .div {
      padding: 10px !important;

      .md-display-1 {
        font-size: 30px;
      }
    }
  }
} */

// Small devices (landscape phones, less than 768px)
@media (max-width: 767.98px) {}

// Medium devices (tablets, less than 992px)
@media (max-width: 991.98px) {}

// Large devices (desktops, less than 1200px)
@media (max-width: 1199.98px) {}
</style>

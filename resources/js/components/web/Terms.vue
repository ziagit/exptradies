<template>
  <div class="terms">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="container">
      <div v-html="body"></div>
    </div>
    <Footer />
  </div>
</template>

<script>
import Header from "./sub/Header";
import Footer from "./sub/Footer";
import axios from "axios";
export default {
  name: "Terms",
  data: () => ({
    title: null,
    body: null,
  }),
  methods: {
    get() {
      axios.get("terms-page").then((res) => {
        this.title = res.data.title;
        this.body = res.data.body;
      });
    },

  },

  created() {
    this.get();
  },
  components: {
    Header,
    Footer,
  },
};
</script>

<style lang="scss" scoped>
.terms {
  height: 100vh !important;
  background: #f9f8f7;
  overflow-y: auto;

  .container {
    padding-top: 162px;
    padding-bottom: 100px;
  }
}
</style>

<template>
  <div>
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="container my-5">
      <router-view :profile="profile"></router-view>
    </div>
    <Footer />
  </div>
</template>
<script>
import Footer from "../sub/Footer";
import Header from "../sub/Header";
export default {
  components: {
    Footer,
    Header,
  },
  data: () => ({
    profile: null,
  }),
  created() {
    this.get();
  },

  methods: {
    get() {
      axios
        .get("employee/profile")
        .then((res) => {
          this.isLoading = false;
          this.profile = res.data;
        })
        .catch((err) => console.log(err.response));
    },
  },

};
</script>
<style scoped lang="scss">
.container {
  min-height: calc(100vh - 93px);
}
</style>


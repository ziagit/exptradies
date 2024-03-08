<template>
  <div class="welcome">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="container">
      <b-card>
        <b-button @click="submit" variant="warning">Complete</b-button>
      </b-card>
    </div>
    <Footer />
  </div>
</template>

<script>
import Header from "../../shared/Header";
import Footer from "../../shared/Footer";
import { mapGetters, mapActions } from "vuex";
export default {
  name: "Welcome",
  components: {},
  data: () => ({
    form: {
      code: null,
      id: this.$route.params.id,
    },
    isSubmitting: false,
  }),
  created() { },
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },
  methods: {
    ...mapActions({
      signUp: "auth/signUp",
    }),
    submit() {
      if (this.user.role.name == "customer") {
        this.$router.push("/shipper/profile/add");
      } else if (this.user.role.name == "mover") {
        this.$router.push("/carrier/profile/add");
      }
    },
  },
  components: {
    Header,
    Footer,
  },
};
</script>

<style lang="scss" scoped>
.container {
  width: 100%;

  .content {
    height: calc(100vh - 3px);
    padding: 60px 30px;

    .main-card {
      width: 90%;
      min-height: 500px;
      margin: auto;
      padding: 20px;
      margin-bottom: 18px;
      text-align: center;
    }
  }
}

@media only screen and (max-width: 576px) {
  .card {
    width: 100% !important;
  }
}
</style>

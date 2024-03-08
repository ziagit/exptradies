<template>
  <div class="post" >
    <Header v-on:togal-menu="$emit('togal-menu')" :scrollValue="scrollValue" />
    <div class="container">
      <div class="content" v-bind:class="{ changeWidth: $route.path == '/post/confirm' }">
        <div v-if="$route.path != '/post/posted' && $route.path != '/post/verify'" class="d-flex justify-content-center text-center">
          <radial-progress-bar :diameter="120" :completed-steps="completedSteps" :total-steps="totalSteps"
            innerStrokeColor="#ddd" startColor="#007bff" stopColor="#007bff">
            {{ percentage }}%
          </radial-progress-bar>
        </div>
        <div style="height: 5px"></div>
        <router-view v-on:progress="progress"></router-view>
      </div>
    </div>
    <Footer />
  </div>
</template>
<script>
import RadialProgressBar from "vue-radial-progress";
import Header from "../sub/Header.vue";
import Footer from "../sub/Footer.vue";
import localData from "../../shared/services/localData";
export default {
  name: "post",
  components: {
    Header,
    Footer,
    RadialProgressBar,
  },
  data: () => ({
    scrollValue: 0,
    completedSteps: 0,
    totalSteps: 1,
    percentage: 0,
  }),
  created() {
    const service = localData.read("service");
    this.totalSteps = service.steps.length+2;
  },
  methods: {
    progress(prgValue) {
      this.completedSteps = prgValue;
      this.percentage = Math.floor((prgValue * 100) / this.totalSteps);
    },
  },
 
};
</script>
<style scoped lang="scss">
@import "../../../../sass/common.scss";
.post {
  background: #f9f8f7;
  overflow-y: auto;

  .container {
    min-height: calc(100vh - 100px);
    text-align: center;
    display: flex;

    .content {
      max-width: 600px;
      width: 100%;
      margin: auto;
    }

    .changeWidth {
      max-width: 100% !important;
      margin-top: 100px;
    }
  }
}

.card-body {
  text-align: center;
}
</style>
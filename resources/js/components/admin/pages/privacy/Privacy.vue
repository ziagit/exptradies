<template>
  <div class="">
    <Edit v-if="togal" v-on:close-dialog="refresh" :privacy="privacy" />
    <div v-else>
      <b-card header="Privacy Page" class="  shadow-none mt-5 mb-5">
        <div v-if="privacy" v-html="privacy.body"></div>
        <div v-else class="text-center">
          <b-spinner variant="primary"></b-spinner>
        </div>
        <b-button @click="togal = true" variant="primary" class="add-btn">
          <b-icon icon="pencil"></b-icon>
        </b-button>
      </b-card>
    </div>
  </div>
</template>

<script>
import Edit from "./Edit";
import axios from "axios";

export default {
  name: "Privacy",
  data: () => ({
    privacy: null,
    togal: false,
  }),

  methods: {
    get() {
      axios
        .get("admin/privacy")
        .then((res) => {
          this.privacy = res.data;
          console.log("privacies: ", res.data);
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
    refresh() {
      this.togal = false;
      this.get();
    },
  },
  created() {
    this.get();
  },
  components: {
    Edit,
  },
};
</script>
<style scoped lang="scss">
.container {
  min-height: calc(100vh - 50px);

  .add-btn {
    position: absolute;
    top: 0;
    right: 0;
  }
}
</style>

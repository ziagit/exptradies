<template>
  <div class="my-4">
    <form @submit.prevent="update">
      <b-form-group>
        <b-form-file @change="onChange" accept="image/jpeg,image/jpg, image/png" />
      </b-form-group>
      <div class="mt-3 text-right">
        <b-spinner variant="warning" v-if="isSubmitting" />
        <div v-else>
          <b-button type="submit" variant="light" @click="onClick">Cancel</b-button>
          <b-button type="submit" variant="light"> Update </b-button>
        </div>
      </div>
    </form>
    <Toaster ref="toaster" />
  </div>
</template>
<script>
import Toaster from "../../sub/Toaster.vue";
import axios from "axios";
export default {
  name: "EditAvatar",
  props: ["user"],
  components: { Toaster },
  data: () => ({
    isSubmitting: false,
    avatar: null,
  }),
  methods: {
    onChange(e) {
      this.avatar = e.target.files[0];
    },
    update() {
      if (this.avatar == null) {
        this.$refs.toaster.show(
          "danger",
          "b-toaster-top-center",
          "Invalid",
          "Please select a file!"
        );
        return;
      }
      this.isSubmitting = true;
      let fd = new FormData();
      fd.append("avatar", this.avatar);
      axios.post("auth/avatar/" + this.user.id, fd).then(res => {
        this.$parent.get();
        this.$parent.changeAvatar();
      })
    },
    onClick() {
      this.$parent.changeAvatar();
    },
  },
  created() { },
};
</script>
<style lang="scss" scoped>
.shipper-account {
  .md-card {
    text-align: left;
    padding: 20px;

    .md-card-actions {
      display: flex;
      justify-content: flex-start;
    }
  }
}
</style>

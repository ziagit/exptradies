<template>
  <div class="py-4">
    <b-avatar href="#bar" size="72px" :src="'/images/uploads/profile/' + user.avatar" @click="onClick"></b-avatar>
  </div>
</template>
<script>
export default {
  name: "Avatar",
  props: ['user'],
  data: () => ({
    avatar: null,
  }),
  methods: {
    onClick() {
      this.$parent.changeAvatar();
    }
  },
};
</script>
<style lang="scss" scoped>
</style>

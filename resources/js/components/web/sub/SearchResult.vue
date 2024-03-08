<template>
  <b-card class="search-result shadow-none" @click="select(service)"
    >{{ service.name }}
  </b-card>
</template>
<script>
export default {
  props: ["service"],
  methods: {
    select(service) {
      this.$emit("selected", service);
    },
  },
};
</script>

<template>
  <div>
    <b-form-group>
      <b-input-group>
        <b-form-datepicker v-model="form.from" placeholder="Start date" :max="new Date()" data-date-format="yyyy-mm-dd">
        </b-form-datepicker>
        <b-form-datepicker v-model="form.to" placeholder="End date" :max="new Date()"></b-form-datepicker>
      </b-input-group>
    </b-form-group>
    <div class="action">
      <b-button variant="light" size="sm" @click="filter()">Filter</b-button>
    </div>
  </div>
</template>
<script>
export default {
  data: () => ({
    form: {
      from: null,
      to: null,
    },
    carriers: [],
    types: [],
  }),
  
  methods: {
    filter() {
      this.$emit("close-dialog", this.form);
    },
  },
};
</script>
<style scoped>
.row {
  display: flex;
  justify-content: space-between;
}

.action {
  text-align: right;
}
</style>

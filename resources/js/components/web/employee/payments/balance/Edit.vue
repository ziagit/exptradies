<template>
  <div>
    <form @submit.prevent="submit" id="payment-form" enctype="multipart/form-data">
 
      <b-input-group class="mb-3">
        <b-form-input ref="focusable" v-model="form.amount" type="text" required placeholder="Amount"></b-form-input>
        <b-form-input v-model="form.email" required placeholder="Email" type="number"></b-form-input>
      </b-input-group>

      <div class="action mt-5">
        <b-spinner variant="primary" v-if="isSubmitting" />
        <b-button v-else id="submit-button" variant="light" type="submit" class="pr-4 pl-4">Add</b-button>
      </div>
    </form>
    <Toaster ref="toaster" />
  </div>
</template>

<script>
import axios from "axios";
import Toaster from "../../../sub/Toaster.vue";

export default {
  name: "Add",
  components: {
    Toaster
  },
  data: () => ({
    form: {
     amount:null,
    },
    isSubmitting: false,
  }),


  methods: {
    submit(){
      if(this.form.amount ==null){
        this.$refs.toaster.show(
          "danger",
          "b-toaster-top-center",
          "Faild",
          "Amount is required."
        );
        return;
      }
      axios.put("employee/contracts").then(res=>{{
        console.log("res ",res.data)
      }})
    }
  },
};
</script>

<style lang="scss" scoped>
</style>

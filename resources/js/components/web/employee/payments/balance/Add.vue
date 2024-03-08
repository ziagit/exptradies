<template>
  <div>
    <form @submit.prevent="submit" id="payment-form" enctype="multipart/form-data">
      <b-input-group class="mb-3" prepend="$">
        <b-form-input type="number" ref="focusable" v-model="form.amount"  required placeholder="Amount"></b-form-input>
        <b-input-group-append>
          <b-button @click="cancel()" variant="outline-secondary">Cancel</b-button>
          <b-spinner variant="primary" v-if="isSubmitting" />
          <b-button v-else id="submit-button" variant="outline-primary" type="submit" class="pr-4 pl-4">Save</b-button>
        </b-input-group-append>
     </b-input-group>
    </form>
    <Toaster ref="toaster" />
  </div>
</template>

<script>
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
          "warning",
          "b-toaster-top-center",
          "Faild",
          "Amount is required."
        );
        return;
      }
      this.isSubmitting = true;
      axios.post("employee/balance",this.form).then(res=>{{
        console.log("res ",res.data)
        this.isSubmitting = false;
        this.$parent.get()
          this.$refs.toaster.show(
            "success",
            "b-toaster-top-center",
            "Success",
            res.data
          );
          this.$parent.addTogal = false;
      }}).catch(err=>{
        console.log(err.response)
        this.isSubmitting = false;
        if(err.response.status ==404 || err.response.status == 400){
          this.$refs.toaster.show(
          "warning",
          "b-toaster-top-center",
          "Not processed",
          err.response.data
        );
        }

      })
    },
    cancel(){
      this.$parent.addTogal = false;
    }
  },
};
</script>

<style lang="scss" scoped>
</style>

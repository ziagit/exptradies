<template>
  <div>
    <b-form @submit.prevent="update">
      <b-form-group>

        <b-input-group prepend="%">
          <b-form-input type="number" min="1" v-model="form.percentage" placeholder="Percentage added to employee balance" required>
          </b-form-input>
        </b-input-group>
      </b-form-group>

      <b-form-group>
        <b-input-group prepend="%">
          <b-form-input type="number" min="1" v-model="form.discount" placeholder="Percentage discount employee accept job" required>
          </b-form-input>
        </b-input-group>
      </b-form-group>

      <b-form-group>
        <b-input-group prepend="$">
          <b-form-input type="number" min="1" v-model="form.min_balance" placeholder="Minimum balance" required>
          </b-form-input>
        </b-input-group>
      </b-form-group>

      <div class="text-right mt-3">
        <b-button @click="$emit('close-dialog')" variant="light">Cancel</b-button>
        <b-button type="submit" variant="light">Submit</b-button>
      </div>
    </b-form>
  </div>
</template>
<script>

import axios from "axios";
export default {
  props: ["balance"],
  data() {
    return {
      isSubmitting: false,
      form: {
        percentage: this.balance.percentage,
        discount: this.balance.discount,
        min_balance:this.balance.min_balance
      },
    };
  },
  created(){
  },  
  methods: {
    update() {
      this.isSubmitting = true;
      axios
        .put("admin/balances/" + this.balance.id, this.form)
        .then((res) => {
          this.isSubmitting = false;
          this.$emit("close-dialog");
        })
        .catch((err) => console.log(err));
    },
  },
};
</script>

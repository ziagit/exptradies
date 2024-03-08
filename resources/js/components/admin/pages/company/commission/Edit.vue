<template>
  <div>
    <b-form @submit.prevent="update">
      <b-form-group>
        <b-form-select v-model="form.service_id">
          <option v-for="service in services" :key="service.id" :value="service.id">
            {{ service.name }}
          </option>
        </b-form-select>
      </b-form-group>
      <b-form-group>
        <b-input-group prepend="$">
          <b-form-input type="number" id="input-1" step="0.1" v-model="form.service_amount" placeholder="Amount" required>
          </b-form-input>
          <b-form-input type="number" id="input-1" step="0.1" v-model="form.km_amount" placeholder="Amount per km" required>
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
  props: ["commission"],
  data() {
    return {
      isSubmitting: false,
      services: [],
      form: {
        service_id: this.commission.service.id,
        service_amount: this.commission.service_amount,
        km_amount: this.commission.km_amount,
      },
    };
  },
  methods: {
    getServices() {
      axios
        .get("services")
        .then((res) => {
          this.services = res.data;
        })
        .catch((err) => console.log(err.response));
    },

    update() {
      this.isSubmitting = true;
      axios
        .put("admin/commissions/" + this.commission.id, this.form)
        .then((res) => {
          this.isSubmitting = false;
          this.$emit("close-dialog");
        })
        .catch((err) => console.log(err));
    },
  },
  created() {
    this.getServices();
  },
};
</script>

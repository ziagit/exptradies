<template>
  <div>
    <b-form @submit.prevent="submit">
      <b-form-group>
        <b-form-input v-model="form.email" placeholder="Email" required />
      </b-form-group>
      <b-form-group>
        <b-form-input v-model="form.phone" placeholder="Phone" required/>
      </b-form-group>
      <b-form-group>
        <b-form-input v-model="form.abn" :max="11" :min="11" placeholder="ABN" required/>
      </b-form-group>
      <b-form-group>
        <b-form-input v-model="form.acn" :max="9" :min="9" placeholder="ACN" required/>
      </b-form-group>
      <b-form-group>
        <b-form-input v-model="form.address" placeholder="Address" required/>
      </b-form-group>
      <div class="mt-3 text-right">
        <b-button variant="primary" type="submit">Submit</b-button>
      </div>
    </b-form>
    <Toaster ref="toaster" />
  </div>
</template>
<script>
import axios from "axios";
import Toaster from "../../../../web/sub/Toaster.vue";
export default {
  props: ["company"],
  components: {
    Toaster,
  },
  data() {
    return {
      form: {
        email: null,
        phone: null,
        abn: null,
        acn: null,
        gst:null,
        address:null,
        acceptable_by:null,
      },
    };
  },
  created() {
      this.form.email = this.company.email;
      this.form.phone = this.company.phone;
      this.form.abn = this.company.abn;
      this.form.acn = this.company.acn;
      this.form.gst = this.company.gst;
      this.form.address = this.company.address;
      this.form.acceptable_by = this.company.acceptable_by;
  },
  methods: {
    submit() {
      axios
        .put("admin/company/" + this.company.id, this.form)
        .then((res) => {
          console.log("edit: ",res.data)
          this.$emit("close-dialog");
        });
    },
  },
};
</script>

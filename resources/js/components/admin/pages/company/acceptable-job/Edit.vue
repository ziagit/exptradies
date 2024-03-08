<template>
  <div>
    <b-form @submit.prevent="submit">
      <b-form-group  >
        <b-input-group >
          <b-form-input v-model="form.acceptable_by" placeholder="Number of business" required />
        </b-input-group>
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
        email:null,
        phone:null,
        abn:null,
        address:null,
        gst: null,
        acn:null,
        acceptable_by:null
      },
    };
  },
  created() {
      this.form.gst = this.company.gst;
      this.form.email = this.company.email;
      this.form.phone = this.company.phone;
      this.form.address = this.company.address;
      this.form.abn = this.company.abn;
      this.form.acn = this.company.acn;
      this.form.acceptable_by = this.company.acceptable_by

  },
  methods: {
    submit() {
      axios
        .put("admin/company/" + this.company.id, this.form)
        .then((res) => {
          this.$emit("close-dialog");
        });
    },
  },
};
</script>

<template>
  <div class="in-phone-no-padding method">
      <Edit v-if="editTogal"/>
      <div v-else>
        <div v-if="isLoaded">
          <Add v-if="methods.length == 0" />
          <div v-else class="text-right">
            <b-table class="table table-light" striped :items="methods"></b-table>
            <b-button variant="light" @click="editTogal = !editTogal">Edit</b-button>
          </div>
        </div>
        <div v-else>
          <b-spinner variant="primary"></b-spinner>
        </div>
      </div>
  </div>
</template>
<script>
import axios from "axios";
import Add from "./Add.vue"
import Edit from "./Edit.vue"

export default {
  components: { Add,Edit },
  data: () => ({
    methods: [],
    addTogal: false,
    editTogal:false,
    isLoaded:false,
  }),
  created() {
    this.get();
  },
  methods: {
    get() {
      this.methods=[];
      axios
        .get("employee/payment-methods")
        .then((res) => {
          res.data.data.forEach((method) => {
            this.methods.push({
              type: method.card.brand,
              date: method.card.exp_month + "/" + method.card.exp_year,
              last4: "... " + method.card.last4,
            });
          });
          this.isLoaded=true;
        })
        .catch((err) => {
          this.isLoaded=true;
          console.log(err)
        });
    },
  },
};
</script>

<template>
  <div class="my-3 in-phone-no-margin">
    <table v-if="invoices" class="table table-light">
      <thead>
        <tr>
          <th>ID</th>
          <th>Amount</th>
          <th>Date</th>
          <th>Details</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(invoice, index) in invoices.data" :key="index">
          <td>{{ index + 1 }}</td>
          <td>${{ (invoice.amount).toFixed(2) }}</td>
          <td>{{ format(invoice.created_at) }}</td>
          <td>
          <b-button variant="light" @click="$router.push('/employee/invoices/'+invoice.id)"><b-icon icon="three-dots"></b-icon></b-button>  
          </td>
        </tr>
      </tbody>
    </table>
    <pagination v-if="invoices" :limit="4" :data="invoices" @pagination-change-page="get"></pagination>

  </div>
</template>
<script >
import axios from "axios";
import formatter from "../../../../shared/services/dateFormatter";

export default {
  data: () => ({
    keywords:null,
    invoices: null,
    isSubmitting: false,
    togal: false,
  }),

  created() {
    this.get();
  },
  methods: {
    get(page=1) {
        axios
          .get("employee/invoices?page="+page)
          .then((res) => {
            this.invoices = res.data;
          })
          .catch((err) => console.log(err));
      },
      buildDate(date) {
        return formatter.format(date);
      },
    buildDate(date) {
      return formatter.format(date);
    },
    format(date) {
      return formatter.format(date)
  }
  },
};
</script>
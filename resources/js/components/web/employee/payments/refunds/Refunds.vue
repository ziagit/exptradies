<template>
    <div  class="my-3 in-phone-no-margin">
      <table v-if="refunds" class="table table-light">
        <thead>
          <tr>
            <th>ID</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Reason</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(refund, index) in refunds" :key="index">
            <td>{{ index + 1 }}</td>
            <td>${{ refund.amount }}</td>
            <td>{{ format(refund.created_at) }}</td>
            <td>{{refund.reason}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  <script >
  import axios from "axios";
  import formatter from "../../../../shared/services/dateFormatter";

  export default {
    data: () => ({
      keywords:null,
      refunds: null,
      isSubmitting: false,
      togal: false,
      showOverlay: false,
    }),
  
    created() {
      this.get();
    },
    methods: {
      get() {
        axios
          .get("employee/refunds")
          .then((res) => {
            this.refunds = res.data;
          })
          .catch((err) => console.log(err));
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
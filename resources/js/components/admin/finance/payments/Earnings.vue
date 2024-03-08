<template>
    <div class="">
      <div class=" mt-5 mb-5" header="Earnings">
        <div class="d-flex justify-content-between align-items-center my-3">
          <div>
            <h4>Total: ${{total.toFixed(2)}}</h4>
          </div>
          <b-form-input class="w-50 search-box-in-phone" placeholder="Search..." type="search" v-model="keywords">
          </b-form-input>
        </div>
        <table v-if="earnings" class="table table-light">
          <thead>
            <tr>
              <th>ID</th>
              <th>Amount</th>
              <th>Date</th>
              <th>Business</th>
              <th>Customer</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(earning, index) in earnings.data" :key="index">
              <td >{{ index + 1 }}</td>
              <td>${{ earning.amount.toFixed(2) }}</td>
              <td>{{ format(earning.created_at) }}</td>
              <td>{{ earning.employee.business_name }}</td>
              <td>{{earning.employer_post.employee.last_name}}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <pagination v-if="earnings" :limit="4" :data="earnings" @pagination-change-page="get"></pagination>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  import formatter from "../../../shared/services/dateFormatter";
  export default {
    name: "earning",
    data: () => ({
      keywords: null,
      earnings: null,
      earning: null,
      addTogal: false,
      editTogal: false,
      deleteTogal: false,
      total:0,
    }),
    watch: {
      keywords(after, before) {
        this.search();
      },
    },
    methods: {
      search() {
        axios
          .get("admin/finance/earnings/search", {
            params: {
              keywords: this.keywords,
            },
          })
          .then((res) => {
            this.calculateTotal(res.data.data)
            this.earnings = res.data;
          })
          .catch((err) => {
            console.log(err);
          });
      },
      get(page=1) {
        axios
          .get("admin/finance/earnings?page="+page)
          .then((res) => {
            console.log("resnnnnnnnnnnnnnn: ",res.data.data)
            this.earnings = res.data;
            this.calculateTotal(res.data.data);
          })
          .catch((err) => {
            console.log("Error: ", err);
          });
      },
     calculateTotal(earnings){
      this.total=0;
      earnings.forEach(er => {
        this.total = this.total + er.amount;
      });
     },
      format(date) {
        return formatter.format(date)
      }
    },
    created() {
      this.get();
    },
  };
  </script>
  <style scoped lang="scss">
  .container {
    min-height: calc(100vh - 50px);
  
    .add-btn {
      position: absolute;
      top: 0;
      right: 0;
    }
  
    // .body {
    //   max-width: 300px;
    //   overflow: hidden;
    //   text-overflow: ellipsis;
    //   white-space: nowrap;
    // }
  }
  </style>
  
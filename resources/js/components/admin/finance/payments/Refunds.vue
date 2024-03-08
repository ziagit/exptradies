<template>
    <div class="">
      <b-modal id="modal-add" size="md" title="Add new refund" :hide-footer="true" hide-header-close>
        <AddRefund v-on:refresh="get()" />
      </b-modal>
      <div class=" mt-5 mb-5" header="refunds">
        <div class="d-flex justify-content-between align-items-center my-3">
          <div>
            <h4>Total: ${{total}}</h4>
          </div>
          <b-form-input class="w-50 search-box-in-phone" placeholder="Search..." type="search" v-model="keywords">
          </b-form-input>
        </div>
        <table v-if="refunds" class="table table-light">
          <thead>
            <tr>
              <th>ID</th>
              <th>Amount</th>
              <th>Date</th>
              <th>Refunded to</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(refund, index) in refunds.data" :key="index">
              <td>{{ index + 1 }}</td>
              <td>${{ refund.amount }}</td>
              <td>{{ format(refund.created_at) }}</td>
              <td>{{ refund.employee.business_name }}</td>
            </tr>
          </tbody>
        </table>
        <b-button variant="light" v-b-modal.modal-add class="add-btn">
          New refund
        </b-button>
      </div>
      <pagination v-if="refunds" :limit="4" :data="refunds" @pagination-change-page="get"></pagination>
  
    </div>
  </template>
  
  <script>
  import AddRefund from "./AddRefund.vue"
  import axios from "axios";
  import formatter from "../../../shared/services/dateFormatter";
  export default {
    name: "refund",
    components:{AddRefund},
    data: () => ({
      keywords: null,
      refunds: null,
      refund: null,
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
          .get("admin/finance/refunds/search", {
            params: {
              keywords: this.keywords,
            },
          })
          .then((res) => {
            this.refunds = res.data;
            this.calculateTotal(res.data.data)

          })
          .catch((err) => {
            console.log(err);
          });
      },
      get(page=1) {
        axios
          .get("admin/finance/refunds?page="+page)
          .then((res) => {
            console.log("refunds:",res.data)
            this.refunds = res.data;
            this.calculateTotal(res.data.data)

          })
          .catch((err) => {
            console.log("Error: ", err);
          });
      },
  
      edit(data) {
        this.refund = data;
        this.$bvModal.show("modal-update");
      },
      remove(id) {
        this.deleteTogal = true;
        this.selectedId = id;
      },
  
      confirm() {
        axios
          .delete("admin/refunds/" + this.selectedId)
          .then((res) => {
            console.log("deleted", res.data);
            this.get();
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
  
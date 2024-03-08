<template>
    <div class="invoice">
      <b-card header-bg-variant="light" class="my-4 " v-if="details" id="printable">
          <div class="add-btn hidden">
            <b-button variant="light"  @click="download()">
              <b-icon icon="download" variant="primary"></b-icon>
            </b-button>
            <b-button variant="light"  @click="$router.back()">
                <b-icon icon="x" variant="primary"></b-icon>
            </b-button>
          </div>
         
        <div class="p-5 in-phone-no-padding">
          <div class="header">
            <div class="d-flex align-items-center">
              <img src="/images/home/logo_text.png" alt="logo" width="150">
            </div>
            <div class=" d-flex justify-content-between">
              <div>
                <div class="text-secondary">ABN: {{details.company.abn}}</div>
                <div class="text-secondary">ACN: {{details.company.acn}}</div>
              </div>
              <p>Tax invoice</p>
            </div>
          </div>
          <hr>
          
          <div class="d-flex flex-column justify-content-end text-right">
            <div>INVOICE DATE: {{formatDate(details.invoice.created_at)}}</div>
            <div>INVOICE #: {{details.invoice.id}}</div>
          </div>

          <div class="in-phone-d my-5 d-flex justify-content-between">
            <div style="max-width: 240px;">
              <h2 class="text-uppercase">{{ details.employee.last_name }}</h2>
              <p class="m-0 mb-0 text-uppercase">{{details.employee.business_name}}</p>
              <p class="text-uppercase">{{ details.employee.address.formatted_address }}</p>
            </div>
            <div class="d-flex justify-content-center flex-column align-items-center">
              <p class="m-0">Total paid</p>
              <div class="amount ">
                <h1 class="m-0">${{details.invoice.amount.toFixed(2)}}</h1>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <b>Account summary</b>
            <b>Amount (INCL. GST) </b>
          </div>
          <hr>
          <div class="d-flex justify-content-end">
            <div class="text-right mr-4">
              <div>Sevice:</div>
              <div>Leads credit plan balance:</div>
              <div>Credit applied:</div>
              <div>Total amount paid:</div>
            </div>
            <div>
              <div>{{ details.invoice.post_with_service.service.name }}</div>
              <div>${{ details.employee.balance?details.employee.balance:'00.00' }}</div>
              <div>${{ details.invoice.amount.toFixed(2) }}</div>
              <div>${{ details.invoice.amount.toFixed(2) }}</div>
            </div>
          </div>
          <hr>
          <div>
            <p>For more information and inquiry refer to exptradies web portal <a href="https://exptradies.com/help">www.exptradies.com/help</a> 
            <div>or call us on {{details.company.phone}}.</div>
            </p>
          </div>
        </div>
      </b-card>
      <div v-else class="text-center"><b-spinner variant="primary"></b-spinner></div>
    </div>
  </template>
  <script >
  import htmlToPdf from "../../../../shared/services/htmlToPdf";
  import axios from "axios";
  import formatter from "../../../../shared/services/dateFormatter";
  import Toaster from "../../../sub/Toaster.vue";
  import { mapActions, mapGetters } from "vuex";
  import dateFormatter from "../../../../shared/services/dateFormatter";
  export default {
    components: {
      Toaster,
    },
    data: () => ({
      details: null,
      isSubmitting: false,
      togal: false,
    }),
    computed: {
      ...mapGetters({
        authenticated: "auth/authenticated",
        user: "auth/user"
      })
    },
    created() {
      this.get();
    },
    methods: {
      formatDate(date){
        return dateFormatter.format(date);
      },  
      get() {
        axios
          .get("employee/invoices/"+this.$route.params.id)
          .then((res) => {
            this.details = res.data;
          })
          .catch((err) => console.log(err));
      },
      buildDate(date) {
        return formatter.format(date);
      },
      async download() {
        await this.hideElements();
        await htmlToPdf.downloadPDF("printable", "Invoice");
        this.showElements();
      },
    hideElements() {
      document.getElementsByClassName("hidden")[0].style.display = "none";
    },
    showElements() {
      document.getElementsByClassName("hidden")[0].style.display = "block";
    },
  
    },
  };
  </script>
  
  <style scoped lang="scss">
  @import "../../../../../../sass/responsive.scss";
 
  .amount{
    background-color: #ddd;
    padding: 8px 60px;
  }
  .card {
    min-height: 1000px;
    background: #fff !important;
  }
  
  ul {
    padding-left: 16px;
  
    li {
      list-style-type: none;
    }
  }
  </style>
  
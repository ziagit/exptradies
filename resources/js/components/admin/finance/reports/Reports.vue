<template>
    <div >
        <b-modal id="modal-filter" size="md" title="Filter By" :hide-footer="true">
            <FilterReport v-on:close-dialog="refresh" />
        </b-modal>
        <b-card id="printable" sub-title="Exptradies Reports" class="in-phone-reports">
            <div class="hidden no-print" id="no-print">
                <b-button variant="light" v-b-modal.modal-filter>
                    <b-icon variant="primary" icon="filter-left"></b-icon>
                </b-button>
                <b-button variant="light" @click="printIt()">
                    <b-icon icon="printer" variant="primary"></b-icon>
                </b-button>
                <b-button variant="light" @click="download()">
                    <b-icon icon="download" variant="primary"></b-icon>
                </b-button>
            </div>
            <div>
                <div class="row mr-0 align-items-center">
                    <div class="col-8">
                        <h5>Gross profit: ${{ totalIncom.toFixed(2) }}</h5>
                    </div>
                    <table class="col-4">
                        <tr>
                            <th>No.</th>
                        </tr>
                        <tr>
                            <th>{{  orderQty  }}</th>
                        </tr>
                    </table>
                </div>
                <div class="break"></div>
                <table v-if="result" class="table-content">
                    <tr>
                        <th>Date</th>
                        <th>Service</th>
                        <th>Location</th>
                        <th>Price</th>
                        <th>GST</th>
                        <th>Customer</th>
                        <th>‌Business</th>
                    </tr>
                    <tr v-for="(res, index) in result" :key="index">
                        <td>{{  dateFormatter(res.created_at)  }}</td>
                        <td>{{  res.employer_post.service.name  }}</td>
                        <td>{{  res.employer_post.address.city  }}</td>
                        <td>${{  res.amount.toFixed(2)  }}</td>
                        <td>${{  res.gst.toFixed(2)  }}</td>
                        <td>{{  res.employer_post.employee.first_name  }}</td>
                        <td>{{  res.employee.business_name  }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Total</td>
                        <td>${{ totalAmount.toFixed(2) }}</td>
                        <td>${{ totalGst.toFixed(2) }}</td>
                        <td colspan="2"></td>
                    </tr>
                </table>
                <b-spinner v-else />
            </div>
        </b-card>
    </div>
</template>
  <script>
import FilterReport from "./Filter";
import htmlToPdf from "../../../shared/services/htmlToPdf";
import dateFormatter from "../../../shared/services/dateFormatter";
import axios from "axios";

export default {
    components: {
        FilterReport,
    },
    data: () => ({
        result: null,
        orderQty: null,
        isLoading: false,
        totalIncom:null,
        totalAmount:null,
        totalGst:null,
    }),
    created() {
        this.get();
    },
    methods: {
        get() {
            this.isLoading = true;
            axios
                .get("admin/finance/reports")
                .then((res) => {
                    console.log("res", res.data);
                    this.total(res.data);
                    this.result = res.data;
                    this.isLoading = false;
                })
                .catch((err) => console.log(err.response));
        },
        refresh(data) {
            this.isLoading = true;
            axios
                .post("admin/finance/reports/filter", data)
                .then((res) => {
                    console.log("filter res: ", res.data);
                    this.result = res.data;
                    this.total(res.data);
                    this.$bvModal.hide("modal-filter");
                    this.isLoading = false;
                })
                .catch((err) => console.log(err));
        },

        dateFormatter(date) {
            return dateFormatter.format(date);
        },
        printIt() {
            window.print();
        },

        total(data) {
            this.totalIncom = 0;
            this.totalAmount=0;
            this.totalGst=0;
            this.orderQty=0;
            for (let i = 0; i < data.length; i++) {
                this.orderQty++;
                this.totalAmount = this.totalAmount + data[i].amount;
                this.totalGst = this.totalGst+data[i].gst;
            }
            this.totalIncom=this.totalAmount-this.totalGst;
        },
      
        async download() {
            await this.hideElements();
            await htmlToPdf.downloadPDF("printable", "SalesReport");
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
  table {
      width: 100%;
      border: 1px solid #ddd;
      border-collapse: collapse;
      tr {
          border: 1px solid #ddd;
          td,
          th {
              border: 1px solid #ddd;
              text-align: left;
              padding: 5px;
          }
      }
  }
  .no-print {
      position: absolute;
      top: 1px;
      right: 1px;
  }
</style>
  
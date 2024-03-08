<template>
  <div class="">
    <b-modal id="update-balance" title="Update balance" :hide-footer="true" hide-header-close>
      <Edit v-on:close-dialog="refresh" :balance="balance" />
    </b-modal>
    <!-- add dialog -->
    <b-card v-if="balances" header="Balance" class="  shadow-none  mb-2">
      <table class="table table-light table-in-phone">
        <tr>
          <th>Percentage add to employee balance</th>
          <th>Percentage discount from employee balance</th>
          <th>Minimum balance contractor can add</th>
        </tr>
        <tr v-for="(balance, index) in balances" :key="index">
          <td>% {{ balance.percentage }}</td>
          <td>% {{ balance.discount }}</td>
          <td>$ {{ balance.min_balance }}</td>
          <td>
            <b-button variant="light" @click="edit(balance)">
              <b-icon icon="pencil" variant="primary"></b-icon>
            </b-button>
          </td>
        </tr>
      </table>
    </b-card>
    <div v-else class="text-center">
      <b-spinner variant="primary"></b-spinner>
    </div>
  </div>
</template>

<script>
import Edit from "./Edit";
import axios from "axios";

export default {
  name: "Balance",
  data: () => ({
    keywords: null,
    balances: null,
    balance: null,
    editTogal: false,
    deleteTogal: false,
  }),

  methods: {
    get() {
      axios
        .get("admin/balances")
        .then((res) => {
          this.balances = res.data;
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
    refresh() {
      this.$bvModal.hide("update-balance");
      this.get();
    },
    edit(data) {
      this.balance = data;
      this.$bvModal.show("update-balance");
    },

    confirm(id) {
      axios
        .delete("admin/balances/" + id)
        .then((res) => {
          console.log("deleted", res.data);
          this.get();
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
  },
  created() {
    this.get();
  },

  components: {
    Edit,
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

  .body {
    max-width: 300px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
}
</style>

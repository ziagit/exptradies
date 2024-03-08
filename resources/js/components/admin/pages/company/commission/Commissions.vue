<template>
  <div class="">
    <b-modal id="update-commission" title="Update Commission" :hide-footer="true" hide-header-close>
      <Edit v-on:close-dialog="refresh" :commission="commission" />
    </b-modal>
    <!-- add dialog -->
    <b-modal id="modal-add" size="md" title="Add New Commition" :hide-footer="true" hide-header-close>
      <Add v-on:close-dialog="refresh" />
    </b-modal>
    
    <b-card v-if="commissions" header="Commission" class="  shadow-none mt-5 mb-5">
      <b-button class="add-btn" variant="light" @click="$bvModal.show('modal-add')">
      <b-icon icon="plus" variant="primary"></b-icon>
    </b-button>
      <table class="table table-light table-in-phone">
        <tr>
          <th class="hide-in-phone">ID</th>
          <th>Service</th>
          <th>Service Amount</th>
          <th>Amount/km</th>
        </tr>
        <tr v-for="(commission, index) in commissions" :key="index">
          <td class="hide-in-phone">{{ index + 1 }}</td>
          <td>{{ commission.service.name }}</td>
          <td>${{ commission.service_amount }}</td>
          <td>${{ commission.km_amount }}</td>
          <td>
            <b-button variant="light" @click="edit(commission)">
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
import Add from "./Add";
import Edit from "./Edit";
import axios from "axios";

export default {
  name: "Commistion",
  data: () => ({
    keywords: null,
    commissions: null,
    commission: null,
    addTogal: false,
    editTogal: false,
    deleteTogal: false,
  }),

  methods: {
    get() {
      axios
        .get("admin/commissions")
        .then((res) => {
          this.commissions = res.data;
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
    refresh() {
      this.$bvModal.hide("modal-add");
      this.$bvModal.hide("update-commission");
      this.get();
    },
    edit(data) {
      this.commission = data;
      this.$bvModal.show("update-commission");
    },
    remove(id) {
      this.$bvModal
        .msgBoxConfirm("You cannot delete this!")
        .then((value) => {
          if (value) {
            //this.confirm(id);
          }
        })
        .catch((err) => {
          console.log("err", err);
        });
    },

    confirm(id) {
      axios
        .delete("admin/commistions/" + id)
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
    Add,
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

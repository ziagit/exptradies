<template>
  <div class="">
    <b-modal id="modal-update" title="Update suboption" :hide-footer="true" hide-header-close>
      <Edit v-on:close-dialog="refresh" :option="option" />
    </b-modal>
    <!-- add dialog -->
    <b-modal id="modal-add" size="md" title="Add new suboption" :hide-footer="true" hide-header-close>
      <Add v-on:close-dialog="refresh" />
    </b-modal>
    <b-card v-if="options" header="Suboptions" class="  shadow-none mt-5 mb-5">
      <table class="table table-light">
        <tr>
          <th class="hide-in-phone">ID</th>
          <th>Titel</th>
          <th class="hide-in-phone">Details</th>
          <th>Actions</th>
        </tr>
        <tr v-for="(option, index) in options" :key="index">
          <td class="hide-in-phone">{{ index + 1 }}</td>
          <td>{{ option.title }}</td>
          <td class="hide-in-phone">
            <div v-html="option.details"></div>
          </td>
          <td>
            <b-button variant="light" @click="edit(option)">
              <b-icon icon="pencil" variant="primary"></b-icon>
            </b-button>
            <b-button variant="light" @click="remove(option.id)">
              <b-icon variant="danger" icon="trash"></b-icon>
            </b-button>
          </td>
        </tr>
      </table>
      <b-button v-b-modal.modal-add variant="primary" class="add-btn">
        <b-icon icon="plus"></b-icon>
      </b-button>
    </b-card>

    <div v-else class="text-center">
      <b-spinner variant="primary"></b-spinner>
    </div>
    <div>
      <b-button variant="light" @click="$router.back()"><b-icon icon="arrow-left"></b-icon></b-button>
    </div>
  </div>
</template>

<script>
import Add from "./Add";
import Edit from "./Edit";
import axios from "axios";

export default {
  name: "options",
  data: () => ({
    options: null,
    option: null,
    addTogal: false,
    editTogal: false,
    deleteTogal: false,
  }),

  methods: {
    get() {
      axios
        .get("admin/suboptions/"+this.$route.params.id)
        .then((res) => {
          console.log("opstiosn: ",res.data)
          this.options = res.data;
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },
    refresh() {
      this.$bvModal.hide("modal-add");
      this.$bvModal.hide("modal-update");
      this.get();
    },
    edit(data) {
      this.option = data;
      this.$bvModal.show("modal-update");
    },
    remove(id) {
      this.$bvModal
        .msgBoxConfirm("Are you sure you want to delete?",
        {
          okVariant: 'light',
          cancelVariant: 'light'
        }
        )
        .then((value) => {
          if (value) {
            this.confirm(id);
          }
        })
        .catch((err) => {
          console.log("err", err);
        });
    },

    confirm(id) {
      axios
        .delete("admin/suboptions/" + id)
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

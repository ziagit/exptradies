<template>
  <div class="">
    <b-modal id="modal-update" title="Update step" :hide-footer="true" hide-header-close>
      <Edit v-on:close-dialog="refresh" :step="step" />
    </b-modal>
    <!-- add dialog -->
    <b-modal id="modal-add" size="md" title="Add new " :hide-footer="true" hide-header-close>
      <Add v-on:close-dialog="refresh" />
    </b-modal>
    <b-card v-if="steps" header="Steps" class="  shadow-none mt-5 mb-5">
      <table class="table table-light">
        <tr>
          <th class="hide-in-phone">ID</th>
          <th>Titel</th>
          <th class="hide-in-phone">Details</th>
          <th>Actions</th>
        </tr>
        <tr v-for="(step, index) in steps" :key="index">
          <td class="hide-in-phone">{{ index + 1 }}</td>
          <td>{{ step.title }}</td>
          <td class="hide-in-phone">
            <div v-html="step.details"></div>
          </td>
          <td>
            <b-button variant="light" @click="edit(step)">
              <b-icon icon="pencil" variant="primary"></b-icon>
            </b-button>
            <b-button variant="light" @click="remove(step.id)">
              <b-icon variant="danger" icon="trash"></b-icon>
            </b-button>
            <b-button variant="light" @click="options(step.id)">
              <b-icon variant="primary" icon="three-dots"></b-icon>
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
      <b-button  variant="light" @click="$router.back()"><b-icon icon="arrow-left"></b-icon></b-button>
    </div>
  </div>
</template>

<script>
import Add from "./Add";
import Edit from "./Edit";
import axios from "axios";

export default {
  name: "Steps",
  components: {
    Add,
    Edit,
  },
  data: () => ({
    steps: null,
    step: null,
    addTogal: false,
    editTogal: false,
    deleteTogal: false,
  }),
  watch:{
    keywords: function(oldValue, newValue){
      this.search()
    }
  },
  methods: {
    get() {
      axios
        .get("admin/steps/"+this.$route.params.id)
        .then((res) => {
          this.steps = res.data;
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
      this.step = data;
      this.$bvModal.show("modal-update");
    },
    options(id){
      this.$router.push("/admin/service/step/"+id);
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
        .delete("admin/steps/" + id)
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

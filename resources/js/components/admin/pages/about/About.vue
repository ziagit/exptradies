<template>
  <div class="">
    <b-modal id="modal-update" size="lg" title="Update Data" :hide-footer="true">
      <Edit v-on:close-dialog="refresh" :about="abt" />
    </b-modal>
   
    <div>
      <b-card v-if="about" class="  shadow-none mt-5 mb-5" header="About Page">
        <table class="table">
          <tr>
            <th class="hide-in-phone">ID</th>
            <th>Title</th>
            <th>Body</th>
            <th>Actions</th>
          </tr>
          <tr v-for="ab in about" :key="ab.id">
            <td class="hide-in-phone">{{  ab.id  }}</td>
            <td>{{  ab.title  }}</td>
            <td>
              <div v-html="ab.body"></div>
            </td>
            <td>
              <b-button variant="light" @click="edit(ab)">
                <b-icon icon="pencil" variant="primary"></b-icon>
              </b-button>
              <b-button variant="light" @click="remove(ab.id)">
                <b-icon variant="danger" icon="trash"></b-icon>
              </b-button>
            </td>
          </tr>
        </table>
      </b-card>
      <div v-else class="text-center">
        <b-spinner variant="primary"></b-spinner>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Add from "./Add";
import Edit from "./Edit";

export default {
  name: "about",
  data: () => ({
    about: null,
    abt: null,
    togal: false,
  }),

  methods: {
    get() {
      axios
        .get("admin/about")
        .then((res) => {
          this.about = res.data;
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
      this.abt = data;
      this.$bvModal.show("modal-update");
    },
    remove(id) {
      this.$bvModal
        .msgBoxConfirm("Are you sure?")
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
        .delete("admin/about/" + id)
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
    Add,
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
}
</style>

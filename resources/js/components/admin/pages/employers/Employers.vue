<template>
  <div class="">
    <b-modal id="modal-update" title="Update  Data" :hide-footer="true">
      <textEditor :initTitle="title" :initBody="initValue" :initPath="path" method="put"
        v-on:close-me="$emit('close-dialog')">
      </textEditor>
    </b-modal>
    <!-- add dialog -->
    <b-modal id="modal-add" size="md" title="Add new " :hide-footer="true">
      <Add v-on:close-dialog="refresh" />
    </b-modal>
    <b-card class="  shadow mt-5 mb-5" header="Mover page">
      <div class="d-flex justify-content-end my-3">
        <b-form-input class="w-50 search-box-in-phone" placeholder="Search..." type="search" v-model="keywords">
        </b-form-input>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th md-numeric>ID</th>
            <th>Title</th>
            <th>Body</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="employer in employers.data" :key="employer.id">
            <td md-numeric>{{ index+1 }}</td>
            <td>{{ employer.title }}</td>
            <td class="body" v-html="employer.body"></td>
            <td md-label="Actions">
              <b-button variant="light" @click="edit(employer)">
                <b-icon icon="pencil" variant="primary"></b-icon>
              </b-button>
              <b-button variant="light" @click="remove(employer.id)">
                <b-icon icon="trash" variant="danger"></b-icon>
              </b-button>
            </td>
          </tr>
        </tbody>
      </table>
      <b-button variant="primary" v-b-modal.modal-add class="add-btn">
        <b-icon icon="plus"></b-icon>
      </b-button>
    </b-card>
    <pagination :limit="4" :data="employers" @pagination-change-page="get"></pagination>

  </div>
</template>

<script>
import Add from "./Add";
import Edit from "./Edit";
import axios from "axios";
import TextEditor from "../../../shared/TextEditor.vue";
export default {
  components: { textEditor: TextEditor },
  name: "employers",
  data: () => ({
    keywords: null,
    employers: null,
    employer: null,
    addTogal: false,
    editTogal: false,
    deleteTogal: false,
  }),
  watch: {
    keywords(after, before) {
      this.search();
    },
  },
  methods: {
    search() {
      axios
        .get("admin//search", {
          params: {
            keywords: this.keywords,
          },
        })
        .then((res) => {
          this.employers = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    get() {
      axios
        .get("admin/employer-page")
        .then((res) => {
          console.log("car", res.data);
          this.employers = res.data;
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },

    refresh() {
      this.addTogal = false;
      this.editTogal = false;
      this.get();
    },
    edit(data) {
      this.employer = data;
      this.$bvModal.show("modal-update");
    },
    remove(id) {
      this.deleteTogal = true;
      this.selectedId = id;
    },

    confirm() {
      axios
        .delete("admin/employer/" + this.selectedId)
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

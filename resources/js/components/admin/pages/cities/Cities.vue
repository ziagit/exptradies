<template>
  <div class="">
    <b-modal id="modal-update" title="Update" :hide-footer="true" hide-header-close>
      <Edit v-on:close-dialog="refresh" :city="city" />
    </b-modal>
    <!-- add dialog -->
    <b-modal id="modal-add" size="md" title="Add new " :hide-footer="true" hide-header-close>
      <Add v-on:close-dialog="refresh" />
    </b-modal>
    <b-card v-if="cities" header="Cities" class="  shadow-none mt-5 mb-5">
      
      <div class="d-flex justify-content-end">
        <b-form-input class="w-50 search-box-in-phone" placeholder="Search..." type="search" v-model="keywords">
        </b-form-input>
      </div>

      <table class="table table-light">
        <tr>
          <th  class="hide-in-phone">Image</th>
          <th>Name</th>
          <th>Details</th>
          <th>Actions</th>
        </tr>
        <tr v-for="(city, index) in cities.data" :key="index">
          <td  class="hide-in-phone">
            <File :city="city" />
          </td>
          <td>{{ city.name }}</td>
          <td>
            <div v-html="city.details"></div>
          </td>
          <td>
            <b-button variant="light" @click="edit(city)">
              <b-icon icon="pencil" variant="primary"></b-icon>
            </b-button>
            <b-button variant="light" @click="remove(city.id)">
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
    <pagination :limit="4" :data="cities" @pagination-change-page="get"></pagination>

  </div>
</template>

<script>
import File from "./UploadFile.vue";
import Add from "./Add";
import Edit from "./Edit";
import axios from "axios";

export default {
name: "Cities",
components: {
  Add,
  Edit,
  File,
},
data: () => ({
  keywords: null,
  cities: null,
  city: null,
  addTogal: false,
  editTogal: false,
  deleteTogal: false,
}),
watch:{
  keywords: function(oldValue, newValue){
    this.search()
  }
},
created() {
  this.get();
},
methods: {
    search() {
      axios.get("admin/cities/search", { params: { keywords: this.keywords } })
      .then((res) => {
        console.log("res ", res.data);
          this.cities = res.data;
      }).catch((err) => {
        console.log(err);
      });
    },
  get(page=1) {
    axios.get("admin/cities?page="+page).then((res) => {
      this.cities = res.data;
    })
  .catch((err) => {
    if (err.response.status == 401) {
    this.$router.push("/404");
  }
      console.log("Error: ", err.response.status);
    });
    },
    refresh() {
      this.$bvModal.hide("modal-add");
      this.$bvModal.hide("modal-update");
      this.get();
    },
    edit(data) {
      this.city = data;
      this.$bvModal.show("modal-update");
    },
    remove(id) {
    this.$bvModal.msgBoxConfirm("Are you sure you want to delete?").then((value) => {
      if (value) {
      this.confirm(id);
      }
    })
    .catch((err) => {
    console.log("err", err);
    });
  },

  confirm(id) {
    axios.delete("admin/cities/" + id)
    .then((res) => {
      this.get();
    })
    .catch((err) => {
    console.log("Error: ", err);
    });
  },
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

<template>
  <div class="">
    <b-modal id="modal-update" title="Update service" :hide-footer="true" hide-header-close>
      <Edit v-on:close-dialog="refresh" :service="service" />
    </b-modal>
    <b-modal id="modal-add" size="md" title="Add new service" :hide-footer="true" hide-header-close>
      <Add v-on:close-dialog="refresh" />
    </b-modal>

    <b-card v-if="services" header="Services" class="  shadow-none mt-5 mb-5">
      <div class="d-flex justify-content-end">
        <b-form-input class="w-50 search-box-in-phone" placeholder="Search..." type="search" v-model="keywords">
        </b-form-input>
      </div>

      <table class="table table-light">
        <tr>
          <th>Image</th>
          <th>Name</th>
          <th>Type</th>
          <th class="hide-in-phone">Details</th>
          <th>Actions</th>
        </tr>
        <tr v-for="(service, index) in services.data" :key="index">
          <td>
            <File :service="service" />
          </td>
          <td>{{ service.name }}</td>
          <td>{{ service.type }}</td>
          <td class="hide-in-phone"> 
            <div v-html="service.details?(service.details).substring(0,100):''"></div>
          </td>
         
          <td>
            <b-button variant="light" @click="edit(service)">
              <b-icon icon="pencil" variant="primary"></b-icon>
            </b-button>
            <b-button variant="light" @click="remove(service.id)">
              <b-icon variant="danger" icon="trash"></b-icon>
            </b-button>
            <b-button variant="light" @click="steps(service.id)">
              <b-icon variant="primary" icon="three-dots"></b-icon>
            </b-button>
          </td>
        </tr>
      </table>
      <b-button v-b-modal.modal-add variant="light" class="add-btn">
        <b-icon icon="plus"></b-icon>
      </b-button>
    </b-card>
    <div v-else class="text-center">
      <b-spinner variant="primary"></b-spinner>
    </div>
    <pagination v-if="services" :limit="4" :data="services" @pagination-change-page="get"></pagination>

  </div>
</template>

<script>
import File from "./UploadFile.vue";
import Add from "./Add";
import Edit from "./Edit";
import axios from "axios";

export default {
name: "Services",
components: {
  Add,
  Edit,
  File,
},
data: () => ({
  keywords: null,
  services: null,
  service: null,
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
      axios.get("admin/services/search", { params: { keywords: this.keywords } })
      .then((res) => {
          this.services = res.data;
      }).catch((err) => {
        console.log(err);
      });
    },
    get(page=1) {
      axios.get("admin/services?page="+page).then((res) => {
        this.services = res.data;
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
      this.service = data;
      this.$bvModal.show("modal-update");
    },
    steps(id){
      this.$router.push('/admin/service/'+id)
    },
    remove(id) {
    this.$bvModal.msgBoxConfirm("Are you sure you want to delete?",
    {
        okVariant: 'light',
        cancelVariant: 'light'
      }
    ).then((value) => {
      if (value) {
      this.confirm(id);
      }
    })
    .catch((err) => {
    console.log("err", err);
    });
  },

  confirm(id) {
    axios.delete("admin/services/" + id)
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

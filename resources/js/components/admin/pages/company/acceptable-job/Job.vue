<template>
    <div class="">
      <b-modal id="edit-job" title="Update  Data" :hide-footer="true" hide-header-close>
        <Edit :company="editData" v-on:close-dialog="refresh" />
      </b-modal>
      <b-card class="  shadow-none mb-2" header="How many business can accept a job">
        <table v-if="company" class="table table-light">
          <thead>
            <tr>
              <th class="hide-in-phone">Acceptable by</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(c, index) in company" :key="index">
              <td class="hide-in-phone">{{ c.acceptable_by }}</td>
              <td>
                <b-button variant="light" @click="edit(c)">
                  <b-icon icon="pencil" variant="primary"></b-icon>
                </b-button>
              </td>
            </tr>
          </tbody>
        </table>
      </b-card>
    </div>
  </template>
  
  <script>
  import Edit from "./Edit";
  import axios from "axios";
  export default {
    name: "user",
    data: () => ({
      company: null,
      editTogal: false,
      editData:null,
    }),
   
    methods: {
      get() {
        axios
          .get("admin/company")
          .then((res) => {
            this.company = res.data;
          })
          .catch((err) => {
            console.log("Error: ", err);
          });
      },
  
      refresh() {
        this.$bvModal.hide("edit-job");
        this.get();
      },
      edit(data) {
        this.editData = data;
        this.$bvModal.show("edit-job");
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
  
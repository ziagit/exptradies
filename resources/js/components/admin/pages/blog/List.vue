<template>
    <div class="">
      <b-modal id="modal-update" size="lg" title="Update Data" :hide-footer="true">
        <Edit v-on:close-dialog="refresh" :blog="lst" />
      </b-modal>
      <b-modal id="modal-add" size="lg" title="Add new " :hide-footer="true">
        <Add v-on:close-dialog="refresh" />
      </b-modal>
      <b-modal id="modal-comment" size="lg" title="Comments" :hide-footer="true">
        <Comments :comments="comments" v-on:close-dialog="refresh"></Comments>
      </b-modal>
      <div>
        <b-card v-if="list" class="  shadow-none mt-5 mb-5" header="Blog Page">
          <div class="d-flex justify-content-end">
        <b-form-input class="w-50 search-box-in-phone mb-2" placeholder="Search..." type="search" v-model="keywords">
        </b-form-input>
      </div>
          <table class="table">
            <tr>
              <th class="hide-in-phone">ID</th>
              <th>Image</th>
              <th>Title</th>
              <th>Body</th>
              <th>Actions</th>
            </tr>
            <tr v-for="lst in list.data" :key="lst.id">
              <td class="hide-in-phone">{{  lst.id  }}</td>
              <td>
                <File :blog="lst" />
              </td>
              <td>{{  lst.title  }}</td>
              <td>
                <div v-html="(lst.body).substring(0,100)"></div>...
              </td>
              <td>
                <b-button variant="light" @click="edit(lst)">
                  <b-icon icon="pencil" variant="primary"></b-icon>
                </b-button>
                <b-button variant="light" @click="remove(lst.id)">
                  <b-icon variant="danger" icon="trash"></b-icon>
                </b-button>
                <b-button v-if="lst.comments.length>0" variant="light" @click="displayComments(lst)">
                  <b-icon variant="primary" icon="chat-square-text"></b-icon>
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
        <pagination :limit="4" :data="list" @pagination-change-page="get"></pagination>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  import Add from "./Add";
import Comments from "./Comments.vue";
  import Edit from "./Edit";
  import File from "./UploadFile.vue"
  export default {
    name: "blog",
    data: () => ({
      list: null,
      lst: null,
      togal: false,
      keywords:null,
      comments:null,
    }),
    watch:{
      keywords: function(oldValue, newValue){
        this.search()
      }
    },
    methods: {
      search() {
          axios.get("admin/blog/search", { params: { keywords: this.keywords } })
          .then((res) => {
              this.list = res.data;
          }).catch((err) => {
            console.log(err);
          });
      },
      get(page=1) {
        axios
          .get("admin/blog?page="+page)
          .then((res) => {
            this.list = res.data;
          })
          .catch((err) => {
            console.log("Error: ", err);
          });
      },
      refresh() {
        this.$bvModal.hide("modal-add");
        this.$bvModal.hide("modal-update");
        this.$bvModal.hide("modal-comment");
        this.get();
      },
      edit(data) {
        this.lst = data;
        this.$bvModal.show("modal-update");
      },
      displayComments(blog){
        this.comments = blog.comments;
        this.$bvModal.show("modal-comment");
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
          .delete("admin/blog/" + id)
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
    File,
    Comments
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
  
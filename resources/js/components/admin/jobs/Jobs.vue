<template>
  <div class="">
    <b-modal id="modal-update" title="Update  Data" :hide-footer="true">
      <Edit :post="post" v-on:close-dialog="refresh" />
    </b-modal>
    <!-- add dialog -->
    <b-card class="  shadow-none mt-5 mb-5" header="Jobs">
      <div class="d-flex justify-content-end my-3">
        <b-form-input class="w-50 search-box-in-phone" placeholder="Search..." type="search" v-model="keywords">
        </b-form-input>
      </div>
      <table v-if="posts" class="table table-light">
        <thead>
          <tr>
            <th class="hide-in-phone">ID</th>
            <th>Type</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(post, index) in posts.data" :key="index">
            <td class="hide-in-phone">{{ index + 1 }}</td>
            <td>{{ post.service.name }}</td>
            <td>{{ post.status }}</td>
            <td >
              <b-button variant="light" @click="details(post.id)">
                <b-icon icon="three-dots" variant="primary"></b-icon>
              </b-button>
              <b-button variant="light" @click="remove(post.id)">
                <b-icon icon="trash" variant="danger"></b-icon>
              </b-button>
            </td>
          </tr>
        </tbody>
      </table>
    </b-card>
    <pagination v-if="posts" :limit="4" :data="posts" @pagination-change-page="get"></pagination>
  </div>
</template>

<script>
import Add from "./Add";
import Edit from "./Edit";
import axios from "axios";
export default {
  name: "post",
  data: () => ({
    keywords: null,
    posts: null,
    post: null,
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
        .get("admin/posts/search", {
          params: {
            keywords: this.keywords,
          },
        })
        .then((res) => {
          this.posts = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    get(page=1) {
      axios
        .get("admin/posts?page="+page)
        .then((res) => {
          console.log("car", res.data);
          this.posts = res.data;
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },

    details(id){
      this.$router.push("/admin/posts/"+id);
    },
    refresh() {
      this.$bvModal.hide("modal-update");
      this.$bvModal.hide("modal-add");
      this.get();
    },
    edit(data) {
      this.post = data;
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
      axios
        .delete("admin/posts/" + id)
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

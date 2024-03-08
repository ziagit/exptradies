<template>
  <div class="">
    <b-modal id="modal-update" title="Update  user" :hide-footer="true" hide-header-close>
      <Edit :user="selectedUser" v-on:close-dialog="refresh" />
    </b-modal>
    <!-- add dialog -->
    <b-modal id="modal-add" size="md" title="Add new user" :hide-footer="true" hide-header-close>
      <Add v-on:close-dialog="refresh" />
    </b-modal>
    <b-card class="  shadow-none mt-5 mb-5" header="Users">
      <div class="d-flex justify-content-end my-3">
        <b-form-input class="w-50 search-box-in-phone" placeholder="Search..." type="search" v-model="keywords">
        </b-form-input>
      </div>
      <table v-if="users" class="table table-light">
        <thead>
          <tr>
            <th>Name</th>
            <th>Role</th>

            <th class="hide-in-phone">Email</th>
            <th class="hide-in-phone">Phone</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(usr, index) in users.data" :key="index">
            <td>{{ usr.name }}</td>
            <td >{{ usr.roles[0].name }}</td>

            <td class="hide-in-phone">{{ usr.email }}</td>
            <td class="hide-in-phone">{{ usr.phone }}</td>

            <td>
              <b-button variant="light" @click="edit(usr)">
                <b-icon icon="pencil" variant="primary"></b-icon>
              </b-button>
              <b-button v-if="usr.id!=1 && usr.roles[0].name!='Admin'" variant="light" @click="remove(usr.id)">
                <b-icon icon="trash" variant="danger"></b-icon>
              </b-button>
            </td>
          </tr>
        </tbody>
      </table>
      <b-button variant="light" v-b-modal.modal-add class="add-btn">
        <b-icon icon="plus"></b-icon>
      </b-button>
    </b-card>
    <pagination v-if="users" :limit="4" :data="users" @pagination-change-page="get"></pagination>
  </div>
</template>

<script>
import Add from "./Add";
import Edit from "./Edit";
import axios from "axios";
import { mapGetters } from "vuex";

export default {
  name: "user",
  data: () => ({
    keywords: null,
    users: null,
    selectedUser: null,
    addTogal: false,
    editTogal: false,
    deleteTogal: false,
  }),
  watch: {
    keywords(after, before) {
      this.search();
    },
  },
  computed: {
        ...mapGetters({
            user: "auth/user",
        })
  },
  methods: {
    search() {
      axios
        .get("admin/users/search", {
          params: {
            keywords: this.keywords,
          },
        })
        .then((res) => {
          this.earnings = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    get(page=1) {
      axios
        .get("admin/users?page="+page)

        .then((res) => {
          this.users = res.data;
        })
        .catch((err) => {
          console.log("Error: ", err);
        });
    },

    refresh() {
      this.$bvModal.hide("modal-update");
      this.$bvModal.hide("modal-add");
      this.get();
    },
    edit(data) {
      this.selectedUser = data;
      this.$bvModal.show("modal-update");
    },
    remove(id) {
      console.log("user id",id)
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
      axios
        .delete("admin/users/" + id)
        .then((res) => {
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

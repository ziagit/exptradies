<template>
  <div class="">
    <b-card class="  shadow-none mt-5 mb-5" header="Employees">
      <div class="d-flex justify-content-end my-3">
        <b-form-input class="w-50 search-box-in-phone" placeholder="Search..." type="search" v-model="keywords">
        </b-form-input>
      </div>
      <table v-if="employees" class="table table-light">
        <thead>
          <tr>
            <th >ID</th>
            <th>Business</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(employee, index) in employees.data" :key="index">
            <td >{{ index + 1 }}</td>
            <td >{{ employee.business_name }}</td>
            <td >{{ employee.user.phone }}</td>
            <td >{{ employee.user.email }}</td>
            <td >
              <b-button variant="light" @click="edit(employee)">
                <b-icon icon="three-dots" variant="primary"></b-icon>
              </b-button>
              <b-button variant="light" @click="remove(employee.id)">
                <b-icon icon="trash" variant="danger"></b-icon>
              </b-button>
            </td>
          </tr>
        </tbody>
      </table>
    </b-card>
    <pagination v-if="employees" :limit="4" :data="employees" @pagination-change-page="get"></pagination>
  </div>
</template>

<script>
import Edit from "./Edit";
import axios from "axios";
export default {
  name: "Employee",
  data: () => ({
    keywords: null,
    employees: null,
    employee: null,
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
        .get("admin/employees/search", {
          params: {
            keywords: this.keywords,
          },
        })
        .then((res) => {
          this.employees = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    get(page=1) {
      axios
        .get("admin/employees?page="+page)
        .then((res) => {
          console.log("empooyes", res.data);
          this.employees = res.data;
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
      this.$router.push('/admin/employee/'+data.id)
    },
    remove(id) {
      this.deleteTogal = true;
      this.selectedId = id;
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

    confirm() {
      axios
        .delete("admin/employees/" + this.selectedId)
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

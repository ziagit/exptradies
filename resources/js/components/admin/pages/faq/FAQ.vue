<template>
  <div class="">
    <b-modal id="modal-update" title="Update FAQ" :hide-footer="true" size="lg">
      <Edit v-on:close-dialog="refresh" :faq="faq" />
    </b-modal>
    <!-- add dialog -->
    <b-modal id="modal-add" size="lg" title="Add new FAQ" :hide-footer="true">
      <Add v-on:close-dialog="refresh" />
    </b-modal>
    <b-card v-if="faqs" header="Frequently asked questions" class="  shadow-none mt-5 mb-5">
      <div class="d-flex justify-content-end">
        <b-form-input class="w-50 search-box-in-phone" placeholder="Search..." type="search" v-model="keywords">
        </b-form-input>
      </div>
      <table class="table">
        <tr>
          <th class="hide-in-phone">ID</th>
          <th>Titel</th>
          <th>Body</th>
          <th>Actions</th>
        </tr>
        <tr v-for="(faq,index) in faqs.data" :key="index">
          <td class="hide-in-phone">{{index+1 }}</td>
          <td>{{ faq.title }}</td>
          <td>
            <div v-html="faq.body"></div>
          </td>
          <td>
            <b-button variant="light" @click="edit(faq)">
              <b-icon icon="pencil" variant="primary"></b-icon>
            </b-button>
            <b-button variant="light" @click="remove(faq.id)">
              <b-icon variant="danger" icon="trash"></b-icon>
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
    <pagination :limit="4" :data="faqs" @pagination-change-page="get"></pagination>

  </div>
</template>

<script>
import Add from "./Add";
import Edit from "./Edit";
import axios from "axios";

export default {
  name: "faq",
  data: () => ({
    keywords: null,
    faqs: null,
    faq: null,
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
      axios.get("admin/faq/search", { params: { keywords: this.keywords } })
      .then((res) => {
          this.faqs = res.data;
      }).catch((err) => {
        console.log(err);
      });
  },
    get(page=1) {
      axios
        .get("admin/faq?page="+page)
        .then((res) => {
          this.faqs = res.data;
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
      this.faq = data;
      this.$bvModal.show("modal-update");
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
        .delete("admin/faq/" + id)
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

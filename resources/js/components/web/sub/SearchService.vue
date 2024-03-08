<template>
  <div class="search-service p-3">
    <!-- current location popover -->
    <b-popover target="popover-target-info" triggers="hover" placement="top">
      <template #title>More info</template>
      <div>
        - Please select a service <br />
        of our
        <a href="/services" target="_blank">coverage</a>.
        <div class="break"></div>
      </div>
    </b-popover>

    <!-- Invalid address -->
    <b-modal id="modal-address" title="Not Found" ok-only>
      <p v-html="popupData"></p>
    </b-modal>
    <form @submit.prevent="keyPressed()" method="post" id="theform">

      <div class="search-container">
        <b-form-group>
          <b-form-input size="lg" type="search" ref="searchInput" placeholder="What are you looking for?" v-model="keywords"></b-form-input>
        </b-form-group>

        <ul v-if="searchTogal">
            <li v-for="(list,index) in services" :key="index" @click="select(list,index)" :class="{ focused: 0 === index }">
                {{  list.name  }}
            </li>
        </ul>
        <ul v-if="notFoundTogal">
            <li>Not found</li>
        </ul>
      </div>

      <div class="mt-4 text-right">
        <b-button variant="outline-secondary"  @click="getQuote()">Get quote</b-button>
      </div>
    </form>
    <Toaster ref="toaster" />
  </div>
</template>
<script>
import Toaster from "../sub/Toaster.vue";
import localData from "../../shared/services/localData";
export default {
  props:['myprop'],
  components: {
    Toaster,
  },
  data: () => ({
    keywords: null,
    services: [],
    popupData: null,
    searchTogal:false,
    notFoundTogal:false,
    isSelected: false,
    focusedItemIndex: -1
  }),

  watch: {
    keywords(after, before) {
      this.search();
    },
   
  },
  created() {
    this.init();
  },

  methods: {
    keyPressed(){
      if(this.services.length===0) return;
        this.select(this.services[0],this.focusedItemIndex);
      return;
    },
    search() {
      axios
        .get("search-service", { params: { keywords: this.keywords } })
        .then((res) => {
          if (res.data.data.length <= 0) {
              this.searchTogal = false;
              this.notFoundTogal = true;
          } else {
              this.services = res.data.data;
              this.notFoundTogal = false;
              this.searchTogal = true;
          }
        })
        .catch((err) => {
          this.isSelected = false;
          console.log(err);
        });
    },
    keyPressed(){
      if(this.services.length===0) return;
            this.select(this.services[0],this.focusedItemIndex);
          return;
    },
    select(service,index) {
      localData.save("service", service);
      this.focusedItemIndex = index;
      this.keywords = service.name;
      this.services = [];
      this.isSelected = true;
      this.searchTogal = false;
    },
    init() {
      var service = localData.read("service");
      if (service) {
        this.keywords = service.name;
        this.isSelected = true;
      }
    },
    getQuote() {
      let data = localData.read("service");
      if (!data) {
        this.$refs.toaster.show(
          "warning",
          "b-toaster-top-center",
          "Please",
          "Please select a service to continue!"
        );
        return;
      }
      this.$router.push("/post");
    },
    refocus(){
      this.$refs.searchInput.$el.focus();
    }
  },
};
</script>

<style lang="scss" scoped>
.list-group-item {
  border: none !important;
}

.search-service {
  width: 100%;

  form {
    position: relative;
    .search-container {
      .search-result {
        position: absolute;
        width: 100%;
        top: 56px;
        z-index: 9;
      }
    }
  }
}
ul {
    border-bottom-right-radius: 5px;
    border-bottom-left-radius: 5px;
    background: #fff;
    position: absolute;
    width: 100%;
    top: 57px;
    margin: 0;
    padding: 10px 0;
    text-align: left;
    z-index: 100;
    box-shadow: 0 3px 1px -2px rgb(0 0 0 / 20%), 0 2px 2px 0 rgb(0 0 0 / 14%),
        0 1px 5px 0 rgb(0 0 0 / 12%);

    li {
        list-style-type: none;
        padding: 2px 12px;
        cursor: pointer;
    }

    li:hover {
        background: #ddd;
    }
}
.focused {
  background-color: #ddd;
}
</style>

<template>
  <div class="search-service">
    <!-- current location popover -->
    <b-popover target="popover-target-info" triggers="hover" placement="top">
      <template #title>More info</template>
      <div>
        - Please select a service <br />
        of our
        <a href="/services" target="_blank">Coverage</a>.
        <div class="break"></div>
      </div>
    </b-popover>

    <!-- Invalid address -->
    <b-modal id="modal-address" title="Not Found" ok-only>
      <p v-html="popupData"></p>
    </b-modal>
    <form @submit.prevent="keyPressed()">

      <div class="search-container">
        <b-form-group description="">
          <b-input-group>
            <b-form-input type="search" ref="searchInput" placeholder="What work need to be done?" v-model="keywords"></b-form-input>
            <b-input-group-append>
              <b-button variant="primary" size="lg"   @click="getQuote()" class="in-phone-no-padding">
                <b-icon icon="search" class="in-phone-d"></b-icon>
                <span class="in-phone-d-none">Get Free Quote</span>
              </b-button>
            </b-input-group-append>
          </b-input-group>
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
     
    </form>
    <Toaster ref="toaster" />
  </div>
</template>
<script>
import Toaster from "./Toaster";
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
    search() {
      if (!this.isSelected) {
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
        }
        this.isSelected = false;
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
          "Please select a service to continu!"
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

    input {
      font-size: 18px;
      border: none;
      height: 56px;
      background: #fff;
      padding-left: 16px;
    }

    input:focus {
      background: #fff;
    }
    .btn-lg {
      padding-top: 0.8rem !important;
      padding-bottom: 0.8rem !important;
      padding-left: 2.5rem !important;
      padding-right: 2.5rem !important;
    }
    .in-phone-d{
      display: none;
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

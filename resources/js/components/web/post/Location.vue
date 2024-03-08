<template>
  <div class="w-100">
    <!-- Invalid address -->
    <b-modal id="modal-address" title="Invalid Address" ok-only @ok="handleOk">
      <p v-html="popupData"></p>
    </b-modal>
    <h2>Where is the job?</h2>
    <b-form @submit.prevent="next">
      <b-card class="shadow-none  ">
        <b-form-input class="w-100" v-model="list.formatted_address" required id="autocomplete" placeholder="Search..."
          ref="focusable" />
      </b-card>
      <br />
      <div class="actions align-items-center">
        <b-button @click="$router.back()" variant="light">
          <b-icon icon="arrow-left"></b-icon>
        </b-button>
        <div class="tab"></div>
        <b-button type="submit" variant="primary">
          <b-icon icon="arrow-right"></b-icon>
        </b-button>
      </div>
    </b-form>
    <Toaster ref="toaster" />
  </div>
</template>
<script>
import localData from "../../shared/services/localData";
import Toaster from "../sub/Toaster.vue";
export default {
  props: ["initialData", "label"],
  components: {
    Toaster,
  },
  data: () => ({
    popupData: null,
    list: {
      country: null,
      state: null,
      city: null,
      zip: null,
      street: null,
      street_number: null,
      formatted_address: null,
    },
  }),
  created() {
    this.$emit("progress", 1);
    this.init();
  },
  mounted() {
    this.$refs.focusable.focus();
    let $vm = this;
    var autocomplete = new google.maps.places.Autocomplete(
      document.getElementById("autocomplete"),
      {
        //types: ["address"],
        componentRestrictions: { country: "au" },
        fields: ["address_components", "formatted_address"],

        /*  bounds: new google.maps.LatLngBounds(
          new google.maps.LatLng(49.246292, -123.116226)
        ), */
        //strictbounds: true,
      }
    );

    google.maps.event.addListener(autocomplete, "place_changed", function () {
      var data = autocomplete.getPlace();
      $vm.validAddress(data);
    });
  },
  methods: {
    validAddress(data) {
      this.list.country=null;
      this.list.state=null;
      this.list.city=null;
      this.list.zip=null;
      this.list.street=null;
      this.list.street_number=null;

      let components = data.address_components;
      let $vm = this;
      $vm.list.formatted_address = data.formatted_address;
      $vm.supportedArea = "";
      components.forEach(function (component) {
        let types = component.types;
        if (types.indexOf("street_number") > -1) {
          $vm.list.street_number = component.long_name;
        }
        if (types.indexOf("route") > -1) {
          $vm.list.street = component.long_name;
        }
        if (types.indexOf("locality") > -1) {
          $vm.list.city = component.long_name;
        }
        if (types.indexOf("administrative_area_level_1") > -1) {
          $vm.list.state = component.short_name;
        }
        if (types.indexOf("postal_code") > -1) {
          $vm.list.zip = component.long_name;

        }
        if (types.indexOf("country") > -1) {
          $vm.list.country = component.long_name;
        }
      });
      localData.save("address", $vm.list);
    },

    handleOk() {
      this.list.formatted_address = this.initialData;
    },
    next() {
      if (this.list.formatted_address == null ||
      this.list.country ==null ||
      this.list.state==null||
      this.list.city==null ||
      this.list.zip==null
    ) {
        this.$refs.toaster.show(
          "danger",
          "b-toaster-top-center",
          "Faild",
          "Please select a valid address."
        );
        return;
      }
      localData.save("prev-route","location");
      this.$router.push("step");
      //this.$router.push("test");

    },
   
    init() {
      var address = localData.read("address");
      if (address) {
        this.list.country = address.country;
        this.list.state = address.state;
        this.list.city = address.city;
        this.list.zip = address.zip;
        this.list.street = address.street;
        this.list.street_number = address.street_number;
        this.list.formatted_address = address.formatted_address;
      }
    },
  },
};
</script>

<style lang="scss" scoped>
@import "../../../../sass/variables";
@import "../../../../sass/common.scss";


.container {
  width: 100%;

  input {
    width: 300px;
    border: none;
    font-size: unset !important;
    color: unset !important;
  }

  input:focus {
    outline: none;
  }

  h1 {
    color: #70b673;
  }
}
</style>

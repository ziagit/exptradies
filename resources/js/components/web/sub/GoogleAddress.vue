<template>
    <b-form-input
      v-model="list.formatted_address"
      required
      id="autocomplete"
      :placeholder="label"
      ref="focusable"
    />
</template>
<script>
export default {
  props: ["initialData", "label"],
  data: () => ({
    popupData: null,
    list: {
      country: "",
      state: "",
      city: "",
      zip: "",
      street: "",
      street_number: "",
      formatted_address: "",
    },
  }),
  watch:{
    initialData: function(newData){
      this.list.formatted_address = newData
    }
  },
  created() {
    this.init();
  },
  mounted() {
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
      this.$emit("google-valid-address", $vm.list);
    },

    handleOk() {
      this.list.formatted_address = this.initialData;
    },

    init() {
      if (this.initialData) {
        this.list.country = this.initialData.country;
        this.list.state = this.initialData.state;
        this.list.city = this.initialData.city;
        this.list.zip = this.initialData.zip;
        this.list.street = this.initialData.street;
        this.list.street_number = this.initialData.street_number;
        this.list.formatted_address = this.initialData.formatted_address;
      }
    },
  },
};
</script>

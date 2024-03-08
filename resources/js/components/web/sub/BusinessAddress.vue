<template>
    <b-form-input
      v-model="list.formatted_address"
      id="add_autocomplete"
      :placeholder="label"
    />
</template>
<script>
export default {
  props: ["label","initAddress"],
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
 
  mounted() {
    let $vm = this;
    var autocomplete = new google.maps.places.Autocomplete(
      document.getElementById("add_autocomplete"),
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
      this.list.formatted_address="";

    },
   
  },
};
</script>

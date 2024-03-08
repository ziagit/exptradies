<template>
  <div>
    <b-form @submit.prevent="submit">
      <b-form-group>
        <b-form-input v-model="form.first_name" placeholder="First name"/>
      </b-form-group>
      <b-form-group>
        <b-form-input v-model="form.last_name" placeholder="Last name"/>
      </b-form-group>
      <b-form-group>
        <b-form-input v-model="form.licence" placeholder="Licence number"/>
      </b-form-group>
      <div class="mt-3 text-right">
        <b-button variant="primary" type="submit">Update</b-button>
      </div>
    </b-form>
  </div>
</template>
<script>

import axios from "axios";
export default {
  data() {
    return {
      form:{
        first_name:null,
        last_name:null,
        licence:null,
      }
    };
  },
  created() {
  },
  methods:{
    submit(){
      axios.post("admin/employees",this.form).then(res=>{
        this.$emit('close-dialog');
      })
    }
  }
};
</script>

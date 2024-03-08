<template>
  <div>
    <b-form @submit.prevent="update">
      <b-form-group>
        <b-form-input id="input-1" v-model="form.name" placeholder="Name" required></b-form-input>
      </b-form-group>
      <b-form-group>
        <b-form-select 
        v-model="form.type" 
        :options="options" >
      </b-form-select>
      </b-form-group>

      <b-form-group>
        <b-form-textarea id="textarea" v-model="form.details" placeholder="Details" rows="3" max-rows="6">
        </b-form-textarea>
      </b-form-group>

      <div class="text-right">
        <b-button @click="$emit('close-dialog')" variant="light">Cancel</b-button>
        <b-button type="submit" variant="light">Submit</b-button>
      </div>

    </b-form>
  </div>
</template>
<script>
import axios from "axios";
export default {
  props: ["service"],
  data() {  return {  
      form: {
        name: this.service.name,
        type:this.service.type,
        details: this.service.details,
      }, 
      options:[],
    }
  }, 
  created() { 
    this.get()
  },
  methods: {
    get(){
    axios.get("admin/service-type")
      .then((res) => {
        res.data.forEach(element => {
          this.options.push({value:element.name,text:element.name})
        });
        }).catch((err) => console.log(err));
    },
    update() {
      axios
        .put("admin/services/" + this.service.id, this.form)
        .then((res) => {
          this.$emit('close-dialog')
        })
        .catch((err) => console.log(err));
    },
  },
};
</script>

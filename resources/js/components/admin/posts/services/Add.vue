<template>
  <div>
    <b-form @submit.prevent="submit">
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
      <div class="text-right mt-3">
        <b-button @click="$emit('close-dialog')" variant="light">Cancel</b-button>
        <b-button type="submit" variant="light">Submit</b-button>
      </div>
    </b-form>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
        form: {
          name: null,
          type:null,
          details: null,
        },
        options: [
          { value: null, text: 'Please select type' }
        ]
    };
  },
  created() { 
    this.get()
  },
methods: {
  submit() {
    axios.post("admin/services", this.form)
    .then((res) => {
      this.$emit('close-dialog')
    }).catch((err) => console.log(err));
  },
  get(){
    axios.get("admin/service-type")
      .then((res) => {
        res.data.forEach(element => {
          this.options.push({value:element.name,text:element.name})
        });

        }).catch((err) => console.log(err));
      }
},
  created() { 
    this.get()
  },
};
</script>

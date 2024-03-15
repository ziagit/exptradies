<template>
  <div>
    <b-form @submit.prevent="update">
      <b-form-group v-if="checkBoxStatus==='checked'">
        <b-form-select v-model="form.custom" :options="options"></b-form-select>
      </b-form-group>
      <b-form-group>
        <b-form-input id="input-1" v-model="form.title" placeholder="Title" required></b-form-input>
      </b-form-group>
      <b-form-group>
        <b-form-textarea id="textarea" v-model="form.details" placeholder="Details" rows="3" max-rows="6">
        </b-form-textarea>
      </b-form-group>
      <b-form-checkbox
        id="checkbox-1"
        v-model="checkBoxStatus"
        name="checkbox-1"
        value="checked"
        unchecked-value="unchecked"
      >
      Add custom feild
      </b-form-checkbox>
      <div class="text-right mt-3">
        <b-button @click="$emit('close-dialog')" variant="light">Cancel</b-button>
        <b-button type="submit" variant="light">Update</b-button>
      </div>
    </b-form>
  </div>
</template>
<script>
import axios from "axios";
export default {
  props: ['option'],
  data() {
    return {
      checkBoxStatus:this.option.custom?'checked': 'unchecked',
      selected: null,
      form: {
        custom:null,
        title: this.option.title,
        details: this.option.details,
        option_id: null,
      },
      options: [
          { value: null, text: 'Please select an option' },
          { value: 'date', text: 'Date feild' },
          { value: 'input', text: 'Input feild' },
        ],
    };
  },
  watch: {
    checkBoxStatus(value) {
      if(value==='unchecked'){
        this.form.custom=null;
      }       
    },
  },
  created(){
    this.form.option_id = this.$route.params.id;
  },
  methods: {
    update() {
      axios
        .put("admin/suboptions/" + this.option.id, this.form)
        .then((res) => {
          this.$emit('close-dialog')
        })
        .catch((err) => console.log(err));
    },
  },

};
</script>

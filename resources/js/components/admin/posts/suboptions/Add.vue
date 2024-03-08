<template>
  <div>
    <b-form @submit.prevent="submit">
      <b-form-group v-if="checkBoxStatus==='checked'">
        <b-form-select v-model="form.custom" :options="options"></b-form-select>
      </b-form-group>

      <b-form-group v-else>
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
      steps: null,
      checkBoxStatus:'unchecked',
      options: [
          { value: null, text: 'Please select an option' },
          { value: 'date', text: 'Date feild' },
          { value: 'input', text: 'Input feild' },
        ],
      form: {
        custom:null,
        title: null,
        details: null,
        option_id: null,
      },
    };
  },
  watch: {
    checkBoxStatus(value) {
      if(value==='unchecked'){
        this.form.custom=null;
      }       
    },
  },
  methods: {
    submit() {
      axios
        .post("admin/suboptions", this.form)
        .then((res) => {
          console.log("Saved");
          this.$emit('close-dialog')

        })
        .catch((err) => console.log(err));
    },
  },
  created() {
    this.form.option_id = this.$route.params.id;
  },
};
</script>

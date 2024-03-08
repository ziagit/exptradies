<template>
    <div>
      <ul>
        <li v-for="option in options" :key="option.id" @click="selectOption(option)">
          {{ option.title }} <br>
          <TestSuboption :suboptions="option.suboptions" :optionId="option.id"></TestSuboption>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
import TestSuboption from './TestSuboption.vue';

  export default {
    props: ['options','stepId'],
    data() {
        return {
        };
    },
    methods: {
        selectOption(option) {
            if (option.suboptions) {
                this.$router.push({ name: 'suboptions', params: { suboptions: option.suboptions } });
            }
            else {
                this.$emit('next-step', this.stepNumber, option);
            }
        },
        goBack() {
            this.$emit('prev-step', this.stepNumber);
        }
    },
    created() {
        //console.log("service: ",this.service.steps)
    },
    components: { TestSuboption }
};
  </script>
<style scoped>
li{
    background: green;
}
</style>
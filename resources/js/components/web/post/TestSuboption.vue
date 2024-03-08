<template>
    <div>
      <ul>
        <li v-for="option in suboptions" :key="option.id" @click="selectOption(option)">
          {{ option.title }} <br>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    props: ['suboptions','optionId'],
    data() {
      return {
      };
    },
   
    methods: {
      selectOption(option) {
        if (option.suboptions) {
          this.$router.push({ name: 'suboptions', params: { suboptions: option.suboptions } });
        } else {
          this.$emit('next-step', this.stepNumber, option);
        }
      },
      goBack() {
        this.$emit('prev-step', this.stepNumber);
      }
    },
    created(){
        //console.log("service: ",this.service.steps)
    },
  };
  </script>
  <style scoped>
  li{
      background: yellow;
  }
  </style>
  
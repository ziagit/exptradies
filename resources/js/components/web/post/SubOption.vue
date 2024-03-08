<template>
    <div>
      <b-form-radio-group
        v-model="selected"
        :options="suboptions"
        value-field="id"
        text-field="title"
        disabled-field="notEnabled"
      ></b-form-radio-group>
    </div>
  </template>
  
  <script>
  export default {
    props: ['suboptions'],
    data:()=>({
      selected:null,
    }),
    watch: {
      index(newValue, oldValue) {
        this.init()
      },
      selected(value) {
        this.$emit("onSelected", {option:this.suboptions[0].option_id,value:value});
      },
    },
    created(){
      this.init()
    },
    methods: {
      init() {
          // for (var i = 0; i < this.initData.length; i++) {
          //     for (var j = 0; j < this.optionData.length; j++) {
          //         if (this.optionData[j].id == this.initData[i].value) {
          //             this.selected = this.initData[i].value;
          //         }
          //     }
          // }
      },
    }
  };
  </script>
  
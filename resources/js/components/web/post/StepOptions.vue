<template>
  <div class="text-left">
    <!-- <b-form-radio-group
      v-model="selected"
      :options="optionData"
      value-field="id"
      text-field="title"
      disabled-field="notEnabled"
    ></b-form-radio-group> -->

    <b-form-group>
      <b-form-radio v-model="selected" :value="option" v-for="(option,i) in optionData" :key="i">{{option.title}}</b-form-radio>
    </b-form-group>

    <b-form-datepicker  v-model="customValue" v-if="customField=='date'"></b-form-datepicker>
    <b-form-input   v-model="customValue" v-if="customField=='input'"></b-form-input>

    <b-modal id="suboption-modal" hide-footer :title="suboptionTitle" centered>
      <SubOption :suboptions="suboptions"  v-on:onSelected="onSubSelected"></SubOption>
    </b-modal> 
  </div>
</template>
<script>
import SubOption from './SubOption.vue';
import localData from "../../shared/services/localData";

export default {
    props: ["optionData", "initData", "index"],
    data: () => ({
        selected: null,
        suboptions:null,
        suboptionTitle:null,
        suboptionArray:[],
        customField:null,
        customValue:null,
    }),
    watch: {
        index(newValue, oldValue) {
            this.init();
        },
        selected(value) {
          console.log("selected: ",value)
            // const foundObject = this.optionData.find(obj => {
            //     return obj.id == value;
            // });

            // if (foundObject.suboptions.length > 0) {
            //   this.suboptionTitle = foundObject.title;
            //   this.suboptions = foundObject.suboptions;
            //   this.$bvModal.show('suboption-modal')
            //     //this.$router.push({ name: 'suboptions', params: { suboptions: foundObject.suboptions } });
            // }
            
            this.customField = value.custom;
            this.$emit("select-option", { step: this.index, value: value});
        },
        customValue(value){
          this.$emit("select-custom", this.index,value);
        }
    },

    created() {
        this.init();
    },

    methods: {
      onSubSelected(value){
        this.suboptionArray.push(value);
        if (this.suboptionArray.length == 0) {
         this.suboptionArray.push(value);
       } else {
         var index = -1;
         for (var i = 0; i < this.suboptionArray.length; i++) {
           if (
             this.suboptionArray[i].step == value.step ||
             this.suboptionArray[i].value == value.value
           ) {
             index = i;
           }
         }
         if (index == -1) {
           this.suboptionArray.push(value);
         } else {
           this.suboptionArray.splice(index, 1);
           this.suboptionArray.push(value);
         }
       }
       localData.save("suboptionArray",this.suboptionArray)
       this.$bvModal.hide('suboption-modal')
      },

      init() {
        console.log("optionData: ",this.optionData)
        console.log("initData: ",this.initData)
        //  for (var i = 0; i < this.initData.length; i++) {
        //    console.log("data: ",this.initData[i]);
        //  }
        for (var i = 0; i < this.initData.length; i++) {
            
          for (var j = 0; j < this.optionData.length; j++) {
                
               if (this.optionData[j].id == this.initData[i].value.id) {
                    this.selected = this.initData[i].value;
                    console.log("found: ", this.selected)
                }
            }
         }
      },
    },
    components: { SubOption }
};
</script>
<style>
@import "../../../../sass/common.scss";

.bv-no-focus-ring {
  display: flex;
  flex-direction: column;
}
.custom-radio {
  margin-bottom: 16px !important;
}
.modal-header .close {
  display:none !important;
}
</style>

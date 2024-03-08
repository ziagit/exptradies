<template>
  <div>
    <b-form-radio-group
      v-model="selected"
      :options="optionData"
      value-field="id"
      text-field="title"
      disabled-field="notEnabled"
    ></b-form-radio-group>
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
    }),
    watch: {
        index(newValue, oldValue) {
            this.init();
        },
        selected(value) {
            const foundObject = this.optionData.find(obj => {
                return obj.id == value;
            });
            if (foundObject.suboptions.length > 0) {
              this.suboptionTitle = foundObject.title;
              this.suboptions = foundObject.suboptions;
              this.$bvModal.show('suboption-modal')
                //this.$router.push({ name: 'suboptions', params: { suboptions: foundObject.suboptions } });
            }
            this.$emit("select-option", { step: this.index, value: value });
        },
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
          for (var i = 0; i < this.initData.length; i++) {
              for (var j = 0; j < this.optionData.length; j++) {
                  if (this.optionData[j].id == this.initData[i].value) {
                      this.selected = this.initData[i].value;
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

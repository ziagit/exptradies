<template>
  <div class="text-left">
    <b-form-group>
      <b-form-radio  
      @change="onOptionChanged(option)" 
      v-model="selected" 
      :value="option.id" 
      v-for="(option,i) in options" 
      :key="i">{{option.title}}</b-form-radio>
    </b-form-group>

    <b-form-datepicker v-model="customField" v-if="customDateVisibility(index)"></b-form-datepicker>
    <b-form-input v-model="customField" v-if="customInputVisibility(index)"></b-form-input> 

  </div>
</template>
<script>

export default {
    props: ["options", "selectedOptions", "index"],
    data: () => ({
        selected: null,
        suboptions:null,
        customField:null,
    }),
    watch: {
        index(newValue, oldValue) {
          this.init();
        },
        customField(value){
          this.$emit("select-custom", this.index,value);
        },
    },

    created() {
        this.init();
    },

    methods: {
      init() {
        this.options.forEach(option =>{
          const found = this.selectedOptions.find(s => s.id === option.id);
          if(found){
            this.selected = found.id;
            this.$parent.isSelected=true;
            this.customField = found.custom;
          }
        });
      },

      onOptionChanged(value){
        this.customField = value.custom;
        this.$emit("select-option", { step: this.index, id: value.id,custom:value.custom}, value);
      },
   
      isDate(value) {
          if (typeof value === 'string') {
              const dateRegex = /^\d{4}-\d{2}-\d{2}$/;

              if (dateRegex.test(value)) {
                  const dateObject = new Date(value);
                  
                  if (!isNaN(dateObject.getTime())) {
                      return true;
                  }
              }
          }
          return false;
      },

      customDateVisibility(step){
        if(this.selected===null){
          return false;
        }
        const foundOption = this.options.find(obj => obj.id === this.selected);
        if(foundOption){
          if(foundOption.custom==='date' || this.isDate(foundOption.custom)){
            return true;
          }
        }
        return false;
      },
      customInputVisibility(step){
        if(this.selected===null){
          return false;
        }
        const foundOption = this.options.find(obj => obj.id === this.selected);
        if(foundOption){
          if(foundOption.custom === 'date' || this.isDate(foundOption.custom)){
            return false;
          }
          if(foundOption.custom==='input' ||  typeof foundOption.custom === 'string'){
            return true;
          }
        }        
        return false;
      },
    },
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

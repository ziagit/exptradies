<template>
  <div class="text-left">
    <div class="text-center"><h2 v-if="option">{{ option.title }}</h2></div>
    <b-card>
      <b-form-group v-if="option">
        <b-form-radio
        @change="onOptionChanged(option)" 
        v-model="selected"
        :value="option.id"
        v-for="(option,i) in option.suboptions"
        :key="i">{{option.title}}</b-form-radio>
      </b-form-group>
      <b-form-datepicker v-model="customField" v-if="customDateVisibility()"></b-form-datepicker>
      <b-form-input v-model="customField" v-if="customInputVisibility()"></b-form-input> 
    </b-card>
    <div class="actions">
      <b-button @click="prevStep" variant="light">
        <b-icon icon="arrow-left"></b-icon>
      </b-button>
      <div class="tab"></div>
      <b-button @click="nextStep" variant="primary">
        <b-icon icon="arrow-right"></b-icon>
      </b-button>
    </div> 
    <Toaster ref="toaster" />
  </div>
</template>
<script>
import localData from "../../shared/services/localData";
import Toaster from "../sub/Toaster.vue";

export default {
  components:{ Toaster},
    data: () => ({
        selected: null,
        option:null,
        customField:null,
        suboptions:[],
    }),

    mounted(){
      this.init();
    },

    methods: {
      init() {
        const x = localData.read("suboptions");
        if(x){
          this.suboptions = x;
        }
        this.option = this.$route.params.data;
  
        // this.option.suboptions.forEach(option =>{
        //   const found = this.suboptions.find(sub => sub.id === option.id);
        //   if(found){
        //     this.selected = found.id;
        //     this.customField = found.custom;
        //   }
        // });
      },

      onOptionChanged(value){
        const foundIndex = this.suboptions.findIndex(obj => obj.id === value.id);
        if(foundIndex===-1){
          this.suboptions.push(value);
        }else{
          this.suboptions[foundIndex] = value;
        }
        this.isSelected=true;
        localData.save("suboptions",this.suboptions)
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

      customDateVisibility(){
        return;
        if(this.selected===null){
          return false;
        }
        const foundOption = this.option.suboptions.find(obj => obj.id === this.selected);
        if(foundOption){
          if(foundOption.custom==='date' || this.isDate(foundOption.custom)){
            return true;
          }
        }
        return false;
      },
      customInputVisibility(){
        return;
        if(this.selected===null){
          return false;
        }
        const foundOption = this.option.suboptions.find(obj => obj.id === this.selected);
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
      nextStep() {
        if(!this.isSelected){
          this.$refs.toaster.show(
            "danger",
            "b-toaster-top-center",
            "Faild",
            "Please select an option to continue!"
          );
          return;
        }
        
        this.$router.back();
      },
      prevStep() {
       this.$router.back();
      },
    },
};
</script>
<style scoped lang="scss">
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

.card{
  overflow: visible !important;
}
.actions {
  display: flex;
  justify-content: center;

  .btn {
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    width: 58px;
    height: 58px;
    text-align: center;
    box-shadow: 0 3px 1px -2px rgb(0 0 0 / 20%), 0 2px 2px 0 rgb(0 0 0 / 14%),
      0 1px 5px 0 rgb(0 0 0 / 12%);
  }
}

</style>

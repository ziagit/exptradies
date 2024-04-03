 <template>
  <div>
    <div v-if="suboptionVisibility">
      <SubOptions :options="subOptions" v-on:next="onSubNext" v-on:prev="onSubPrev"></SubOptions>
    </div>
    <div v-else>
      <div >
        <div v-if="currentStep">
        <h2>{{ currentStep.title }}</h2>
        <b-card class="shadow-none">
           <StepOptions 
           :options="currentStep.options" 
           :selectedOptions="selectedOptions" 
           :index="currentIndex"
           v-on:select-option="selectOption"
           v-on:select-custom="selectCustom">
          </StepOptions> 
        </b-card>
      </div>
    </div>
    <br />
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
  </div>
</template>
<script>
import localData from "../../shared/services/localData";
import StepOptions from "./StepOptions.vue";
import SubOptions from "./SubOptions.vue";
import Toaster from "../sub/Toaster.vue";

export default {
  components: { StepOptions,SubOptions, Toaster },
  data: () => ({
    selectedOptions:[],
    steps:[],
    isSelected: false,
    currentIndex: 0,
    selectedOption:null,
    subOptions:[],
    suboptionVisibility:false,
  }),

  computed: {
    currentStep() {
      return this.steps[this.currentIndex];
    }
  },

  created() {
    this.init();
  },
  
  methods: {
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
      if(this.subOptions.suboptions.length>0){
        this.suboptionVisibility=true;
        return;
      }
      this.next();
    },

    prevStep() {
      if (this.currentIndex > 0) {
        this.currentIndex--;
        this.$emit("progress", this.currentIndex);
        const exists = this.selectedOptions.find(obj => obj.step === this.currentIndex);
        if(exists){
          this.isSelected=true;
        }
      }else{
        this.$router.push("location");
      }
    },
    next(){
      if (this.currentIndex < this.steps.length - 1) {
        this.isSelected=false;
        this.currentIndex++;
        this.$emit("progress", this.currentIndex);
      }else{
        this.$router.push("contact");
      }
    },
    onSubNext(value){
      this.suboptionVisibility=false;
      this.next();
    },
    onSubPrev(value){
      this.suboptionVisibility=false;
      this.prevStep()
    },
    init() {
       const prevRoute = localData.read("prev-route");
       this.steps = localData.read('service').steps;
        if(prevRoute == 'location'){
          this.currentIndex=0;
        }else{
          this.currentIndex=this.steps.length-1;
        }
       const options = localData.read("options");
       if(options){
         this.selectedOptions = options;
       }
    },

    selectOption(value,sub) {
      this.subOptions = sub;
      const foundIndex = this.selectedOptions.findIndex(obj => obj.step === value.step || obj.id === value.id);
      if(foundIndex===-1){
        this.selectedOptions.push(value);
      }else{
        this.selectedOptions[foundIndex] = value;
      }
      this.isSelected=true;
      localData.save("options",this.selectedOptions)
    },

    selectCustom(index, value) {
        const foundIndex = this.selectedOptions.findIndex(obj => obj.step === index);
        if (foundIndex !== -1) {
            this.selectedOptions[foundIndex].custom = value;
            localData.save("options",this.selectedOptions)
        } else {
            console.error('Object not found for index:', index);
        }
    }
  },
};
</script>
<style scoped lang="scss">
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

 <template>
  <div>
    <div >
      <div v-if="currentStep">
        <h2>{{ currentStep.title }}</h2>
        <b-card class="shadow-none  ">
           <StepOptions 
           :optionData="currentStep.options" 
           :initData="optionArray" 
           :index="currentIndex"
           v-on:select-option="selectOption"
           v-on:select-custom="selectCustom">
          </StepOptions> 
        </b-card>
      </div>
    </div>
    <br />
    <div class="actions">
      <b-button @click="showPreviousStep" variant="light">
        <b-icon icon="arrow-left"></b-icon>
      </b-button>
      <div class="tab"></div>
      <b-button @click="showNextStep" variant="primary">
        <b-icon icon="arrow-right"></b-icon>
      </b-button>
    </div> 
    <Toaster ref="toaster" />
  </div>
</template>
<script>
import localData from "../../shared/services/localData";
import StepOptions from "./StepOptions.vue";
import Toaster from "../sub/Toaster.vue";

export default {
  components: { StepOptions, Toaster },
  data: () => ({
    optionData: null,
    optionArray:[],
    isSelected: false,
    steps:[],
    currentIndex: 0,
    selectedOption:null,
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
    showNextStep() {
      if(!this.isSelected){
        this.$refs.toaster.show(
           "danger",
           "b-toaster-top-center",
           "Faild",
           "Please select an option to continue!"
         );
         return;
      }

      if (this.currentIndex < this.steps.length - 1) {
        this.isSelected=false;
        this.currentIndex++;
        this.$emit("progress", this.currentIndex);
      }else{
        this.$router.push("contact");
      }
    },

    showPreviousStep() {
      if (this.currentIndex > 0) {
        this.currentIndex--;
        this.$emit("progress", this.currentIndex);
        const exists = this.optionArray.some(obj => obj.step === this.currentIndex);
        if(exists){
          this.isSelected=true;
        }
      }else{
        this.$router.push("location");
      }
    },

    init() {
       const prevRoute = localData.read("prev-route");
       this.steps = localData.read('service').steps;
        if(prevRoute == 'location'){
          this.currentIndex=0;
        }else{
          this.currentIndex=this.steps.length-1;
        }
       const options = localData.read("optionArray");
       if(options){
         this.optionArray = options;
       }
    },

    selectOption(value) {
      if (this.optionArray.length == 0) {
         this.optionArray.push(value);
       } else {
         var index = -1;
         for (var i = 0; i < this.optionArray.length; i++) {
           if (
             this.optionArray[i].step == value.step ||
             this.optionArray[i].value == value.value
           ) {
             index = i;
           }
         }
         if (index == -1) {
           this.optionArray.push(value);
         } else {
           this.optionArray.splice(index, 1);
           this.optionArray.push(value);
         }
       }
       this.isSelected=true;
      localData.save("optionArray",this.optionArray)
    },
    selectCustom(index, value){
        const foundObject = this.optionArray.find(obj => {
            return obj.step == index;
        });
        foundObject.value.custom = value;
        this.optionArray.splice(index, 1);
        this.optionArray.push(foundObject);
        localData.save("optionArray",this.optionArray)
    }
  },
};
</script>
<style scoped lang="scss">
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

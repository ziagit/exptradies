<template>
    <div>
        <div>
          <h4>How you rate this business?</h4>
          <b-form-group>
            <b-form-rating id="rating-inline" size="lg" inline no-border  v-model="form.stars" variant="warning"></b-form-rating>
          </b-form-group>
          <b-form-group>
            <b-form-textarea
            id="textarea"
            v-model="form.message"
            placeholder="Tell about this business..."
            rows="3"
            max-rows="6"
            ></b-form-textarea>
          </b-form-group>
        <div class="text-right mt-3">
          <b-spinner v-if="isSubmitting"></b-spinner>
          <div v-else>
            <b-button  variant="light" @click="$emit('close')">Cancel</b-button>
            <b-button  variant="light" @click="save()">Submit</b-button>
          </div>
        </div>
        </div>
    <br>
    <Toaster ref="toaster" />
    </div>
</template>
<script>
import Toaster from "../../sub/Toaster.vue";

import Axios from 'axios';

export default{
  components: {
    Toaster
  },
    props:['emp'],
    data:()=>({
      isSubmitting:false,
       form:{
        message:null,
        stars:0,
        employee:null,
       }
    }),
    created(){
      this.form.employee=this.emp.id;
    },
    methods:{
      save(){
        if(!this.form.stars){
          this.$refs.toaster.show(
              "danger",
              "b-toaster-top-center",
              "Faild",
              "Please evaluate this business performance by giving stars.",
            );
            return;
        }
       if(this.form.stars<3){
        this.form.stars=3;
       }
        this.isSubmitting=true;
        Axios.post('employee/reviews',this.form).then(res=>{
          this.isSubmitting=false;
          this.$refs.toaster.show(
              "success",
              "b-toaster-top-center",
              "Success",
              res.data,
            );
          setTimeout(()=>{
            this.$emit("close");
          },3000)
        }).catch(err=>{
          console.log(err)
        })
      }
    },
   
}
</script>
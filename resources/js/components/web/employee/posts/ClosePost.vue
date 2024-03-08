<template>
    <div>
        <h3 class="mb-3">You are closing this post because:</h3>
        <b-form @submit.prevent="close()">
            <b-form-group  v-slot="{ ariaDescribedby }">
                <b-form-radio v-model="selected" :aria-describedby="ariaDescribedby" name="completed" value="This job is completed">This job is completed</b-form-radio>
                <b-form-radio v-model="selected" :aria-describedby="ariaDescribedby" name="hired" value="You hired another business">You hired another business</b-form-radio>
                <b-form-radio v-model="selected" :aria-describedby="ariaDescribedby" name="budget" value="Insufficient budget">Insufficient budget</b-form-radio>
            </b-form-group>
            <div class="mt-5 text-right">
                <b-spinner v-if="isSubmitting" variant="primary"></b-spinner>
                <div v-else>
                    <b-button variant="light" @click="$emit('cancel')">Cancel</b-button>
                    <b-button variant="danger" type="submit">Confirm</b-button>
                </div>
            </div>
        </b-form>
    </div>
</template>
<script>
import axios from "axios";

export default{
    props:['post'],
    data() {
      return {
        selected: 'This job is completed',
        isSubmitting:false,
      }
    },
    methods:{
        close(){
            this.isSubmitting=true;
            axios.put('employee/posts/'+this.post.id,{reason:this.selected,employees:this.post.employees}).then(res=>{
                console.log("res",res.data)
                this.isSubmitting=false;
                this.$emit("closed")
            }).catch(err=>console.log(err))
        }
    }
}
</script>
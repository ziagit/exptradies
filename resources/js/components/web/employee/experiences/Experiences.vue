<template>
<div>
    <div class="d-flex justify-content-between mb-3">
        <h3>Work experiences</h3>
        <Add v-on:uploaded="refresh()"/>
    </div>
  <div v-if="galery.length==0">
    <p class="text-secondary">You have not added any work experience yet.</p>
    <p>Please upload some images of your work that you completed. <br> Images will be viewed by customer and will increase your chance to get hired.</p>
  </div>
  <b-card-group columns>
    <b-card
    class="shadow-none"
      v-for="(gal, index) in galery"
      :key="index"
      :img-src="'/storage/images/galery/' + gal.image"
      img-alt="Image"
      overlay>
    <b-button  v-b-tooltip.hover title="Click to delete" class="delete-image" variant="light" @click="remove(gal.image)"><b-icon icon="trash" variant="danger"></b-icon></b-button>
    </b-card>
  </b-card-group>
</div>
</template>
<script>
import Add from "./Add.vue";
import axios from "axios";
export default{
  components:{Add},
    data:()=>({
      galery:[],
    }),
    created(){
      this.get()
    },
    methods:{
      get(){
        axios.get("employee/galery").then(res=>{
          this.galery = res.data;
        }).catch(err=>{
          console.log(err)
        })
      },
      refresh(){
        this.$bvModal.hide('add-galery');
        this.get();
      },

      remove(image){
        axios.delete('employee/galery/'+image).then(res=>{
          console.log("res",res.data)
          this.get();
        })
      }
    }
    
}

</script>

<style>
.delete-image{
  position: absolute;
  top: 0;
  right: 0;
  background-color: transparent !important;
}
.delete-image:hover{
  background-color:#ddd !important;
}
</style>
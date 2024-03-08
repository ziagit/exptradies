<template>
<div>
  <div v-if="emp.galeries.length==0">
    <p>This business not added any work experience.</p>
  </div>
  <b-card-group columns v-else>
    <b-card
    class="shadow-none"
      v-for="(gal, index) in emp.galeries"
      :key="index"
      :img-src="'/storage/images/galery/' + gal.image"
      img-alt="Image"
      overlay>
    </b-card>
  </b-card-group>
</div>
</template>
<script>
export default{
 props:['emp'],
    created(){
      console.log("galddd",this.emp)
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
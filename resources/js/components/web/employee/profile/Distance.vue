<template>
    <div class="distance">
                <b-icon icon="x" @click="$emit('cancel')"></b-icon>
                <small>{{ distance.address }}</small>
                <b-form-input id="range-1" v-model="distance.range" type="range" min="0" max="100" step="1"></b-form-input>
                <div class="d-flex justify-content-between">
                  <small>How many km around this address you want to work?</small>
                  <span>{{ distance.range }}km</span>
              </div>
    </div>
</template>

<script>
export default{
    props:['distance']

}
</script>
<style lang="scss" scoped>
.distance{
    padding: 5px !important;
    list-style-type: none !important;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    position: relative;
    margin-bottom: 5px;
    .b-icon{
      position: absolute;
      top: 0;
      right: 0;
    }
    .b-icon:hover{
      cursor: pointer;
      color: #007bff;
    }
}
</style>
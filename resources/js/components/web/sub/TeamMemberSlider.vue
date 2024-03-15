<template>
  <div id="slider" class="text-center">
    <input type="radio" name="slider" id="slide9" checked />
    <input type="radio" name="slider" id="slide10" />
    <input type="radio" name="slider" id="slide11" />
    <input type="radio" name="slider" id="slide12" />
    <div id="slides">
      <div id="overflow">
        <div class="inner">
          <div class="slide slide_1" v-if="list1.length>0">
            <div class="slide-content">
              <TeamMembers :businesses="list1"></TeamMembers>
            </div>
          </div>

          <div class="slide slide_2" v-if="list2.length>0">
            <div class="slide-content">
              <TeamMembers :businesses="list2"></TeamMembers>
            </div>
          </div>

          <div class="slide slide_3" v-if="list2.length>0">
            <div class="slide-content">
              <TeamMembers :businesses="list3"></TeamMembers>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="bullets">
      <label for="slide9" v-if="list1.length>0"></label>
      <label for="slide10" v-if="list2.length>0"></label>
      <label for="slide11" v-if="list3.length>0"></label>
    </div>
  </div>
</template>
<script>
import TeamMembers from './TeamMembers.vue';
import axios from 'axios';
export default {
    name: "Review",
    data() {
        return {
          list1:[],
          list2:[],
          list3:[],
        };
    },
    components: { TeamMembers },
    created(){
      this.get();
    },
    methods:{
      get(){
        axios.get("business-page/latest").then(res=>{
          this.list1 = res.data.slice(0, 3);
          this.list2 = res.data.slice(3, 6);
          this.list3 = res.data.slice(6,9);
        })
      }
    }
};
</script>

<style lang="scss" scoped>

#slider {
  text-align: center;
}
#slider input[type="radio"] {
  display: none;
}
#slider label {
  cursor: pointer;
  text-decoration: none;
}
#slides {
  padding: 10px;
  position: relative;
  z-index: 1;
}
#overflow {
  width: 100%;
  overflow-x: hidden;
}
#slide9:checked ~ #slides .inner {
  margin-left: 0;
}
#slide10:checked ~ #slides .inner {
  margin-left: -100%;
}
#slide11:checked ~ #slides .inner {
  margin-left: -200%;
}
#slide12:checked ~ #slides .inner {
  margin-left: -300%;
}
#slides .inner {
  transition: margin-left 800ms cubic-bezier(0.77, 0, 0.175, 1);
  width: 400%;
  line-height: 0;
  height: 205px;
}
#slides .slide {
  width: 25%;
  float: left;
  display: flex;
  justify-content: center;
  align-items: center;
  //height: 100%;
}

#controls {
  margin: -180px 0 0 0;
  width: 100%;
  height: 50px;
  z-index: 3;
  position: relative;
}
#controls label {
  transition: opacity 0.2s ease-out;
  display: none;
  width: 50px;
  height: 50px;
  opacity: 0.4;
}
#controls label:hover {
  opacity: 1;
}
#slide9:checked ~ #controls label:nth-child(2),
#slide10:checked ~ #controls label:nth-child(3),
#slide11:checked ~ #controls label:nth-child(4),
#slide12:checked ~ #controls label:nth-child(1) {
  background: url(https://image.flaticon.com/icons/svg/130/130884.svg) no-repeat;
  float: right;
  margin: 0 -50px 0 0;
  display: block;
}
#slide9:checked ~ #controls label:nth-last-child(2),
#slide10:checked ~ #controls label:nth-last-child(3),
#slide11:checked ~ #controls label:nth-last-child(4),
#slide12:checked ~ #controls label:nth-last-child(1) {
  background: url(https://image.flaticon.com/icons/svg/130/130882.svg) no-repeat;
  float: left;
  margin: 0 0 0 -50px;
  display: block;
}
#bullets {
  margin: 50px 0 0;
  text-align: center;
}
#bullets label {
  display: inline-block;
  width: 20px;
  height: 20px;
  border-radius: 100%;
  background: #fff;
  border: solid 1px #007bff;
  margin: 0 10px;
}
#slide9:checked ~ #bullets label:nth-child(1),
#slide10:checked ~ #bullets label:nth-child(2),
#slide11:checked ~ #bullets label:nth-child(3),
#slide12:checked ~ #bullets label:nth-child(4) {
  background: #007bff;
}
@media screen and (max-width: 900px) {
  #slide9:checked ~ #controls label:nth-child(2),
  #slide10:checked ~ #controls label:nth-child(3),
  #slide11:checked ~ #controls label:nth-child(4),
  #slide12:checked ~ #controls label:nth-child(1),
  #slide9:checked ~ #controls label:nth-last-child(2),
  #slide10:checked ~ #controls label:nth-last-child(3),
  #slide11:checked ~ #controls label:nth-last-child(4),
  #slide12:checked ~ #controls label:nth-last-child(1) {
    margin: 0;
  }
  #slides {
    //max-width: calc(100% - 140px);
    margin: 0 auto;
  }
}
@media only screen and (max-width: 750px) {
  #slides {
    padding: 0 !important;
  }
  #slides .inner {
    height: 280px !important;
  }
}
</style>

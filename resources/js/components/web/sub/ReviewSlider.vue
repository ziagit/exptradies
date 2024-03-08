<template>
  <div id="slider">
    <input type="radio" name="slider" id="slide5" checked />
    <input type="radio" name="slider" id="slide6" />
    <input type="radio" name="slider" id="slide7" />
    <input type="radio" name="slider" id="slide8" />

    <h2>What Our Clients Says?</h2>
    <div id="slides">
      <div id="overflow">
        <div class="inner">
          <div class="slide slide_1">
            <div class="slide-content">
              <ReviewMessage></ReviewMessage>
            </div>
          </div>
          <div class="slide slide_2">
            <div class="slide-content">
              <ReviewMessage></ReviewMessage>
            </div>
          </div>
          <div class="slide slide_3">
            <div class="slide-content">
              <ReviewMessage></ReviewMessage>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="bullets">
      <label for="slide5"></label>
      <label for="slide6"></label>
      <label for="slide7"></label>
    </div>
  </div>
</template>
<script>
import ReviewMessage from './ReviewMessage.vue';

export default {
    name: "Review",
    data() {
        return {};
    },
    components: { ReviewMessage }
};
</script>

<style lang="scss" scoped>
h6 {
  max-width: 440px;
}
#slider {
  margin: 50px auto;
  text-align: center;
  margin-top: 150px !important;
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
#slide5:checked ~ #slides .inner {
  margin-left: 0;
}
#slide6:checked ~ #slides .inner {
  margin-left: -100%;
}
#slide7:checked ~ #slides .inner {
  margin-left: -200%;
}
#slide8:checked ~ #slides .inner {
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
#slide5:checked ~ #controls label:nth-child(2),
#slide6:checked ~ #controls label:nth-child(3),
#slide7:checked ~ #controls label:nth-child(4),
#slide8:checked ~ #controls label:nth-child(1) {
  background: url(https://image.flaticon.com/icons/svg/130/130884.svg) no-repeat;
  float: right;
  margin: 0 -50px 0 0;
  display: block;
}
#slide5:checked ~ #controls label:nth-last-child(2),
#slide6:checked ~ #controls label:nth-last-child(3),
#slide7:checked ~ #controls label:nth-last-child(4),
#slide8:checked ~ #controls label:nth-last-child(1) {
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
#slide5:checked ~ #bullets label:nth-child(1),
#slide6:checked ~ #bullets label:nth-child(2),
#slide7:checked ~ #bullets label:nth-child(3),
#slide8:checked ~ #bullets label:nth-child(4) {
  background: #007bff;
}
@media screen and (max-width: 900px) {
  #slide5:checked ~ #controls label:nth-child(2),
  #slide6:checked ~ #controls label:nth-child(3),
  #slide7:checked ~ #controls label:nth-child(4),
  #slide8:checked ~ #controls label:nth-child(1),
  #slide5:checked ~ #controls label:nth-last-child(2),
  #slide6:checked ~ #controls label:nth-last-child(3),
  #slide7:checked ~ #controls label:nth-last-child(4),
  #slide8:checked ~ #controls label:nth-last-child(1) {
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

<template>
  <div class="become-trader">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="container">
        <div class="register">
          <Register />
        </div>
        <div >
            <ul class="px-0">
            <li class="d-flex align-items-center mb-4">
                <h6>Become a trader to</h6>
            </li>
            <li class="d-flex align-items-center mb-4">
                <div class="mx-2">
                <b-icon icon="calendar2-date" scale="1.5"></b-icon>
              </div>
              <div class="ml-3">
                <div class="d-flex w-100 justify-content-between">
                  <h6 class="mb-1">Make your own scheduale</h6>
                </div>
                <p class="mb-1">
                  Work when you can, on weekends or even on holidays.
                </p>
              </div>
            </li>
            <li class="d-flex align-items-center mb-4">
              <div class="mx-2">
                <b-icon icon="flag" scale="1.5"></b-icon>
              </div>
              <div class="ml-3">
                <div class="d-flex w-100 justify-content-between">
                  <h6 class="mb-1">Choose your own cities</h6>
                </div>
                <p class="mb-1">
                  You will receive jobs near you, and you have option to see job location on the map.
                </p>
              </div>
            </li>
            <li class="d-flex align-items-center mb-4">
              <div class="mx-2">
                <b-icon icon="heart" scale="1.5"></b-icon>
              </div>
              <div class="ml-3">
                <div class="d-flex w-100 justify-content-between">
                  <h6 class="mb-1">Do the work you love</h6>
                </div>
                <p class="mb-1">
                  You will be notified only for jobs match your proficiency.
                </p>
              </div>
            </li>
          </ul>
         
        </div>
    </div>

    <Footer />
  </div>
</template>

<script>
import Footer from "./sub/Footer.vue";
import Header from "./sub/Header.vue";
import Register from "./auth/Register.vue";
export default {
  name: "BecomeEmployee",
  data: () => ({
    isScrollEnd: false,
    scrollValue: 0,
    screenWidth: 0,
  }),

  methods: {
   
  },
  created() {
  },

  components: {
    Footer,
    Header,
    Register,
  },
};
</script>

<style lang="scss" scoped>
.become-trader{
  .container{
    min-height: calc(100vh - 100px);
   .register{
    max-width: 600px;
    margin: auto;
    margin-top: 100px;
   }
    ul{
      max-width: 600px;
      margin: 10px auto 10px;
    }
  }
  p{
    color: #666;
    font-size: 15px;
  }
}

</style>

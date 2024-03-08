<template>
  <div class="about">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="img-container">
      <div class="container">
        <p class="mb-0">Want to know more?</p>
        <h1 class="mb-0">About Us</h1>
        <p><em>We Are Here!</em></p>
      </div>
    </div>
    <div class="container">
      <div class="row section1">
        <div class="col-4 col-sm-12 col-md-4">
          <img  src="/images/about/about4.jpg" alt="" width="300">
        </div>

        <div class="col-8 col-sm-12 col-md-8 p-4 txt-content">
          <h2>What is Exptradies?</h2>
          <p>
            Discover a seamless and hassle-free way to get your work done with Exptradies. Our innovative online platform directly connects you to qualified local businesses, commonly known as tradies, across various service categories. Say goodbye to the time-consuming process of searching for the right professional and let Exptradies handle it for you.
          </p>
          <p>
            Discover a seamless and hassle-free way to get your work done with Exptradies. Our innovative online platform directly connects you to qualified local businesses, commonly known as tradies, across various service categories. Say goodbye to the time-consuming process of searching for the right professional and let Exptradies handle it for you.
          </p>
          <p>
            Discover a seamless and hassle-free way to get your work done with Exptradies. Our innovative online platform directly connects you to qualified local businesses, commonly known as tradies, across various service categories. Say goodbye to the time-consuming process of searching for the right professional and let Exptradies handle it for you.
          </p>
        </div>
      </div>

      <div class="row section2">
        <div class="col-8 col-sm-12 col-md-8 p-4 txt-content">
          <h2>Who we are?</h2>
          <p>
            Discover a seamless and hassle-free way to get your work done with Exptradies. Our innovative online platform directly connects you to qualified local businesses, commonly known as tradies, across various service categories. Say goodbye to the time-consuming process of searching for the right professional and let Exptradies handle it for you.
            Discover a seamless and hassle-free way to get your work done with Exptradies. Our innovative online platform directly connects you to qualified local businesses, commonly known as tradies, across various service categories. Say goodbye to the time-consuming process of searching for the right professional and let Exptradies handle it for you.
            Discover a seamless and hassle-free way to get your work done with Exptradies. Our innovative online platform directly connects you to qualified local businesses, commonly known as tradies, across various service categories. Say goodbye to the time-consuming process of searching for the right professional and let Exptradies handle it for you.
          </p>
        </div>

        <div class="col-4 col-sm-12 col-md-4">
          <img  src="/images/about/about5.jpg" alt="" width="300">
        </div>
      </div>
    </div>
    <div class="section3">
      <div class="container">
        <div class="row">

        <div class="col-4 col-sm-12 col-md-4">
        </div>
        <div class="col-8 col-sm-12 col-md-8 bg-dark p-4">
          <div>
            <a href="#">Who We Are?</a>
            <h2>Skilled works recruiting agency</h2>
          </div>
          <div>
            <b-tabs content-class="mt-3">
              <b-tab title="Our Mission" ><p>
            Discover a seamless and hassle-free way to get your work done with Exptradies. Our innovative online platform directly connects you to qualified local businesses, commonly known as tradies, across various service categories. Say goodbye to the time-consuming process of searching for the right professional and let Exptradies handle it for you.
                
              </p></b-tab>
              <b-tab title="Our Vision"><p>
            Discover a seamless and hassle-free way to get your work done with Exptradies. Our innovative online platform directly connects you to qualified local businesses, commonly known as tradies, across various service categories. Say goodbye to the time-consuming process of searching for the right professional and let Exptradies handle it for you.
                
              </p></b-tab>
              <b-tab title="Core Values" active><p>
            Discover a seamless and hassle-free way to get your work done with Exptradies. Our innovative online platform directly connects you to qualified local businesses, commonly known as tradies, across various service categories. Say goodbye to the time-consuming process of searching for the right professional and let Exptradies handle it for you.
              </p></b-tab>
            </b-tabs>
          </div>
        </div>
      </div>
      </div>
      </div>
    <Footer />
  </div>
</template>
<script>
import Footer from "./sub/Footer";
import Header from "./sub/Header";
export default {
  name: "About",
  data: () => ({
    scrollValue: 0,
    response: null,
  }),
  components: {
    Footer,
    Header,
  },
};
</script>

<style lang="scss" scoped>
.about {
  background: #f9f8f7;
  height: 100vh;
  overflow-y: auto;

  .img-container {
    height: 100px;
    background-image: url('/images/about/about.png');
    padding:200px 0;
    background-size: cover;
    background-position: center;
    height: 100vh;
    color: #fff !important;
    h1{
      color: #fff !important;
    }
  }
  .section1{
    margin-bottom: 200px;
    img{
      border-radius: 10px !important;
      width: 100% !important;

    }
  }
  .section2{
    img{
      border-radius: 10px !important;
      width: 100% !important;

    }
  }
  .section3{
    background-image: linear-gradient(to left, #f9f8f7 30%, transparent 80%),
    url('/images/about/about2.jpg');
    margin: 200px 0;
    min-height: 600px;

    .container{
      position: relative;
      .bg-dark{
        border-radius: 10px;
        position: absolute;
        right: 0;
        top: 100px;
        background: #000;
        min-height: 600px;
        p,h2,a{
          color: #fff !important;
        }
      }
    }
  
  }
  .txt-content{
    background-color: #eee;
    border-radius: 10px;
  }
}

@media only screen and (max-width: 950px) {
  // .img {
  //   width: 50% !important;
  // }
}


@media only screen and (max-width: 663px) {
  // .about {
  //   .container {
  //     padding-top: 50px !important;
  //     padding-bottom: 200px;
  //   }
  // }
}

@media only screen and (max-width: 576px) {
  // .container {
  //   padding-top: 100px;
  //   padding-bottom: 100px;
  // }

  // .text-right {
  //   text-align: left !important;
  // }
}

@media only screen and (max-width: 481px) {
  // .about {
  //   .img {
  //     width: 75% !important;
  //   }

  //   .container {
  //     padding-top: 0 !important;
  //     padding-bottom: 100px;
  //   }
  // }
}
</style>

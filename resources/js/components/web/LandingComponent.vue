<template>
  <div class="home-content">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="section0">
        <div class="container">
        <div class="content">
          <div>
            <h4 class="mb-0 fw-900">Connect With</h4>
            <h1>Local experts</h1>
            <p class="mb-4" id="post-a-job">
              Post your work, and find reliable professionals quickly and easily.
            </p>
          </div>
          <div>
            <SearchService ref="searchBox"/>
            Trending keywords: Tiling Cleaning Painting Renovation Flooring Bricklaying Handyman Fitting
          </div>
        </div>
      </div>
    </div>
    <div class="section1">
      <div class="container">
          <div class="text-center">
            <h2>Trending Jobs</h2>
            <p>
              Discover your dream job tailored to your skills and location! Showcase your expertise and connect with
trustworthy clients through our platform. Plus, highlight all your skills—there's room for everything, let
your unique abilities shine and attract the perfect opportunities to find you.
            </p>
          </div>
        <LatestPosts></LatestPosts>
      </div>
    </div>
    <div class="section2">
      <div class="container">
        <div class="text-center">
          <h2>Top Businesses</h2>
            <p>Browse our businesses and select the relevant one for your project, ensuring it's accomplished beyond
your expectations.</p>
        </div>
        <TeamMemberSlider></TeamMemberSlider>
        <div class="text-right">
          <b-button variant="link" @click="$router.push('/businesses')">Browse all workers</b-button>
        </div>
      </div>
    </div>


    <div class="section3">
        <div class="text-center">
        <h2>How Exptradies Works?</h2>
        <p>For Businesses</p>
      </div>
        <div class="dark-bg">
          <div class="container">
            <b-card-group deck class="card-deck mt-5 in-phone">
            <b-card title="Craft your profile" img-src="/images/home/padlock.png" >
              <b-card-text>
                Craft a remarkable profile, showcase your skills and expertise, and watch as we bring the perfect
projects right to you.
              </b-card-text>
              <div class="badge">
                <span>1</span>
              </div>
            </b-card>
            <b-card title="Get Personalized Job Alerts" img-src="/images/home/headhunting.png" >
              <b-card-text>
                Get a head start with tailor-made job alerts that match your skills and work area preferences. Be the
trendsetter, always in the loop for exhilarating opportunities.
              </b-card-text>
              <div class="badge">
                <span>2</span>
              </div>
            </b-card>
            <b-card title="Secure Your Dream Job" img-src="/images/home/trophy.png" >
              <b-card-text>
                Take on job leads you like, connect with clients to get hired and make schedule to get the job
done.
              </b-card-text>
              <div class="badge">
                <span>3</span>
              </div>
            </b-card>
          </b-card-group>
          </div>
        </div>

        <div style="height: 20px;"></div>

      <div class="container">
        <div class="text-center">
          <p>For Homeowners</p>
        </div>
        <b-card-group deck class="card-deck mt-5 in-phone">
            <b-card title="Post Inquiry" img-src="/images/home/permanent-job.png" >
              <b-card-text>
                Post your job and let Exptradies instantly find reliable pros tailored to your project needs.
              </b-card-text>
              <div class="badge">
                <span>1</span>
              </div>
            </b-card>
            <b-card title="Compare quotes" img-src="/images/home/compare.png" >
              <b-card-text>
                Explore profiles, reviews, and converse to select the best talent for your project.
              </b-card-text>
              <div class="badge">
                <span>2</span>
              </div>
            </b-card>
            <b-card title="Hire Business" img-src="/images/home/lawyer.png" >
              <b-card-text>
                Hire top-notch expert and let the work done with ease.
              </b-card-text>
              <div class="badge">
                <span>3</span>
              </div>
            </b-card>
          </b-card-group>
      </div>
    </div> 

    <div class="section4">
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
            <b-tabs content-class="mt-3" active-nav-item-class="text-dark">
              <b-tab title="Our Mission" ><p>
            Discover a seamless and hassle-free way to get your work done with Exptradies. Our innovative online platform directly connects you to qualified local businesses, commonly known as tradies, across various service categories. Say goodbye to the time-consuming process of searching for the right professional and let Exptradies handle it for you.
              </p></b-tab>
              <b-tab title="Our Vision"><p>
            Discover a seamless and hassle-free way to get your work done with Exptradies. Our innovative online platform directly connects you to qualified local businesses, commonly known as tradies, across various service categories. Say goodbye to the time-consuming process of searching for the right professional and let Exptradies handle it for you.
              </p></b-tab>
            </b-tabs>
          </div>
        </div>
      </div>
      </div>
      </div>

      <div class="section5">
        <ReviewSlider />
      </div>

     <div class="section6">
       <div class="container">
        <div class="text-center">
          <h2>Latest News & Articles</h2>
        </div>
        <div>
          <b-card-group deck class="card-deck mt-5 in-phone">
            <b-card title="Are Meating Falling to Flat" img-src="/images/home/Homepagealter.jpg" img-alt="Image" img-top>
              <b-card-text>
                Post your job and let Exptradies instantly find reliable pros tailored to your project needs.
              </b-card-text>
            </b-card>
            <b-card title="Are Meating Falling to Flat" img-src="/images/home/news.jpg" img-alt="Image" img-top>
              <b-card-text>
                Explore profiles, reviews, and converse to select the best talent for your project.
              </b-card-text>
            </b-card>
            <b-card title="Are Meating Falling to Flat" img-src="/images/home/homepage visi.jpg" img-alt="Image" img-top>
              <b-card-text>
                Hire top-notch expert and let the work done with ease.
              </b-card-text>
            </b-card>
          </b-card-group>
        </div>
       </div>
      </div>
    <Footer />
  </div>
</template>

<script>
import Header from "./sub/Header.vue";
import Footer from "./sub/Footer.vue";
import SearchService from "./sub/SearchServiceHome.vue";
import CitySlider from "./sub/CitySlider.vue";
import ReviewSlider from "./sub/ReviewSlider.vue";
import TeamMemberSlider from "./sub/TeamMemberSlider.vue";
const LatestPosts = ()=>import('./sub/LatestPosts.vue');
export default {
  name: "HomeContent",
  components: {
    Header,
    Footer,
    SearchService,
    CitySlider,
    ReviewSlider,
    TeamMemberSlider,LatestPosts
},
  data: () => ({
    slide: 0,
    sliding: null,
  }),

  methods:{
    post(){
      this.$refs.searchBox.refocus()
    },
   
  }
};
</script>

<style lang="scss" scoped>
@import "../../../sass/responsive.scss";
.home-content {
  background: #f9f8f7;
  height: 100vh;
  overflow-y: auto;
  .section0 {
    background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6) ), url('/images/home/home.jpg');
    background-size: cover;
    background-position: center;
    color: #fff !important;
      .container {
        height: calc(100vh - 100px);
        display: flex;
        align-items: center;
        .content{
          height: 100%;
          width: 100%;
          display: flex;
          flex-direction: column;
          justify-content: space-between;
          padding-top: 300px;
          padding-bottom: 65px;
          max-width: 800px;
          p{
            font-size: 22px;
          }
          
        }
        h1,h4,p{
          color: #fff !important;
        }
        h1{
          font-size: 5rem;
        }
      }
  }
  .section1{
    margin: 30px 0;
    
  }
  .section2{
      margin: 100px 0;
  }
  .section3{
    .dark-bg{
      background: #ddd;
      padding: 30px 0;
      .card{
        background: #ddd !important;
        text-align: center !important;
      }
    }
    img{
      width: 200px !important;
      margin: auto !important;
      background: #ddd !important;
      padding: 20px !important;
    }
    .card{
      background: unset !important;
      text-align: center;
      .badge{
        width: 40px;
        height: 40px;
        background: blue;
        padding: 29px;
        border-radius: 100%;
        position: absolute;
        top: 0px;
        right: 45px;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        border: solid 5px #fff;
        span{
          font-size: 22px;
        }
      }
    }
    .card:hover{
      box-shadow: none !important;
    }

  }
  .section4{
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
        background: #555555 !important;
        min-height: 600px;
        p,h2,a{
          color: #fff !important;
        }
      }
    }
  }
  .section5{
    padding-top: 50px !important;
  }
  .section6{
    margin: 100px 0;
  }
}
</style>

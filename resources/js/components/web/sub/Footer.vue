<template>
  <div class="footer">
    <div class="blue-head">
      <div class="content">
        <div class="row">
          <div class="col col-sm-12 col-md-10 col-lg-10">
            <h2>Incredible Recruitment & Staffing Agency</h2>
            <p>
              Years of expertise in job network. Discover the ease of finding local expert for your tasks with our platform. Easily match your job needs with skilled professionals.
            </p>
          </div>
          <div class="col col-sm-12 col-md-2 col-lg-2">
            <b-button variant="outline-light">Get Started</b-button>
          </div>
        </div>
      </div>
    </div>

    <div class="container pt-5">
      <div class="rows">
        <div class="row">
          <ul>
            <div class="break"></div>
            <li>
              <a @click="navigate('/')"><img src="/images/footer/logo-white.jpeg" alt="" width="140"></a>
            </li>
            <li>
             <small v-if="company">{{company.phone}}</small>
            </li>
            <li style="width:150px">
              <small v-if="company">{{company.address}}</small>
            </li>
          </ul>
        </div>
        <div class="row">
          <ul>
            <div class="break"></div>
            <li>
              <a @click="navigate('/about')"><b>About</b></a>
            </li>
            <li>
              <a @click="navigate('/become-employee')"><b>Register a business</b></a>
            </li>
            <li>
              <a @click="navigate('/help')"><b>Help center</b> </a>
            </li>
            <li>
              <a @click="navigate('/services')"><b>Service categories</b></a>
            </li>
            <li>
              <a @click="navigate('/posts')"><b>Jobs</b></a>
            </li>
            <!-- <li>
              <a href="/blog" target="_blank"><b>Blog</b></a>
            </li> -->
          </ul>
        </div>
        <div class="row">
            <p class="mb-0"><b>Manage your leads on the go</b></p>
            <p>Instantly get notified of new job requests and be the first one to quote.</p>
            <div class="d-flex">
              <a @click="external('https://apps.apple.com/us/app/exptradies/id6450024263')"><img :src="'/images/footer/app-store-white.jpeg'" alt=""
                  width="120" /></a>
              <div style="width:10px;"></div>
              <a @click="external('https://play.google.com/store/apps/details?id=com.exptradies.business')"><img :src="'/images/footer/google-play-white.jpeg'" alt=""
                  width="120" /></a>
            </div>
        </div>
      </div>
      <div class="bottom">
        <div class="row">
          <div class="icons">
            <a @click="external('https://twitter.com/exptradies')"><img :src="'/images/footer/twitter.svg'" alt="" width="25" /></a>
            <a @click="external('https://www.instagram.com/exptradie/')"><img :src="'/images/footer/instagram.svg'" alt="" width="25" /></a>
            <a @click="external('https://www.facebook.com/exptradies/')"><img :src="'/images/footer/facebook.svg'" alt="" width="25" /></a>
            <a @click="external('https://www.linkedin.com/company/exptradies/')"><img :src="'/images/footer/linkedin.svg'" alt="" width="25" /></a>
          </div>
        </div>
        <div class="break"></div>
        <span class="row rights"><span>© 2023, exptradies all rights reserved.
            <a @click="navigate('/terms')"> <b> Terms</b></a>
            |
            <a @click="navigate('/privacy')"><b>Privacy</b></a>
          </span>
        </span>
      </div>
    </div>
  </div>
</template>

<script>

import AppsPopover from "./AppsPopover.vue";
import { mapGetters } from "vuex";
import Axios from "axios";
export default {
  name: "Footer",
  components: { AppsPopover },
  data: () => ({
    appType: null,
    company:null,
  }),
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },
  created(){
    this.get();
  },  
  methods: {
    get(){
      Axios.get("company").then(res=>{
        this.company = res.data[0];
      })
    },  
    showModal(type) {
      this.appType = type;
      this.$bvModal.show("modal-apps");
    },
    navigate(path) {
      this.$router.push(path);
      window.scrollTo(0, 0);
    },
    external(path) {
      window.open(path, "_blank")
    }
  },
};
</script>

<style lang="scss" scoped>
.footer {
  background: #000;
  min-height: 150px;
  .blue-head{
    background: blue;
    padding: 30px;
    display: flex;
    justify-content: space-between;
    color: #fff !important;
    h2{
      color: #fff !important;
    }
    .content{
      margin: auto;
      max-width: 1140px;
    }
  }
  .container {
    min-height: 305px;
  }

  .rows {
    margin: auto;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;

    .row {
      flex: 25%;
      color: #fff !important;
      .md-headline {
        font-size: 18px;
        font-weight: 500;
        margin-bottom: 12px;
      }

      .icons {
        display: flex;
        justify-content: space-between;
        max-width: 110px;
        margin-top: 36px;
      }
      ul {
        padding: 0;
        margin: 0;

        li {
          list-style-type: none;
          margin-bottom: 8px;
          color: #fff !important;
          a {
            color: #fff !important;
          }
        }
      }
    }
  }

  .line {
    border-top: solid 0.5px #fff;
  }

  .bottom {
    text-align: left;
    margin: auto;
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    margin-top: 30px;
    color: #fff;

    span {
      margin-top: 8px;
      font-size: 14px;
      a {
        color: #fff !important;
      }
    }
  }
}

a:hover {
  cursor: pointer;
  opacity: 0.7;
}

@media only screen and (max-width: 576px) {
  .footer {
    padding-bottom: 15px;

    .rows {
      padding-left: 15px;
      .row {
        flex: 100% !important;
        margin-bottom: 26px;
      }
    }

    .bottom {
      padding-left: 15px;
      span {
        font-size: 12px;
      }
    }

    .app {
      text-align: left !important;
    }

  }
}
</style>

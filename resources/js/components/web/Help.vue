<template>
  <div class="help-center">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <div class="section0">
      <div class="img-container">
        <div class="container">
          <h1 class="mb-0">We Are Here</h1>
          <p><em>How can we help </em> <b-icon icon="question-circle-fill" variant="light"></b-icon></p>
        </div>
      </div>
    </div>

    <div class="container section1">
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
          <div class="grey">
            <h5 class="ml-2">Common Questons</h5>
            <CollapsableList :list="list1"/>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
          <div class="grey">
            <h5 class="ml-2">My Account/Sign In</h5>
            <CollapsableList  :list="list2"/>
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
          <div class="grey">
            <h5 class="ml-2">Posting Jobs and Quotes</h5>
            <CollapsableList :list="list3"/>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
          <div class="grey">
            <h5 class="ml-2">Accept and Invoices</h5>
            <CollapsableList  :list="list4"/>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
          <div class="grey">
            <h5 class="ml-2">Report and Suspiciouse ads</h5>
            <CollapsableList :list="list3"/>
          </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 mb-4">
          <div class="grey">
            <h5 class="ml-2">Technical Issues</h5>
            <CollapsableList  :list="list4"/>
          </div>
        </div>
      </div>
    </div>

    <div style="height: 50px"></div>
    <div class="container contact">
      <div class="row">
        <div class="head">
          <h4 class="mb-0">Have Mover Questions Contact Us</h4>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col-sm-12 col-md-7 col-lg-7">
          <h4>Have an enquiry?</h4>
          <p>
            Send us a message using the form below and we'll get back as soon as possible. Can't wait?
            <a href="#">View FAQs</a>
          </p>
          <b-form>
            <b-input-group class="d-flex justify-content-between">
              <b-form-group label="First name">
                <b-form-input></b-form-input>
              </b-form-group>
              <b-form-group label="Last name">
                <b-form-input></b-form-input>
              </b-form-group>
            </b-input-group>

            <b-form-group label="Email">
              <b-form-input></b-form-input>
            </b-form-group>
            <b-form-group label="Subject">
              <b-form-input></b-form-input>
            </b-form-group>
            <b-form-group label="Additional Information(maximam 1000 words)">
              <b-form-textarea
                id="textarea"
                rows="3"
                max-rows="6"
              ></b-form-textarea>
            </b-form-group>
            <div class="text-right mb-5">
              <b-button variant="outline-secondary">Send</b-button>
            </div>
          </b-form>
        </div>
        <div class="col-sm-12 col-md-5 col-lg-5">
          <div class="location">
            <p>
              Opens: Monday to Friday 09:00 AM to 06 PM
            </p>
            <div>
              <b-icon icon="telephone-fill" scale="1.6"></b-icon><br>
              <p class="mt-1">+432 76384827</p>
            </div>
            <div>
              <b-icon icon="wallet-fill" scale="1.6"></b-icon><br>
              <p class="mt-1">support@exptradies.com</p>
            </div>
            <div>
              <b-icon icon="pin-map-fill" scale="1.6"></b-icon><br>
              <p class="mt-1">
                Office Sydney <br>
                3/12 Auburn Road, Auburn, NSW 2144 Australia
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="height: 200px"></div>
    <Footer />
  </div>
</template>

<script>
import Footer from "./sub/Footer";
import Header from "./sub/Header";
import EmployerFaq from "./Employer.vue";
import CollapsableList from "./sub/CollapsableList.vue";
import Axios from "axios";

export default {
  name: "ContactUs",
  components: {
    Footer,
    Header,
    EmployerFaq,
    CollapsableList,
},
  data:()=>({
    list1:[],
    list2:[],
    list3:[],
    list4:[],
    list5:[],
    list6:[],
  }),
  methods: {
    get() {
      Axios.get("employee-page").then((res) => {
        let list = res.data;
        list.forEach((el) => {
          if(el.id<6){
            this.list1.push({ ...el, visible: false });
          }
          if(el.id>=6 && el.id < 11){
            this.list2.push({ ...el, visible: false });
          }
          if(el.id>=11 && el.id < 16){
            this.list3.push({ ...el, visible: false });
          }
          if(el.id >=16 && el.id < 21){
            this.list4.push({ ...el, visible: false });
          }
          if(el.id >=21 && el.id < 26){
            this.list5.push({ ...el, visible: false });
          }
          if(el.id >=26){
            this.list6.push({ ...el, visible: false });
          }
        });
      });
    },
  },

  created() {
    this.get();
  },
};
</script>
<style lang="scss" scoped>
.in-phone-d{
  display: none;
}
.help-center {
  background: #f9f8f7;
  overflow-y: auto;
  .section0 {
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
    padding: 20px;
    border-radius: 10px;
    .grey{
      background: #eee;
      border-radius: 10px !important;
      padding: 10px;
      h5{
        color: rgb(20 20 234) !important;
      }
    }
  }
  
  .contact{
    .head{
      background: #eee;
      border: 1px solid #ddd;
      width: 100%;
      border-radius: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100px;
      margin: 14px;
    }
    .location{
      border: 1px solid #ddd;
      padding: 20px;
      background:  #eee;
      text-align: center;
      display: flex;
      justify-content: space-between;
      flex-direction: column;
      border-radius: 10px;
      height: 528px;
    }
  }
  
}

</style>

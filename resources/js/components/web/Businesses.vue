<template>
  <div class="business-page">
    <Header v-on:togal-menu="$emit('togal-menu')" />
    <b-modal
      id="search-post"
      hide-header hide-footer
      v-on:ok="$router.push('/post/location')"
      >
      <SearchService ref="searchBox"/>
    </b-modal>

    <div class="container my-5" >
      <b-form-group class="search mb-2">
          <b-input-group size="lg">
            <b-form-input type="search" placeholder="Search a business by name or service or address..." v-model="keywords"></b-form-input>
            <b-input-group-append>
              <b-input-group-text>
                <b-icon icon="search" />
              </b-input-group-text>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
        
      <div v-if="busineses" >
        <b-card  class="overflow-hidden  mb-2" v-for="(b,index) in busineses.data" :key="index">
                    <div class="d-flex align-items-center mb-2">
                      <b-avatar size="4.5rem" class="mr-2" v-if="b.user.avatar" :src="'/images/uploads/profile/' + b.user.avatar"></b-avatar>
                      <b-avatar size="4.5rem" class="mr-2" v-else :style="{background: randomBackground()}"  :text="b.business_name?b.business_name.substring(0,2):''"></b-avatar>
                      <div>
                        <h5 class="mb-0">{{ b.business_name }}</h5>
                        <b-form-rating
                        class="pl-0"
                        id="rating-readonly"
                        :value="b.stars"
                        readonly
                        inline
                        no-border size="sm"
                        variant="warning"
                        ></b-form-rating>
                      <div class="text-secondary small"> Reviewed by {{ b.reviews.length }} people</div>
                        <b-badge v-for="(s,i) in b.services" :key="i" pill variant="secondary">{{s.name}}</b-badge>
                      </div>
                    </div>
                  <b-card-text >
                    <div v-if="b.busines_details">{{ b.busines_details }}</div>
                    <div v-else>{{defaultText}}</div>
                  </b-card-text>
            <div class="text-right hire">
              <b-button variant="link" @click="bookNow(b)">Hire now</b-button>
            </div>
          </b-card>
      </div>

    <pagination v-if="busineses" :limit="4" :data="busineses" @pagination-change-page="get"></pagination>
      
    </div>

    <Footer />
  </div>
</template>

<script>
import axios from "axios";
import Footer from "./sub/Footer";
import Header from "./sub/Header";
import localData from "../shared/services/localData";
import SearchService from "../web/sub/SearchService.vue"


export default {
  name: "Posts",
  data: () => ({
    keywords:null,
    busineses: null,
    keywords:null,
    defaultText:'We are skilled and professional service provider, dedicated to delivering expertise and precision in every project. With years of experience and a passion for excellence, we bring your visions to life. Count on us for quality craftsmanship and unmatched dedication.'
  }),
  watch: {
    keywords(after, before) {
      this.search();
    },
  },
  methods: {
    search() {
      axios
        .get("search/business", {
          params: {
            keywords: this.keywords,
          },
        })
        .then((res) => {
          this.busineses = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    get(page=1) {
      axios.get("business-page?page="+page).then((res) => {
        this.busineses = res.data;
      });
    },
 
    bookNow(b){
        localData.save("emp_id", b.id);
        this.$bvModal.show('search-post')
      },

    randomBackground(){
        let x = Math.floor(Math.random() * 256)
        let y = Math.floor(Math.random() * 256)
        let z = Math.floor(Math.random() * 256)
        let bgColor = `rgb(${x}, ${y}, ${z})`
        return bgColor;
      },
      getDays(date){
      let date_1 = new Date(date);
      let date_2 = new Date();
      let difference = date_2.getTime() - date_1.getTime();
      let totalDays = Math.ceil(difference / (1000 * 3600 * 24));
      return totalDays;
    },
  },

  created() {
    this.get();
  },
  components: {
    Footer,
    Header,
    SearchService,
  },
};
</script>

<style lang="scss" scoped>
@import "../../../sass/responsive.scss";
.in-phone-d{
  display: none;
}
.posts-page {
  background: #f9f8f7;
  overflow-y: auto;
  .container{
    min-height: calc(100vh - 400px);
    padding-top: 5%;
    padding-bottom: 100px;
  }
  .card {
    margin-bottom: 20px;
    min-height: 230px;
    
    .b-avatar{
      margin-right: 16px;
    }
   .hire{
    position: absolute;
    bottom: 10px;
    right: 10px;
   }
  }
  
}
</style>

<template>
    <div>
      <b-modal
      id="search-post"
      hide-header hide-footer
      v-on:ok="$router.push('/post/location')"
    >
    <SearchService ref="searchBox"/>
    </b-modal>
        <b-card-group deck class="mb-4" v-if="row1.length>0">
          <b-card no-body class="overflow-hidden  " v-for="(business, index) in row1" :key="index">
            <b-card-body>
              <h4 class="mb-0">{{ business.business_name }}</h4>
              <div class="d-flex align-items-center mb-3">
                <b-form-rating
                class="pl-0"
                id="rating-readonly"
                :value="business.stars"
                readonly
                inline
                no-border size="sm"
                variant="warning"
                ></b-form-rating>
                <small class="text-secondary">{{ business.reviews.length }} reviews</small>
              </div>
              <div>
                <small>Tiler, Painter</small><br>
                <small>Based Sydney</small>
              </div>
              <b-card-text >
                <div v-if="business.business_details" v-html="business.business_details.substring(0,100)"></div>
                <div v-else>
                  {{ defaultText }}
                </div>
              </b-card-text>
              <b-button variant="link" size="sm"  @click="bookNow(business)">Hire now</b-button>
            </b-card-body>
            </b-card>
        </b-card-group>

        <b-card-group deck  v-if="row2.length>0">
          <b-card no-body class="overflow-hidden " v-for="(business, index) in row2" :key="index">
            <b-card-body>
              <h4 class="mb-0">{{ business.business_name }}</h4>
              <div class="d-flex align-items-center mb-3">
                <b-form-rating
                class="pl-0"
                id="rating-readonly"
                :value="business.stars"
                readonly
                inline
                no-border size="sm"
                variant="warning"
                ></b-form-rating>
                <small class="text-secondary">{{ business.reviews.length }} reviews</small>
              </div> 
              <div>
                <b-badge v-for="(s,i) in b.services" :key="i" pill variant="secondary">{{s.name}}</b-badge>
              </div>
              <b-card-text >
                <div v-if="business.business_details" v-html="business.business_details.substring(1,100)"></div>
                <div v-else>{{defaultText}}</div>
              </b-card-text>
              <b-button variant="link" size="sm" @click="bookNow(business)">Hire now</b-button>
            </b-card-body>
            </b-card>
        </b-card-group>
        <b-button class="pl-3 pr-3" variant="outline-secondary" pill @click="$router.push('/businesses')">See all businesses</b-button>
    </div>
  </template>
  
  <script>
  import InfiniteSlideBar from 'vue-infinite-slide-bar'
  import SearchService from "../sub/SearchService.vue"
  import localData from '../../shared/services/localData'
  export default {
    components: { InfiniteSlideBar,SearchService },
    data() {
      return {
        row1: [],
        row2:[],
        defaultText:'We are skilled and professional service provider, dedicated to delivering expertise and precision in every project. With years of experience and a passion for excellence, we bring your visions to life. Count on us for quality craftsmanship and unmatched dedication.'
      }
    },
    created() {
      this.get()
    },

    methods: {
      get() {
        axios.get("business-page/latest").then((res) => {
          if(res.data.length>3){
            for(let i=0;i<3;i++){
              this.row1.push(res.data[i]);
            }
            for(let i=3;i<res.data.length;i++){
              this.row2.push(res.data[i]);
            }
          }else{
            this.row1 = res.data;
          }
        });
      },
      bookNow(b){
        localData.save("emp_id", b.id);
        this.$bvModal.show('search-post');
      }
    }
  }
  </script>
  <style scoped lang="scss">
 

  .card:hover {
    box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%) !important;
  }
  
 
  </style>
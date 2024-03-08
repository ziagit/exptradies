<template>
  <div class="service-slider">
    <infinite-slide-bar duration="100s" delay="10s">
      <div class="items" v-if="services">
        <div v-for="(service, index) in services.data" :key="index">
          <b-card no-body class="overflow-hidden  ">
            <b-row no-gutters>
              <b-col md="12" lg="12" sm="12">
                <b-card-body :title="service.name">
                  <b-card-text >
                    <div v-if="service.details" v-html="service.details.substring(0,100)+'...'"></div>
                    <div v-else >No move details provided.</div>

                    <div class="pb-2">
                    <b-button variant="link" @click="bookNow(service)">Book now</b-button>
                  </div>
                  </b-card-text>
                </b-card-body>
              </b-col>
            </b-row>
          </b-card>
        </div>
      </div>
    </infinite-slide-bar>
  </div>
</template>

<script>
import InfiniteSlideBar from 'vue-infinite-slide-bar'
import localData from '../../shared/services/localData'
export default {
  components: { InfiniteSlideBar },
  data() {
    return {
      services: null
    }
  },
  created() {
    this.get()
  },
  methods: {
    get(page=1) {
      axios.get("services-page?page="+page).then((res) => {
        this.services = res.data;
      });
    },
    bookNow(service){
      localData.save("service", service);
      this.$router.push("/post");
    }
  }
}
</script>
<style scoped>
.card {
  width: 350px;
  height: 200px;
  margin: 20px;
}



.items {
  display: flex;
  justify-content: space-around;
}
.d-in-phone{
  display: none;
}
@media only screen and (max-width: 769px) {
  .d-in-phone {
    display: block !important;
    position: absolute;
    right:5px;
    bottom: 5px;
  }
}
</style>
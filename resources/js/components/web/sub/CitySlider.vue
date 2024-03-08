<template>
  <div>
    <infinite-slide-bar duration="1000s" direction="reverse" delay="10s">
      <div class="items">
        <div v-for="(city, index) in cities" :key="index">
          <b-card no-body class="overflow-hidden  ">
            <b-row no-gutters>
              <b-col md="6">
                <b-card-img src="https://picsum.photos/400/400/?image=20" alt="Image" class="rounded-0" width="50">
                </b-card-img>
              </b-col>
              <b-col md="6">
                <b-card-body :title="city.name">
                  <b-card-text>
                   {{city.details}}
                    <div class="pb-2">
                    <b-button variant="link" @click="Select(city)">Select</b-button>
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
      cities: []
    }
  },
  created() {
    this.get()
  },
  methods: {
    get() {
      axios.get("cities-page").then((res) => {
        this.cities = res.data;
      });
    },
    select(city){
      localData.save("city", city);
      this.$router.push("/cities");
    }
  }
}
</script>
<style scoped>
.card {
  max-width: 540px;
  max-height: 200px;
  margin: 20px;
}

.card:hover {
  box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%) !important;
}

.items {
  display: flex;
  justify-content: space-around;
}
</style>
<template>
  <div class="service-slider">
    <infinite-slide-bar duration="100s" delay="10s"  direction="reverse">
      <div class="items">
        <div v-for="(post, index) in posts" :key="index">
          <b-card no-body class="overflow-hidden">
            <b-row no-gutters>
              <b-col md="12" lg="12" sm="12">
                <b-card-body>
                  <div class="text-secondary service" >{{ post.service.name.toUpperCase() }}</div>
                    <div class="d-flex mb-2">
                      <b-avatar :style="{background: randomBackground()}" id="avatar" :text="post.employee?post.employee.first_name.substring(0,2):'EX'"></b-avatar>
                      <div>
                        <h5 class="mb-0" v-if="post.employee">{{  post.employee.first_name }}</h5>
                        <div class="text-secondary address" v-if="post.address">{{ post.address.city }}, {{ post.address.state }}</div>
                      </div>
                    </div>
                  <b-card-text >
                    <div>
                      <span v-if="post.note.length>100">{{ post.note.substring(0,100) }}...</span>
                      <span v-else>{{ post.note }}</span>
                    </div>
                  </b-card-text>
                  <div class="text-secondary posted-at"> Posted {{ getDays(post.created_at) }} days ago</div>
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
export default {
  components: { InfiniteSlideBar },
  data() {
    return {
      posts: [],
    }
  },
  created() {
    this.get()
  },
  methods: {
    get() {
      axios.get("posts/latest").then((res) => {
        this.posts = res.data;
      });
    },
    
    getDays(date){
      let date_1 = new Date(date);
      let date_2 = new Date();
      let difference = date_2.getTime() - date_1.getTime();
      let totalDays = Math.ceil(difference / (1000 * 3600 * 24));
      return totalDays;
    },
    randomBackground(){
        let x = Math.floor(Math.random() * 256)
        let y = Math.floor(Math.random() * 256)
        let z = Math.floor(Math.random() * 256)
        let bgColor = `rgb(${x}, ${y}, ${z})`
        return bgColor;
      }
  }
}
</script>
<style scoped lang="scss">
.items {
  display: flex;
  justify-content: space-around;
  .card {
    width: 350px;
    height: 200px;
    margin: 20px;
    .service{
      font-size: 12px;
      margin-bottom: 3px;
    }
    .b-avatar{
      margin-right: 10px;
    }
    .address{
      font-size: 12px;
    }
    .posted-at{
      position: fixed;
      bottom: 35px;
      font-size: 11px;
    }
  }

  .card:hover {
    box-shadow: 0 0.125rem 0.25rem rgb(0 0 0 / 8%) !important;
  }
}




</style>
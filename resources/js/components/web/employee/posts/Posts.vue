<template>
  <div>
    <b-modal id="modal-image" hide-backdrop hide-header hide-footer content-class="shadow" title="Item Image">
      <b-img :src="'/storage/images/posts/' + imageToView" fluid alt="Item Image"></b-img>
    </b-modal>
    <b-modal
      id="search-post"
      hide-header hide-footer
      v-on:ok="$router.push('/post/location')"
    >
    <SearchService ref="searchBox"/>
    </b-modal>

    <div class="d-flex justify-content-between mb-2">
      <h3>Posts</h3>
      <b-button v-b-modal.search-post variant="outline-primary" class="px-3">Post a new job</b-button>
    </div>
    <div class="my-3" >
          <b-form-input placeholder="Search..." type="search" v-model="keywords"></b-form-input>
      </div> 
      <div v-if="posts">
        <div v-for="(post, index) in posts.data" :key="index">
              <b-card  class="text-left shadow-none mb-1">
                <b-badge :variant="post.status=='active'?'success':'danger'" >{{ post.status }}</b-badge>
                <ul>
                    <li class="row">
                      <p class="col-6"><b>{{post.service.name}}</b></p>
                    </li>
                    <li class="row">
                      <p class="col-6"><b>Created at:</b> </p><p class="col-6">{{ buildDate(post.created_at) }}</p>
                    </li>
                    <li class="row">
                      <p class="col-6"><b>Address:</b> </p><p class="col-6">{{ post.address.formatted_address }}</p>
                    </li>
                    <li class="row">
                      <p class="col-6"><b>post description:</b> </p><p class="col-6">{{ post.note }}</p>
                    </li>
                </ul>
                <div class="text-right">
                  <b-button  variant="light" @click="$router.push('/employee/posts/'+post.id)">Details</b-button>
                </div>
              </b-card>
          </div>
      </div>
    <div v-else>
      <b-spinner variant="primary"></b-spinner>
    </div>
    <Toaster ref="toaster" />
    <pagination v-if="posts" :limit="4" :data="posts" @pagination-change-page="get"></pagination>
  </div>
</template>
<script>
import axios from "axios";
import formatter from "../../../shared/services/dateFormatter";
import Toaster from "../../sub/Toaster.vue";
import { mapActions, mapGetters } from "vuex";
import SearchService from "../../sub/SearchService.vue"
export default {
  components: {
    Toaster,SearchService
  },
  data: () => ({
    posts: null,
    steps: [],
    isSubmitting: false,
    togal: false,
    imageToView:null,
    postId:null,
    keywords:null,

  }),
  watch: {
      keywords(after, before) {
        this.search();
      },
    },
  created() {
    this.get();
  },
  methods: {
    search() {
        axios
          .get("employee/posts/search", {
            params: {
              keywords: this.keywords,
            },
          })
          .then((res) => {
            this.posts = res.data;
          })
          .catch((err) => {
            console.log(err);
          });
      },
    get(page=1) {
      axios
        .get("employee/posts?page="+page)
        .then((res) => {
          this.posts = res.data;
        })
        .catch((err) => console.log(err));
    },
    
    buildDate(date) {
      return formatter.format(date);
    },
   
    ...mapActions({
      chat: "shared/chat",
    }),
  },
};
</script>

<style scoped lang="scss">
.badge {
  position: absolute;
  top: 10px;
  right: 10px;
}

ul {
  padding-left: 16px;

  li {
    list-style-type: none;
  }
}
</style>

<template>
     <div class="px-3 py-1">
        <b-img :src="imageUrl(post)" fluid thumbnail></b-img> 
        <div v-if="post!=null">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
              <div><strong>{{ post.service.name }}</strong></div>
              <small>{{ formatDate(post.created_at) }}</small>
            </div>
            <b-button class="mt-4" variant="outline-primary" @click="accept()">Accept</b-button>
          </div>
          <table >
            <tr>
              <td>Business: </td>
              <td>{{ post.employee.business_name}}</td>
            </tr>
            <tr>
              <td>Location: </td>
              <td>{{ post.address.city }}</td>
            </tr>
            <tr v-for="(st,index) in steps" :key="index">
              <td>{{ st.qus }} </td>
              <td>{{ st.ans }}</td>
            </tr>
          </table>
          <b-card-text class="mt-4 mb-4">
            {{post.note}}
          </b-card-text>
          <a class="" v-bind:href="
              'https://www.google.com/maps/place/' +
              post.address.city
            " target="_blank">View on Google Maps</a>
        </div>
      </div>
</template>

<script>
import dateFormatter from "../shared/services/dateFormatter";
import { mapGetters } from "vuex";
export default{
    props:['post','steps'],
    computed: {
      ...mapGetters({
        authenticated: "auth/authenticated",
        user: "auth/user",
      }),
    },
    methods:{
      accept(){
        if(this.authenticated && this.user.role.name == "Employee"){
          this.$router.push("/employee/leads");
          return;
        }
        this.$router.push("/signin")
      },
      formatDate(date){
        return dateFormatter.format(date);
      },
      imageUrl(post){
        if(post==null) return;
        if(post.service.image){
          return '/storage/images/services/' + post.service.image;
        }else{
          return "/images/placeholder.png";
        }
      }
    }
}
</script>
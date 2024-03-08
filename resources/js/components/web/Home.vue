<template>
  <div>
    <b-sidebar v-model="isSidebarOpen" backdrop shadow no-header variant="light">
      <Menue v-on:togal-menu="isSidebarOpen=!isSidebarOpen"/>
    </b-sidebar>
    <router-view v-on:togal-menu="isSidebarOpen = true"></router-view>
    <div v-if="canHide()" class="chat-bot">
      <ChatBot ></ChatBot>
    </div>
</div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex';
import Menue from "./employee/Menu.vue"
import ChatBot from "../shared/chat/ChatBot.vue";
export default{
    components: { Menue,ChatBot },
    data: () => ({
      isSidebarOpen: false,
    }),
    computed: {
      ...mapGetters({
        authenticated: "auth/authenticated",
        user: "auth/user"
      })
    },
    methods: {
      canHide(){
        if(this.$router.currentRoute.name!='help'){
          return false;
        }
        if(this.authenticated){
          if(this.user.role.name == 'Guest'){
            return true;
          }
          return false;
        }
        return true;
      },  
      whichUser(role) {
        if (this.authenticated)
          return role == this.user.role.name ? true : false;
      },
    }
}
</script>

<style lang="scss" scoped>
@import "../../../sass/common.scss";
  .chat-bot{
    position: fixed;
    bottom: 10px;
    right: 10px;
  }
</style>
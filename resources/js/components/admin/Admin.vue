<template>
  <div>
    <div class="head in-phone-no-padding">
      <div class="d-flex justify-content-between p-3">
        <div class="d-flex justify-content-between">
          <b-button variant="light" v-b-toggle.sidebar-1>
            <b-icon icon="list"></b-icon>
          </b-button>
          <h2 class="mb-0 ml-3 d-flex align-items-center">Exptradies</h2>
        </div>
        <b-spinner v-if="isSubmitting" />
        <div v-else  class="d-flex">
          <b-button variant="light" @click="signOut()"> Log out </b-button>
          <NotificationBell/>
        </div>
      </div>

      <b-sidebar id="sidebar-1" title="Exptradies" backdrop  >
        <template #default="{ hide=isMenuVisible }">
          <div class="p-3">
            <nav class="mb-3">
              <b-nav vertical>
                <b-nav-item href="#" @click="togalMenu('/admin/dashboard')">Dashboard</b-nav-item>
                <b-nav-item href="#" @click="openChat('/admin/chat')">Chat room</b-nav-item>
                <b-nav-item href="#" @click="togalMenu('/admin/company')">Company details</b-nav-item>
                <div class="border-top my-3" v-if="authenticated && user.role.name=='Admin'"></div>
                <b-nav-item  v-if="authenticated && user.role.name=='Admin'" href="#" @click="togalMenu('/admin/payments')">Payments</b-nav-item>
                <b-nav-item  v-if="authenticated && user.role.name=='Admin'" href="#" @click="togalMenu('/admin/reports')">Reports</b-nav-item>
                <div class="border-top my-3"></div>
                <b-nav-item href="#" @click="togalMenu('/admin/service-types')">Service types</b-nav-item>
                <b-nav-item href="#" @click="togalMenu('/admin/services')">Services</b-nav-item>
                <b-nav-item href="#" @click="togalMenu('/admin/employees')">Businesses</b-nav-item>
                <b-nav-item href="#" @click="togalMenu('/admin/posts')">Jobs</b-nav-item>
                <b-nav-item v-if="authenticated && user.role.name=='Admin'" href="#" @click="togalMenu('/admin/users')">Users</b-nav-item>
                <div class="border-top my-3"></div>
                <!-- <b-nav-item href="#" @click="togalMenu('/admin/blog')">Blog</b-nav-item> -->
                <b-nav-item href="#" @click="togalMenu('/admin/cities')">Cities</b-nav-item>
                <b-nav-item href="#" @click="togalMenu('/admin/faq')">Faq</b-nav-item>
                <b-nav-item href="#" @click="togalMenu('/admin/privacy')">Privacy</b-nav-item>
                <b-nav-item href="#" @click="togalMenu('/admin/terms')">Terms</b-nav-item>
                <div class="border-top my-3" v-if="authenticated && user.role.name=='Admin'"></div>
                <b-nav-item v-if="authenticated && user.role.name=='Admin'" href="#" @click="togalMenu('/admin/settings/backups')">Database backup</b-nav-item>
              </b-nav>
            </nav>
          </div>
        </template>
      </b-sidebar>
    </div>
    <div class="container">
      <router-view></router-view>
    </div>

  </div>
</template>
<script>
import NotificationBell from "../web/sub/NotificationBell.vue";
import { mapGetters, mapActions } from "vuex";
export default {
  name: "Admin",
  components:{
    NotificationBell,
  },
  data: () => ({
    isSubmitting: false,
    isMenuVisible:false,
  }),
  created() { },
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },

  methods: {
    ...mapActions({
      signOutAction: "auth/signOut",
      setNotification: "shared/setNotification",
    }),
    openChat() {
      this.$router.push({
        name: "admin-chatroom",
        params: { listener: null }
      })
    },
    togalMenu(path){
      this.$router.push(path);
      this.isMenuVisible=false;
    },  
    signOut() {
      this.isSubmitting = true;
      this.signOutAction().then(() => {
        this.isSubmitting = false;
        this.$router.push("/");
      });
    },
    
    togal() {
      this.subMenuTogal = !this.subMenuTogal;
    },
  },
};
</script>
<style lang="scss" scoped>
.head {
  padding: 18px 40px;
}

.container {
  height: calc(100vh - 50px);
}
.nav-item,.nav-link{
  color: black !important;
}
.nav-link:hover{
  font-weight: 500 !important;
}

</style> 
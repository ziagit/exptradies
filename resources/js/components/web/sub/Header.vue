<template>
  <div class="header ">
    <b-navbar variant="faded" class="d-flex justify-content-between fixed-nav in-phone-no-padding"
      :class="{ customShadow: isScrollEnd }">
      <!-- horizontal menu -->
      <b-navbar-brand class="mr-5  d-flex">
        <div class="brand">
          <b-button class="mr-3" v-if="isLogedIn()" variant="light" @click="$emit('togal-menu')">
            <b-icon icon="list"></b-icon>
          </b-button>
          <img :src="'/images/home/logo_text.png'" class="d-inline-block align-top hover-pointer ml-2" alt="aTradies" width="140"
            @click="$router.push('/')" />
        </div>
      </b-navbar-brand>

      <b-navbar-nav  class="large-size">
        <b-nav-item @click="$router.push('/')" class="h5 mr-1 ml-4 mb-0 nav-custom"> <span v-bind:class="{
          active: $route.name == 'home'
        }">Home</span>
        </b-nav-item>

        <b-nav-item class="h5 mr-1 ml-4 mb-0 nav-custom" id="category-link"> <span v-bind:class="{
          active: $route.name == 'category'
        }">Category <b-icon icon="caret-down" font-scale="0.9"></b-icon></span>
        </b-nav-item>
        <b-popover 
          target="category-link" 
          triggers="hover" 
          placement="top"
          custom-class="category-popover">
          <CategoryMenu />
        </b-popover>

        <b-nav-item @click="$router.push('/about')" class="h5 mr-1 ml-4 mb-0 nav-custom"> <span v-bind:class="{
          active: $route.name == 'about'
        }">About</span>
        </b-nav-item>

        <b-nav-item @click="$router.push('/help')" class="h5 mr-1 ml-4 mb-0 nav-custom"><span v-bind:class="{
          active: $route.name == 'help'
        }">Help</span></b-nav-item>

         <b-nav-item v-if="isLogedIn()"  @click="signOut()" class="h5 mr-1 ml-4 mb-0 nav-custom"><span v-bind:class="{
          active: $route.name == 'signin'
        }">Logout</span></b-nav-item>
        <b-nav-item v-else @click="$router.push('/signin')" class="h5 mr-1 ml-4 mb-0 nav-custom"><span v-bind:class="{
          active: $route.name == 'signin'
        }">Login</span></b-nav-item>

        <b-nav-item v-if="!isLogedIn() || (isLogedIn() && user.role.name != 'Employee')">
          <b-button variant="outline-primary" pill size="lg" class="my-2 my-sm-0 pt-2 pl-4 pr-4 become-trad" type="submit"
              @click="$router.push('/become-employee')">New business</b-button>
        </b-nav-item>

        <NotificationBell v-if="isLogedIn()"/>
      </b-navbar-nav>

      <b-navbar-nav  class="large-size small-size">
        <NotificationBell v-if="isLogedIn()"/>
        <b-button variant="light" @click="togal()">
          <b-icon v-if="subMenuTogal" icon="x"></b-icon>
          <b-icon v-else icon="list"></b-icon>
        </b-button>
      </b-navbar-nav>
    </b-navbar>

    <transition name="slide">
      <div class="sub-menu" v-show="subMenuTogal">
        <b-list-group>
          <b-list-group-item @click="$router.push('/')" class="  h5 nav-custom"><span v-bind:class="{
            active: $route.name == 'home'
          }">Home</span></b-list-group-item>
        <b-list-group-item class="h5 mb-0 nav-custom" @click="mobileSubMenuToggal=!mobileSubMenuToggal"> <span v-bind:class="{
          active: $route.name == 'category'
        }">Category <b-icon icon="caret-down" font-scale="0.9"></b-icon></span>
        </b-list-group-item>
          <CategoryMenu v-show="mobileSubMenuToggal"/> 
          <b-list-group-item @click="$router.push('/about')" class="h5 nav-custom"><span v-bind:class="{
            active: $route.name == 'about'
          }">About</span></b-list-group-item>

          <b-list-group-item @click="$router.push('/help')" class="h5 nav-custom"><span v-bind:class="{
            active: $route.name == 'help'
          }">Help</span>
          </b-list-group-item>

          <b-list-group-item v-if="isLogedIn()"  @click="signOut()" class="h5 nav-custom">Logout
          </b-list-group-item>
          <b-list-group-item v-else @click="$router.push('/signin')" class="h5 nav-custom">Login
          </b-list-group-item>
          
          <b-list-group-item class="h5"  v-if="!isLogedIn() || (isLogedIn() && user.role.name != 'Employee')">
            <b-button variant="outline-primary" pill size="lg" class="my-2 my-sm-0 pt-2 pl-4 pr-4 become-trad" type="submit"
              @click="$router.push('/become-employee')">New business</b-button>
          </b-list-group-item>

        </b-list-group>
      </div>
    </transition>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import NotificationBell from "./NotificationBell.vue";
import CategoryMenu from "./CategoryMenu.vue";
export default {
  name: "Headder",
  components:{ NotificationBell, CategoryMenu },
  props: ["scrollValue"],
  data: () => ({
    subMenuTogal: false,
    isSubmitting: false,
    isScrollEnd: false,
    mobileSubMenuToggal:false,
  }),
  watch: {
    scrollValue: function (newVal, oldVal) {
      if (newVal > 2) {
        this.isScrollEnd = true;
      } else {
        this.isScrollEnd = false;
      }
    },
  },
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },
  created() {
  },
  methods: {
    ...mapActions({
      signOutAction: "auth/signOut",
      setNotification: "shared/setNotification",
    }),
    isLogedIn(){
      if(this.authenticated && this.user.role.name != 'Guest'){
        return true;
      }
      return false;
    },
    
    signOut() {
      this.isSubmitting = true;
      this.signOutAction().then(() => {
        this.isSubmitting = false;
        this.$router.push("/");
      });
      this.subMenuTogal=false;
    },
    togal() {
      this.subMenuTogal = !this.subMenuTogal;
    },
    
  },
};
</script>

<style lang="scss">
.category-popover{
  max-width: 1000px !important;
}
.slide-enter-active {
  -moz-transition-duration: 0.3s;
  -webkit-transition-duration: 0.3s;
  -o-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -moz-transition-timing-function: ease-in;
  -webkit-transition-timing-function: ease-in;
  -o-transition-timing-function: ease-in;
  transition-timing-function: ease-in;
}

.slide-leave-active {
  -moz-transition-duration: 0.3s;
  -webkit-transition-duration: 0.3s;
  -o-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -moz-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
  -webkit-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
  -o-transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
  transition-timing-function: cubic-bezier(0, 1, 0.5, 1);
}

.slide-enter-to,
.slide-leave {
  max-height: 400px;
  overflow: hidden;
}

.slide-enter,
.slide-leave-to {
  overflow: hidden;
  max-height: 0;
}

a {
  font-family: "futura-medium", system-ui, "Helvetica Neue", sans-serif !important;
}

.header {
  .brand {
    display: flex;
    justify-content: space-between;
    align-items: center;

    span {
      font-size: 23px;
      font-family: "futura-bold", system-ui, "Helvetica Neue", sans-serif !important;
    }
  }

  .brand-text {
    color: #54575a;
  }

  .brand-text:hover {
    cursor: pointer;
  }

  .fixed-nav {
    width: 100%;
    top: 0;
    left: 0;
    padding: 18px;
  }

  .small-size {
    display: none;
  }

  .customShadow {
    box-shadow: 0 10px 28px 0 rgb(0 0 0 / 5%);
  }

  img:hover {
    cursor: pointer;
  }

  .menu {
    z-index: 90;
  }

  .nav-custom {
    a {
      color: #4c4f52 !important;
      font-family: "futura-medium", system-ui, "Helvetica Neue", sans-serif !important;
    }
  }

  .sub-menu {
    .list-group-item {
      font-weight: 600 !important;
    }
    .list-group-item:hover {
      background: #ddd;
      cursor: pointer;
    }
    .mobileSubMenuToggal{
      display: block;
    }
  }
li{
  display: flex;
  align-items: center;
}
  .active {
    color: #999;
  }
.bell:hover{
  opacity: 0.7;
  cursor: pointer;

}
  @media only screen and (max-width: 949px) {
    .large-size {
      display: none !important;
    }

    .small-size {
      display: flex !important;
    }

    .customShadow {
      box-shadow: none !important;
    }

    .sub-menu {
      position: absolute;
      top: 70px;
      background: white;
      width: 100%;
      padding: 25px;
      z-index: 99;
      box-shadow: 0 10px 28px 0 rgb(0 0 0 / 5%);

      ul {
        display: flex;
        flex-direction: column;
        list-style: none;
        padding: 0;
      }
    }

    .brand-text {
      font-size: 24px !important;
    }
  }
}
</style>

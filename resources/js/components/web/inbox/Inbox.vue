<template>
  <div class="notification" :class="{ container: $route.path == '/customer/inbox' }">
    <b-card sub-title="Notifications" class=" mt-5 text-left">
      <div v-if="notifications.length == 0">
        There is no notification available yet.
      </div>

      <b-button v-b-toggle.sidebar-right class="mobile-menu" variant="light">
        <b-icon icon="three-dots-vertical"></b-icon>
      </b-button>

      <b-sidebar id="sidebar-right" title="Sidebar" right>
        <template #footer="{ hide }">
          <div class="d-flex bg-dark text-light align-items-center px-3 py-2">
            <b-button variant="dark" size="sm" @click="hide">Close</b-button>
          </div>
        </template>
        <div class="px-3 py-2">
          <List :notifications="notifications" />
        </div>
      </b-sidebar>

      <div class="row" v-if="notifications.length > 0">
        <div class="menu col-3">
          <List :notifications="notifications" />
        </div>
        <div class="content col-9">
          <Details :notification="selectedNot" v-if="isOpened" />
          <div v-else>
            <h3>Notifications</h3>
            <br>
            <p>Open a notification from the list.</p>
          </div>
        </div>
      </div>
    </b-card>
  </div>
</template>
<script>
import axios from "axios";
import List from "./List.vue";
import Details from "./Details.vue";
import { mapGetters, mapActions } from "vuex";
import browserPermission from "../../shared/services/browserPermission";
export default {
  components: {
    List, Details,
  },
  data: () => ({
    selectedNot: null,
    notifications: [],
    isOpened: false
  }),
  created() {
    this.get();
  },
  computed: {
    ...mapGetters({
      getNotification: 'shared/notification'
    })
  },
  watch: {
    getNotification(val, oldVal) {
      this.get()
    }
  },
  methods: {
    ...mapActions({
      setNot: "shared/notification"
    }),
    get() {
      axios.get("auth/notifications").then(res => {
        this.notifications = res.data;
      }).catch(err => {
        console.log(err.response)
      })
    },

    details(not) {
      this.selectedNot = not;
      this.read(not.id);
    },
    read(id) {
      axios.get('auth/notifications/' + id).then(res => {
        this.isOpened = true;
        this.get()
        this.updateBell();
      }).catch(err => {
        console.log(err.response)
      })
    },
    updateBell(id) {
      setTimeout(() => {
        var unread = this.notifications.filter((item) => item.pivot.read_at == null);
        this.setNot(unread);
      }, 4000)
    },
    askPermission() {
      browserPermission.askNotificationPermission(this);
    }
  },
};
</script>
<style lang="scss" scoped>
.menu {
  border-right: 1px solid #ddd;
  max-height: 600px;
  overflow-y: scroll;
}

.mobile-menu {
  display: none;
}
</style>

<template>
  <b-card class="  mt-0">
    <b-list-group>
      <b-list-group-item
        class="  d-flex align-items-center"
        button
        v-for="(room, index) in rooms"
        :key="index"
        @click="select(room)"
      >
        <b-avatar class="mr-5 avatar"></b-avatar>
        <div
          v-if="room.user_id == user.id"
          class="d-flex align-items-center justify-content-between w-100"
        >
          <span class="mr-auto"> {{ room.user.name }}</span>
          <span class="time">{{ time(room.created_at) }}</span>
        </div>
        <div
          v-else
          class="d-flex align-items-center justify-content-between w-100"
        >
          <span v-bind:class="{ active: $route.params.id == room.id }">
            {{ room.name }}</span
          >
          <span class="time">{{ time(room.created_at) }}</span>
        </div>
      </b-list-group-item>
    </b-list-group>
  </b-card>
</template>

<script>
import formatter from "../services/formatter";
export default {
  props: ["rooms", "currentRoom"],
  data: function () {
    return {
      selected: "",
      username: "",
      room: "",
      user: null,
    };
  },
  methods: {
    select(room) {
      this.selected = room;
      this.$emit("roomchanged", this.selected);
    },
    time(date) {
      return formatter.formatDate(date);
    },
  },
  created() {
    this.selected = this.currentRoom;
    this.user = JSON.parse(localStorage.getItem("user"));
  },
};
</script>
<style scoped>
.card {
  width: 300px;
  height: calc(100vh - 90px);
  margin-top: 4px;
}
.avatar {
  background: #dfe5e7;
  color: white;
  margin-right: 4px !important;
}

.time {
  font-size: 9px;
  color: #827d7d;
}
.active {
  font-weight: 600;
}
</style>
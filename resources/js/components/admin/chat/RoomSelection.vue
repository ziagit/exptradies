<template>
    <b-card class="custom-height  mt-0">
        <div class="user-count py-1 mb-1"> Users in line: <span class="ml-2">{{ usersInLine }}</span></div>
        <b-list-group>
            <b-list-group-item class="  flex-column align-items-start"
                               button
                               v-for="(room, index) in rooms"
                               :class="[room.status === 'Active' ? 'isActive' : 'inActive']"
                               :key="index"
                               @click="select(room)">
                <!-- <b-avatar class="mr-2 avatar"></b-avatar> -->

                <div v-if="room.user_id == user.id"
                     class="d-flex w-100 justify-content-between">
                    <p class="mb-1" :class="[room && room.status == 'Active' ?  'extra-bold-font': 'medium-font' ]">{{ room.name }}</p>
                    <small class="right-0">{{ time(room.created_at) }}</small>
                </div>

                <div v-else
                     class="d-flex w-100 justify-content-between">
                    <p class="mb-1 "
                       :class="[room && room.isNew ?  'extra-bold-font': 'medium-font' ]"> {{ room.name }}</p>
                    <small class="right-0">{{ time(room.created_at) }}</small>
                </div>
                <small v-if="room.user_id == user.id">{{ room.creator_user.roles[0].name }}</small>
                <small v-else>talking with {{ room.user.roles[0].name }}</small>
            </b-list-group-item>
        </b-list-group>
    </b-card>
</template>
<script>
import formatter from "../../shared/services/formatter";
import { mapGetters } from "vuex";
export default {
    props: ["rooms", "currentRoom"],
    data: function () {
        return {
            selected: "",
            username: "",
            room: "",
            usersInLine: 0
        };
    },
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
        })
    },
    methods: {
        select (selectedRoom) {
            this.selected = selectedRoom;
            this.selected.isNew = false;
            const roomIndex = this.rooms.findIndex(room => room.id === selectedRoom.id)
            this.rooms[roomIndex].isNew = false;
            this.$emit("roomchanged", this.selected);
        },
        time (date) {
            return formatter.formatTime(date, false);
        },
        getUsersInline(){
            axios
                .get(`admin/rooms/waiting`)
                .then(res => {
                    this.usersInLine = res.data.length
                })
                .catch(err => console.log(err.response));
        }
    },
    created () {
        this.selected = this.currentRoom;
        this.getUsersInline();
    }
};
</script>
<style scoped lang="scss">
.card-header {
    background-color: #8ab4f9;
}

.card {
    width: 300px;
    margin-top: 4px;
    overflow-y: scroll;
    min-height: calc(100vh - 263px) !important;
}

.avatar {
    background: #dfe5e7;
    color: white;
    margin-right: 4px;
}

.time {
    font-size: 10px;
    color: #827d7d;
}

.isActive {
    // background-color: #f8f9fa !important;
    color: #000 !important
}
.inActive{
    color: #999 !important
}
.right-0{
    position: absolute;
    right: 10px;
}
.custom-height{
    height: 75vh !important;
    overflow-y: scroll;
    overflow-x: hidden;
}
.user-count{
    text-align: center;
    background: #d4e5fd91;
    border: 1px dashed #999;
    font-size: 0.8rem;
}
</style>

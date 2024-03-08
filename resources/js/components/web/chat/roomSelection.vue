<template>
    <b-card class="mt-0">

        <div class="w-100 text-center mb-3" v-if="!hasActive">
            <b-button  variant="outline-dark" pill type="submit"
                        @click="createNewRoom()"> Start new chat
                    </b-button>
        </div>
        <b-list-group>
            <b-list-group-item v-for="(room, index) in rooms"
                               class="  flex-column align-items-left"
                               :class="[['Active', 'Waiting'].includes(room.status) ? 'isActive' : 'inActive', room.id == currentRoom.id ? 'isActive' :'']"
                            button
                               :key="index"
                               @click="select(room)">
                <div v-if="room.user_id == user.id"
                     class="d-flex justify-content-between w-100"
                     :class="{ 'gray-color': room.status == 'Inactive' }">
                    <p class="mb-1"  :class="[room && room.isNew ?  'extra-bold-font': 'medium-font' ]">{{ room.name }}</p>
                    <small class="right-0">{{ time(room.created_at) }}</small>
                </div>
                <div v-else
                     class="d-flex justify-content-between w-100">
                    <p v-if="room.user.roles[0].name !== 'support'"
                        class="mb-1" :class="[room && room.isNew ?  'extra-bold-font': 'medium-font' ]">
                        {{ room.user.name }}
                    </p>
                    <p v-else
                        class="mb-1" :class="[room && room.isNew ?  'extra-bold-font': 'medium-font' ]">Support</p>
                    <small class="right-0">{{ time(room.created_at) }}</small>
                </div>
            </b-list-group-item>
        </b-list-group>
    </b-card>
</template>

<script>
import formatter from "../../shared/services/formatter";
import { mapActions, mapGetters } from "vuex";
import axios from 'axios';
export default {
    props: ["rooms", "currentRoom", "hasActive"],
    data: function () {
        return {
            selected: "",
            room: ""
        };
    },
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user",
            chat: "shared/chat",
        })
    },
    methods: {
        ...mapActions({
            setRoom: "shared/room",
            removeRome: "shared/removeRome"
        }),
        createNewRoom(){
            axios
            .post("chat/room", {
                    listener: this.chat.listener
                })
                .then(res => {
                    if (res.status == 201 || res.status == 200) {
                        console.log(res.data);
                        this.removeRome();
                        const createdRoom = {
                            'id': res.data.id,
                            'name': res.data.name,
                            'created_at': res.data.created_at,
                            'creator': res.data.creator,
                            'status': res.data.status,
                            'updated_at': res.data.updated_at,
                            'user_name': res.data.user.name,
                            'user_id': res.data.user_id,
                            'user_avatar': res.data.user.avatar,
                        };
                        this.setRoom(createdRoom);
                         this.$emit("newRoom");
                         this.$emit("roomchanged", createdRoom);
                    }
                })
                .catch(error => console.log(error));
        },
        select (selectedRoom) {
            this.selected = selectedRoom;
            this.selected.isNew = false;
            const roomIndex = this.rooms.findIndex(room => room.id === selectedRoom.id)
            this.rooms[roomIndex].isNew = false;
            this.$emit("roomchanged", this.selected);
        },
        time (date) {
            return formatter.formatTime(date, false);
        }
    },
    created () {
        this.selected = this.currentRoom;
    }
};
</script>
<style scoped>
.card {
    width: 300px;
    height: 100%;
    overflow-y: auto;
    margin-top: 4px;
}

.avatar {
    background: #dfe5e7;
    color: white;
    margin-right: 4px !important;
}

.time {
    font-size: 12px;
    color: #827d7d;
}

.active {
    font-weight: 600;
}

.isActive {
    color: #000 !important
}
.inActive{
    color: #999 !important
}

.inActive {
    color: #8d9090 !important;
}

.gray-color {
    color: #9d9a9a !important;
}
.right-0{
    position: absolute;
    right: 10px;
}
</style>
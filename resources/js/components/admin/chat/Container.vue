<template>
    <div class="chat chat-container">
        <div v-if="chatRooms.length > 0" class="d-flex">
            <div
                :class="[isRoomSelected ? 'in-phone-d-none' : 'in-phone-room']"
            >
                <room-selection
                    :rooms="chatRooms"
                    :currentRoom="currentRoom"
                    v-on:roomchanged="setRoom($event)"
                />
            </div>
            <div
                class="w-100 px-0 pt-0"
                :class="[
                    !isRoomSelected ? 'in-phone-d-none' : 'in-phone-message'
                ]"
            >
                <div class="d-none in-phone-display">
                    <h6 class="text-center d-none in-phone-display">
                        {{
                            currentRoom.user_id == user.id
                                ? currentRoom.name
                                : (currentRoom.user ?currentRoom.user.name : '')
                        }}
                    </h6>
                    <div class="text-left in-phone-message-back">
                        <b-button
                            variant="light"
                            @click="isRoomSelected = !isRoomSelected"
                        >
                            <b-icon icon="arrow-left"></b-icon>
                        </b-button>
                    </div>
                </div>
                <b-card class=" h-100 in-phone-h-95"  v-if="hasActive || (currentRoom && currentRoom.id)">
                    
                    <message-container :messages="messages" :room="currentRoom" :isLoading="isLoading && ['Active', 'Waiting'].includes(currentRoom.status)" />
                    <input-message
                        v-if="user && user.role.name !== 'admin' && currentRoom.status === 'Active'"
                        :room="currentRoom"
                        v-on:messagesent="loadMessages()"
                    />


                    <div class="close-chat" :class="{ transparent: !showCloseDialog }">
                        <div class="text-center" :class="{ 'close-chat-dialog': showCloseDialog }">
                            <p class="medium-font">Are you sue you want to end the chat?</p>
                            <b-button
                                variant="danger"
                                pill
                                type="button"
                                @click="inActiveRoom()"
                                >End Chat
                            </b-button>
                            <p class="hover-pointer" @click="showCloseDialog = false">Cancel</p>
                        </div>
                    </div>
                    <div class="head-icons" v-if="hasActive">
                        <b-icon icon="x" @click="showCloseDialog = true"></b-icon>
                    </div>
                   
               
                </b-card>
                <div class="d-flex justify-content-center align-items-center text-center"  v-else> 
                    <p class="w-50">There is no active chat available.</p>
                </div>
            </div>
        </div>
        <div v-else class="text-center mt-5 mb-5">
            <b-spinner variant="warning" type="grow"></b-spinner>
        </div>
    </div>
</template>
<script>
import MessageContainer from "./MessageContainer.vue";
import InputMessage from "./InputMessage.vue";
import RoomSelection from "./RoomSelection.vue";
import { mapGetters } from "vuex";
import { EchoService } from "../../shared/services/echoService";
export default {
    components: {
        MessageContainer,
        InputMessage,
        RoomSelection
    },
    data: function() {
        return {
            chatRooms: [],
            hasActive: false,
            showCloseDialog: false,
            isRoomCreated: false,
            isLoading: false,
            currentRoom: [],
            messages: [],
            isRoomSelected: false
        };
    },

    watch: {
        getNotification(val, oldVal) {
            this.getRooms();
        },
        currentRoom(val, oldVal) {
            if (oldVal.id) {
                this.disconnect(oldVal);
            }
            this.connect();
        }
    },
    created() {
        this.getRooms();
    },
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user",
            rm: "shared/room",
            getNotification: "shared/notification"
        })
    },
    methods: {
        inActiveRoom() {
            axios
                .get(`chat/in-active/room/${this.currentRoom.id}`)
                .then(res => {
                    this.getRooms();
                    this.currentRoom.status = 'Inactive'
                    this.showCloseDialog = false;
                    this.hasActive = false;
                    this.removeRome();
                    
                    
                })
                .catch(err => console.log(err.response));
        },
        connect() {
            let vm = this;
            this.getMessages();
            EchoService.listen(
                "chat." + this.currentRoom.id,
                ".chat-event",
                e => {
                    this.isLoading = true;
                    setTimeout(() => {
                        vm.getMessages();
                    }, 2000);
                }
            );

            EchoService.listen("room." + this.user.id, ".room-event", e => {
                vm.getRooms();
            });
        },

        disconnect(room) {
            window.Echo.leave("chat." + room.id);
        },
        getRooms() {
            this.hasActive = false; 
            axios
                .get("admin/rooms?isSupport=true")
                .then(res => {
                   
                        res.data.forEach(room => {
                            console.log('has active is true',room.status)
                            if(room.status === 'Active'){
                                this.hasActive = true
                                this.setRoom(room)
                            }
                            let found = false;
                            this.chatRooms.forEach(chatRoom => {
                                if (room.id === chatRoom.id) {
                                    found = true;
                                }
                            });
                            if (!found) {
                                room.isNew = true;
                                this.chatRooms.unshift(room);
                            }
                        });
                   
                })
                .catch(error => {
                    console.log(error);
                });
        },

        setRoom(room) {
            this.currentRoom = room;
            this.isRoomSelected = true;
        },
        getMessages() {
            axios
                .get("admin/room/" + this.currentRoom.id + "/messages")
                .then(res => {
                    this.isLoading = false;
                    if (res.data.length === 1 && this.currentRoom.status == 'Active') {
                        setTimeout(() => {
                            axios
                                .post(
                                    "admin/room/" +
                                        this.currentRoom.id +
                                        "/message",
                                    {
                                        message: "What can we help you with?"
                                    }
                                )
                                .then(response => {
                                    if (response.status == 200) {
                                        this.getMessages();
                                    }
                                })
                                .catch(error => {
                                    console.log(error);
                                });
                        }, 3000);
                    }
                    this.messages = res.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        loadMessages(){
            axios
                .get("admin/room/" + this.currentRoom.id + "/messages").then(res => {
                    this.messages = res.data;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    beforeDestroy() {
        this.disconnect(this.currentRoom);
    }
};
</script>


<style scoped lang="scss">
    @import "../../../../sass/variables.scss";

.transparent {
    z-index: -1 !important;
    background: transparent !important;
}

.head-icons {
    position: absolute;
    top: 5px;
    right: 10px;
    font-size: 24px !important;
    padding: 0 10px;
    background: #fff;

    .b-icon:hover {
        cursor: pointer;
        color: $indigo;
    }
}

.close-chat {
    background: #95949433;
    position: absolute;
    width: 100%;
    height: 100%;
    margin: 0 auto;
    bottom: 0;
    left: 0;
    z-index: 100;
    overflow: hidden;
     transition-duration: 0.8s;
        transition-timing-function: ease-in-out;
        transition-property: z-index;

    > div {
        width: 100%;
        height: 0%;
        transition-duration: 0.2s;
        transition-timing-function: ease-in;
        transition-property: height;
        overflow: hidden;
        position: absolute;
        background: #fff;
        bottom: 0
    }
    .close-chat-dialog {
        
        height: 35%;
        
        
        .btn{
            margin-bottom: 0 !important;
            min-height: 62px;
            padding: 0px 32px;
            font-family: "Outfit-bold", system-ui, "Helvetica Neue", sans-serif !important;
        }
        >p{
            font-size: 20px !important;
            margin-top: 15px !important;
        }
        .hover-pointer:hover{
            cursor: pointer;
        }
        .medium-font{
            margin-top: 30px !important;
        }
        // box-shadow: 1px 1px 10px 1px #ccc;
    }
}
</style>

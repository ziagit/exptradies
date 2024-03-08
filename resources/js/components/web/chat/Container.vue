<template>

    <div class="chat-container mb-5 chat-container-in-phone">
        <div class="d-flex mb-5 h-100" :class="[]">
            <div class="w-100 d-flex h-90 justify-content-center" :class="[
                !isRoomSelected ? '' : 'in-phone-message'
            ]">
                <room-selection 
                :class="[isRoomSelected ? 'in-phone-d-none' : '']"
                :rooms="chatRooms" :currentRoom="currentRoom" :hasActive="hasActive" v-if="!(
                (chat.route === 'Employee' && chat && chat.post) ||
                (chat && chat.order))" v-on:roomchanged="setRoom($event)" v-on:newRoom="getRooms()" />
                <div class="in-phone-display">
                    <div class="text-left w-70 in-phone-message-back" v-if="
                        (chat.route === 'Employee' && chat && chat.post) ||
                        (chat && chat.order)
                    ">
                        <b-button variant="light" @click="back()">
                            <b-icon icon="arrow-left"></b-icon>
                        </b-button>
                    </div>
                </div>
                <b-card class="h-custom" v-if="hasActive || (currentRoom && currentRoom.id)" :class="[
                !isRoomSelected ? 'in-phone-d-none' : '']">
                    <message-container :room="currentRoom" :messages="messages"
                        :isLoading="isLoading && ['Active', 'Waiting'].includes(currentRoom.status)" />
                    <input-message :room="currentRoom" v-on:messagesent="loadMessages()" />

                    <!-- <div class="close-chat" :class="{ transparent: !showCloseDialog }">
                        <div class="text-center" :class="{ 'close-chat-dialog': showCloseDialog }">
                            <p class="medium-font">Are you sue you want to end the chat?</p>
                            <b-button variant="danger" pill type="button" @click="inActiveRoom()">End Chat
                            </b-button>
                            <p class="hover-pointer" @click="showCloseDialog = false">Cancel</p>
                        </div>
                    </div>
                    <div class="head-icons" v-if="hasActive && ['Active', 'Waiting'].includes(currentRoom.status) &&
                        !(
                            (chat.route === 'Employee' && chat && chat.post) ||
                            (chat && chat.order))
                    ">
                        <b-icon icon="x" @click="showCloseDialog = true"></b-icon>
                    </div> -->

                </b-card>
                <div class="d-flex in-phone-d-none justify-content-center align-items-center text-center" v-else>
                    <p class="w-50">There is no active chat, if you need support you can always start new chat.</p>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import MessageContainer from "./messageContainer.vue";
import InputMessage from "./inputMessage.vue";
import RoomSelection from "./roomSelection.vue";
import { mapActions, mapGetters } from "vuex";
import { EchoService } from "../../shared/services/echoService";
export default {
    components: {
        MessageContainer,
        InputMessage,
        RoomSelection
    },
    data: function () {
        return {
            chatRooms: [],
            currentRoom: [],
            messages: [],
            isRoomSelected: false,
            showCloseDialog: false,
            isRoomCreated: false,
            isLoading: false,
            hasActive: false
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
    methods: {
        inActiveRoom() {
            axios
                .get(`chat/in-active/room/${this.currentRoom.id}`)
                .then(res => {
                    this.currentRoom = []
                    this.getRooms()
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
                    console.log("event receivved..............");
                    vm.getMessages(true);
                }
            );
        },
        disconnect(room) {
            window.Echo.leave("chat." + room.id);
        },
        getRooms() {
            this.hasActive = false
            axios
                .get("chat/rooms" + (this.chat.listener ? "?listener=" + this.chat.listener : ''))
                .then(response => {
                    console.log("roomes: ", response.data)
                    response.data.forEach(room => {
                        if (['Active', 'Waiting'].includes(room.status)) {
                            this.hasActive = true
                            this.setRoom(room)
                        }
                    });
                    if (!this.hasActive) {
                        this.setRoom([])
                    }
                    this.chatRooms = response.data
                })
                .catch(error => {
                    console.log(error);
                });
        },
        setRoom(room) {
            this.currentRoom = room;
            this.isRoomSelected = true;
        },
        getMessages(doLoading = false) {
            this.isLoading = doLoading;
            axios
                .get("chat/room/" + this.currentRoom.id + "/messages")
                .then(response => {
                    if (response.data.length === 1) {
                        this.isLoading = true;
                    } else if (
                        response.data.length === 2 &&
                        response.data
                            .at(0)
                            .message.includes(
                                "Our supports are busy at the moment, we will get back to you as soon as possible."
                            )
                    ) {
                        this.isLoading = true;
                        setTimeout(() => {
                            this.messages = [response.data.at(1)];
                        }, 1000);
                    }
                    setTimeout(
                        () => {
                            this.messages = response.data;
                            this.isLoading = false;
                        },
                        this.isLoading ? 3000 : 0
                    );
                })
                .catch(error => {
                    console.log(error);
                });
        },
        loadMessages() {
            axios
                .get("chat/room/" + this.currentRoom.id + "/messages").then(response => {
                    this.messages = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        logout() {
            this.roomAction(null);
            this.chatAction(null);
            if (this.user.role.name == "Employee") {
                this.$router.push("/employee");
            } else if (this.user.role.name == "Employer") {
                this.$router.push("/employer");
            } else {
                this.$router.push("/");
            }
        },
        back() {
            this.$router.push(
                this.chat.route === 'employer'
                    ? '/employer/posts' 
                    : '/employee/posts')
        },
        beforeDestroy() {
            this.disconnect(this.currentRoom);
        },
        ...mapActions({
            roomAction: "shared/room",
            chatAction: "shared/chat",
            signOutAction: "auth/signOut",
            removeRome: "shared/removeRome"
        })
    },

    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user",
            room: "shared/room",
            chat: "shared/chat",
            getNotification: "shared/notification"
        })
    },
    created() {
        this.getRooms();
    }
};
</script>
<style scoped lang="scss">
@import "../../../../sass/variables.scss";

.chat-container {
    height: 75vh;
    width: 100%;
    margin: auto;
}

.navbar {
    padding-right: 30px;
    padding-left: 30px;
}

.active {
    font-weight: 600;
}

.h-custom {
    padding: 20px 10px;
    width: 75%;
}

.h-90 {
    height: 90% !important;
}

.w-70 {
    width: 70%;
    margin: auto;
}

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

    >div {
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

        height: 40%;


        .btn {
            margin-bottom: 0 !important;
            min-height: 62px;
            padding: 0px 32px;
            font-family: "Outfit-bold", system-ui, "Helvetica Neue", sans-serif !important;
        }

        >p {
            font-size: 20px !important;
            margin-top: 15px !important;
        }

        .hover-pointer:hover {
            cursor: pointer;
        }

        .medium-font {
            margin-top: 30px !important;
        }

        // box-shadow: 1px 1px 10px 1px #ccc;
    }
}

@media only screen and (max-width: 400px) {

    .card {
    width: 100% !important;
    }
.head-icons{
    display: flex !important;
    top: 5px;
    left: auto;
    width: 72%;
    height: 2rem;
    align-items: center;
    right: auto;
    justify-content: space-between;
}

}
</style>
<template>
    <div class="msg">
        <message-container :messages="messages" :isLoading="isLoading" :isChatClosed="isChatClosed" />
        <input-message v-if="!isChatClosed" :room="room" v-on:messagesent="getMessages()" />
    </div>
</template>

<script>
import MessageContainer from "./MessageContainer.vue";
import InputMessage from "./InputMessage.vue";
import { mapGetters } from "vuex";
import axios from "axios";
import { EchoService } from "../services/echoService";

export default {
    props: ["isChatClosed"],
    components: {
        MessageContainer,
        InputMessage
    },
    data: () => {
        return {
            messages: [],
            chatRooms: [],
            currentRoom: [],
            isLoading: false
        };
    },
    watch: {
        currentRoom(val, oldVal) {
            if (oldVal && oldVal.id) {
                this.disconnect(oldVal);
            }
            this.connect();
        }
    },
    created() {
        this.setRoom();
    },
    beforeDestroy() {
        this.disconnect(this.room && this.room.id);
    },
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user",
            room: "shared/room"
        })
    },
    methods: {
        setRoom() {
            this.currentRoom = this.room;
        },
        connect() {
            this.getMessages();

            EchoService.listen(
                `chat.${this.room && this.room.id}`,
                ".chat-event",
                e => {
                    console.log("message event: ", e);
                    console.log("this time getting message form event.");
                    this.getMessages(true);
                }
            );
        },
        disconnect(room) {
            window.Echo.leave("chat." + this.room);
        },

        getMessages(doLoading = false) {
            this.isLoading = doLoading;
            if (this.currentRoom && this.currentRoom.id)
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
        }
    }
};
</script>
<style scoped lang="scss">
.msg {
    height: 100%;
}
</style>

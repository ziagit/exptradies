<template>
    <div>
    <div v-if="!canHideButton" clas="live-support">
        <b-button
        :class="{'in-phone-move-out-screen': show}"
            id="popover-button-sync"
            class="chat-button-togal"
            variant="light"
            >
        <b-icon class="chat-icon" icon="chat-fill"></b-icon>
        </b-button>
        <b-popover
            id="live-support"
            target="popover-button-sync"
            placement="topleft"
            :show.sync="show"
            custom-class="shadow  "
            content="Content here "
        >
            <Container v-if="isRoomCreated" :isChatClosed="isChatClosed" />
            <Loading v-else v-on:room-created="createdRoom($event)" :isRoomCreated="isRoomCreated" />

            <div class="close-chat" :class="{ transparent: !showCloseDialog }">
                <div class="text-center" :class="{ 'close-chat-dialog': showCloseDialog }">
                    <p class="medium-font">Are you sue you want to end the chat?</p>
                    <b-button
                        class="px-4 py-3"
                        variant="danger"
                        pill
                        type="button"
                        @click="inActiveRoom()"
                        >End Chat
                    </b-button>
                    <p class="hover-pointer" @click="showCloseDialog = false">Cancel</p>
                </div>
            </div>
            <div class="head-icons">
                <b-icon icon="x" @click="isChatClosed ? closeChatSilently() : (show = !show)"></b-icon>
                <!-- <b-icon icon="x" @click="isChatClosed ? closeChatSilently() : (showCloseDialog = true)"></b-icon> -->
            </div>
        </b-popover>
    </div>
</div>
</template>
<script>
import Container from "./Container.vue";
import Loading from "./Loading.vue";
import { mapActions, mapGetters } from "vuex";
import axios from "axios";
import { EchoService } from '../services/echoService';

export default {
    components: {
        Container,
        Loading
    },
    data() {
        return {
            show: false,
            showCloseDialog: false,
            isRoomCreated: false,
            canHideButton: false,
            isChatClosed: false,
            roomId: null
        };
    },
    mounted() {
        this.checkForCurrentRoute();
    },
    created(){
        this.isChatClosed = false;
    },
    watch: {
        $route: {
            deep: true,
            handler(to, from) {
                this.checkForCurrentRoute();
            }
        }
    },
    computed: {
        ...mapGetters({
            user: "auth/user"
        })
    },
    methods: {
        ...mapActions({
            signOutAction: "auth/signOut",
            clean: "shared/clean"
        }),
        closeChatSilently(){
            this.close();
            this.showCloseDialog = false;
            this.isChatClosed = false;
            this.clean();
        },
        close() {
            this.isRoomCreated = false;
            this.show = !this.show;
        },
        createdRoom(id) {
            if (id) {
                this.isRoomCreated = true;
                this.roomId = id;
                EchoService.listen("notification." + this.user.id, ".notification-event", (e) => {
                    this.clean();
                    this.isChatClosed = true;
                });
            }
        },
        inActiveRoom() {
            axios
                .get(`chat/in-active/room/${this.roomId}`)
                .then(res => {
                    this.close();
                    this.showCloseDialog = false;
                    this.clean();
                })
                .catch(err => console.log(err.response));
        },
        checkForCurrentRoute() {
            this.canHideButton = [
                "password",
                "signin",
                "password-forget",
                "verify",
                "password-reset",
                "social-login",
                "employee-room",
                "employer-room"
            ].includes(this.$route.name);
            if (
                this.user?.role[0]?.name === "customer" ||
                this.user?.role[0]?.name === "mover"
            ) {
                this.canHideButton = true;
                if (this.$route.name === "help") {
                    this.canHideButton = false;
                }
            }
        }
    }
};
</script>
<style scoped lang="scss">
@import "../../../../sass/variables";
@import "../../../../sass/common.scss";

.chat-button-togal{
    background: #fff;
    box-shadow: 0 3px 1px -2px rgb(0 0 0 / 20%), 0 2px 2px 0 rgb(0 0 0 / 14%);
    height:58px;
    width: 58px;
    border: none !important;
    border-radius: 100%;
    .chat-icon{
        transform: scaleX(-0.9);
        font-size: 24px !important;
    }
}

.popover {
    width: 80% !important;
    height: 450px !important;
    max-width: 400px !important;
    border-radius: 5% 5% 0 5%;
  
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

    .content {
        height: 100% !important;
        overflow-y: auto;
    }

    .footer {
        position: absolute;
        bottom: 10px;
        width: 92%;

        .btn-sm {
            height: 38px;
            width: 38px;

            .b-icon {
                transform: rotate(45deg);
            }
        }

        .btn-sm:hover {
            height: 38px;
            width: 38px;
        }
    }
}

.btn:hover {
    color: $indigo !important;
}
.transparent {
    z-index: -1 !important;
    background: transparent !important;
}

.close-chat {
    background: #95949433;
    position: relative;
    width: 107%;
    height: 104%;
    margin: 0 auto;
    bottom: 102%;
    left: -13.5px;
    border-bottom-left-radius: 5%;
    border-top-right-radius: 5%;
    border-top-left-radius: 5%;
    z-index: 100;
    overflow: hidden;
     transition-duration: 0.8s;
        transition-timing-function: ease-in-out;
        transition-property: z-index;

    > div {
        width: 99%;
        height: 0%;
        transition-duration: 0.2s;
        transition-timing-function: ease-in;
        transition-property: height;
        overflow: hidden;
        position: absolute;
        bottom: -3px;
        left: 1px;
        background: #fff;
    }
    .close-chat-dialog {
        
        height: 50%;
        
        
        .btn{
            margin-bottom: 0 !important
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

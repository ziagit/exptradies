<template>
    <div class="d-flex align-items-center">
        <b-navbar-nav class="notification-bell">
            <b-nav-item @click="open()" id="notification-toltip">
                <b-button variant="light" class="bell-btn"><b-icon icon="bell" variant="secondary"/> <div v-if="getNot && getNot.length > 0" class="red-dot"></div></b-button>
            </b-nav-item>
        </b-navbar-nav>
        <b-tooltip target="notification-toltip" triggers="hover" variant="dark">
            You have <b v-if="getNot">{{ getNot.length }}</b> unread notifications in your inbox!
        </b-tooltip>
    </div>
</template>
<script>

import { mapGetters, mapActions } from "vuex";
import { EchoService } from "../../shared/services/echoService";
export default {
    data() {
        return {
            notifications: [],
            soundurl: '/mp3/notification-sound.mp3'
        };
    },
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user",
            getNot: 'shared/notification',
            chat: 'shared/chat'
        })
    },
    created() {
        this.get();
    },
    mounted() {
        this.connect();
    },
    methods: {
        ...mapActions({
            setNot: "shared/notification"
        }),
        connect() {
            EchoService.listen("notification." + this.user.id, ".notification-event", (e) => {
                console.log("Event fired: ",e)
                if (!this.isChatOpened(e)) {
                    if(!this.checkIfDuplicate(e)){
                        this.notifications.push(e)
                        this.setNot(this.notifications)
                        this.playSound();
                    };
                }
            });
        },
        disconnect(id) {
            window.Echo.leave("notification." + id);
        },
        checkIfDuplicate(e){
            if(e.type!="sms"){
                return false;
            }
            let isFound=false;
            let sr=JSON.stringify([e.fromUser,e.toUser]);
            this.notifications.forEach(el=>{
                if(el.fromUser===e.fromUser && el.toUser===e.toUser){
                    isFound = true;
                    return;
                }
                if(el.room_ids===sr && el.pivot.read_at===null){
                    isFound = true;
                    return;
                }
            })
            return isFound;
        },
        get() {
            axios.get("auth/unread/notifications").then(res => {
                this.notifications = res.data
                this.setNot(this.notifications)
            });
        },
        beforeDestroy() {
            this.disconnect(this.user.id);
        },
        playSound() {
            var audio = new Audio(this.soundurl);
            audio.play();
        },
        open() {
            switch (this.user.role.name) {
                case "Employee": this.$router.push('/employee/inbox');
                    break;
                case "Employer": this.$router.push('/employer/inbox');
                    break;
                case "Support": this.$router.push("/admin/inbox");
                    break;
                case "Admin": this.$router.push("/admin/inbox");
                    break;
                default: console.log("route not found");
            }
        },
        isChatOpened(event) {
            if (this.$router.history.current.path == '/admin/chatroom' || this.$router.history.current.path == '/mover/chat/room' || this.$router.history.current.path == '/customer/chat/room') {
                if (event.type == 'sms') {
                    if (event.fromUser == this.chat.listener) {
                        return true;
                    }
                    return false;
                }
                return false;
            }
            return false;
        }
    }
};
</script>
<style scoped lang="scss">
.bell-btn{
    background: #fff;
    box-shadow: 0 3px 5px 0 rgba(100,100,111,.2)!important;
    border: none!important;
    position: relative;
}
.bell-btn:hover{
    box-shadow: none !important;
}
.red-dot{
    background: #007bff;
    position: absolute;
    left: 36px;
    bottom: -5px;
    width: 13px;
    height: 13px;
    border-radius: 100%;
    border: solid 2px #fff;
}
</style>
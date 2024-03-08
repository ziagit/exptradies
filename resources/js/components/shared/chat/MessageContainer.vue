<template>
    <div class="msg-container h-full p-2 flex flex-col-reverse overflow-auto">
        <div v-if="isLoading">
            <TypingLoader />
        </div>
        <div v-if="isChatClosed">
            <p class="text-center mt-4 my-4 t2 chat-closed">This chat is ended, if you still need help, please contact us again.</p>
            <p class="text-center">{{ (new Date()).toLocaleString()}}</p>
        </div>
        <div v-for="(message, index) in messages" :key="index">
            <message-item :message="message" :me="myId" />
        </div>
        
    </div>
</template>

<script>
import MessageItem from "./MessageItem.vue";
import TypingLoader from "./TypingLoader.vue";
import { mapActions, mapGetters } from "vuex";
export default {
    components: {
        MessageItem,
        TypingLoader
    },
    props: ["messages", "isLoading", 'isChatClosed'],
    data: function () {
        return {
            myId: null
        };
    },
    watch: {
        isChatClosed(val, oldVal) {
            if(val){
                console.log(val, '%%%%%%%%%%%%%% getting the closed room')
            }
            
        }
    },
    created() {
        console.log("msg container:‌", this.user);
        this.myId = this.user.id;
    },
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
        })
    }
};
</script>
<style scoped>
.msg-container {
    height: 88%;
    display: flex;
    width: 100%;
    flex-direction: column-reverse;
    overflow: auto;
    padding: 8px;
}
.chat-closed{
    border: 1px solid #f98a95;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 5px !important;
}
</style>

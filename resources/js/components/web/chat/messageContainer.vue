<template>
    <div class="custom-height d-flex">
        <div class="msg-container h-full p-2 flex flex-col-reverse overflow-auto">
            <div v-if="isLoading">
                <TypingLoader />
            </div>
            <div v-if="room.status === 'Inactive'">
                <p class="text-center mt-4 my-4 t2 chat-closed">This chat is ended, if you still need help, please contact us again.</p>
                <p class="text-center">{{ (new Date(room.updated_at)).toLocaleString()}}</p>
            </div>
            <div v-for="(message, index) in messages" :key="index">
                <message-item :message="message" :me="myId" />
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import MessageItem from "./messageItem.vue";
import  TypingLoader  from '../../shared/chat/TypingLoader.vue'
export default {
    components: {
        MessageItem,
        TypingLoader
    },
    props: ["messages", "isLoading", "room"],
    data: function () {
        return {
            myId: null
        };
    },
    created() {
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
.container {
    display: flex;
    background: #fff;
    width: 100% !important;
    min-height: calc(100vh - 350px) !important;
}

.msg-container {
    display: flex;
    width: 100%;
    flex-direction: column-reverse;
    overflow: auto;
    padding: 8px;
}
.custom-height{
    height: 93% !important;
}
.chat-closed{
    border: 1px solid #f98a95;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 5px !important;
}
</style>

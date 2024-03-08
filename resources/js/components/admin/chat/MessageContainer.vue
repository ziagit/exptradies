<template>
    <div class="container in-phone-height">
        <div class="msg-container h-full p-2 flex flex-col-reverse overflow-auto">
            <div v-if="room.status === 'Inactive'">
                <p class="text-center mt-4 my-4 t2 chat-closed">This chat is ended on <span class="fs-16">{{ (new Date(room.updated_at)).toLocaleString()}}</span>.</p>
            </div>
            <div v-if="isLoading">
                <TypingLoader />
            </div>
            <div v-for="(message, index) in messages" :key="index">
                <message-item :isAdmin="user.role.name === 'admin'" :message="message" :me="user.id" :iDs="messages" />
            </div>
        </div>
    </div>
</template>

<script>
import MessageItem from "./MssageItem.vue";
import { mapGetters } from "vuex";
import  TypingLoader  from '../../shared/chat/TypingLoader.vue'
export default {
    components: {
        MessageItem,
        TypingLoader
    },
    props: ["messages",  "room", "isLoading"],
    data: function () {
        return {
            firstId: null,
        }
    },
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user",
        }),
    },
};
</script>
<style scoped lang="scss">
.container {
    min-height: 90% !important;
    display: flex;
    background: #fff;
    width: 100% !important;
}

.msg-container {
    display: flex;
    width: 100%;
    flex-direction: column-reverse;
    overflow: auto;
    padding: 8px;
    max-height: 60vh;
}
.chat-closed{
    border: 1px solid #f98a95;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 5px !important;
    .fs-16{
        font-size: 16px !important;
    }
}
</style>

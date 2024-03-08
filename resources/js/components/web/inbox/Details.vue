<template>
    <div>
        <h3 class="mb-5">{{ notification.title }}</h3>

        <div v-if="notification.type == 'sms'">
            <div v-if="user.role.name == 'Employer'" class="mb-5">
                <p>You have a new message from <b>{{ sr[0] }}</b>, open the chat to see the message.</p>
                <b-button variant="outline-primary" class="px-3" pill
                    @click="openChat('employer', notification.room_ids[1], '/employer/chat/loading/room')">Open chat
                </b-button>
            </div>
            <div v-else-if="user.role.name == 'Employee'" class="mb-5">
                <p>You have a new message from <b>{{ sr[0] }}</b>, open the chat to see the message.</p>
                <b-button variant="outline-primary" class="px-3" pill
                    @click="openChat('employee', notification.room_ids[1], '/employee/chat/loading/room')">Open chat
                </b-button>
            </div>
            <div v-else class="mb-5">
                <p>{{ sr[0] }} sent a new message to {{ sr[1] }}</p>
                <b-button variant="outline-primary" class="px-3" pill
                    @click="openChat('admin', notification.room_ids[1], '/admin/chatroom')">
                    Open chat</b-button>
            </div>
        </div>

        <div v-if="notification.type == 'post'">
            <div v-if="user.role.name == 'Employee'">
                <div v-if="notification.title == 'New job'" class="my-5">
                    <p>A new <b>{{ sr[0] }}</b> job posted in your local area <a href="#" @click="readMore('/employee/leads/'+notification.post_id)"><b>View</b></a> for more details.</p>
                </div>
                <div v-if="notification.title == 'Job accepted'" class="my-5">
                    <p>Business <b>{{ sr }}</b> has been accepted your post <a href="#" @click="readMore('/employee/posts/'+notification.post_id)"><b>View</b></a> for more details.</p>
                </div>
                <div v-if="notification.title == 'Job closed'" class="my-5">
                    <p>Job with title <b>{{ sr[0] }}</b> has been closed, no forther action required.
                    </p>
                </div>
            </div>
            
            <div v-else>
                <div v-if="notification.title == 'New job'" class="my-5">
                    <p>A new <b>{{ sr[0] }}</b> job posted by <b>{{ sr[1] }}</b> <a href="#" @click="readMore('/admin/posts/'+notification.post_id)"><b>View</b></a> for more details.</p>
                </div>
                <div v-if="notification.title == 'Job accepted'" class="my-5">
                    <p>Business <b>{{ sr[1] }}</b> has been accepted a job <a href="#" @click="readMore('/admin/posts/'+notification.post_id)"><b>View</b></a> for more details.</p>
                </div>
                <div v-if="notification.title == 'Job closed'" class="my-5">
                    <p>Job with title <b>{{ sr[0] }} </b>has been closed, no forther action required.</p>
                </div>
            </div>
        </div>
        <div v-if="notification.type == 'balance'">
            <div v-if="user.role.name == 'Employee'" class="my-5">
                <p>Your balance added successfuly. To see your balance, click the <strong>view</strong> button.</p>
                <b-button variant="outline-primary" class="px-3" pill @click="readMore('/employee/payment-methods')">View
                </b-button>
            </div>
            <div v-else class="my-5">
                <p>A new payment is processed successfully. for more details, click the <strong>view</strong> button.
                </p>
                <b-button variant="outline-primary" class="px-3" pill
                    @click="readMore('/admin/payments')">View
                </b-button>
            </div>
        </div>

        <div v-if="notification.type == 'payment'">
            <div v-if="user.role.name == 'Employee'" class="my-5">
                <p>Your payment is processed successfully. for more details, click the <strong>view</strong> button.</p>
                <b-button variant="outline-primary" class="px-3" pill @click="readMore('/employee/payment-methods')">View
                </b-button>
            </div>
            <div v-else class="my-5">
                <p>A new payment is processed successfully. for more details, click the <strong>view</strong> button.
                </p>
                <b-button variant="outline-primary" class="px-3" pill
                    @click="readMore('/admin/payments')">View
                </b-button>
            </div>
        </div>

        <div v-if="notification.type == 'refund'">
            <div v-if="user.role.name == 'Employee'" class="my-5">
                <p>Your refunded is processed successfully. for more details, click the <strong>view</strong> button.
                </p>
                <b-button variant="outline-primary" class="px-3" pill
                    @click="readMore('/employee/payment-methods')">View</b-button>
            </div>
            <div v-else class="my-5">
                <p>A new refund is processed successfully. for more details, click the <strong>view</strong> button.</p>
                <b-button variant="outline-primary" class="px-3" pill @click="readMore('/admin/payments')">View</b-button>
            </div>
        </div>
    </div>
</template>
<script>
import dateFormatter from "../../shared/services/dateFormatter";
import { mapGetters, mapActions } from "vuex";
import localData from "../../shared/services/localData";
export default {
    props: ['notification'],
    data: () => ({
        sr: null,
    }),
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user",
        }),
    },
    created() {
        console.log("notificaion: ", this.notification)
        this.sr = JSON.parse(this.notification.body)
    },
    methods: {
        ...mapActions({
            chat: "shared/chat",
        }),
        format(date) {
            return dateFormatter.format(date);
        },
        
        readMore(path) {
            this.$router.push(path)
        },

        openChat(route, id, path) {
            this.chat({ route: route, listener: JSON.parse(id) });
            this.$router.push({
                path: path,
            })
        },
        rebook(postId) {
            localData.save("old-post", postId)
            this.$router.push("/order/locations")
        },

    },
};
</script>
<style lang="scss" scoped>
.selected {
    background: #ffa60017;
}

.not-id {
    width: 100px;
    word-break: keep-all;
    display: inline-block;
    overflow: hidden;
}
</style>

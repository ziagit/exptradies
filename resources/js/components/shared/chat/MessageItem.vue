<template>
    <div class="message-item-container">
        <div
            v-bind:class="[
                message.user_id === me || message.user_id === anonymousId
                    ? 'my-sms'
                    : 'frind-sms'
            ]"
        >
            <div class="msg">{{ message.message }}</div>
            <div class="time-container">
                <!--        <b-icon-->
                <!--          v-if="message.user_id == me"-->
                <!--          icon="check-all"-->
                <!--          variant="primary"-->
                <!--        ></b-icon>-->
            </div>
        </div>
        <span
            class="d-none time mx-3 show-time"
            :class="[message.user_id === me ? 'float-right' : '']"
            >{{ time(message.created_at) }}</span
        >
    </div>
</template>

<script>
import formatter from "../services/formatter";

export default {
    props: ["message", "me"],
    data: () => ({
        anonymousId: +localStorage.getItem("anonymousId")
    }),
    methods: {
        time(date) {
            return formatter.formatTime(date);
        }
    }
};
</script>
<style scoped>
.my-sms {
    float: right;
    background-color: #8ab4f95c;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    border-bottom-left-radius: 10px;
    margin-bottom: 5px;
    display: inline-block;
    padding: 0.3rem 0.6rem;
    font-size: 14px;
    -webkit-box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.15);
    -moz-box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.15);
    box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.15);
}

.msg {
    font-size: 16px !important;
    font-family: "Outfit-regular", system-ui, "Helvetica Neue", sans-serif !important;
}

.float-right {
    float: right;
    margin-top: 10px;
}

.frind-sms {
    background-color: #bbbbbb2e;
    border-bottom-left-radius: 10px;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    margin-bottom: 5px;
    display: inline-block;
    padding: 0.3rem 0.6rem;
    font-size: 14px;
    -webkit-box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.15);
    -moz-box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.15);
    box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.15);
}
.message-item-container:hover .show-time {
    display: inline-block !important;
}

.time-container {
    text-align: right;
}

.time {
    font-size: 9px;
    color: #827d7d;
}
</style>

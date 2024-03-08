<template>
  <div class="message-item-container">
    <div v-bind:class="[message.user_id == me ? 'my-sms' : 'frind-sms']">
      <div class="msg" v-if="isText(message.message)">{{ message.message }}</div>
      <img v-else @click="viewImage(message.message)"  :src="'/storage/images/chat/' + message.message" width="50  " />
      <div class="time-container">
        <!---<span class="time">{{ time(message.created_at) }}</span>-->
        <!-- <b-icon v-if="message.user_id == me" icon="check-all" variant="primary"></b-icon> -->
      </div>
    </div>
    <span
        class="d-none time mx-3 show-time"
        :class="[message.user_id === me ? 'float-right' : '']"
        >{{ time(message.created_at) }}</span>

  </div>
</template>

<script>
import formatter from '../../shared/services/formatter';
export default {
  props: ["message", "me"],
  data:()=>({
    extensions:['.jpg','.jpeg','.png'],
  }),
  methods: {
    time(date) {
      return formatter.formatTime(date);
    },
    isText(str){
      if (this.extensions.some(v => str.includes(v))) {
         return false;
      }
      return true;
    },
    viewImage(name){
      var msgWindow = window.open('','width=500,height=700,top=100,right=100,scrollbars=yes');
      msgWindow.document.body.innerHTML = `<img src="https://exptradies.com/storage/images/chat/${name}"></img>`;
    },
  },
};
</script>
<style scoped>
img:hover{
  cursor: pointer;
}
.my-sms {
  float: right;
  background-color: #8ab4f95c;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  border-bottom-left-radius: 10px;
  margin-bottom: 5px;
  display: inline-block;
  padding: 3px 6px;
  font-size: 14px;
  -webkit-box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.15);
  box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.15);
}

.frind-sms {
  background-color: white;
  border-bottom-left-radius: 10px;
  border-top-right-radius: 10px;
  border-bottom-right-radius: 10px;
  margin-bottom: 5px;
  display: inline-block;
  padding: 3px 6px;
  font-size: 14px;
  -webkit-box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.15);
  -moz-box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.15);
  box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.15);
}

.msg {
    font-size: 16px !important;
    font-family: "Outfit-regular", system-ui, "Helvetica Neue", sans-serif !important;
}

.time-container {
  text-align: right;
}

.message-item-container:hover .show-time {
    display: inline-block !important;
    margin-top: 10px !important;
}

.time {
  font-size: 9px;
  color: #827d7d;
}
</style>

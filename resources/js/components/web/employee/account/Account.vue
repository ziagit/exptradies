<template>
    <div class="mb-3">
        <b-card title="Account " class="text-left shadow-none  ">
            <div class="row ml-1 mb-2">
                <div class="w-100 mr-3">
                    <EditAvatar v-if="avatarTogal" :user="user" />
                    <Avatar v-else :user="user" />
                </div>
            </div>
            <EditAccount v-if="accountTogal" :user="user" />
            <div v-else>
                <div class="row mb-2">
                    <div class="col-4">
                        Email:
                    </div>
                    <div class="col-8">
                        {{ user.email }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        Phone:
                    </div>
                    <div class="col-8">
                        {{ user.phone }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        Password:
                    </div>
                    <div class="col-8">
                        ********
                    </div>
                </div>
                <div class="text-right mt-5">
                    <b-button variant="light" @click="accountTogal = !accountTogal">Edit</b-button>
                </div>
            </div>

        </b-card>
    </div>
</template>
  <script >
import Avatar from './Avatar.vue';
import EditAvatar from './EditAvatar.vue';
import EditAccount from './EditAccount.vue';
export default {
    props:['user'],
    components: { Avatar, EditAvatar, EditAccount },
    data: () => ({
        avatarTogal: false,
        accountTogal: false,
    }),
    methods: {
        changeAvatar() {
            this.avatarTogal = !this.avatarTogal
        },
        get(){
            this.$parent.get();
            this.accountTogal=false;
        }
    }


};
</script>
  <style scoped>
  ul li {
      list-style-type: none;
  }
  </style>
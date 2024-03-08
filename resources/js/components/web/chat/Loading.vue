<template>
    <div class=" d-flex align-items-center justify-content-center">
        <b-button variant="light">
            <b-spinner variant="warning" type="grow"></b-spinner>
        </b-button>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import axios from "axios";
export default {
    data: () => ({
        isLoading: true
    }),
    created() {
        this.isLoading = false;
        if (this.chat.listener) {
            this.createRoom()
        } else {
            this.$router.push({
                name: this.chat.route + "-room"
            });
        }
    },

    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user",
            chat: "shared/chat"
        })
    },
    methods: {
        ...mapActions({
            room: "shared/room"
        }),

        createRoom() {
            axios
                .post("chat/room", {
                    listener: this.chat.listener
                })
                .then(res => {
                    if (res.status == 201 || res.status == 200) {
                        this.isLoading = false;
                        this.$router.push({
                            name: this.chat.route + "-room"
                        });
                    }
                })
                .catch(error => console.log(error));
        }
    }
};
</script>
<style scoped>
.container {
    height: 100vh;
}
</style>
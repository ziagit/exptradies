<template>
    <div class="loading">
        <b-spinner
            variant="warning"
            type="grow"
        ></b-spinner>
        <Toaster ref="toaster" />
    </div>
</template>
<script>
import axios from "axios";
import { mapActions, mapGetters } from "vuex";
import cookieBuilder from "../services/cookieBuilder";
import clientInfo from "../services/clientInfo";
import Toaster from "../../web/sub/Toaster.vue";

export default {
    props: ["isRoomCreated"],
    components: {
        Toaster
    },
    data: () => ({
        isSubmitting: false,
        form: {
            name: null,
            email: null,
            password: "123",
            me: null
        }
    }),
    created() {
        this.submit();
    },
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            getRoom: "shared/room"
        })
    },
    methods: {
        ...mapActions({
            signIn: "auth/signIn",
            room: "shared/room"
        }),

        submit() {
            if (this.authenticated) {
                if (this.getRoom === null) {
                    this.createRoom();
                } else {
                    this.$emit("room-created", this.getRoom.id);
                }
                return;
            }

            this.isSubmitting = true;
            var cookie = cookieBuilder.checkCookie("exptradies");
            this.form.email = cookie;
            this.form.name = clientInfo.get();
            axios
                .post("auth/chat/user", this.form)
                .then(res => {
                    if (res.status == 200) {
                        this.form.me = res.data.id;
                        this.signIn(this.form).then(res => {
                            this.createRoom();
                        });
                    }
                })
                .catch(err => console.log(err.response));
        },

        createRoom(listener = null) {
            axios
                .post("chat/room", {
                    listener: listener
                })
                .then(res => {
                    if (res.status == 201 || res.status == 200) {
                        console.log("room created:‌", res.data);
                        this.room({
                            id: res.data.id,
                            name: res.data.name,
                            created_at: res.data.created_at,
                            creator: res.data.creator,
                            status: res.data.status,
                            updated_at: res.data.updated_at,
                            user_name: res.data.user.name,
                            user_id: res.data.user_id,
                            user_avatar: res.data.user.avatar
                        });
                        this.$emit("room-created", res.data.id);
                    }
                })
                .catch(error => console.log(error));
        }
    }
};
</script>
<style scoped lang="scss">
.loading {
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;

    .form {
        width: 94%;
    }
}
</style>

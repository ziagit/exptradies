<template>
    <div class="loading">
        <b-spinner  variant="warning" type="grow"></b-spinner>
    </div>
</template>
<script>
import axios from "axios";
import { mapActions, mapGetters } from "vuex";

export default {
    data: () => ({
        isRoomExist: true
    }),
    created() {
        this.get();
    },
    computed: {
        ...mapGetters({
            getRoom: "shared/room",
            user: "auth/user"
        })
    },

    methods: {
        ...mapActions({
            setRoom: "shared/room"
        }),

        get() {
            axios
                .get("admin/room/" + this.$route.params.listener)
                .then(res => {
                    this.$emit("loaded");
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>

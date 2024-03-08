<template>
    <div>
        <Container v-if="show" />
        <div v-else class="d-flex justify-content-center align-items-center text-center">
            <Loading v-on:loaded="show = !show" />
        </div>
    </div>
</template>
<script>
import Loading from "./Loading.vue";
import Container from "./Container.vue";
import { mapGetters } from "vuex";
import { EchoService } from "../../shared/services/echoService";
export default {
    components: {
        Container,
        Loading
    },
    data() {
        return {
            show: false,
        };
    },
    created(){
        EchoService.listen("notification." + this.user.id, ".notification-event", (e) => {
            this.show = !this.show
        });
    },
    computed: {
        ...mapGetters({
            user: "auth/user",
        })
    },


};
</script>

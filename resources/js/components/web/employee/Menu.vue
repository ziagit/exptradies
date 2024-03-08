<template>
    <div>
        <div v-if="authenticated">
            <div class="text-center mt-4 mb-3">
                <b-avatar class="my-3" button :src="'/images/uploads/profile/' + user.avatar" size="5rem"
                    @click="navigate('/employee/profile')">
                </b-avatar>
                <div  v-if="details">
                    <h3 class="mb-0 fw-bold">{{ details && details.business_name?details.business_name: user.name }}</h3>
                    <b-form-rating
                    id="rating-readonly"
                    :value="details.stars"
                    readonly
                    disabled
                    inline
                    no-border size="sm"
                    ></b-form-rating>
                </div>
            </div>
            <div class="line"></div>
            <b-list-group>
                <b-list-group-item v-for="(m, index) in menuList()" :key="index" class="  fw-bold" button
                    @click="navigate(m.path)">
                    <span v-bind:class="{
                        active: $route.name == m.name
                    }">{{ m.title }}</span>
                </b-list-group-item>
                <b-list-group-item button class="  fw-bold" @click="openChat()">
                    <span class="mb-0" v-bind:class="{
                        active: $route.name == 'employee-chat'
                    }">
                        Support
                    </span>
                </b-list-group-item>

                <b-list-group-item button class="  fw-bold" @click="$router.push('/employee/posts')">
                    <span class="mb-0" v-bind:class="{
                        active: $route.name == 'employee-posts'
                    }">
                        Customer view
                    </span>
                </b-list-group-item>

            </b-list-group>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from 'vuex';
import menu from "../../shared/services/menu"
export default {
    data:()=>({
        details:null,
    }),
    computed: {
        ...mapGetters({
            authenticated: "auth/authenticated",
            user: "auth/user"
        })
    },
    created(){
        this.get()
    },
    methods: {
        ...mapActions({
            signOutAction: "auth/signOut",
            clean: "shared/clean",
            chat: "shared/chat",
        }),
        get() {
            axios
                .get("employee/profile")
                .then((res) => {
                    this.details = res.data;
                })
                .catch((err) => console.log(err.response));
            },
        openChat() {
            this.chat({ route: "employee", listener: null });
            this.$router.push({
                path: "/employee/chat/loading/room",
            })
        },
        navigate(path) {
            this.$router.push(path);
        },
        menuList() {
            return menu.employee()
        },
        formatPhone(phone) {
            return phone;
        },
        signOut() {
            this.signOutAction().then(() => {
                this.$router.push("/");
            });
            this.$emit("closeMenu");
        },
    }
}
</script>
<style>
.fw-bold {
    font-weight: 600 !important;
}
</style>
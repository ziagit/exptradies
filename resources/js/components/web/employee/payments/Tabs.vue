<template>
    <b-tabs class="in-phone-tabs">
        <b-tab title="Balance" :active="activeTab==1">
            <Balance />
        </b-tab>
        <b-tab title="Invoices" :active="activeTab==2">
            <Invoices />
        </b-tab>
        <b-tab title="Refunds" :active="activeTab==3">
            <Refunds />
        </b-tab>
    </b-tabs>
</template>

<script>
import Balance from "./balance/Balance.vue";
import Methods from "./methods/Methods.vue";
import Invoices from "./invoices/Invoices.vue";
import Refunds from "./refunds/Refunds.vue";
export default {
    name: "Tabs",
    components: {
        Balance,
        Methods,
        Invoices,
        Refunds
    },
    data: () => ({
        activeTab:1,
        prevRoute: null
    }),
    beforeRouteEnter(to, from, next) {
        next(vm => {
            vm.prevRoute = from.name
        })
    },
    mounted() {
        if(this.prevRoute=='employee-invoice'){
            this.activeTab=2;
        }
    },
    methods: {}
};
</script>
<style>

</style>

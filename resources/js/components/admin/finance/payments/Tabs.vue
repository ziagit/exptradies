<template>
    <b-card>
        <b-tabs>
            <b-tab title="Earnings" active>
                <Earnings />
            </b-tab>
            <b-tab title="Refunds" >
                <Refunds />
            </b-tab>
        </b-tabs>
    </b-card>
</template>

<script>
import Earnings from "./Earnings.vue";
import Refunds from "./Refunds.vue";
export default {
    name: "Tabs",
    components: {Earnings,Refunds},
};
</script>

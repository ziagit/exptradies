<template>
    <div class="mb-5 pb-5">
        <b-tabs content-class="mt-3">
            <b-tab title="Details" active>
                    <Details/>
                    <Balance/>
                    <Gst />
                    <Job />
            </b-tab>
            <b-tab title="Commissions">
                <Commission/>
            </b-tab>
        </b-tabs>
        <div>
        </div>
    </div>
</template>

<script>
import Gst from "./gst/Gst.vue";
import Details from "./details/Details.vue";
import Commission from "./commission/Commissions.vue";
import Balance from "./balance/Balance.vue";
import Job from "./acceptable-job/Job.vue";
export default{
    components:{
    Commission,
    Balance,
    Details,
    Gst,
    Job
}
}

</script>
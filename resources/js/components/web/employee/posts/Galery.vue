<template>
    <div>
        <div v-if="!galery">
            <b-spinner></b-spinner>
        </div>
        <div v-else>
            <b-card-group columns v-if="galery.length>0">
            <b-card
                class="shadow-none"
                v-for="(gal, index) in galery"
                :key="index"
                :img-src="'/storage/images/galery/' + gal.image"
                img-alt="Image"
                overlay>
            </b-card>
        </b-card-group>
        <div v-else>There is no work to show.</div>
        </div>
    </div>
</template>
<script>
import axios from "axios";

export default{
    props:['emp'],
    data:()=>({
        galery:null,
    }),
    created(){
        this.get();
    },
    methods:{
        get(){
            axios.get('employee/experiences/'+this.emp.id).then(res=>{
                this.galery = res.data;
            }).catch(err=>{
                console.log(err);
            })
        }
    },
}
</script>
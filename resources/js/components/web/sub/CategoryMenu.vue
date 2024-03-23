<template>
       <div class="container">
        <div class="row">
            <div v-for="(category, index) in categorizedServices" :key="index" class="col col-sm-12 col-md-4 col-lg-4">
            <strong>{{ category.name }}</strong>
            <ul>
                <li v-for="(service, serviceIndex) in category.services" :key="serviceIndex">
                <a href="#" @click="openLink(service.id)">{{ service.name }}</a>
                </li>
            </ul>
            </div>
        </div>
       </div>
</template>
<script>
import axios from 'axios';
export default{
    data:()=>({
        categorizedServices: []
    }),
    created(){
        this.get();
    },
    methods:{
        openLink(id){
            this.$router.push('/services/'+id);
        },
        get(){
            axios.get("categories").then(res=>{
                this.categorizeServices(res.data);
            }).catch(err=>console.log(err));
        },
        categorizeServices(services) {
            const categorizedServices = {};
            services.forEach(service => {
                if (!categorizedServices[service.type]) {
                categorizedServices[service.type] = {
                    name: service.type,
                    services: []
                };
                }
                categorizedServices[service.type].services.push(service);
            });
            this.categorizedServices = Object.values(categorizedServices);
        },
    }
}
</script>
<style scoped lang="scss">
.container{
    width: 490px !important;
}
ul{
    margin: 0 !important;
    padding-left: 16px !important;
}
</style>
<template>
    <div>
        <div v-for="(comment,index) in comments" :key="index">
          <strong>{{ comment.name }}</strong>
          <p>{{ comment.comment }}</p>
          <div class="text-right">
            <b-button variant="light" @click="remove(comment.id)">
                <b-icon variant="danger" icon="trash"></b-icon>
            </b-button>
          </div>
          <hr>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default{
    props:['comments'],
    data:()=>({}),
    created(){
        console.log(this.comments);
    },
    methods:{
        remove(id){
            axios.get("admin/blog/comment/"+id).then(res=>{
                console.log("removed comment",res.data);
                this.$emit('close-dialog');
            }).catch(err=>{
                console.log("error: ",err)
            })
        }
    }
}
</script>
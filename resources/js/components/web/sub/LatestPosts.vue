<template>
    <div>
        <div class="row">
          <div class="col col-sm-12 col-md-8 col-lg-8" >
            <b-card-group deck v-if="list1.length>0">
              <b-card v-for="(p, index) in list1" :key="index" style="max-width: 21rem;" class="text-left" :title="p.service.name" img-src="/images/home/tiling-wall.png" img-alt="Image" img-top>
                <b-card-text>
                  {{p.note}}
                </b-card-text>
              </b-card>
            </b-card-group>
            <br>
            <b-card-group deck v-if="list2.length>0">
              <b-card v-for="(p, index) in list1" :key="index" style="max-width: 21rem;" class="text-left" :title="p.service.name" img-src="/images/home/cleaning-floor-man.png" img-alt="Image" img-top>
                <b-card-text>
                  {{p.note}}
                </b-card-text>
              </b-card>
            </b-card-group>
          </div>

          <div class="col col-sm-12 col-md-4 col-lg-4 text-container">
            <div class="mb-5 see-job">
              <strong>See more jobs</strong>
            </div>

            <div class="p-3 text-center">
              <p>
                Unlock the perfect solution for your projects, from timely and professional completion to connecting
with top-notch experts, your search stops here. No task is too small or too big—post any job, repair, or
project, and let Exptradies link you with pros perfectly tailored to your needs. Experience exceptional
results in every task you entrust to us.
              </p>
              <div class="post-job">
               <a href="#post-a-job"><strong>Post a Job</strong></a>
              </div>
            </div>
          </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default{
    data:()=>({
        list1:[],
        list2:[],
    }),
    created(){
        this.get();
    },
    methods:{
        get(){
            axios.get("posts/latest").then(res=>{
                this.list1 = res.data.slice(0, 2);
                this.list2 = res.data.slice(2, 4);
            });
        }
    }
}
</script>

<style scoped lang="scss">
.text-container{
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      .see-job{
        padding: 20px;
        border: solid 1px #ddd;
        height: 100px;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
      }
      .text-center{
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background: #fff;
        padding: 10px;
      }
      .post-job{
        background: blue;
        color: #ddd;
        width: 100%;
        height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
      }
    }
</style>
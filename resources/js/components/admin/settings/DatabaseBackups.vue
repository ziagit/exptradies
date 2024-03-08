<template>
    <div>
        <b-modal v-model="backupToggle" hide-footer hide-header  size="sm">
            <div class="d-block"><b>Take a new backup</b></div>
            <div class="text-right mt-4">
                <b-button variant="light" @click="backupToggle=!backupToggle">Cancel</b-button>
                <b-spinner v-if="isSubmitting" variant="primary"></b-spinner>
                <b-button v-else variant="light" @click="handleBackup()">Confirm</b-button>
            </div>
        </b-modal>
       <b-card sub-title="Backups">
            <table class="table table-light" v-if="backups && backups.length>0">
                <thead>
                    <tr>
                        <th>File</th>
                        <th>Size</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(backup,index) in backups.slice().reverse()" :key="index">
                        <td>{{ (backup.file).slice(17) }}</td>
                        <td>{{(backup.size.toFixed(3))}}kb</td>
                    </tr>
                </tbody>
            </table>
            <div v-else>
                <p>There is no backup taken yet.</p>
            </div>
            <b-button variant="light" class="add-btn" @click="backupToggle=!backupToggle">Backup now</b-button>
       </b-card>
    </div>
</template>
<script>

import axios from 'axios';
export default{
    data:()=>({
        backups:null,
        backupToggle:false,
        isSubmitting:false,
    }),

    created(){
        this.get();
    },
    
    methods:{
        get(){
            axios.get('admin/backup').then(res=>{
                this.backups=res.data;
            }).catch(err=>{
                console.log("err",err)
            })
        },
       
        backup(){
            this.backupToggle = !this.backupToggle;
        },
        handleBackup(){
            this.isSubmitting=true;
            axios.post("admin/backup",{}).then(res=>{
             this.isSubmitting=false;
             this.backupToggle=false;
           
             this.get();

         }).catch(err=>{
             console.log(err)
         })
        },
      
    }
}
</script>
<style scoped lang="scss">
.backup-now{
    position: absolute;
    top: 0;
    right: 0;
}
</style>
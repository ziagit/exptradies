<template>
    <div>
        <b-form @submit.prevent="submit">
          <b-form-group>
            <b-form-select v-model="selected" required @change="handleSelectChange">
            <template #first>
              <b-form-select-option :value="null" disabled>Refund to</b-form-select-option>
            </template>
            <b-form-select-option 
            v-for="(emp, index) in employees" 
            :key="index"
            :value="emp"
            >{{emp.business_name}}</b-form-select-option>
          </b-form-select>
          </b-form-group>
          <b-form-group>
            <b-input-group >
              <b-form-input 
              class="search-box-in-phone" 
              placeholder="Amount ($)" 
              type="number" 
              step="0.01"
              v-model="form.amount" required>
            </b-form-input>
            </b-input-group>
          </b-form-group>
          <b-form-group>
            <b-form-textarea
              v-model="form.reason"
              placeholder="Refund reason..."
              rows="3"
              max-rows="6"
            ></b-form-textarea>
          </b-form-group>
          <div class="mt-3 text-right">
            <b-spinner v-if="isSubmitting" variant="primary"></b-spinner>
            <div v-else>
              <b-button @click="$parent.$bvModal.hide('modal-add')" variant="light">Cancel</b-button>
            <b-button type="submit" variant="light">Submit</b-button>
            </div>
          </div>
        </b-form>
    <Toaster ref="toaster" />
    </div>
</template>
<script>
import Toaster from "../../../web/sub/Toaster.vue";

export default{
  components:{Toaster},
    data:()=>({
      form:{
        employee_id:null,
        post_id:null,
        amount:null,
        reason:null,
      },
      selected:null,
      employees:null,
      isSubmitting:false,
    }),
    created(){
      this.get();
    },  
    methods:{
        handleSelectChange() {
          this.form.amount=this.form.employee_id=this.form.post_id=null;
          this.form.amount = this.selected.posts[0].pivot.commission;
          this.form.employee_id=this.selected.id;
          this.form.post_id=this.selected.posts[0].id;
        },
       
        get() {
            axios
            .get("admin/finance/refunds/employees")
            .then((res) => {
                this.employees = res.data;
            })
            .catch((err) => {
                console.log(err);
          });
        },
        submit(){
          this.isSubmitting=true;
          axios.post("admin/finance/refunds",this.form).then(res=>{
            this.isSubmitting=false;
            this.$parent.$bvModal.hide("modal-add");
            this.$emit('refresh')
          }).catch(err=>{
            this.isSubmitting=false;
            this.$refs.toaster.show(
              "danger",
              "b-toaster-top-center",
              "Faild",
              err.response.data
            );
            console.log(err)
          })
        },
    }
}
</script>
<template>
  <div class="balance in-phone-no-padding" v-if="employee != null">

    <div class="my-3">
      <Methods></Methods>
    </div>

      <div  class="balence-container">
        <div v-if="employee.balance == null" class="text-left">
          <h3>There is no balance available.</h3>
          <p>Add your balance and receive credit from Exptradies, 
            everytime you accept a job the fee will be deducted 
            from your balance. We value your time and security.</p>
          
          <div class="text-right mt-5 d-flex ">
           <Add v-if="addTogal" />
            <b-button v-else variant="outline-primary" @click="addTogal = !addTogal">Add balance</b-button>
          </div>
        </div>

        <div v-else>
          <p><b-icon icon="check-lg" class="text-success"></b-icon> Your balance is still valid.</p>
          <p>Expires in <strong>{{calculateExpirationDate(employee.balance_updated_at)}}</strong> days</p>
          <div class="text-right mt-5">
            <div v-if="employee" class="d-flex align-items-center">
            <h2 class="mr-3 text-secondary">Balance:</h2>
            <h1>{{employee.balance==null?"0.00":employee.balance}}</h1> <h5 class="text-secondary mb-4">AUD</h5>
            </div>
          </div>
          <div class="text-right mt-5 d-flex ">
           <Add v-if="addTogal" />
            <b-button v-else variant="outline-primary" @click="addTogal = !addTogal">Add more</b-button>
          </div>
        </div>
      </div>
     
      <div class="mt-3">
        <b-form-checkbox v-model="renewBalance" name="check-button" switch @change="onChangeAutoRenew">
          Auto renew 
        </b-form-checkbox>
        <small v-if="renewBalance">Your balance will be extended after expiration every month</small>
      </div>
  </div>
</template>
<script>
import axios from "axios";
import Add from "./Add.vue";
import Edit from "./Edit.vue";
import Methods from "../methods/Methods.vue";

export default {
  components: { Add, Edit, Methods },
  data: () => ({
    employee: null,
    addTogal: false,
    editTogal:false,
    renewBalance:false,
  }),
  created() {
    this.get();
  },
   
  methods: {
    get() {
      axios
        .get("employee/balance")
        .then((res) => {
         this.employee = res.data;
         this.renewBalance = res.data.is_balance_auto_renew ===1?true:false;
        })
        .catch((err) => {
          console.log(err)
        });
    },
    onChangeAutoRenew(e){
      axios.put("employee/balance/"+this.employee.id, {status:e}).then(res=>{
      }).catch(err=>console.log(err))
    },
    calculateExpirationDate(date){
      const diffInMs   =  new Date() - new Date(date);
      const diffInDays = diffInMs / (1000 * 60 * 60 * 24);
      const remainingDays = 31 - diffInDays;
      return remainingDays.toFixed(0);
    }
  },
};
</script>

<style scoped >

.balence-container{
  border: solid 1px #007bff1a;
  border-radius: 10px;
  min-height: 300px;
  padding: 30px;
}
.available-balance{
    background: #007bff48;
    padding: 20px;
    
  }
</style>

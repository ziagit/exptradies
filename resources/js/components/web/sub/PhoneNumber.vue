<template>
     <b-form-group class="mt-3">
          <b-input-group prepend="+61">
            <b-form-input v-model="phone" placeholder="Phone" :state="isValid" ></b-form-input>
          </b-input-group>
        </b-form-group> 
</template>
<script>
export default{
    props:['initialNumber'],
    data:()=>({
        phone:null,
        isValid:false,
    }),
    watch: {
        phone(newValue, oldValue) {
            if(this.isValidPhone(newValue)){
                this.isValid=true;
                const modifiedStr = this.phone.slice(-9);
                this.$emit('number','+61'+modifiedStr);
            }else{
                this.isValid=false;
                this.$emit('number',null);
            }
        }
  },
    created(){
        if(this.initialNumber!=null){
            const modifiedStr = this.initialNumber.slice(-9);
            this.phone = '0'+modifiedStr;
        }
    },
    methods:{
        isValidPhone(phoneNumber) {
        const digitsOnly = phoneNumber.replace(/\D/g, '');

        const regex = /^(?:\+?61|0)[2-478](?:[ -]?[0-9]){8}$/;
        
        return regex.test(digitsOnly);
        }
    }

}

</script>
<template>
  <div>
      <form @submit.prevent="createStripePaymentMethod" id="payment-form" enctype="multipart/form-data">
        <b-input-group class="mb-3">
          <b-form-input v-model="form.name_oncard" ref="focusable" required placeholder="Name on card" type="text"></b-form-input>
        </b-input-group>

        <div ref="card">
          <!-- A Stripe Element will be inserted here. -->
        </div>

        <div class="action mt-2">
          <b-spinner variant="primary" v-if="isSubmitting" />
          <div v-else>
            <b-button variant="light" @click="cancel()">Cancel</b-button>
            <b-button  id="submit-button" variant="light" type="submit" >Update</b-button>
          </div>
        </div>
      </form>
    <Toaster ref="toaster" />
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
import GoogleAddress from "../../../sub/GoogleAddress.vue";
import Toaster from "../../../sub/Toaster.vue";
import validator from "../../../../shared/services/validator";
var stripe = Stripe(process.env.MIX_STRIPE_KEY);
var style = {
  base: {
    color: "#32325d",
    fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: "antialiased",
    fontSize: "16px",
    "::placeholder": {
      color: "#aab7c4",
    },
  },
  invalid: {
    color: "#fa755a",
    iconColor: "#fa755a",
  },
};
var card = undefined;
export default {
  name: "Card",
  components: {
    Toaster,
    GoogleAddress,
  },
  data: () => ({
    elements: stripe.elements(),
    form: {
      name_oncard: null,
      paymentMethod:null,
    },
    sameAddress: false,
    shipperExist: null,
    isSubmitting: false,
    cardAdded: false,
  }),
 
  mounted: function () {
    card = this.elements.create("card", {
      style: style,
      hidePostalCode: true,
    });
    card.mount(this.$refs.card);
    this.$refs.focusable.$el.focus();
  },
  computed: {
    ...mapGetters({
      authenticated: "auth/authenticated",
      user: "auth/user",
    }),
  },
  methods: {
    cancel(){
      this.$parent.editTogal=false;
    },  
    createStripePaymentMethod: function () {
      if (
        this.form.name_oncard == null ){
        this.$refs.toaster.show(
          "danger",
          "b-toaster-top-center",
          "Faild",
          "All the fields are required!"
        );
        return;
      }
      if(!validator.emailValidator(this.form.email)){
        this.$refs.toaster.show(
          "danger",
          "b-toaster-top-center",
          "Faild",
          "Please provide a valid email!"
        );
        return;
      }

      this.isSubmitting = true;
      stripe.createStripePaymentMethod({
          type: 'card',
          card: card,
        }).then((result)=>{
          if (result.error) {
           this.isSubmitting = false;
           this.$refs.toaster.show(
             "danger",
             "b-toaster-top-center",
             "Error",
             result.error.message
           );
         } else {
          this.handleMethod(result.paymentMethod);
         }
        });
    },
    handleMethod: function (methode) {
      this.form.paymentMethod = methode.id;
      axios
        .put("employee/payment-methods/"+this.user.id, this.form)
        .then((res) => {
          this.$parent.get()
          this.$refs.toaster.show(
            "success",
            "b-toaster-top-center",
            "Success",
            res.data
          );
          this.$parent.editTogal=false;
        })
        .catch((err) => {
          this.$refs.toaster.show(
            "danger",
            "b-toaster-top-center",
            "Faild",
            err.response.data
          );
          this.togalMassage = err;
        });
        this.isSubmitting = false;
    },
  },
};
</script>

<style lang="scss" scoped>
.shipperTogal {
  margin: 8px 16px 8px 0;
  label {
    font-size: 11px;
  }
}

.action {
  text-align: right;
}

/**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  box-sizing: border-box;
  font-family: "Roboto";
  height: 40px;

  padding: 10px 12px;

  border: 1px solid #ddd;
  border-radius: 4px;
  background-color: white;

  /* box-shadow: 0 1px 3px 0 #e6ebf1; */
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

/*  .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        } */

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>

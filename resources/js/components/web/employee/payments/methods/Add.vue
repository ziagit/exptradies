<template>
  <div>
    <form @submit.prevent="createStripePaymentMethod" id="payment-form" enctype="multipart/form-data">
      <b-input-group class="mb-3">
        <b-form-input ref="focusable" v-model="form.name_oncard" required placeholder="Name on card" type="text"></b-form-input>
      </b-input-group>

      <div ref="card">
        <!-- A Stripe Element will be inserted here. -->
      </div>

      <div class="text-right mt-3">
        <b-spinner variant="primary" v-if="isSubmitting" />
        <b-button v-else id="submit-button" variant="light" type="submit" class="pr-4 pl-4">Submit</b-button>
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
      email: null,
      name_oncard: null,
      paymentMethod:null,
    },
    isSubmitting: false,
  }),

  mounted: function () {
    this.form.email = this.user.email;
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
    createStripePaymentMethod: function () {
      if (
        this.form.email == null ||
        this.form.name_oncard == null) {
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
      
      stripe.createPaymentMethod({
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

    handleMethod: function (paymentMethod) {
      this.form.paymentMethod = paymentMethod.id;
      
      axios
        .post("employee/payment-methods", this.form)
        .then((res) => {
          this.$parent.get()
          this.$refs.toaster.show(
            "success",
            "b-toaster-top-center",
            "Success",
            res.data
          );
          this.$parent.addTogal = false;
        })
        .catch((err) => {
          this.isSubmitting = false;
          this.$refs.toaster.show(
            "danger",
            "b-toaster-top-center",
            "Error",
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

.StripeElement {
  box-sizing: border-box;
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

.close-btn {
  position: absolute;
  top: 0;
  right: 0;
}

@media only screen and (min-width: 600px) {
  .card {
    .header {
      margin: 10px auto;

      .md-display-1 {
        font-size: 30px;
      }
    }

    .md-card {
      padding: 0px 20px 0 20px;
    }
  }
}
</style>

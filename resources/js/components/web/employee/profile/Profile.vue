 <template>
  <div v-if="profile">
    <Account :user="profile.user"/>
    <b-card title="Profile details" class="text-left shadow-none  ">
      <Add v-if="addTogal"/>
      <Edit v-else-if="editTogal" :profile="profile"/>
    <div v-else>
      <div class="row mb-2">
        <div class="col-4">
          First name:
        </div>
        <div class="col-8">
          {{ profile.first_name }}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-4">
          Last name:
        </div>
        <div class="col-8">
          {{ profile.last_name }}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-4">
          Address:
        </div>
        <div class="col-8">
          {{ profile.address.formatted_address }}
        </div>
      </div>
      
      <div class="row mb-2">
        <div class="col-4">
          Professions:
        </div>
        <div class="col-8 d-flex">
          <div class="" v-for="(service, index) in profile.services" :key="index">
            <b-badge class="mr-2"  variant="secondary">{{ service.name }}</b-badge>
          </div>
        </div>
      </div>

      <div class="row mb-2">
        <div class="col-4">
          Work area:
        </div>
        <div class="col-8">
          <div class="" v-for="(area, index) in profile.business_addresses" :key="index">
              <span  variant="secondary">{{ area.address }}: <b-badge>{{ area.range }}km</b-badge></span>
          </div>
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-4">
          Business ABN:
        </div>
        <div class="col-8">
          {{ profile.business_abn }}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-4">
          License number:
        </div>
        <div class="col-8">
          {{ profile.license_number }}
        </div>
      </div>
      <div class="row mb-2">
        <div class="col-4">
          Business name:
        </div>
        <div class="col-8">
          {{ profile.business_name }}
        </div>
      </div>
      <div class="mb-2">
        <div>
          Business details:
        </div>
        <div>
          {{ profile.business_details }}
        </div>
      </div>
      <div class="mt-5" v-if="checkData()">
        <b-alert show variant="warning">Dear {{ profile.first_name }}, if you want to receive job in this portal, please add professions, work area, business details and business ABN.</b-alert>
      </div>
      <div class="text-right mt-5">
        <b-button variant="light" @click="editTogal=!editTogal">Edit</b-button>
      </div>
    </div>
    </b-card>
    <div class="text-right mt-2">
      <b-modal centered v-model="deleteTogal" body-class="pb-0" footer-class="border-top-0" hide-header hide-footer
          size="sm" ok-title="Delete"  okVariant="light" cancelVariant="light">
          <p>Are you sure you want to delete your account?</p>
          <div class="text-right my-2">
            <b-button variant="ligth" @click="deleteTogal=!deleteTogal">Cancel</b-button>
            <b-spinner v-if="isSubmitting" variant="primary" ></b-spinner>
            <b-button v-else variant="danger" @click="confirmDelete()" >Delete</b-button>
          </div>
        </b-modal>
      <b-button variant="danger" @click="deleteTogal=!deleteTogal">Delete account</b-button>
    </div>
    <Toaster ref="toaster" />
  </div>
</template>
<script>

import Account from "../account/Account.vue"
import EditAccount from "../account/EditAccount.vue"
import Edit from "./Edit.vue";
import Add from "./Add.vue";
import { mapActions, mapGetters } from "vuex";
import Toaster from "../../sub/Toaster.vue";


export default {
  props: ["profile"],
  components: {
    Account,
    EditAccount,
    Edit,
    Add,Toaster,
},  
  data:()=>({
    editTogal:false,
    addTogal:false,
    deleteTogal:false,
    isSubmitting:false,
  }),
  
  computed: {
      ...mapGetters({
        authenticated: "auth/authenticated",
        user: "auth/user"
      })
  },
  methods:{
    ...mapActions({
        signOutAction: "auth/signOut",
    }),
    checkData(){
      if(this.profile.business_addresses.length==0 || this.profile.services.length==0 || this.profile.business_name==null || this.profile.business_abn==null){
        return true;
      }
      return false;
    },
    get(){
      this.$parent.get();
      this.editTogal = false;
      this.addTogal = false;
    },
    confirmDelete(){
      const id = this.user.id;
      this.signOut();
      axios
        .delete("remove-me/" + id)
        .then(res => {
          this.isSubmitting = false;
          this.deleteTogal = false;
          this.$refs.toaster.show(
          "success",
          "b-toaster-top-center",
          "Deleted",
          "Your account removed successfully."
        );
          this.$router.push("/")
        })
        .catch(err => {
          console.log(err);
        });
    },
    signOut() {
      this.signOutAction().then(() => {});
    },
  }
};
</script> 
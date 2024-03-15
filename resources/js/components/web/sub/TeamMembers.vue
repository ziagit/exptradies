<template>
    <div>
        <b-card-group columns>
            <b-card class="text-center" v-for="(b,index) in businesses" :key="index">
              <b-avatar size="4.5rem" class="mr-2" :style="{background: randomBackground()}"  :text="b.business_name?b.business_name.substring(0,2):''"></b-avatar>
              <div>
                <b-form-rating
                    id="rating-readonly"
                    :value="b.stars"
                    readonly
                    inline
                    no-border 
                    color="#FFA500"
                    size="md"
                    ></b-form-rating>
              </div>
              <h4>{{b.business_name}}</h4>
              <small v-for="(s,indx) in b.services" :key="indx" class="text-muted">{{s.name}},</small>
              <div class="member-location my-5">
                <b-icon icon="pin-map"></b-icon>
                <span v-if="b.address">Based on {{b.address.city}}</span>
                <span v-else>Location not provided</span>
              </div>
              <div>
                <b-button variant="outline-primary" block>View profile</b-button>
              </div>
            </b-card>
          </b-card-group>
    </div>
</template>
<script>
import randomColorPicker from '../../shared/services/randomColorPicker';
export default{
  props:['businesses'],
  methods:{
    randomBackground(){
      return randomColorPicker.randomBackground();
    }
  }
}
</script>
<style scoped lang="scss">
  .team-members{
    img{
      border-radius: 100%;
    }
    .card{
        min-height: 400px;
    }
  }
  img{
    border-radius: 100% !important;
  }
</style>
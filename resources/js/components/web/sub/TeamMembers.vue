<template>
    <div>
        <b-card-group columns>
            <b-card class="text-center">
              <img src="https://picsum.photos/400/400/?image=41" alt="" width="80">
              <div>
                <b-form-rating
                    id="rating-readonly"
                    :value="4"
                    readonly
                    inline
                    no-border 
                    color="#ff00ff"
                    size="md"
                    ></b-form-rating>
              </div>
              <h4>Dr. Sam</h4>
              <small>Tiler, Painer</small>
              <div class="member-location my-5">
                <b-icon icon="pin-map"></b-icon>
                <span>Melburn, Safa, Westroad 234</span>
              </div>
              <div>
                <b-button variant="outline-primary" block>View profile</b-button>
              </div>
            </b-card>

            <b-card class="text-center">
              <img src="https://picsum.photos/400/400/?image=41" alt="" width="80">
              <div>
                <b-form-rating
                    id="rating-readonly"
                    :value="4"
                    readonly
                    inline
                    no-border 
                    color="#ff00ff"
                    size="md"
                    ></b-form-rating>
              </div>
              <h4>Dr. Sam</h4>
              <small>Tiler, Painer</small>
              <div class="member-location my-5">
                <b-icon icon="pin-map"></b-icon>
                <span>Melburn, Safa, Westroad 234</span>
              </div>
              <div>
                <b-button variant="outline-primary" block>View profile</b-button>
              </div>
            </b-card>
            <b-card class="text-center">
              <img src="https://picsum.photos/400/400/?image=41" alt="" width="80">
              <div>
                <b-form-rating
                    id="rating-readonly"
                    :value="4"
                    readonly
                    inline
                    no-border 
                    color="#ff00ff"
                    size="md"
                    ></b-form-rating>
              </div>
              <h4>Dr. Sam</h4>
              <small>Tiler, Painer</small>
              <div class="member-location my-5">
                <b-icon icon="pin-map"></b-icon>
                <span>Melburn, Safa, Westroad 234</span>
              </div>
              <div>
                <b-button variant="outline-primary" block>View profile</b-button>
              </div>
            </b-card>
          </b-card-group>
    </div>
</template>
<script>
export default{
  
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
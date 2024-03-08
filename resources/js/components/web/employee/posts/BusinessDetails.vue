<template>
    <div>
        <b-card no-body 
        header-text-variant="white">
            <b-card-header header-tag="header" role="tab" >
                <b-button 
                    block 
                    v-b-toggle="`collapse-${ emp.id }`"
                    variant="light" 
                    class="p-0 m-0 d-flex justify-content-between align-items-center">
                    <span>{{ emp.business_name }}</span>
                <div class="d-flex align-items-center">
                  <b-icon icon="chevron-right"></b-icon>
                </div>
                </b-button>
            </b-card-header>

            <b-collapse v-show="index === 0" :id="`collapse-${ emp.id }`" visible accordion="my-accordion" role="tabpanel">
                <div class="row card-content">
                    <div class="col-sm-12 col-md-4 col-lg-4 text-center ">
                        <b-avatar src="https://placekitten.com/300/300" size="5rem"></b-avatar>
                        <div>
                            <b-form-rating
                            id="rating-readonly"
                            :value="emp.stars"
                            readonly
                            inline
                            no-border size="sm"
                            variant="warning"
                            ></b-form-rating>
                        </div>
                        <p class="mb-0"><b>{{ emp.first_name }}</b></p>
                        <p class="mb-0 text-secondary">{{ emp.user.email }}</p>
                        <p class="mb-0 text-secondary">{{ emp.user.phone }}</p>
                        <p class="mb-0 text-secondary">{{ emp.business_abn }}</p>
                     
                        <div class="text-left mt-5">
                            <p><b>Work area </b> {{ emp.address.city }}</p>
                            <p class="mb-0"><b>About me:</b></p>
                            <p v-if="emp.business_details">{{ emp.business_details }}</p>
                            <p v-else> We are skilled and professional service provider, dedicated to delivering expertise and precision in every project. With years of experience and a passion for excellence, we bring your visions to life. Count on us for quality craftsmanship and unmatched dedication.
                            </p>
                            <div class="d-flex justify-content-between mb-5">
                                <div class="d-flex">
                                    <b-button @click="openLink('https://linkedin.com')" variant="light"><b-icon icon="linkedin"></b-icon></b-button>
                                    <b-button @click="openLink('https://exptradies.com')" variant="light"><b-icon icon="globe2"></b-icon></b-button>
                                </div>
                                <b-button variant="outline-secondary" @click="openChat(emp)">Message</b-button>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <div>
                            <h3>Portfolio</h3>
                            <p>Latest most recent projects</p>
                        </div>
                        <Galery :emp="emp"></Galery>
                        <div class="mb-3">
                            <b-button @click="$emit('review')" variant="light" class="review" v-b-tooltip.hover title="Rate and review this business">{{ emp.reviews.length }} Reviews</b-button>
                        </div>
                        <div>
                            <div v-for="(review,index) in emp.reviews" :key="index" class="reviews">
                                <div class="review-text">
                                    <p>“{{review.message}}”</p>
                                    <p class="blockquote-footer">{{review.review_by}}.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </b-collapse>
        </b-card>
    </div>
</template>
<script>
import Galery from "./Galery.vue";
import { mapActions, mapGetters } from "vuex";

export default{
    props: ["emp", "index"],
    components:{Galery},
    data() {
        return {
            visible: true,
            employee:null,
        };
    },
    methods:{
        ...mapActions({
            chat: "shared/chat",
        }),
       
        openReview(emp){
            this.employee=emp;
            this.$bvModal.show('review-modal');
        },

        openChat(emp) {
            this.chat({ route: "employee", listener: emp.user_id, order: emp });
            this.$router.push({
                name: "employee-chat",
            });
        },
        openLink(url){
            window.open(url);
        }
    },
}
</script>
<style>
.give-review{
    border: dotted 1px #ddd;
    border-radius: 10px;
    padding: 10px;
}
.card-content{
    padding: 20px;
}
.card-header{
    background: #fff !important;
    .btn{
        background: #fff !important;
    }
}
.reviews{
    p{
        color: grey;
    }
    .review-text{
        border-left: 5px solid #007bff3b;
        padding-left: 10px;
    }
}
</style>
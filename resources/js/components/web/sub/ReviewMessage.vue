<template>
    <div>
        <div class="row">
            <div class="text-left col col-sm-12,col-md-4 col-lg-4" v-for="(review,index) in reviews" :key="index">
                <div class="d-flex">
                    <div class="line"></div>
                    <div class="text-container">
                        <h6 class="text-muted font-italic">
                            {{review.message}}
                        </h6>
                    </div>
                </div>
                <div  class="d-flex">
                    <b-form-rating
                    id="rating-readonly"
                    :value="review.stars"
                    readonly
                    inline
                    no-border 
                    color="#FFA500"
                    size="sm"
                    ></b-form-rating>
                </div>
                <div class="d-flex align-items-center">
                    <img src="https://picsum.photos/400/400/?image=41" alt="" width="50">
                    <h3 class="ml-2">{{review.name}}</h3>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["reviews"],
};
</script>

<style scoped lang="scss">
.text-left{
    background: #ddd;
    border: #f9f8f7 5px solid;
    padding: 30px;
}
.text-container{
    max-width: 300px;
}
.line{
    margin-right: 10px;
    background: blue;
    height: 150px;
    width: 5px;
}
img{
    border-radius: 100% !important;
}
</style>
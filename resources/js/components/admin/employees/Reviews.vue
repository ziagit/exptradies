<template>
    <div>
        <div v-if="emp.reviews.length==0">
          <p>No review given yet.</p>
        </div>
        <div v-else>
          <div v-for="(review,index) in emp.reviews" :key="index" class="reviews">
          <div class="review-text">
            <p>“{{review.message}}”</p>
            <p class="blockquote-footer">{{review.review_by}}.</p>
          </div>
        </div>
        </div>
    </div>
</template>
<script>
export default{
    props:['emp'],
}
</script>
<style scoped lang="scss">
.reviews{
    max-width: 400px;
    .review-text{
        border-left: 5px solid #007bff3b;
        padding-left: 10px;
    }
}
</style>
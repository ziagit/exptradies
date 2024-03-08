<template>
    <div>
        <div class="row">
            <div class="text-left col col-sm-12,col-md-4 col-lg-4" v-for="(index,item) in [1,2,3]" :key="index">
                <div class="d-flex">
                    <div class="line"></div>
                    <div class="text-container">
                        <h6 class="text-muted font-italic">
                            My dream home was brought to life by a team of skilled and trustworthy professionals from exptradies. Their expertise, integrity, and timeliness undoubtedly make them an excellent and highly-recommended choice for any construction project.
                        </h6>
                    </div>
                </div>
                <div  class="d-flex">
                    <div v-for="i in [1,2,3,4,5]">
                        <b-icon icon="star-fill" style="color: #7952b3;" class="mx-1 my-4"></b-icon>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <img src="https://picsum.photos/400/400/?image=41" alt="" width="50">
                    <h3 class="ml-2">John Do.</h3>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["review"],
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
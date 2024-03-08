<template>
    <div class="msg">
        <div class="loader">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</template>
<script>
export default {};
</script>
<style lang="scss" scoped>
.msg {
    background-color: #bbbbbb2e;
    border-bottom-left-radius: 10px;
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    margin-bottom: 5px;
    display: inline-block;
    padding: 0.3rem 0.6rem;
    font-size: 14px;
    -webkit-box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.15);
    -moz-box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.15);
    box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.15);

    .loader {
        display: flex;
        justify-content: center;
        align-content: center;
        padding-top: 10px;

        > span {
            display: inline-block;
            background: #706f6f;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            margin: 0 1px;
            transform: translate3d(0);
            animation: bounce 0.3s infinite alternate;
        }
        > span:nth-child(2) {
            animation-delay: 0.1s;
        }
        > span:nth-child(3) {
            animation-delay: 0.2s;
        }
    }
}
@keyframes bounce {
    to {
        width: 5px;
        height: 5px;
        transform: translate3d(0, -5px, 0);
    }
}
</style>

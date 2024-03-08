<template>
<div>
    <div class="collapsable">
      <div
        v-b-toggle:my-collapse
        v-for="(item, index) in list"
        :key="item.id"
        :list="item"
      >
        <b-button v-b-toggle="'collapse-' + item.id" variant="light" class="text-left">{{
          item.title
        }}</b-button>
        <b-collapse :id="'collapse-' + item.id" class="mt-2">
          <div  v-html="item.body"></div>
        </b-collapse>
      </div>
    </div>
</div>
</template>
<script>
    export default{
        props: ["list"],
    };
</script>
  <style lang="scss">
  .collapsable {
    .btn {
      font-size: 20px !important;
      color: #54575a;
    }
  }
  .btn{
    color: #000 !important;
  }
  @media only screen and (max-width: 576px) {
    .img {
      text-align: center !important;
      .container {
        text-align: center !important;
        p {
          width: 100%;
        }
      }
    }
  }
  </style>
  
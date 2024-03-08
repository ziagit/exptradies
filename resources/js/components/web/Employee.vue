<template>
  <div class="shipper-faq">
    <div v-b-toggle:my-collapse v-for="(item, index) in dynamicList" :key="index" :list="item">
      <b-button v-b-toggle="'collapse-' + index" variant="light" class="text-left">{{
          item.title
      }}</b-button>
      <b-collapse :id="'collapse-' + index" class="mt-2" :aria-expanded="true">
        <div class="pl-3" v-html="item.body"> </div>
      </b-collapse>
    </div>
    <div class="mt-5">
      <b-button v-b-toggle="'collapse-more'" variant="light" class="text-left">Still need help?</b-button>
      <b-collapse :id="'collapse-more'" class="mt-2" :aria-expanded="true">
        <div class="pl-3">Click on chat icon at the bottom-right corner of this page. </div>
      </b-collapse>
    </div>
  </div>
</template>
<script>
import Axios from "axios";
import InfoList from "./sub/AccordionList";
export default {
  data: () => ({
    scrollValue: 0,
    dynamicList: [],
  }),
  methods: {
    get() {
      Axios.get("employer-page").then((res) => {
        let list = res.data;
        list.forEach((element) => {
          this.dynamicList.push({ ...element, visible: false });
        });
      });
    },
  },

  created() {
    this.get();
  },
  components: { InfoList },
};
</script>
<style lang="scss">
.shipper-faq {
  .btn {
    font-size: 20px !important;
    color: #54575a;
  }
}

@media only screen and (max-width: 600px) {}
</style>

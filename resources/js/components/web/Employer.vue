<template>
  <div class="carrier-faq">
    <div
      v-b-toggle:my-collapse
      v-for="(item, index) in dynamicList"
      :key="index"
      :list="item"
    >
      <b-button v-b-toggle="'collapse-' + index" variant="light" class="text-left">{{
        item.title
      }}</b-button>
      <b-collapse :id="'collapse-' + index" class="mt-2">
        <div  v-html="item.body"></div>
      </b-collapse>
    </div>
    
  </div>
</template>
<script>
import Axios from "axios";
import InfoList from "./sub/AccordionList";
export default {
  data: () => ({
    dynamicList: [],
  }),
  methods: {
    get() {
      Axios.get("employee-page").then((res) => {
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
.carrier-faq {
  .btn {
    font-size: 20px !important;
    color: #54575a;
  }
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

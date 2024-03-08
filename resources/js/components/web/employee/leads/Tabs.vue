<template>
      <b-tabs>
        
          <b-tab title="Latest job" active>
            <div>
              <All />
            </div>
          </b-tab>
          <b-tab title="Accepted">
            <Accepted />
          </b-tab>
      </b-tabs>
</template>
<script>

import Accepted from "./Accepted.vue";
import All from "./All.vue";
export default {
  name: "Tabs",
  components: {
    Accepted,
    All
  },
};
</script>

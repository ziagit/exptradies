<template>
  <div class="my-5">
    <div class="px-2 pb-2">
      <b-card class="text-center   shadow-none" title="CUMULATIVE PROJECTIONS">
        <DailyProjections />
      </b-card>
    </div>
    <b-card-group>
      <div class="p-2 w-50">
        <b-card class="shadow-none  " header="SALES">
          <Sales />
        </b-card>
      </div>
      <div class="p-2 w-50">
        <b-card class="shadow-none  " header="JOBS">
          <Jobs />
        </b-card>
      </div>
    </b-card-group>

    <b-card-group class="mb-5">
      <div class="p-2 w-100">
        <b-card class="shadow-none  " header="BUSINESSES">
          <Employees />
        </b-card>
      </div>
    </b-card-group>
    <br>
  </div>
</template>

<script>
import DailyProjections from "./DailyProjections";
import Employees from "./Employees";
import Jobs from "./Jobs";
import Sales from "./Sales";
export default {
  components: {
    DailyProjections,
    Employees,
    Sales,
    Jobs,
  },
};
</script>

<style scoped lang="scss">
</style>

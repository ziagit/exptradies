<template>
  <div>
    <div v-if="isLoaded">
      <GChart class="graph" type="PieChart" :data="chartData" :options="chartOptions" />
    </div>
    <div v-else>No data.</div>
    <div class="legend">
      <span class="caption">
        <span class="dot" style="background: #ed7d31"></span>
        <span>Received : {{ received.length }}</span></span
      >
      <span class="caption">
        <span class="dot" style="background: #4472c4"></span>
        <span>Active: {{ active.length }}</span></span
      >
      <span class="caption">
        <span class="dot" style="background: #ff0000;"></span>
        <span>Closed: {{ closed.length }}</span></span
      >
    </div>
  </div>
</template>
<script>
import { GChart } from "vue-google-charts";
export default {
  data: () => ({
    isLoaded: false,
    received: [],
    active:[],
    closed: [],

    chartData: [["jobs", "Qty"]],
    chartOptions: {
      chart: {
        title: "Company Performance",
        subtitle: "Sales, Expenses, and Profit: 2014-2020",
      },
      width: 300,
      height: 300,
      pieHole: 0.65,
      legend: "none",
      chartArea: {
        left: "3%",
        top: "3%",
        height: "600",
        width: "600",
      },
      colors: [],
    },
  }),
  created() {
    this.get();
  },
  methods: {
    get() {
      axios
        .get("admin/dashboard/daily-projections")
        .then((res) => {
          console.log("projections: ", res.data)
          if (res.data.length > 0) {
            this.feedChart(res.data);
          }
        })
        .catch((err) => console.log(err));
    },
    feedChart(posts) {
      for (let i = 0; i < posts.length; i++) {
        if(posts[i].status=='active'){
          this.active.push(posts[i]);
        }
        if(posts[i].status=='closed'){
          this.closed.push(posts[i]);
        }
        this.received.push(posts[i]);
      }
      //received
      this.received = posts;
      this.chartData.push(["Received", this.received.length]);
      this.chartOptions.colors.push("#ed7d31");
      //active
      this.chartData.push(["Active", this.active.length]);
      this.chartOptions.colors.push("#4472c4");
       //closed
       this.chartData.push(["Closed", this.closed.length]);
      this.chartOptions.colors.push("#ddd");
      this.isLoaded = true;
    },
  },
  mounted: function () {},
  components: {
    GChart,
  },
};
</script>

<style scoped lang="scss">
.graph {
  display: flex;
  justify-content: center;
}
.legend {
  margin: 30px 10px;
  display: flex;
  justify-content: center;
  .caption {
    margin: 10px;
    display: flex;
    align-items: center;
    .dot {
      height: 10px;
      width: 10px;
      border-radius: 0%;
      display: inline-block;
      margin: 1px;
    }
  }
}
</style>

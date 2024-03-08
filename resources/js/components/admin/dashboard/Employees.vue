<template>
  <div>
    <div v-if="isLoaded">
      <GChart type="ColumnChart" :data="chartData" :options="chartOptions" />
    </div>
    <div v-else>No data.</div>
  </div>
</template>
<script>
import { GChart } from "vue-google-charts";
export default {
  data: () => ({
    isLoaded: false,
    chartData: [["Month", "Businesses"]],
    chartOptions: {
      chart: {
        title: "Businesses",
        subtitle: "Businesses companies registered with us: 2014-2020 ",
      },
      legend: "none",
      hAxis: {
        textStyle: {
          fontSize: 6, 
        },
      },
    },
  }),
  created() {
    this.get();
  },
  methods: {
    get() {
      axios.get("admin/dashboard/employees").then((res) => {
        if (res.data.length > 0) {
          this.feedChart(res.data);
        }
      });
    },
    feedChart(movers) {
      var jan = 0;
      var feb = 0;
      var mar = 0;
      var apr = 0;
      var may = 0;
      var jun = 0;
      var jul = 0;
      var aug = 0;
      var sep = 0;
      var oct = 0;
      var nov = 0;
      var dec = 0;
      for (let i = 0; i < movers.length; i++) {
        var month = new Date(movers[i].created_at).getMonth() + 1;
        switch (month) {
          case 1:
            jan += 1;
            break;
          case 2:
            feb += 1;
            break;
          case 3:
            mar += 1;
            break;
          case 4:
            apr += 1;
            break;
          case 5:
            may += 1;
            break;
          case 6:
            jun += 1;
            break;
          case 7:
            jul += 1;
            break;
          case 8:
            aug += 1;
            break;
          case 9:
            sep += 1;
            break;
          case 10:
            oct += 1;
            break;
          case 11:
            nov += 1;
          case 12:
            dec += 1;
            break;
        }
      }
      this.chartData.push(["Jan", jan]);
      this.chartData.push(["Feb", feb]);
      this.chartData.push(["Mar", mar]);
      this.chartData.push(["Apr", apr]);
      this.chartData.push(["May", may]);
      this.chartData.push(["Jun", jun]);
      this.chartData.push(["Jul", jul]);
      this.chartData.push(["Aug", aug]);
      this.chartData.push(["Sep", sep]);
      this.chartData.push(["Oct", oct]);
      this.chartData.push(["Nov", nov]);
      this.chartData.push(["Jan", dec]);
      this.isLoaded = true;
    },
  },
  mounted: function () {},
  components: {
    GChart,
  },
};
</script>

<style scoped lang="scss"></style>

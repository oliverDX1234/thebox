<template>
    <Layout>
        <PageHeader
            :title="title"
        />
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">By Gender</h4>

                                <apexchart
                                    class="apex-charts"
                                    height="300"
                                    type="donut"
                                    dir="ltr"
                                    :series="series"
                                    :options="chartOptions"
                                ></apexchart>
                                <div class="row">
                                    <div v-for="(name, value, index) in statistics.gender"  class="col-6">
                                        <div class="text-center mt-4">
                                            <h6 class="mb-2 text-truncate">
                                                <i :style="{color: chartOptions.colors[index]}" class="mdi mdi-circle font-size-10 mr-1"></i> {{ name }}
                                            </h6>
                                            <h5 class="text-capitalize">{{ value }}</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">

                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import PageHeader from "@/components/custom/page-header";
import Layout from "../../layouts/main";
import StatisticsService from "../../../services/statisticsService";

export default {
    components: {
        Layout,
        PageHeader
    },
    data() {
        return {
            title: "Statistics For Users",
            series: [],
            statistics: null,
            chartOptions: {
                labels: ["Male", "Female"],
                legend: {
                    show: true,
                    position: 'bottom',
                    horizontalAlign: 'center',
                    verticalAlign: 'middle',
                    floating: false,
                    fontSize: '14px',
                    offsetX: 0,
                    offsetY: -10
                },
                responsive: [{
                    breakpoint: 600,
                    options: {
                        chart: {
                            height: 240
                        },
                        legend: {
                            show: false
                        },
                    }
                }],
                colors: ["#5664d2", "#1cbb8c"]
            }
        };
    },
    methods:{
      async getStatistics(){
          let statistics = await StatisticsService.getUserStatistics();

          this.statistics = statistics;

          this.chartOptions.labels = Object.keys(statistics.gender);

          this.series = Object.values(statistics.gender);
      }
    },
    mounted(){
        this.getStatistics();
    }
};
</script>

<template>
    <Layout>
        <PageHeader
            :title="title"
        />
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <donut-chart title="By Gender" :statistics="statistics?.gender"></donut-chart>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <donut-chart title="By Age" :statistics="statistics?.age"></donut-chart>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <bar-chart title="By City" :statistics="statistics?.city"></bar-chart>
                            </div>
                        </div>
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
import DonutChart from "../../../components/reusable/Charts/DonutChart";
import BarChart from "../../../components/reusable/Charts/BarChart";

export default {
    components: {
        Layout,
        PageHeader,
        DonutChart,
        BarChart
    },
    data() {
        return {
            title: "Statistics For Users",
            statistics: null
        };
    },
    methods:{
      async getStatistics(){
          this.statistics = await StatisticsService.getUserStatistics();
      }
    },
    mounted(){
        this.getStatistics();
    }
};
</script>

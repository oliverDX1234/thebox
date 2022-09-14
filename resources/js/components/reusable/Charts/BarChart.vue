<template>
    <div v-if="statistics && chartOptionsComputed.series[0].data.length">
        <h4 class="card-title mb-4">{{ title }}</h4>

        <apexchart
            class="apex-charts"
            height="500"
            type="bar"
            dir="ltr"
            :series="chartOptionsComputed.series"
            :options="chartOptionsComputed.chartOptions"
        ></apexchart>
    </div>
    <div class="position-relative" v-else>
        <b-spinner variant="primary" class="align-middle"></b-spinner>
    </div>
</template>

<script>
import {colors} from "./chartOptions.";
export default {
    name: "BarChart",
    props: {
        title: {
            required: true,
            type: String
        },
        statistics: {
            required: true,
            type: Array | Object,
        }
    },
    computed: {
        chartOptionsComputed() {
            let obj = {
                series: [{
                    data: []
                }],
                chartOptions: {
                    chart: {
                        toolbar: {
                            show: false,
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                            distributed: true
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    colors: colors,
                    grid: {
                        borderColor: '#f1f1f1',
                    },
                    xaxis: {
                        labels: {
                            formatter: function(val) {
                                return Math.floor(val)
                            }
                        },
                        categories: [],
                    }
                }
            }

            obj.series[0].data.push(...Object.values(this.statistics));
            obj.chartOptions.xaxis.categories.push(...Object.keys(this.statistics));

            return obj;
        }
    }
}
</script>

<style scoped>

</style>

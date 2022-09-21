<template>

    <div>

        <div v-if="statistics">
            <h4 class="card-title mb-4">{{ title }}</h4>

            <apexchart
                class="apex-charts"
                height="300"
                type="donut"
                dir="ltr"
                :series="chartOptionsComputed.series"
                :options="chartOptionsComputed"
            ></apexchart>
            <div class="row">
                <div v-for="(name, value, index) in statistics" :class="getClass">
                    <div class="text-center mt-4">
                        <h6 class="mb-2 text-truncate">
                            <i :style="{color: chartOptionsComputed.colors[index]}"
                               class="mdi mdi-circle font-size-10 mr-1"></i> {{ name }}
                        </h6>
                        <p class="text-capitalize font-weight-bold">{{ value }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-relative" v-else>
            <b-spinner variant="primary" class="align-middle"></b-spinner>
        </div>

    </div>
</template>

<script>


import {colors} from "./chartOptions.";

export default {
    name: "DonutChart",
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
        getClass(){

            if(Object.keys(this.statistics).length >= 4){
                return {
                    "col-3": true
                }
            }else if(Object.keys(this.statistics).length === 3){
                return {
                    "col-4": true
                }
            }else{
                return {
                    "col-6": true
                }
            }
        },
        chartOptionsComputed() {
            let obj = {
                responsive: [{
                    breakpoint: 1199,
                    options: {
                        chart: {
                            height: 300
                        },
                        legend: {
                            show: false
                        },
                    }
                }],
                colors: colors
            }

            obj.labels = Object.keys(this.statistics);
            obj.series = Object.values(this.statistics)

            return obj;
        }
    }
}
</script>

<style scoped>

</style>

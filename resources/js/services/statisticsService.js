import router from "@/router"

const StatisticsService = {

    async getUserStatistics() {
        let response = await axios.get('/api/statistics/user-statistics');
        return response.data.payload.statistics;
    },

    async getProductStatistics(){
        let response = await axios.get('/api/statistics/product-statistics');
        return response.data.payload.statistics;
    }
}

export default StatisticsService

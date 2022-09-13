import router from "@/router"

const StatisticsService = {

    async getUserStatistics(filters = null) {
        let response = await axios.get('/api/statistics/user-statistics');
        return response.data.payload.statistics;
    }
}

export default StatisticsService

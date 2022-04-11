<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <Line v-if="loaded" :chart-data="chartData"></Line>
            </div>
        </div>
    </div>
</template>

<script>

import { Line } from 'vue-chartjs'
import { Chart as ChartJS, LineController, LineElement, PointElement, LinearScale, Title, CategoryScale } from 'chart.js'
import api from "../services/api.js";

ChartJS.register(LineController, LineElement, PointElement, LinearScale, Title, CategoryScale)

export default {
    name: 'LineChart',
    components: {
        Line
    },
    data: () => ({
        loaded: false,
        chartData: null
    }),
    methods: {
        setChartDataFromApiData(rows) {
            this.chartData = {
                labels: rows.map(row => row.created_at),
                datasets: [
                    {
                        label: 'T',
                        backgroundColor: '#f87979',
                        data: rows.map(row => row.temp)
                    }
                ]
            }
        },
        async getDefaultData () {
            this.loaded = false
            let config = {
                params: {
                    count: 50,
                },
            }
            try {
                const last_temps = await api.get('/weather/getLastTemps', config)
                this.setChartDataFromApiData(last_temps.data.reverse())
                this.loaded = true
            } catch (e) {
                console.error(e)
            }
        }
    },
    mounted() {
        this.getDefaultData();
        this.emitter.on("rerender_chart", chart_data => {
            this.setChartDataFromApiData(chart_data)
        });
    }
}
</script>

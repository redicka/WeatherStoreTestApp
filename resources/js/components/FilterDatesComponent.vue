<template>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body" style="min-height: 200px;">
                <form class="row g-3" @submit.prevent="getDataByDates">
                    <div class="col-md-6">
                        <label for="inputDatetimeFrom" class="form-label">Дата с</label>
                        <input type="date" class="form-control" id="inputDatetimeFrom" v-model="inputDatetimeFrom" required="true">
                    </div>
                    <div class="col-md-6">
                        <label for="inputDatetimeTo" class="form-label">Дата по</label>
                        <input type="date" class="form-control" id="inputDatetimeTo" v-model="inputDatetimeTo" required="true">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Получить данные</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import api from "../services/api.js";

export default {
    name: "FilterDatesComponent.vue",
    data() {
        return {
            inputDatetimeFrom: Date,
            inputDatetimeTo: Date
        }
    },
    methods: {
        async getDataByDates() {
            let config = {
                params: {
                    start_date: this.inputDatetimeFrom,
                    end_date: this.inputDatetimeTo
                },
            }
            const temps_data = await api.get('/weather/getTempsByDates', config);
            if (temps_data.data.length) {
                console.log('call emit')
                this.emitter.emit('rerender_chart', temps_data.data);
            }
        }
    }
}
</script>

<style scoped>

</style>

<template>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body" style="min-height: 200px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 col-md-6">Последнее значение температуры:</div>
                        <div v-if="last_temp_value != null" class="col-md-6">{{ last_temp_value > 0 ? '+' + last_temp_value: '-' + last_temp_value}}&deg</div>
                    </div>
                    <div class="row">
                        <div class="col-6 col-md-6">Дата создания:</div>
                        <div class="col-md-6">{{ last_temp_create_date }}</div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button @click="getLastTemp" type="submit" class="btn btn-primary">Загрузить последнее значение</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import api from "../services/api.js";

export default {
    name: "LastTempComponent.vue",
    data: () => ({
        last_temp_value: null,
        last_temp_create_date: null
    }),
    methods: {
        async getLastTemp () {
            try {
                const temp_data = await api.get('/weather/getLastTemp')
                if (temp_data.data.length) {
                    this.last_temp_value = temp_data.data[0].temp
                    this.last_temp_create_date = temp_data.data[0].created_at
                }
            } catch (e) {
                console.error(e)
            }
        }
    },
    mounted() {
        this.getLastTemp();
    }
}
</script>

<style scoped>

</style>

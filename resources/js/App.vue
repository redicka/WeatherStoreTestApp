<template>
    <div class="container shadow min-vh-100 py-2">
        <div class="row">
            <div class="col-sm-12">
                <div class="row m-2">
                    <filter-dates-component></filter-dates-component>
                    <last-temp-component></last-temp-component>
                </div>
                <div class="row m-2">
                    <div class="col-md-12">
                        <chartline-component></chartline-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ChartlineComponent from './components/ChartlineComponent.vue'
import FilterDatesComponent from './components/FilterDatesComponent.vue'
import LastTempComponent from './components/LastTempComponent.vue'
export default {
    name: "App",
    components: {
        FilterDatesComponent, LastTempComponent, ChartlineComponent
    }
}
</script>

<style scoped>

</style>

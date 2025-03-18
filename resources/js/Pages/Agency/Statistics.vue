<script setup>
  import CarRentChart from './Stats/CarRentChart.vue';
  const props = defineProps({
    cWeekRents : Array,
    lWeekRents : Array,
    cWeekRevenue : Array,
    lWeekRevenue : Array
  })

  const labels = ['Mo' , 'Tu', 'Wed', 'Th' , 'Fr' ,'Sa' , 'Su'];
  

  const cWeekRents = Array(7).fill(0);
  const lWeekRents = Array(7).fill(0);
  const cWeekRevenue = Array(7).fill(0);
  const lWeekRevenue = Array(7).fill(0);  



  props.cWeekRents.forEach(e => {
    cWeekRents[e.weekday] = e.rentCount
  });

  props.lWeekRents.forEach(e => {
    lWeekRents[e.weekday] = e.rentCount
  });

  props.cWeekRevenue.forEach(e => {
    cWeekRevenue[e.weekday] = e.rentPrice
  });

  props.lWeekRevenue.forEach(e => {
    lWeekRevenue[e.weekday] = e.rentPrice
  });

  console.log(lWeekRents,cWeekRents,cWeekRevenue,lWeekRevenue)

  </script>
<script>
  import "admin-lte/plugins/fontawesome-free/css/all.css";
  import MainLayout from "./Layouts/MainLayout.vue";
  export default {
    layout: MainLayout,
  };
</script>
<template>
  <div class="row">
    <div class="col-lg-6">
      <div class="card ml-3 mr-0">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
            <h3 class="card-title">Number Of Rents Per Week</h3>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex w100">
            <CarRentChart :labels="labels" :titles="['This Week', 'Last Week']" :datasets="[cWeekRents, lWeekRents]" />
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card ml-3 mr-0">
        <div class="card-header border-0">
          <div class="d-flex justify-content-between">
            <h3 class="card-title">Revenue Of Rents Per Week</h3>
          </div>
        </div>
        <div class="card-body">
          <div class="d-flex w100">
            <CarRentChart :labels="labels" :titles="['This Week', 'Last Week']" :datasets="[cWeekRevenue, lWeekRevenue]" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
  
</style>
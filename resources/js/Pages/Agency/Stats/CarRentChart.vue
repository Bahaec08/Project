<script setup>
import Chart from 'chart.js/auto';
import { onMounted, ref } from 'vue';

const props = defineProps({
    labels : Array,
    datasets: Array,
    titles: Array
})

const canvas = ref('')

onMounted(() => {
  //console.log(props);
  new Chart(canvas.value, {
    type: 'line',
    data: {
      datasets: [{
            type: 'line',
            label: props.titles[0],
            data: props.datasets[0],
            tension: 0.1
        }, {
            type: 'line',
            label: props.titles[1],
            data: props.datasets[1],
            tension: 0.1
        }],
        labels: props.labels
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          type: 'linear',
           ticks: {
               stepSize: 1 // Set the step size to 1 for integer values
            }
        }
      },
      
    }
  });
})
</script>
<template>
  <div class="w100">
     <canvas class="chart" ref="canvas"></canvas>
  </div>
</template>
<style scoped>
.w100{
  width: 100%;
}
</style>
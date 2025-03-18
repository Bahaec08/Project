<script setup>
//import "slick-carousel/slick/slick.css";
//import "slick-carousel/slick/slick-theme.css";
import "slick-carousel";

import { Inertia } from '@inertiajs/inertia';
import { useSwalError } from '../../../Complosables/alert';
import { ref, onMounted } from "vue";
import { usePage } from '@inertiajs/inertia-vue3'

  const props = defineProps({
  cars: Object
});


import Car from './Car.vue';

const car = ref(null);
onMounted(() => {
$(car.value).slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 3000,
});
});

const handerFav = (fav, carid) => {

const handler = (id) => {
  if(!usePage().props.value.user)
    return useSwalError('Please Login or Register !');
    Inertia.get(`rent/${id}`)

  }

  if(!usePage().props.value.user)
    return useSwalError('Please Login or Register !');
  if (fav)
    Inertia.get(`/fav/delete/${carid}`)
  else
    Inertia.get(`/fav/add/${carid}`)
}
</script>
<template>
  <div>
    <section class="infoMost">
      <div class="ekri-info">
        <h1>Most Popular car rental deals</h1>
        <p>Rent a car from the most popular rental companies through our website. Enjoy flexible rental options, competitive <br> pricing,  and well-maintained cars with basic features</p>
        <div class="rental-list">
          <nav>
            <ul>
              <li><img src="/imgs/cars/Mercedes-Benz-logo-2011-1920x1080.png" alt="Mercedes-Benz"></li>
              <li><img src="/imgs/cars/ford-logo-2017.png" alt="Ford"></li>
              <li><img src="/imgs/cars/toyota-logo-1989-1400x1200.png" alt="Toyta"></li>
              <li><img src="/imgs/cars/Volkswagen-logo-2015-1920x1080.png" alt="Volkswagen"></li>
              <li><img src="/imgs/cars/honda-logo-1700x1150.png" alt="Honda"></li>
            </ul>
          </nav>
        </div>
      </div>
    </section>
    
    <div class="carCards" ref="car" >
      <Car v-for="car in cars" :car="car" :key="car.id">
        <template #fav>
           <img @click="handerFav(car.fav, car.id)" :src="car.fav ? '/imgs/red-heart.png' : '/imgs/heart.png'" class="heart"  alt="">
        </template>
        <Link :href="'/review/'+car.id" preserve-scroll>Review</Link>
      </Car>
    </div>
  </div>
</template>
<style scoped>
.slick-prev{
display: none!important;
}
</style>


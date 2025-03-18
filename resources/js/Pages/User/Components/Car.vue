<script setup>
defineProps({
  car: Object
})
</script>
<template>
  <article class="cardInfo" data-aos="fade-up" data-aos-once="true">
        <div class="carSec">
          <div>
            <img :src="'/storage/car/'+car.photo" class="show" alt="image" /> 
          </div>
          <slot name="fav" />
          <!-- <div class="rating">
              <div class="stars">
                <img src="/imgs/star.png" alt="">
                <img src="/imgs/star.png" alt="">
                <img src="/imgs/star.png" alt="">
                <img src="/imgs/star.png" alt="">
                <img src="/imgs/star.png" alt="">
              </div>
            <span>(50)</span>
          </div> -->
          <div class="carDesc">
            <h5>{{ car.carMark }} {{ car.carModel }}</h5>
            <slot name="options"></slot>
            <div class="caracter">
              <div>
                <img src="/imgs/3users-svgrepo-com.svg" alt="">
                <span>{{ car.nofplaces }} People</span>
              </div>
              <div>
                <img src="/imgs/steering-wheel-svgrepo-com.svg" alt="">
                <span>{{ car.Gearbox }}</span>
              </div>
              <div>
                <img src="/imgs/drive-svgrepo-com.svg" id="wheel" alt="">
                <span>{{ car.consumption }} km/ 1 littre</span>
              </div>
              <div>
                <img src="/imgs/gas-pump-icon.svg" alt="">
                <span>Disel</span>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="carPrice">
          <span><b>{{ car.price }} DT</b> <span><small>/ day</small></span></span>
          <slot />
        </div>
      </article >
</template>
<script>
  import MainLayout from '../Layouts/MainLayout.vue';
  import { useSwalError } from '../../../Complosables/alert';
  import Car from '../Components/Car.vue'
  import { Inertia } from '@inertiajs/inertia';


  export default {
    name: 'Search',
    props: ['search'],
    layout : MainLayout
  }
</script>
<script setup>
  import { usePage } from '@inertiajs/inertia-vue3'
  
  const handler = (id) => {

    if(!usePage().props.value.user)
      return useSwalError('Please Login or Register !');
    Inertia.get(`rent/${id}`)

  }
  const handerFav = (fav, carid) => {

    if(!usePage().props.value.user)
      return useSwalError('Please Login or Register !');
    if (fav)
      Inertia.get(`/fav/delete/${carid}`)
    else
      Inertia.get(`/fav/add/${carid}`)
      
  }
</script>
<template>
  <div class="container">
  <div class="right carCards">
      <Car v-for="car in search" :car="car" :key="car.id">
        <template #options>
          <ul class="option">
            <li v-if="car.babyseat">&#x2022; BabySeat</li>
            <li v-if="car.luggagehandler">&#x2022; Luggage Handler</li>
            <li v-if="car.gps">&#x2022; GPS</li>
          </ul>
        </template>
        <button @click="handler(car.id)">
              <span>Rent Now 
              <img src="/imgs/right-arrow.png" id="arrow" alt="">
            </span>
        </button>
        <template #fav>
          <img @click="handerFav(car.fav, car.id)" :src="car.fav ? '/imgs/red-heart.png' : '/imgs/heart.png'" class="heart" alt="">
        </template>
      </Car>
      </div>
    </div>  
</template>
<style scoped>
.container{
  position: relative;
  display: flex;
  flex-direction: row;
  width: 100%;
  background-color: #f6f6f6;
}

.right,.left{
  padding: .5rem 1rem;
}
.mw50{
  width: 100%;
  height: 250px;
}
.option{
  display: flex;
  flex-direction: row;
  color: #b1b3b8;
  column-gap: 5px;
  list-style: none;
  margin: 5px 0;
  font-size: 11px;
}
.left{
  flex: 1 0 0;
  height: 100%;
  background-color: white;
}
.right{
  flex: 4 0 0;
  height: 100%;
}
.carCards {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px;
}
.carSearchCard{
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding: 1.25rem 1rem;
  min-height: 50px;
  background-color: #ffffff;
  border-radius: 5px;
}
.carSearchCard h2{
  font-size: 1.5rem;
}
.carSearchCard img{
  width: 240px;
  align-self: center;
}
.last{
  display: flex;
  justify-content: space-around;
  align-items: center;
}
.rent-btn{
  width: 90px;
  height: 35px;
  border: 0;
  background-color: #8a78f0;
  color: white;
  border-radius: 20px;
}
.rent-btn:hover{
  cursor: pointer;
}
</style>
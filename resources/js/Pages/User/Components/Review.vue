<script setup>
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import {  ref } from 'vue';

import StarRating from 'vue-star-rating';

const review = useForm({
  text : '',
  rat : 0
})

const loaded = ref(false)



 const setRating = (r) => {
  review.rat = r
 }

const addReview  = (id) => {
    if(!review.text)
      return useSwalError('Please Enter a valid Text')
    review.post('/addreview/'+id)
    review.text = ''
    review.rat = 0
}
</script>
<script>
  import MainLayout from '../Layouts/MainLayout.vue';
import { useSwalError } from '../../../Complosables/alert';

  export default {
    layout : MainLayout,
  }
</script>
<template>
   <Head>
    <link rel="shortcut icon" href="/imgs/ekri.png" type="image/x-icon">
  </Head> 
  <!-- {{ rating }} -->
  <main>
    <div class="box">
      <div class="car-card">
          <img @load="loaded = true" :src="'/storage/car/'+usePage().props.value.car.photo" alt="">
          <h4>{{usePage().props.value.car.carMark }} {{ usePage().props.value.car.carModel }}</h4>
      </div>
      <div class="reviews-card">
          <div class="wrapper">
            <div class="review" v-for="review in usePage().props.value.reviews" :key="review.id">
            <img :src="'/storage/user/'+review.picture" alt="">
            <div class="content">
              <h3>{{ review.fullName }}</h3>
                <StarRating :read-only="true" :rating="review.rating" :star-size="15" />
              <p>{{ review.description }}</p>
            </div>
          </div>
        </div>
        <div v-if="loaded" class="bottomsec">
          <form @submit.prevent="addReview(usePage().props.value.car.id)" v-if="usePage().props.value.user && usePage().props.value.rented" action="">
            <StarRating class="pabs"  @update:rating ="setRating" v-model="rating" :star-size="15"  />
            <textarea v-model="review.text" placeholder="Review !" ></textarea>
            <button type="submit">
              <font-awesome-icon :icon="['fas', 'plus']" />
            </button>
          </form>
          <h3 v-else-if="!usePage().props.value.user">Please Log In!</h3>
          <h3 v-else>You need to rent before rating !</h3>
        </div>
      </div>
    </div>
  </main>  
</template>
<style scoped>
.box{
  display: flex;
  width: 750px;
    margin: 0 auto;
    padding: 1rem 1.25rem;
    border: 1px dashed rgb(198, 194, 194);
    border-radius: 5px;
    column-gap: 45px;
    height: 340px;
}
.pabs{
  position: absolute;
  top: -20px;
}
.car-card{  
  flex: 1;
  align-self: center;
}
.car-card h4{
  text-align: center;
  color: #221d1d;
}
.wrapper{
  display: flex;
  flex-direction: column;
  row-gap: 8px;
  overflow-y: auto;
  height: 212px;
  scrollbar-width: thin;
}
.review{
  display: flex;
  width: 100%;
  padding: 5px 10px;
  align-items: center;
  background-color: rgb(244, 242, 242);
  color: #221d1d;
  border-radius: 5px;
  min-height: 60px;
}
.car-card img{
  width: 230px;
}
.reviews-card{ 
  position: relative;
  flex: 2;
}

img{
  width: 30px;
  margin-right: 10px;
}
.content{
  flex: 1;
  font-size: .8rem;
}
.content p{
  font-size: 12px;
  margin-top: 2px;
}
.bottomsec{
    position: absolute;
    bottom: 25px;
    width: 100%;
    height: 59px;
}
.bottomsec h3 {
  text-align: center;
}
.bottomsec textarea{
  flex: 1;
  outline: 0;
  padding: .5rem;
  resize: none;
  border: 0;
  font-size: 14px;
}
.bottomsec textarea::placeholder{
  transform: translateY(2px);
}
.bottomsec form{
  display: flex;
  flex-direction: row;
  height: 38px;
  width: 100%;
  border: 1px solid #8a78f0;

}
.bottomsec form button{
  width: 50px;
  background-color: #8a78f0;
  border: 0;
  color: white;
}
.bottomsec form button svg{
  fill: white;
}
.bottomsec form textarea{
  flex: 1;
  outline: 0;
  padding: .5rem;
  resize: none;
  border: 0;
  font-size: 14px;
}

</style>
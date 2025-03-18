<script>
  import MainLayout from "./Layouts/MainLayout.vue";
  export default {
  components: { useSwalError },
    layout: MainLayout,
  };
</script>

<script setup>
  import HeaderCom from "./Components/HeaderCom.vue";
  import Modal from "./Components/Modal.vue";
  import RentForm from "./Components/RentForm.vue";
  import CarSection from "./Components/CarSection.vue";
  import CarWork from "./Components/CarWork.vue";
  import WhyUs from "./Components/WhyUs.vue";
  import SubForm from "./Components/SubForm.vue";
  import ReviewsSlick from "./Components/ReviewsSlick.vue";

  
  import { usePage } from "@inertiajs/inertia-vue3";
import useSwalError from '../../Shared/useSwalError.vue';
  
  const props = defineProps({
    cars: Object,
    reviews: Object
});
</script>

<template>

  <HeaderCom />



  <RentForm />

  <CarSection :cars="cars"/>

  <CarWork />

  <WhyUs />

  <SubForm />

  <ReviewsSlick :reviews="reviews" />
</template>
<style scoped>
a {
  color: rgb(70, 70, 70);
  text-decoration: none;
  font-size: 0.7rem;
  font-weight: 400;
}
a[role="button"] {
  font-size: 0.8rem;
  padding: 0.5rem 2rem;
  border-radius: 20px;
}
</style>

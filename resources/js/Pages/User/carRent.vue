<script setup>
  import Modal from "./Components/Modal.vue";
  import { useForm } from "@inertiajs/inertia-vue3";
  import { computed, ref } from "vue";
  import { usePage } from "@inertiajs/inertia-vue3";
   
   const props = defineProps({
     car: Object,
     start: String,
     end: String,
     periode: {
      type: Number,
      NonNullable: true
     }
   });

   const Payment = useForm({
    carId: props.car.id,
    start: props.start,
    end: props.end,
    creditPay: false,
    periode: props.periode,
    options: []
   })

   
   const option = ref([])



   const fullPrice = computed(() => {
    let sum = props.car.price * props.periode;
    Payment.options.forEach(e => sum += usePage().props.value.options[e - 1].price)
    return sum
   })
   
   const submit = () => {
    Payment.post(rout('pay'),{
      onSuccess: (page) => {
        console.log(page)
      }
    })
   }




   

</script>
<script>
    import MainLayout from "./Layouts/MainLayout.vue"
  import { useForm } from "@inertiajs/inertia-vue3";
// import Register from 'vendor/laravel/breeze/stubs/inertia-react/resources/js/Pages/Auth/Register'
  export default {
    layout: MainLayout
}
</script>
<template>
  <Modal />
    
  <main class="card">
    <Link class="back" :href="route('home')">Home</Link>
    <form @submit.prevent="Payment.post(route('pay'))">
       <h1>Confirm Payment</h1> 
       <img class="carimg" :src="'/storage/car/'+car.photo" alt="">
        <div class="info">
          {{ car.carMark }}
          {{ car.carModel }}
          {{ car.consumption }}
          from {{ start }} to {{ end }}
        </div>
        <div class="paymethod">
            <label :class="{ active: !Payment.creditPay}" for="cache">
              <span>Cache</span>
              <input hidden type="radio" :checked="!Payment.creditPay" v-on:change="Payment.creditPay = false" name="paymethod" id="cache">
            </label>
            <label :class="{ active: Payment.creditPay}" for="credit">
              <span>Credit</span>
              <input hidden type="radio" v-on:change="Payment.creditPay = true" name="paymethod" id="credit">
            </label>
        </div>
        {{ fullPrice }}
        <ul >
          <li v-for="op in usePage().props.value.options">
               <!-- {{ op.id }} -->
               <label :for="op.id">{{ op.optionName }}</label>
               <input v-model="Payment.options" :value="op.id" type="checkbox" :id="op.id">
          </li>
        </ul>
        <div v-show="Payment.creditPay" class="credit-card">
          Credit Card Here !
        </div>
        <div class="paybtn">
          <button type="submit" class="payNow">Pay Now ! {{ fullPrice }} TND</button>
        </div>
      </form>
  </main>
</template>
<style scoped>
  .card{
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    width: 410px;
    padding: 1.25rem;
    background-color: whitesmoke;
    margin-top: 25px;
    min-height: 50px;
    margin: 0 auto;
    border-radius: 5px;
  }
  .back{
    align-self: flex-start;
    margin-bottom: 10px;
  }
  .card h1 {
    font-size: 1.5rem;
  }
  .carimg{
    width: 250px;
  }
  .paymethod{
    display: flex;
    justify-content: space-evenly;
    align-items: center;
    width: 100%;
    padding: 5px 0;
  }
  .paymethod label{
    background-color: #e1dede;
    width: 145px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 30px;
    border-radius: 20px;
    color: #343232;
  }
  .paymethod label:hover{
    cursor: pointer;
  }
  label:has(> input:checked){
    background-color: #b7afed;
    color: white;
  }
  .paybtn{
    width: 100%;
  }
  .payNow{
    width: 100%;
    height: 35px;
    border: 0;
    font-size: .95rem;
    border-radius: 20px;
    background-color: #53ab37;
    color: white;
    cursor: pointer;
  }
  .paymethod label.active{
    background-color: #7c4fe6;
    color: white;
  }
</style>
<script setup>

import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";



const form = useForm({
  location: ''
})

const request = ref({
  start : null,
  end: null
})



function datemodifeir(date){

  return `${date?.getFullYear()}-${date?.getMonth() + 1}-${date?.getDate()}`;
}


function send(){
  form
  .transform((data) => ({
    ...data,
    start : this.datemodifeir(this.request.start),
    end: this.datemodifeir(this.request.end)
  }))
  .get('/search')
}


</script>

<template>
  <div class="ekri-form">
    <form class="search-form" @submit.prevent="send()">
      <div class="form-group">
        <p class="black-p">Where to Pick Up</p>
        <font-awesome-icon class="ekri-input-icon" :icon="['fas', 'location-dot']" />
        <input type="text" placeholder="Enter Location" class="form-input" v-model="form.location"/>
      </div>
      
      <VDatePicker v-model="request" :min-date="new Date()" is-range>
        <template #default="{ inputValue, inputEvents }">
          <div class="flex-layout">
            <div>
              <p class="black-p">Pick Up Date</p>
              <font-awesome-icon class="ekri-input-icons" :icon="['fas', 'calendar']" />
              <input class="form-input" :value="inputValue.start" v-on="inputEvents.start" placeholder="Start date"/>
            </div>
            <div>
              <p class="black-p">Return Date</p>
              <font-awesome-icon class="ekri-input-icons" :icon="['fas', 'calendar']"/> 
              <input class="form-input" disabled :value="inputValue.end" v-on="inputEvents.end" placeholder="End date" />
            </div>
          </div>
        </template> 
        </VDatePicker>
        <div class="form-group-sub">
          <input type="submit" class="submit-btn-fom" value="Search" />
        </div>
    </form>
  </div>
</template>
<style scoped>
.flex-layout{
  display: flex;
  flex-direction: row;
  column-gap: 20px;
  justify-content: center;
  align-items: center;
}
.flex-layout div{
  position: relative;
}
.black-p{
  margin-bottom: 10px;
}
.ekri-input-icons{
  font-size: 16px;
  position: absolute;
  left: 10px;
  bottom: 10px;
  color: rgb(138,120,240);
}
input{outline: none;}
</style>
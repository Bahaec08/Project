
<script>
  import MainLayout from "./Layouts/MainLayout.vue";
  //import useSwalSuccess from '../../Shared/useSwalSuccess.vue';
  export default {
    layout: MainLayout
  }
</script>

<script setup>
  //import UseSwalSuccess from '../../Shared/UseSwalSuccess.vue';
  import UseSwalSuccess from "@/Shared/UseSwalSuccess.vue";
  import { Inertia  } from "@inertiajs/inertia";
  import { usePage } from "@inertiajs/inertia-vue3";
  
    defineProps({
      list: Array
    })

    const acceptWaiting = (id) => {
      Inertia.get(route('rent.acceptewaiting'),{
        id : id
      })
    }
    
    const refuseWaiting = (id) => {
      Inertia.get(route('rent.refusewaiting'),{
        id : id
      })
    }


 </script>
<template>
  <!-- <UseSwalSuccess /> -->
  <UseSwalSuccess v-if="usePage().props.value.flash.success" :message="usePage().props.value.flash.success" />
   <!-- <use-swal-success v-if="usePage().props.value.flash.success" :message="usePage().props.value.flash.success"/>   -->
    <!-- <useSwalSuccess v-if="usePage().props.value.flash.success" :message="usePage().props.value.flash.success" /> -->
    
    <div class="content">
    <div class="container-fluid">
      <section class="content">
        
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Waiting list</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse" >
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove" >
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          
          <div class="card-body p-0">
            <!-- <div v-if="list.length ===0" >
              <h4>no request at the moment</h4>
            </div> -->
            <table class="table table-striped projects">
              
              <thead>
                <tr>
                  <th style="width: 1%">#</th>
                  <th>Client</th>
                  <th>Car</th>
                  <th>From</th>
                  <th>To</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in list" :key="item.id">
                  <td>{{ item.id }}</td>
                  <td>
                    <img id="img" :src="'/storage/user/'+item.picture" alt="{{ item.firstName item.lastName }}"> 
                    {{item.firstName}} {{item.lastName}}
                  </td>
                  <td><img  id="carimg" :src="'/storage/car/'+item.photo" :title="item.carmodel" ></td>
                  <td>{{ item.startDate }}</td>
                  <td>{{ item.endDate }}</td>
                  <td>
                    <Link  as="button" class="btn btn-success btn-sm mx-2" @click="acceptWaiting(item.rentID)"><i class="fas fa-check"></i>Accepte</Link>
                    <Link  as="button" class="btn btn-danger btn-sm" @click="refuseWaiting(item.rentID)"><i class="fas fa-trash"></i> Refuse</Link>
                  </td>
                </tr>
               
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>
<style scoped>
#img{
  width: 40px;
  aspect-ratio: 1 / 1;
  border-radius: 50%;
}
#carimg{
  width: 100px;
}
</style>
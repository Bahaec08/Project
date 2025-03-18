<script setup>
import Pagination from "@/Shared/Pagination.vue";
import CarModal from "./CarModal.vue";
import { Inertia } from "@inertiajs/inertia";
import { ref, toRefs, onMounted } from 'vue';
import { useSwalSuccess as Alert } from "../../../Complosables/alert";
import useSwalSuccess from '../../../Shared/useSwalSuccess.vue';
import useSwalError from '../../../Shared/useSwalError.vue';


const viewCar = ref(null)
const markFilter = ref("")
const modelFilter = ref("")
// const per_page = ref(4)

const props = defineProps({
    cars: Object,
    Marks: Object,
    Models: Object,
    flash: Object
});


const { flash } = toRefs(props)


if(flash._object.flash.success)
  Alert("Car deleted successfully");


const clear = () => {
  props.flash.success = null
}

const search = function(){
  if(markFilter.value || modelFilter.value){
    Inertia.get(route("carslist", { mark: markFilter.value, model: modelFilter.value}), {}, {
      replace: true,
      preserveState: true
    })
  }
}








</script>
<script>
  import MainLayout from "../Layouts/MainLayout.vue";

  export default {
    layout: MainLayout
}

</script>

<template>
    <CarModal :car="viewCar" />
    <useSwalSuccess v-if="props.flash.success" :message="props.flash.success" @close="clear" />
    <useSwalError v-if="props.flash.error" :message="props.flash.error" @close="clear" />

    <div class="content">
    <div class="container-fluid">
      
      <section class="content">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">The list of all cars</h3>
            <div class="card-tools">
              <button
                type="button"
                class="btn btn-tool"
                data-card-widget="collapse"
                title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button
                type="button"
                class="btn btn-tool"
                data-card-widget="remove"
                title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="d-flex justify-content-center align-items-center pt-3">
            
            <select @change="search" v-model="markFilter" class="form-control col-2" >
              <option value="" :selected="markFilter == null">Filter by mark</option>
              <option v-for="car in cars.data" :key="car.id" :value="car.carMark ">{{ car.carMark }}</option>
            </select>

            <select @change="search" v-model="modelFilter" class="form-control col-2" >
              <option value="" :selected="modelFilter == null" >Filter by model</option>
              <option v-for="car in cars.data" :key="car.id" :value="car.carModel">{{ car.carModel}}</option>
            </select>
          </div>
          <div class="card-body p-0">
            <table class="table table-striped projects">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Car photo</th>
                  <th>car mark</th>
                  <th>Car model</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="car in cars.data" :key="car.id">
                  <td> {{ car.id }}</td>
                  <td>
                    <img :src="'/storage/car/'+car.photo" class="show" alt="image" style="width:150px;"/>
                  </td>
                  <td>
                    {{ car.carMark }}
                  </td>
                  <td class="project_progress">
                    {{ car.carModel }}
                  </td>
                  <td class="project-actions text-center">
                    <button @click="viewCar = car" data-toggle="modal" data-target="#exampleCarModal" class="btn btn-primary btn-sm mr-2" href="#">
                      <i  class="fas fa-folder"> </i>
                      View
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
           <div class="card-footer clearfix d-flex justify-content-around"> 
            <!-- <select @change="pageMap" v-model="per_page" class="form-control col-1">
              <option value="2">2</option>
              <option value="4">4</option>
              <option value="10">10</option>
              <option value="20">20</option>
            </select> -->

            <Pagination
              :links="props.cars.links"
              :prev="props.cars.prev_page_url"
              :next="props.cars.next_page_url" />
           </div> 
        </div>
      </section>
    </div>
  </div>
</template>
<style scoped>
.pcenter{
  text-align: center;
}
</style>

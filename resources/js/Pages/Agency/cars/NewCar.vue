<script>
import MainLayout from "../Layouts/MainLayout.vue";
export default {
  layout: MainLayout,
};
</script>
<script setup>
import { useForm, usePage} from "@inertiajs/inertia-vue3";
import UseSwalSuccess from "@/Shared/UseSwalSuccess.vue";
import { reactive } from "vue";



const addCar = useForm({
  mark: null,
  model: null,
  consumption: null,
  Kilometrage: null,
  price: null,
  gearbox: 'Choose gearbox type',
  petrolType: 'Choose petrol type',
  nofplaces: null,
  photo : null,
});

const checkFile =  (e) => {
  if(e.target.files[0].size > 1000000)
    return addCar.errors.photo = 'Max file sizes 1MB';
  delete addCar.errors.photo
};

const submitAddCar = () => {
  addCar.post("add", {
    onSuccess: (page) => {
      addCar.reset()
    },
    onError: (error) => {
    },
  });
};

// const flashMessage = reactive({
//   success: null,
// });

// const { flash } = usePage().props;
// flashMessage.success = flash.success || null;

</script>
<template>
  <!-- {{ usePage() }} -->
  <!-- <UseSwalSuccess v-if="flashMessage" :message="success"/> -->
  
  <UseSwalSuccess v-if="usePage().props.value.flash.success" :message="usePage().props.value.flash.success" />
  <div class="row ml-2 mr-2">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Add car</h3>
        </div>

        <form @submit.prevent="submitAddCar">
          <div class="card-body">
            <div class="row">
              <div class="col form-group">
                <label for="exampleInputEmail1">Car mark</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleInputEmail1"
                  placeholder="Enter car mark"
                  v-model="addCar.mark"
                />
                <span class="ekri-error" v-if="addCar.errors.mark">{{
                  addCar.errors.mark
                }}</span>
              </div>
              <div class="col form-group">
                <label for="exampleInputEmail1">Car model</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleInputEmail1"
                  placeholder="Enter car model"
                  v-model="addCar.model"
                />
                <span class="ekri-error" v-if="addCar.errors.model">{{
                  addCar.errors.model
                }}</span>
              </div>
            </div>

            <div class="row">
              <div class="col form-group">
                <label for="exampleInputConsumption">Consumption</label>
                <input
                  type="number"
                  class="form-control"
                  id="exampleInputConsumption"
                  placeholder="Enter consumption"
                  v-model="addCar.consumption"
                />
                <span class="ekri-error" v-if="addCar.errors.consumption">{{
                  addCar.errors.consumption
                }}</span>
              </div>
              <div class="col form-group">
                <label for="exampleInputMileage">Kilometrage</label>
                <input
                  type="number"
                  class="form-control"
                  id="exampleInputMileage"
                  placeholder="Enter kilomerage"
                  v-model="addCar.Kilometrage"
                />
                <span class="ekri-error" v-if="addCar.errors.Kilometrage">{{
                  addCar.errors.Kilometrage
                }}</span>
              </div>
            </div>

            <div class="row">
                <!-- <div class="col form-group">
                  <label for="exampleInputConsumption">N° of Places</label>
                  <input
                    type="number"
                    class="form-control"
                    id="exampleInputConsumption"
                    placeholder="Enter N° of Places"
                    v-model="addCar.nofplaces"
                    max="10"
                  />
                  <span class="ekri-error" v-if="addCar.errors.nofplaces">
                    {{ addCar.errors.nofplaces }}</span>
                </div> -->
              <div class="col form-group">
                <label for="exampleInputConsumption">Gearbox</label>
                <select
                  class="form-control"
                  id="exampleInputConsumption"
                  v-model="addCar.gearbox">
                  <option value="Choose gearbox type">Choose gearbox type</option>
                  <option value="Manual">Manual</option>
                  <option value="Automatic">Automatic</option>
                </select>
                <span class="ekri-error" v-if="addCar.errors.gearbox">
                  {{ addCar.errors.gearbox }}</span>
              </div>
              <div class="col form-group">
                  <label>Chosse petrol type</label>
                  <select class="form-control" v-model="addCar.petrolType">
                      <option value="Choose petrol type" >Choose petrol type</option>
                      <option value="Essance">Essance</option>
                      <option value="Disel">Disel</option>
                  </select>
                  <span class="ekri-error" v-if="addCar.errors.petrolType">{{
                    addCar.errors.petrolType
                  }}</span>
              </div>
            </div>
            <div class="row">
              <div class="col form-group">
                <label for="exampleInputEmail1">Price per day</label>
                <input
                  type="number"
                  class="form-control"
                  id="exampleInputPhone"
                  placeholder="Enter price per date"
                  v-model="addCar.price"
                />
                <span class="ekri-error" v-if="addCar.errors.price">{{ addCar.errors.price }}</span>
              </div>

              <div class="col form-group">
                  <label for="exampleInputConsumption">N° of Places</label>
                  <input
                    type="number"
                    class="form-control"
                    id="exampleInputConsumption"
                    placeholder="Enter N° of Places"
                    v-model="addCar.nofplaces"
                    max="10"
                  />
                  <span class="ekri-error" v-if="addCar.errors.nofplaces">
                    {{ addCar.errors.nofplaces }}</span>
                </div>

              
            </div>
            <div class="row">
              <div class="col form-group">
                <label for="exampleInputFile">File input</label>
                <div class="input-group">
                  <div class="custom-file">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    <input
                      type="file"
                      class="custom-file-input"
                      accept="image/*"
                      id="exampleInputFile"
                      @change="checkFile($event)"
                      @input="addCar.photo = $event.target.files[0]"/>
                  </div>

                </div>
                <div class="ekri-error"  v-if="addCar.errors.photo">{{ addCar.errors.photo }}</div>

              </div>
            </div>
          </div>
          <div class="card-footer">
            <input
              type="submit"
              :disabled="addCar.processing"
              class="btn btn-primary"
              value="ADD"
            />
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

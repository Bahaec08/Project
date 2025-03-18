<script>
import MainLayout from "../Layouts/MainLayout.vue";
export default {
  layout: MainLayout,
};
</script>
<script setup>
import { computed } from "vue";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { useSwalSuccess, useSwalError } from "../../../Complosables/alert";

const addOption = useForm({
  option_id: 0,
  nop: 0,
  price: 0
});

const selectedOp = computed(() => {
  return usePage().props.value.optionslist.filter(e => e.id == addOption.option_id)[0]
})

const submitaddOption = () => {
    addOption.post(route('option.store'), {
    onSuccess: (page) => {
      useSwalSuccess("Option added successfully");
      addOption.reset()
    },
    onError: (error) => {
      useSwalError("An error occured !");
    },
  });
};
</script>
<template>
  <div class="row ml-2 mr-2">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Add option</h3>
        </div>
        <!-- {{ usePage() }} -->
        <form @submit.prevent="submitaddOption">
          <div class="card-body">
            <div class="row">
              <div class="col form-group">
                <label>Chosse petrol type</label>
                  <select v-model="addOption.option_id" class="form-control">
                    <option value=0 selected>Choose your Option</option>
                      <option v-for="option in usePage().props.value.optionslist" :value="option.id">{{ option.opname }}</option>
                  </select>
               </div>
              </div>
               <div v-if="addOption.option_id != 0" class="row">
                <div class="col form-group">
                  <label for="exampleInputConsumption">N° of {{ selectedOp.opname }}</label>
                    <input
                      type="number"
                      class="form-control"
                      v-model="addOption.nop"
                    />
                    <!-- <span class="ekri-error" v-if="addCar.nofplaces">{{
                      addCar.errors.nofplaces
                    }}</span> -->
                </div>
                <div class="col form-group">
                  <label for="exampleInputConsumption">Price of {{ selectedOp.opname }}</label>
                    <input
                      type="number"
                      class="form-control"
                      v-model="addOption.price"
                    />
                    <!-- <span class="ekri-error" v-if="addCar.nofplaces">{{
                      addCar.errors.nofplaces
                    }}</span> -->
                </div>
                </div>  
            </div>

          <div class="card-footer">
            <input
              type="submit"
              :disabled="addOption.processing"
              class="btn btn-primary"
              value="ADD"
            />
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

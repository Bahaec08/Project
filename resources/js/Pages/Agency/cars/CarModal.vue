<script setup>
import { Inertia } from "@inertiajs/inertia";
import { useForm } from '@inertiajs/inertia-vue3';
import { ref, toRefs } from "vue";
import { useSwalSuccess, useSwalError, useSwalConfirm } from "../../../Complosables/alert";

const props = defineProps({
  car: Object
});


const refProps = toRefs(props)


const update = ref(false);

const formUpdate = useForm({
  carModel: null,
  carMark: null,
  consumption: null,
  Gearbox: null,
  Kilometrage: null,
  petrolType: null,
  price: null
})



const deleteCar = (id) => {
  Inertia.get(route("car.delete", { car: id }), {
    onSuccess: (page) => {
      useSwalSuccess("Car deleted successfully");
    },
    onError: (error) => {
      useSwalError(error.message ?? "An error occured !");
    },
  });
};



const updateCar = () => {
  $("#exampleCarModal").modal('hide')
  update.value = !update.value
  formUpdate.transform(d => ({
    id: refProps.car.value.id,
    ...d
  })).post(route("car.update"),{
    onSuccess: () => {
      formUpdate.reset()
    }
  });
};



const deleteConfirmation = (car) => {
  const message = `You are going to delete "${car.carMark} ${car.carModel}" continue ?`;
  useSwalConfirm(message, () => {
    deleteCar(car.id);
  });
};


const updateConfimration = (car) => {
  const message = `You are going to update "${car.carMark} ${car.carModel}" continue ?`;
  useSwalConfirm(message, () => {
    updateCar();
  });
};

</script>
<template>
  <Teleport v-if="car" to="body">
    <!-- <main>
      <div class="container">
        <section>
          <button @click="$emit('close')">X</button>
          {{ agency }}
        </section>
      </div>
    </main> -->
    <div class="modal fade" id="exampleCarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <!-- <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            
          </div> -->
          <!-- {{ car }} -->

          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <table class="table">
              <tbody>
                <tr>
                  <td>Car Mark</td>
                  <td>
                    <input v-if="update" :placeholder="car.carMark" v-model="formUpdate.carMark"/>
                    <span v-else>{{ car.carMark }}</span>
                  </td>
                </tr>
                <tr>
                  <td>Car Model</td>
                  <td>
                    <input v-if="update" :placeholder="car.carModel" v-model="formUpdate.carModel"/>
                    <span v-else>{{ car.carModel}}</span>
                  </td>
                </tr>
                <tr>
                  <td>Consumption</td>
                  <td>
                    <input v-if="update" :placeholder="car.consumption" v-model="formUpdate.consumption"/>
                    <span v-else>{{ car.consumption}}</span>
                  </td>
                </tr>
                <tr>
                  <td>Kilometrage</td>
                  <td>
                    <input v-if="update" :placeholder="car.Kilometrage" v-model="formUpdate.Kilometrage"/>
                    <span v-else>{{ car.Kilometrage}}</span>
                  </td>
                </tr>
                <tr>
                  <td>Gearbox</td>
                  <td>
                    <select v-if="update"  v-model="formUpdate.Gearbox" >
                      <option >Select Gearbox</option>
                      <option  v-for="item in ['Automatic','Manuel']" :key="item" :value="item">{{ item }}</option>
                    </select>
                    <span v-else >{{ car.Gearbox}}</span>
                  </td>
                </tr>
                <tr>
                  <td>Petrol Type</td>
                  <td>
                    <select v-if="update"  v-model="formUpdate.petrolType" >
                      <option>Select Petrol</option>
                      <option  v-for="item in ['Disel','Essance']" :key="item" :value="item">{{ item }}</option>
                    </select>
                    <span v-else >{{ car.petrolType }}</span>
                  </td>
                </tr>
               <tr>
                <td>Price/Day</td>
                  <td>
                    <input v-if="update" :placeholder="car.price" v-model.number="formUpdate.price"/>
                    <span v-else>{{ car.price}}</span>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="d-flex justify-content-center">
              <img v-if="car.photo"
                :src="'/storage/car/' + car.photo"
                class="show"
                alt="image"
                style="width: 500px"
                title="{{ car.carMark }}"
              />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" @click="deleteConfirmation(car)" data-dismiss="modal">
              Delete
            </button>
            <button type="button" @click="update = !update" :class="{'btn-secondary' : update, 'btn-primary': !update}" class="btn btn-primary">{{update ? 'Back' : 'Update' }}</button>
            <button v-if="update" type="button" @click="updateConfimration(car)" class="btn btn-primary">Save Update</button>
          </div>
        </div>
      </div>
    </div>
  </Teleport>
</template>

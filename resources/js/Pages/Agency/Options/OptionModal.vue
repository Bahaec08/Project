<script setup>
import { Inertia } from "@inertiajs/inertia";
import { useSwalSuccess, useSwalError, useSwalConfirm } from "../../../Complosables/alert";

defineProps({
  option: Object
});
defineEmits(["close"]);

const deleteOption = (id) => {
  Inertia.get(route("option.delete", { option: id }), {
    onSuccess: (page)=>{
      useSwalSuccess("Option deleted successfully");
    },
    onError: (error) => {
      useSwalError(error.message ?? "An error occured");
    },
  });
};

const deleteConfirmation = (option) => {
  const message = `You are going to delete "${option.optionName}" continue ?`;
  useSwalConfirm(message, () => {
    deleteOption(option.id);
  });
};
</script>
<template>
  <Teleport v-if="option" to="body">
    <!-- <main>
      <div class="container">
        <section>
          <button @click="$emit('close')">X</button>
          {{ agency }}
        </section>
      </div>
    </main> -->
    <div
      class="modal fade"
      id="exampleOptionModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table">
              <tbody>
                <tr>
                  <td>Option name</td>
                  <td>{{ option.optionName }}</td>
                </tr>
                <tr>
                  <td>Total</td>
                  <td>{{ option.optionNumber }}</td>
                </tr>
                <tr>
                  <td>Available</td>
                  <td>djgbjg</td>
                </tr>
              </tbody>
            </table>
            <div class="d-flex justify-content-center">
              <!-- <img
                :src="'/storage/car/' + car.photo"
                class="show"
                alt="image"
                style="width: 500px"
              /> -->
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="deleteConfirmation(option)" data-dismiss="modal">
              Delete
            </button>
            <button type="button" class="btn btn-primary">Update</button>
          </div>
        </div>
      </div>
    </div>
  </Teleport>
</template>

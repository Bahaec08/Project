<script setup>
import OptionModal from "./OptionModal.vue";
import { ref } from 'vue'

const viewOption = ref(null)

const props = defineProps({
    options: Object
});


</script>
<script>
  import MainLayout from "../Layouts/MainLayout.vue";
import { usePage } from "@inertiajs/inertia-vue3";
  export default {
    layout: MainLayout
  }
</script>

<template>
  <OptionModal :option="viewOption" />
    <div class="content">
    <div class="container-fluid">
      <section class="content">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">The list of all options</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-striped projects">
              <thead>
                <tr>
                  <th>id</th>
                  <th>Option name</th>
                  <th>Total</th>
                  <th>Cost</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="option in options" :key="option.id">
                  <td>
                    {{ option.id }}
                  </td>
                  <td>
                    {{ option.opname }}
                  </td> 
                  <td>
                    {{ option.nop }}
                  </td>
                  <td>
                    {{ option.price }}
                  </td>
                  <td class="project-actions">
                    <button @click="this.viewOption = option" data-toggle="modal" data-target="#exampleOptionModal" class="btn btn-primary btn-sm mr-2 text-center" href="#">
                      <i class="fas fa-folder"> </i>
                      View
                    </button>
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

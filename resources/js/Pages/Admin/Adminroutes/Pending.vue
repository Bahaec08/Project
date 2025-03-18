<script setup>
import Pagination from "@/Shared/Pagination.vue";
import PendingModal from "./PendingModal.vue";
import { ref } from "vue";
import useSwalSuccess from '../../../Shared/useSwalSuccess.vue';


const viewPending = ref(null)

const props = defineProps({
  pendingAgencies: Object,
  flash : Object
});


const clear = () => {
  props.flash.success = null
}



</script>

<script>
import "admin-lte/plugins/fontawesome-free/css/all.css";
import MainLayout from "../Layouts/MainLayout.vue"

export default {
  layout: MainLayout,
};


</script>
<template>
  <PendingModal :agency="viewPending" />
  <useSwalSuccess v-if="props.flash.success" :message="props.flash.success" @close="clear" />
  <div class="content">
    <div class="container-fluid">
      <section class="content">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">The list of pending agencies</h3>
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
          <div class="card-body p-0">
            <table class="table table-striped projects">
              <thead>
                <tr>
                  <td >#</td>
                  <td >Agency Name</td>
                  <!-- <td >Number of cars</td>
                  <td >Total rents</td> -->
                  <td >Phone number</td>
                  <td class="text-center">Action</td>
                </tr>
              </thead>
              <tbody>
                <tr v-for="agency in pendingAgencies.data" :key="agency.id">
                  <td>{{ agency.id }}</td>
                  <td>{{ agency.agencyName }}</td>
                  <!-- <td>{{ agency.carsNumber }}</td>
                  <td>{{ agency.phone }}</td> -->
                  <td>{{ agency.phone }}</td>
                  <td class="project-actions text-right">
                    <button @click="viewPending = agency" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-sm mr-2" href="#">
                      <i  class="fas fa-folder"> </i>
                      View
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <Pagination
            :links="props.pendingAgencies.links"
            :prev="props.pendingAgencies.prev_page_url"
            :next="props.pendingAgencies.next_page_url" />
        </div>
      </section>
    </div>

  </div>
  


</template>

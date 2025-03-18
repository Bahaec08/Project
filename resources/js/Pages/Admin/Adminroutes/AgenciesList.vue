<script setup>
import Pagination from "@/Shared/Pagination.vue";
import AgencyModal from "./AgencyModal.vue";
import { ref } from 'vue'

const viewAgency = ref(null)

const props = defineProps({
    agencies: Object,
});

</script>
<script>
import MainLayout from "../Layouts/MainLayout.vue"
  export default {
    layout: MainLayout,
  }
</script>

<template>
    <AgencyModal :agency="viewAgency"/>
    <div class="content">
    <div class="container-fluid">
      <section class="content">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">The list of all agencies</h3>
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
                  <td >#</td>
                  <td >Agency Name</td>
                  <td >Number of cars</td>
                  <td >Total rents</td>
                  <td class="text-center">Action</td>
                </tr>
              </thead>
              <tbody>
                <tr v-for="agency in agencies.data" :key="agency.id">
                  <td>{{ agency.id }}</td>
                  <td>
                     {{ agency.agencyName }}
                  </td>
                  <td>
                    {{ agency.nofcars }}
                  </td>
                  <td class="project_progress">
                      {{ agency.nofrents }}
                    <font-awesome-icon icon="fa-solid fa-eye" />
                  </td>
                  <td class="project-actions text-right">
                    <button @click="viewAgency = agency" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary btn-sm mr-2" href="#">
                      <i  class="fas fa-folder"> </i>
                      View
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer clearfix">
            <Pagination
            :links="props.agencies.links"
            :prev="props.agencies.prev_page_url"
            :next="props.agencies.next_page_url" />
          </div>
          
        </div>
      </section>
    </div>
  </div>
</template>

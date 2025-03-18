<script setup>
  defineProps({
    agency: Object
  })
</script>

<script>
import "admin-lte/plugins/fontawesome-free/css/all.css";
import MainLayout from "./Layouts/MainLayout.vue";
import { usePage } from "@inertiajs/inertia-vue3";
export default {
  layout: MainLayout
};
</script>
<template>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ usePage().props.value.nofusers }}</h3>
              <p>N° Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ usePage().props.value.rentsrevenue  ? usePage().props.value.rentsrevenue : '0'}} DT </h3>
              <p>TOTAL REVENUE</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ usePage().props.value.adminrevenue  ? usePage().props.value.adminrevenue : '0'}} DT </h3>
              <p>ADMIN REVENUE</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ usePage().props.value.agencyrevenue  ? usePage().props.value.agencyrevenue : '0'}} DT </h3>
              <p>AGENCY REVENUE</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>
</template>

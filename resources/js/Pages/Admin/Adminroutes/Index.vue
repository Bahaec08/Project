<script>
import "admin-lte/plugins/fontawesome-free/css/all.css";
import MainLayout from "../Layouts/MainLayout.vue";
export default {
  layout: MainLayout,
};
</script>
<script setup>
  import { usePage } from "@inertiajs/inertia-vue3";
</script>
<template>
 <section class="content">
    <div class="container-fluid">
      <div class="d-flex justify-content-center row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ usePage().props.value.nofagencies }}</h3>
              <p>N° of Agencies</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a v-if="usePage().props.value.nofagencies" href="/download/agencies" download class="small-box-footer">Download all Agencies <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ usePage().props.value.nofusers }}</h3>
              <p>N° of Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a v-if="usePage().props.value.nofusers" href="/download/users" download class="small-box-footer">Download all Users <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ usePage().props.value.nofrents }}</h3>
              <p>N° of Rents</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a v-if="usePage().props.value.nofrents" href="/download/rents" download class="small-box-footer">Download all Rents <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ usePage().props.value.nofactiveusers }}</h3>
              <p>N° of Active Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

      </div>

    </div>
  </section>
</template>

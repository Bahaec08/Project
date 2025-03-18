<script setup>
  // import { Head } from "@inertiajs/vue3";

  import { provide, toRefs } from "vue";

  import Menu from "./Partials/Menu.vue"
  import "admin-lte/plugins/fontawesome-free/css/all.css";
  import "admin-lte/dist/css/adminlte.css";
  import 'admin-lte/plugins/bootstrap/js/bootstrap.bundle'
  import 'admin-lte/dist/js/adminlte'

  


</script>
<template>
  <Head>
    <title>ADMIN-EKRI</title>
    <link rel="shortcut icon" href="imgs/ekri.png" type="image/x-icon">
  </Head>
  <div class="dark-mode sidebar-mini" style="overflow-x: hidden;" cz-shortcut-listen="true">
    <div class="wrapper">
      <nav class="main-header navbar navbar-expand navbar-white navbar-dark bg-dark">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
              <i class="fas fa-bars"></i>
            </a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto"> 
          <li class="nav-item">
            <div class="theme-switch-wrapper nav-link">
              <label class="theme-switch" for="checkbox">
              <input type="checkbox" id="checkbox">
              <span class="slider round"></span>
              </label>
            </div>
          </li>      
          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>  
        </ul>
      </nav>
      <Menu /> <!-- :NoAgencies="NumberOfAgencies" :PendingList="PendingList" -->
     <div class="content-wrapper">
        <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Starter Page</h1>
              </div>
          </div>
      </div>
    </div>
      <slot />
      </div>
    </div>
  </div>
</template>


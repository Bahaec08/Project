

<script setup>
  
  import Menu from "./Partials/Menu.vue"
  import "admin-lte/plugins/fontawesome-free/css/all.css";
  import "admin-lte/dist/css/adminlte.css";
  import "admin-lte/plugins/jquery/jquery";
  import "admin-lte/plugins/bootstrap/js/bootstrap.bundle";
  import "admin-lte/dist/js/adminlte";




</script>

<template>
  <Head>
    <title>AGENCY-EKRI</title>
    <link rel="shortcut icon" href="/imgs/ekri.png" type="image/x-icon">
  </Head>
  
  <div class="dark-mode sidebar-mini h-100" style="overflow-x: hidden;" cz-shortcut-listen="true">
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
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
        </ul>
      </nav>
     <Menu />
     <div class="content-wrapper">
        <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
          </div>
      </div>
    </div>
        <slot />
      </div>
    </div>
  </div>
</template>


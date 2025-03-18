<script setup>

import { usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue";

  const fullName = computed(() => {
    return usePage().props.value.AdminName.firstName + ' ' + usePage().props.value.AdminName.lastName
  })


  

</script>
<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4" >
        <Link href="/" class="brand-link">
          <img
            src="imgs/ekri.png"
            alt=""
            class="brand-image img-circle elevation-3"
            style="opacity: 0.8"
          />
          <span class="brand-text font-weight-light"><b>Ekri.tn</b></span>
        </Link>
        <div class="sidebar">
          <div class="user-panel p-2 d-flex">
            <div class="image">

            </div>
            <div class="info">
             {{ fullName  }}
            </div>
          </div>
           <nav class="mt-3">
            <ul
              class="nav nav-pills nav-sidebar flex-column"
              data-widget="treeview"
              role="menu"
              data-accordion="false">
              <li class="nav-item">
                <Link href="/" class="nav-link" :class="{'bg-primary':$page.component === 'Admin/Adminroutes/Index'}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Admin dashboard</p>
                </Link>
              </li>
              <li class="nav-item">
                  <Link href="/statistic" class="nav-link" :class="{'bg-primary':$page.component === 'Admin/Adminroutes/Statistic'}">
                      <font-awesome-icon :icon="['fas', 'chart-simple']" />
                      &nbsp;
                      <p>&nbsp;Statistics</p>
                  </Link>
              </li>
              <li class="nav-item">
                <Link href="#" class="nav-link" :class="{'bg-primary':$page.component=='Admin/Adminroutes/AgenciesList'||$page.component=='Admin/Adminroutes/Pending'||$page.component=='Admin/Adminroutes/new'}">
                    <font-awesome-icon :icon="['fas', 'shop']" />
                  <p>&nbsp; Agencies
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </Link>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <Link href="/AgenciesList" class="nav-link">
                        &nbsp;&nbsp;<font-awesome-icon :icon="['fas', 'list']" />
                      <p class="m-2">All  <span :class="{'bg-danger': usePage().props.value.NumberOfAgencies  == 0, 'badge-primary' : usePage().props.value.NumberOfAgencies }" class="right badge">{{ usePage().props.value.NumberOfAgencies }}</span></p>
                    </Link>
                  </li>
                  <li class="nav-item">
                    <Link href="/pending" class="nav-link">
                        &nbsp;&nbsp;<font-awesome-icon :icon="['fas', 'note-sticky']" />
                      <p class="m-2">Pending <span :class="{'bg-danger': usePage().props.value.PendingList  == 0, 'badge-primary' : usePage().props.value.PendingList }" class="right badge">{{ usePage().props.value.PendingList }}</span></p>
                    </Link>
                  </li>
                  <li class="nav-item">
                    <Link href="/new" class="nav-link">
                        &nbsp;&nbsp;<font-awesome-icon :icon="['fas', 'circle-plus']" />
                      <p class="m-2">Add</p>
                    </Link>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <Link :href="route('admin.logout')" class="nav-link" method="post">
                  <font-awesome-icon :icon="['fas', 'right-from-bracket']" /> 
                  &nbsp;<p>&nbsp;Logout</p>
                </Link>
              </li>
            </ul>
          </nav>
        </div>
      </aside>
</template>

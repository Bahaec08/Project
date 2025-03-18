
<script setup>

  import { usePage } from '@inertiajs/inertia-vue3';



</script>
<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- <Link href="/" class="brand-link">
          <img
            src="/imgs/ekri.png"
            alt=""
            class="brand-image img-circle elevation-3"
            style="opacity: 0.8"
          />
          <span class="brand-text font-weight-light">Ekri.tn</span>
        </Link> -->

        <div class="sidebar">
          <div class="user-panel p-2 d-flex">
            <div class="image">

            </div>
            <div class="info">
              <Link href="#" class="d-block" id="username">{{ usePage().props.value.AgencyName }}</Link>
            </div>
          </div>


          <nav class="mt-3">
            <ul
              class="nav nav-pills nav-sidebar flex-column"
              data-widget="treeview"
              role="menu"
              data-accordion="false">
              <li class="nav-item">
                <Link href="/" class="nav-link" :class="{'bg-primary':$page.component === 'Agency/Index'}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Agency dashboard</p>
                </Link>
              </li>
              <li class="nav-item">
                <Link href="/statistics" class="nav-link" :class="{'bg-primary':$page.component === 'Agency/Statistics'}">
                    <font-awesome-icon :icon="['fas', 'chart-simple']" />
                    &nbsp;
                  <p>&nbsp;Statistics</p>
                </Link>
              </li>

              <li class="nav-item">
                <Link href="#" class="nav-link" :class="{'bg-primary':$page.component.startsWith('Agency/cars/')}">
                    <font-awesome-icon :icon="['fas', 'car']" />
                  &nbsp;
                  <p>
                    Cars
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </Link>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <Link href="/carsList" class="nav-link">
                        &nbsp;&nbsp;<font-awesome-icon :icon="['fas', 'list']" />
                      <p class="m-2">All <span :class="{'bg-danger': usePage().props.value.NumberOfCars  == 0, 'badge-primary' : usePage().props.value.NumberOfCars }" class="right badge">{{ usePage().props.value.NumberOfCars }}</span></p>
                    </Link>
                  </li>
                  <li class="nav-item">
                    <Link href="/newCar" class="nav-link">
                        &nbsp;&nbsp;<font-awesome-icon :icon="['fas', 'circle-plus']" />
                      <p class="m-2">Add</p>
                    </Link>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <Link href="#" class="nav-link" :class="{'bg-primary':$page.component.startsWith('Agency/Options/')}">
                  <font-awesome-icon :icon="['fas', 'filter']" />
                  &nbsp;
                  <p>
                    Options
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </Link>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <Link :href="route('option.index')" class="nav-link">
                        &nbsp;&nbsp;<font-awesome-icon :icon="['fas', 'list']" />
                        <p class="m-2">All <span :class="{'bg-danger': usePage().props.value.Nop  == 0, 'badge-primary' : usePage().props.value.Nop }" class="right badge">{{ usePage().props.value.Nop }}</span></p>
                    </Link>
                  </li>
                  <li class="nav-item">
                    <Link :href="route('option.create')" class="nav-link">
                    <!-- <Link :href="route('option.create')" class="nav-link"> -->
                        &nbsp;&nbsp;<font-awesome-icon :icon="['fas', 'circle-plus']" />
                      <p class="m-2">Add</p>
                    </Link>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <Link href="/rents" class="nav-link" :class="{'bg-primary':$page.component == 'Agency/Rents'}">
                    <font-awesome-icon :icon="['fas', 'handshake-simple']" />
                  &nbsp;
                  <p>Rent Deals <span :class="{'bg-danger': usePage().props.value.RentHistory  == 0, 'badge-primary' : usePage().props.value.RentHistory }" class="right badge">{{ usePage().props.value.RentHistory }}</span></p>
                </Link>
              </li>
              <li class="nav-item">
                <Link href="/waiting" class="nav-link" :class="{'bg-primary':$page.component == 'Agency/Waiting'}">
                  <font-awesome-icon :icon="['fas', 'clock']" />
                  &nbsp;
                  <p>Wating <span :class="{'bg-danger': usePage().props.value.Waiting  == 0, 'badge-primary' : usePage().props.value.Waiting }" class="right badge">{{ usePage().props.value.Waiting }}</span></p>
                </Link>
              </li>
              <li class="nav-item">
                <Link :href="route('agency.logout')" class="nav-link" method="post">
                  <font-awesome-icon :icon="['fas', 'right-from-bracket']" /> 
                  &nbsp;<p>&nbsp;Logout</p>
                </Link>
              </li>
            </ul>
          </nav>
        </div>
      </aside>
</template>


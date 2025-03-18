
<script>
  import MainLayout from "./Layouts/MainLayout.vue"
  export default {
    layout: MainLayout
  }
</script>
<script setup>
  defineProps({
    list: Array
  })
</script>
<template>
    <div class="content">
    <div class="container-fluid">
      <section class="content">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">The list of all rents</h3>
            <div class="card-tools">
              <button
                type="button"
                class="btn btn-tool"
                data-card-widget="collapse"
                title="Collapse"
              >
                <i class="fas fa-minus"></i>
              </button>
              <button
                type="button"
                class="btn btn-tool"
                data-card-widget="remove"
                title="Remove"
              >
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-striped projects">
              <thead>
                <tr>
                  <th style="width: 1%">#</th>
                  <th>Client</th>
                  <th>Car</th>
                  <th>From</th>
                  <th>To</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in list" :key="item.id">
                  <td>{{ item.id }}</td>
                  <td>
                    <img  id="img" :src="'/storage/user/'+item.picture" :alt="item.firstName"> 
                    {{ item.firstName }} {{  item.lastName }}
                  </td>
                  <td><img  id="carimg" :src="'/storage/car/'+item.photo" :title="item.carmodel" ></td>
                  <td>{{ item.startDate }}</td>
                  <td>{{ item.endDate }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>
<style scoped>
#img{
  width: 40px;
  aspect-ratio: 1 / 1;
  border-radius: 50%;
}
#carimg{
  width: 100px;
}
</style>
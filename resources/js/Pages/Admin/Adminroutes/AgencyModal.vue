<script setup>
defineProps({
  agency: Object,
});
defineEmits(["close"]);
</script>
<template>
  <Teleport v-if="agency" to="body"> 
    <!-- <main>
      <div class="container">
        <section>
          <button @click="$emit('close')">X</button>
          {{ agency }}
        </section>
      </div>
    </main> -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agency information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- {{ agency }} -->
            <table class="table">
              <tbody>
                <tr>
                  <td>Agency Name</td>
                  <td>{{ agency.agencyName }}</td>
                </tr>
                <tr>
                  <td>Agency Owner</td>
                  <td>{{ agency.ownerName }}</td>
                </tr>
                <tr>
                  <td>Phone Number</td>
                  <td>{{ agency.phone }}</td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td><a :href="'mailto:'+ agency.email "> {{ agency.email }} </a></td>
                </tr>
                <tr>
                  <td>Cars Number</td>
                  <td>{{ agency.carsNumber }}</td>
                </tr>
                <tr>
                  <td>Location</td>
                  <td>{{ agency.location }}</td>
                </tr>
              </tbody>
            </table>
            <div class="d-flex justify-content-center">
              <img :src="'/storage/agency/'+agency.license" class="show" alt="image" /> 
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Close
            </button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </Teleport>
</template>

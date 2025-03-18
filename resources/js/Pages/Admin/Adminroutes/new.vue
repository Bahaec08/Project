
<script>
import MainLayout from "../Layouts/MainLayout.vue"
export default {
  layout: MainLayout,
};
</script>

<script setup>
  import { usePage } from '@inertiajs/inertia-vue3';
  import { useForm } from '@inertiajs/inertia-vue3';
  import { useSwalSuccess, useSwalError } from "../../../Complosables/alert";

  const form = useForm({
   ag_name: null,
   owner_name: null,
   ag_phone: null,
   ag_email: null,
   ag_cars: null,
   location: null,
   password: null,
   photo: null,
   status: null
})



const submitForm = () => {
  form.post(route("Agency.store"), {
    onSuccess: (page) => {
      if(page.props.flash.success)
        useSwalSuccess(page.props.flash.success)
      else
        useSwalError(page.props.flash.error)
    }
  })
}


</script>
<template>
  <div class="row m-2">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Add agency</h3>
        </div>
        <form @submit.prevent="submitForm">
          <div class="card-body">
            <div class="row">
              <div class="col form-group">
                <label for="exampleInput1">Agency name</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleInput1"
                  placeholder="Enter name"
                  v-model="form.ag_name"
                />
                <span v-if="form.errors.ag_name">{{ form.errors.ag_name }}</span>
              </div>
              <div class="col form-group">
                <label for="exampleInput2">Agency owner</label>
                <input
                  type="text"
                  class="form-control"
                  id="exampleInput2"
                  placeholder="Enter owner name"
                  v-model="form.owner_name"
                />
                <span v-if="form.errors.owner_name">{{ form.errors.owner_name }}</span>
              </div>
            </div>

          <div class="row">
            <div class="col form-group">
                <label for="exampleInput3">Phone number</label>
                <input
                  type="number"
                  class="form-control"
                  id="exampleInput3"
                  placeholder="Enter phone"
                  v-model="form.ag_phone"
                />
                <span v-if="form.errors.ag_phone">{{ form.errors.ag_phone }}</span>
              </div>
            <div class="col form-group">
              <label for="exampleInput4">Owner email address</label>
              <div class="input-group">
                <div class="custom-file">
                  <input
                  type="email"
                  class="form-control"
                  id="exampleInput4"
                  placeholder="Enter email"
                  v-model="form.ag_email"
                />
                <span v-if="form.errors.ag_email">{{ form.errors.ag_email }}</span>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col form-group">
                <label for="exampleInpu5">Number of cars</label>
                <input
                  type="number"
                  class="form-control"
                  id="exampleInput5"
                  placeholder="Enter phone"
                  v-model="form.ag_cars"
                />
                <span v-if="form.errors.ag_cars">{{ form.errors.ag_cars }}</span>
              </div>
              <div class="col form-group">
                <label for="exampleInpu5">Location</label>
                  <select class="form-control" v-model="form.location">
                      <option value="">Choose location</option>
                      <option value="Ariana">Ariana</option>
                      <option value="Béja">Béja</option>
                      <option value="Ben Arous">Ben Arous</option>
                      <option value="Bizerte">Bizerte</option>
                      <option value="Gabès">Gabès</option>
                      <option value="Gafsa">Gafsa</option>
                      <option value="Jendouba">Jendouba</option>
                      <option value="Jendouba">Jendouba</option>
                      <option value="Kairouan">Kairouan</option>
                      <option value="Kasserine">Kasserine</option>
                      <option value="Kébili">Kébili</option>
                      <option value="Kef">Kef</option>
                      <option value="Mahdia">Mahdia</option>
                      <option value="Manouba">Manouba</option>
                      <option value="Médenine">Médenine</option>
                      <option value="Monastir">Monastir</option>
                      <option value="Nabeul">Nabeul</option>
                      <option value="Sfax">Sfax</option>
                      <option value="Sidi Bouzid">Sidi Bouzid</option>
                      <option value="Siliana">Siliana</option>
                      <option value="Sousse">Sousse</option>
                      <option value="Tataouine">Tataouine</option>
                      <option value="Tozeur">Tozeur</option>
                      <option value="Tunis">Tunis</option>
                      <option value="Zaghouan">Zaghouan</option>
                  </select>
                <span v-if="form.errors.location">{{ form.errors.location }}</span>
              </div>
          </div>

          <div class="row">
            <div class="col form-group">
              <label for="exampleInputFile">License</label>
              <div class="input-group">
                <div class="custom-file">
                  <input
                  type="file"
                  accept="image/*"
                  class="custom-file-input"
                  id="exampleInputFile"
                  @input="form.photo = $event.target.files[0]"
                  />
                  <label class="custom-file-label" for="exampleInputFile"
                    >Choose file</label>
                </div>
              </div>
            </div>
          </div>
          </div>
          <div class="card-footer">
            <button type="submit" :disabled="form.processing" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

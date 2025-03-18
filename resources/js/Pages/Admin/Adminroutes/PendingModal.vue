<script setup>
  import { Inertia } from '@inertiajs/inertia';
  import { useSwalSuccess, useSwalError } from "../../../Complosables/alert";
  
  defineProps({
    agency: Object
  }); 


  const handleAccept = (id) => { 
    $("#exampleModal").modal('hide') 
    Inertia.post(route('accept.agency', {id: id}),{
      onSuccess : (page) => {
        
        useSwalSuccess('Agency has been accepted successfully !'); 
      },
      onError : (errors)=>{
        useSwalError('error !')
      }
    })
  }

  const handelDelete = (id) => {  
    Inertia.delete(route('delete.agency',{id: id}),{
      onSuccess : (page) => {
        $("#exampleModal").modal('hide')
        useSwalSuccess('Agency has been deleted successfully !'); 
      }
    })
  }
  

</script>
<template>
  <Teleport v-if="agency" to="body">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
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
            <button type="button" @click="handleAccept(agency.id)" class="btn btn-success">Accepte</button>
            <button type="button" @click="handelDelete(agency.id)" class="btn btn-danger">Delete</button>
          </div>
        </div>
      </div>
    </div>
  </Teleport>
</template>

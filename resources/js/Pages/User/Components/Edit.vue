
<script setup>
import { reactive, onMounted, computed } from 'vue';
import { store } from '../../../store.js';
import { useForm, usePage } from '@inertiajs/inertia-vue3';
import { useVuelidate } from '@vuelidate/core';
import { required, email, helpers, sameAs } from '@vuelidate/validators';

const isEmailTaken = (v) => {
  return false;
};

const UpdateForm = useForm({});

const state = reactive({
  firstName: usePage().props.value.user?.firstName,
  lastName: usePage().props.value.user?.lastName,
  Password: '',
  CPassword: '',
  Phone: usePage().props.value.user?.phone,
  Email: usePage().props.value.user?.email,
  Picture: null
});

const checkEmail = async (value) => {
  if (value && value !== '') {
    try {
      const response = await fetch('/check-email', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: value })
      });
      const data = await response.json();
      return !data.exists;
    } catch (error) {
      console.error('Error checking email:', error);
      return false;
    }
  }
  return true;
};

const rules = computed(() => {
  return {
    firstName: {
      required: helpers.withMessage('Please Enter First Name', required)
    },
    lastName: {
      required: helpers.withMessage('Please Enter Last Name', required)
    },
    CPassword: {
      sameAs: sameAs(state.Password)
    },
    Phone: {
      required: helpers.withMessage('Please Enter Phone', required)
    },
    Email: {
      required: helpers.withMessage('Please Enter Email', required),
      email: helpers.withMessage('Please Enter A Valid Email', email),
    },
    Picture: {
      required: helpers.withMessage('Please Enter A Picture', required)
    }
  };
});

const handleClose = () => {
  document.documentElement.style.overflow = 'scroll';
  store.isAppear = false;
};

onMounted(() => {
  const root = document.documentElement;
  $('.close-btn').click(handleClose);
});

const v$ = useVuelidate(rules, state);

const update = async () => {
  const validate = await v$.value.$validate();
  if (validate) {
    UpdateForm.transform((d) => ({
      firstName: state.firstName,
      lastName: state.lastName,
      password: state.Password,
      phone: state.Phone,
      email: state.Email,
      picture: state.Picture
    })).post('/update');
    store.isAppear = false;
  }
};
</script>

<template>
    <div class="overlay-popup" v-if="store.isAppear"></div>
    <div class="center-popup popup-box" :class="{ 'show-popup': store.isAppear }">
      <div>
        <font-awesome-icon class="close-btn" :icon="['fas', 'xmark']" @click="handleClose" />
      </div>
      <div class="form_container"> 
            <form name="form" class="UpdateForm" id="register" ref="register" @submit.prevent="update">
              <div class="form_wrap">
                <div class="form_item" >
                  <!-- <label>Upload Profile picture</label>
                  <input
                      type="file"
                      accept="image/*"
                      id="exampleInputFile"
                      @input="UpdateForm.Npicture = $event.target.files[0]"/> -->

                </div>
              </div>

              <div class="form_wrap">
                <div class="form_item" >
                  <label>New First Name</label>
                  <input type="text" v-model="state.firstName" />
                  <span v-if="v$.firstName.$errors[0]">{{ v$.firstName.$errors[0].$message }}</span>
                </div>
                
                <div class="form_item">
                  <label>New Last Name</label>
                  <input type="text" v-model="state.lastName" />
                  <span v-if="v$.lastName.$errors[0]">{{ v$.lastName.$errors[0].$message }}</span>
                </div>
              </div>

              <div class="form_wrap">
                <div class="form_item">
                  <label>New Email Address</label>
                  <input type="text" v-model="state.Email"/>
                  <span v-if="v$.Email.$errors[0]">{{ v$.Email.$errors[0].$message }}</span>
                </div>
                <div class="form_item">
                  <label>New Phone</label>
                  <input v-model="state.Phone" type="number" />
                  <span v-if="v$.Phone.$errors[0]">{{ v$.Phone.$errors[0].$message }}</span>
                </div>
              </div>

              <div class="form_wrap">
                <div class="form_item" >
                  <label>New Password</label>
                  <input type="password" v-model="state.Password" />
                </div>
                
                <div class="form_item">
                  <label>Confirm New Password</label>
                  <input type="password" v-model="state.CPassword" />
                  <span v-if="v$.CPassword.$errors[0]">{{ v$.CPassword.$errors[0].$message }}</span>
                </div>
              </div>

              <label class="file-input">
                        <input type="file"
                               accept="image/*"
                               id="exampleInputFile"
                               @input="state.Picture = $event.target.files[0]">
                        <span class="file-input-label">Choose File</span>
                        <span class="file-input-file-name"></span>
                      </label>

              <div class="btn">
                <input type="submit" value="Save Changes !" />
              </div>
            </form>
        
      </div>
    </div>
</template>
<style scoped>


.overlay-popup {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 11;
  background-color: rgba(0, 0, 0, 0.3);
  overflow: hidden;
}
.center-popup {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%); /* Hide scrollbars */
}
.start-btn.show-popup {
    opacity: 0;
    visibility: hidden;
}
.popup-box.show-popup {
    top: 50%;
    opacity: 1;
    visibility: visible;
    transition: 0.4s;
    z-index: 12;
    overflow-y: hidden;
}
.popup-box {
  top: 40%;
  opacity: 0;
  visibility: hidden;
  background: white;
  height: auto;
  width: 575px;
  padding: 50px 10px 10px 10px;
  border-radius: 10px;
}
.form_container {
  /* padding: 0px 30px 0px 30px; */
  border-radius: 3px;
  width: 550px;
  height: 530px;
  overflow: hidden;
}
.close-btn {
  float: right;
  margin-right: 10px;
  color: gray;
  cursor: pointer;
}
.popup-box .close-btn {
  position: absolute;
  top: 0;
  right: 0;
  background: #6271f0;
  height: 15px;
  width: 15px;
  line-height: 20px;
  margin: 20px;
  color: white;
  font-size: 15px;
  border-radius: 100%;
  text-align: center;
  cursor: pointer;
  padding: 2px;
  transition: all 0.1.5s ease-in;
}
.popup-box .close-btn:hover {
  scale: 1.3;
  font-size: 20px;
}

.UpdateForm {
  display: flex;
  flex-direction: column;
  row-gap: 40px;
  margin-top: -5px;
  transition: 0.5s;
  width: 100%;
}
span {
  color: red;
  font-size: 14px;
  margin-top: 6px;
  margin-left: 10px;
}
.UpdateForm .form_wrap{
  display: flex;
  column-gap: 40px;
  flex-direction: row;
}

.UpdateForm .form_wrap .form_item{
  display: flex;
  flex-direction: column;
  width: 100%;
}

.form_container .form_item input {
  width: 100%;
  padding: 7px;
  font-size: 16px;
  border: 1px solid #dadce0;
  border-radius: 3px;
  outline: none;
}

.form_container .btn input[type="submit"] {
  background: #6271f0;
  border: 1px solid #6271f0;
  padding: 10px;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  color: #fff;
}

.file-input {
  position: relative;
  overflow: hidden;
}

.file-input input[type="file"] {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
  width: 100%;
  height: 100%;
  cursor: pointer;
}

.file-input-label {
  display: inline-block;
  padding: 10px 20px;
  background-color: #e9e9e9;
  color: #333;
  border: 1px solid #ccc;
  border-radius: 4px;
  cursor: pointer;
}

.file-input-label:hover {
  background-color: #ccc;
}

.file-input-file-name {
  display: inline-block;
  margin-left: 10px;
  color: #333;
}

</style>
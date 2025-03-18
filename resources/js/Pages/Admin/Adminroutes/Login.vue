<script setup>
import { useForm  } from '@inertiajs/inertia-vue3';


  const LoginAdminform = useForm({
    email: '',
    password: '',
    remember: false,
})

 const submitForm =()=>{
  // LoginAdminform.post(route('login.post'),{
  LoginAdminform.post('login',{

     onError: (error)=>{
     }
   })
 }
</script>
<template>
  <div id="ekri-admin">
    <div class="ekri-container">
      <div class="ekri-form-container">
        <div class="ekri-heading">
          <strong><h2>EKRI</h2></strong>
          <h2>.TN</h2>
        </div>
        <div class="ekri-login-form">
          <div class="ekri-info-head">Sign in to start your session</div>
          <form class="ekri-admin-form" @submit.prevent="submitForm">
            <div class="ekri-group">
              <!-- <label for="">Email</label> -->
              <input type="text" placeholder="Enter email" v-model="LoginAdminform.email"/>
              <font-awesome-icon :icon="['fas', 'envelope']" class="ekri-icon" />
              <span class="ekri-error" v-if="LoginAdminform.errors.email">{{ LoginAdminform.errors.email }} &nbsp;</span>
            </div>
            <div class="ekri-group md">
              <!-- <label for="">Password</label> -->
              <input type="password" placeholder="Enter pasword" v-model="LoginAdminform.password"/>
              <font-awesome-icon :icon="['fas', 'lock']" class="ekri-icon" />
              <span class="ekri-error" v-if="LoginAdminform.errors.password">{{ LoginAdminform.errors.password }} &nbsp;!</span>
            </div>
            <div class="ekri-group-ck">
              <input type="checkbox" placeholder="Enter pasword" v-model="LoginAdminform.remember"/>
              <label for="">Remember me</label>
            </div>
            <!-- <span class="ekri-error" v-if="Loginform.errors.aerror">{{ Loginform.errors.aerror }} &nbsp;!</span> -->
            <div class="ekri-button">
              <input type="submit" :disabled="LoginAdminform.processing" class="ekri-submit-button" value="LOGIN" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* * {
  margin: 0;
  padding: 0;
} */
#ekri-admin {
  min-height: 100vh;
  background-image: url(imgs/admin.jpeg);
  background-size: cover;
}
.ekri-container {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100vh;
  background: linear-gradient(to bottom, rgba(255, 255, 255, 0.1), rgba(1, 1, 1, 0.5));
}
.ekri-container .ekri-form-container {
  width: 350px;
}
.ekri-container .ekri-form-container .ekri-heading {
  display: flex;
  justify-content: center;
  color: #495057;
  margin-bottom: 20px;
}
.ekri-container .ekri-login-form {
  border-radius: 10px;
  background-color: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(1px);
  padding: 30px 25px;
}
.ekri-container .ekri-login-form .ekri-info-head {
  text-align: center;
  margin-bottom: 30px;
}
.ekri-container .ekri-login-form .ekri-group {
  display: flex;
  flex-direction: column;
  width: 100%;
  position: relative;
  row-gap: 10px;
  margin-top: 25px;
}
.ekri-container .ekri-login-form .ekri-group .ekri-icon {
  position: absolute;
  right: 15px;
  top: 10px;
  color: #6385c5;
}
.ekri-container .ekri-login-form .ekri-group input {
  background-color: #ffffff1a;
  border: none;
  border-bottom: 1px #00000081 solid;
  height: 38px;
  padding-left: 20px;
  outline: none;
}
.ekri-container .ekri-login-form .ekri-group-ck {
  display: flex;
  margin-top: 25px;
  column-gap: 5px;
}
.ekri-submit-button {
  margin-top: 20px;
  width: 100%;
  height: 30px;
  background-color: #6385c5;
  border: none;
}
</style>

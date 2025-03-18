<script setup>

import { useForm  } from '@inertiajs/inertia-vue3';
import { useSwalSuccess } from "../../../Complosables/alert";
import { store } from '../../../store';
import { onMounted, ref, unref } from 'vue';
import { useVuelidate } from '@vuelidate/core';
import { required, email, helpers, sameAs } from '@vuelidate/validators';
import { reactive, computed } from 'vue';

const checkList = (new Map())
  .set(/[a-z]/, 'At least letter ')
  .set(/[0-9]/,'At least number ')
  .set(/.{8,}/,'At least 8 caracter')

const emailError = ref();


const Loginform = useForm({
  email: null,
  password: null,
  remember: false,
})

const submitLoginForm = async ()=>{
    Loginform.post('/LoginUser',{
      onSuccess: (page)=>{
        handleClose()
        Loginform.reset()
      },
      onError: (error)=>{

      }
    })
}

const state = reactive({
  firstname: '',
  lastname: '',
  password: '',
  cpassword: '',
  phone: '',
  email: '',
});

const form = useForm({})


const rules = computed(() => {
  return {
    firstname: {
      required: helpers.withMessage('Please Enter First Name', required)
    },
    lastname: {
      required: helpers.withMessage('Please Enter Last Name', required)
    },
    password: {
      required: helpers.withMessage('Please Enter Password', required)
    },
    cpassword: {
      sameAs: sameAs(state.password)
    },
    phone: {
      required: helpers.withMessage('Please Enter Phone', required)
    },
    email: {
      required: helpers.withMessage('Please Enter Email', required),
      email: helpers.withMessage('Please Enter A Valid Email', email),
    }
  };
});




const v$ = useVuelidate(rules, state);

const submitRegisterForm = async ()=>{
  const v = await v$.value.$validate();
  if(v){
      form.
      transform((data) => ({
      firstname : state.firstname,
      lastname : state.lastname,
      email : state.email,
      password: state.password,
      phone: state.phone
    })).post('RegisterUser',{
      onSuccess: (page)=>{
        //console.log(page);
        //useSwalSuccess("User created and logged in")
        handleClose()
        form.reset()
      },
      onError: (errors)=>{
        //console.log('error');
      }
    })
  }
}

const register = ref(null);
const login = ref(null);
const btn = ref(null);

const handleClose = () => {
  document.documentElement.style.overflow = 'scroll';
  store.userModel = false; 
}

const registerToggle = () => {
  register.value.style.left = "0px";
  login.value.style.left = "450px";
  btn.value.style.left = "0";
}

const loginToggle = () => {
  register.value.style.left = "-450px";
  login.value.style.left = "0px";
  btn.value.style.left = "110px";
}

 const checkPassword = () => {
  unref(registerError).splice(0,unref(registerError).length);
  checkList.forEach((v,k) => {
  if(!form.password.match(k))
      return unref(registerError).push(v);
  })
 }

onMounted(() => {
  const root = document.documentElement;
  $('.signup, .login').click(() => {
    root.style.overflow = 'hidden';
  });
  $('.closebtn').click(handleClose);
})

</script>
<template>
    <div class="overlay" v-if="store.userModel"></div>
    <div class="center modal-box" :class="{ 'show-modal': store.userModel }">
      <div>
        <font-awesome-icon class="closebtn" :icon="['fas', 'xmark']" @click="handleClose" />
      </div>
      <div>
        <div class="form_container">
          <div class="button-box">
            <div id="btn" ref="btn"></div>
            <button type="button" class="toggle-btn" id="login-btn" @click="registerToggle">
              Register
            </button>
            <button type="button" class="toggle-btn" id="register-btn" @click="loginToggle">
              Login
            </button>
          </div>
          <div class="fromSelector">

            <form name="form" class="input-group-form" id="login" ref="login" @submit.prevent="submitLoginForm">
              <div class="form_wrap form_grp">
                <div class="form_item" >
                  <label>Email</label>
                  <input type="email" v-model="Loginform.email" />
                  <span class="ekri-error" v-if="Loginform.errors.email">{{ Loginform.errors.email }}</span>
                </div>
              </div>
              <div class="form_wrap form_grp">
                <div class="form_item">
                  <label>Password</label>
                  <input type="password" v-model="Loginform.password"/>
                  <span class="ekri-error" v-if="Loginform.errors.password">{{ Loginform.errors.password }}</span>
                </div>
              </div>
              <div class="form_wrap form_grp">
                <div class="form_item">
                  <input type="checkbox" name="remember" id="" v-model="Loginform.remember" style="margin:3px 0px 0px -70px;position:absolute;">
                  <label >remember me</label>
                </div>
              </div>
              <span class="ekri-error" v-if="Loginform.errors.error">{{ Loginform.errors.error }}</span>
              <div class="btn">
                <input type="submit" :disabled="Loginform.processing" value="Get Started" />
              </div>
            </form>

            <form name="form" class="input-group-form" id="register" ref="register" @submit.prevent="submitRegisterForm">
              <div class="form_wrap form_grp">
                <div class="form_item">
                  <label>First Name</label>
                  <input type="text" v-model="state.firstname" />
                  <span v-if="v$.firstname.$errors[0]">{{ v$.firstname.$errors[0].$message }}</span>
                </div>
                <div class="form_item">
                  <label>Last Name</label>
                  <input type="text" v-model="state.lastname" />
                  <span v-if="v$.lastname.$errors[0]">{{ v$.lastname.$errors[0].$message }}</span>
                </div>
              </div>
              <div class="form_wrap">
                <div class="form_item">
                  <label>Email Address</label>
                  <input type="text" v-model="state.email" />
                  <span v-if="v$.email.$errors[0]">{{ v$.email.$errors[0].$message }}</span>
                </div>
              </div>
              <div class="form_wrap form_grp">
                <div class="form_item">
                  <label>Password</label>
                  <input type="password" v-model="state.password" />
                  <span v-if="v$.password.$errors[0]">{{ v$.password.$errors[0].$message }}</span>
                </div>
                <div class="form_item">
                  <label>Confirm Password</label>
                  <input type="password" v-model="state.cpassword" />
                  <span v-if="v$.cpassword.$errors[0]">{{ v$.cpassword.$errors[0].$message }}</span>
                </div>
              </div>
              <div class="form_wrap">
                <div class="form_item">
                  <label>Phone</label>
                  <input type="text" v-model="state.phone" />
                  <span class="ekri-error" v-if="v$.phone.$errors[0]">{{ v$.phone.$errors[0].$message }}</span>
                </div>
              </div>
              <div class="btn">
                <input type="submit" value="Get Started"/>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</template>



<style scoped>
@import url("https://fonts.cdnfonts.com/css/proxima-nova-2");

span{
  font-size: 15px;
  color: red;
}
.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 11;
  background-color: rgba(0, 0, 0, 0.3);
  overflow: hidden;
}
.center {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%); /* Hide scrollbars */
}
.input-group-form {
  position: absolute;
  transition: 0.5s;
  width: 100%;
}
.modal-box {
  top: 40%;
  opacity: 0;
  visibility: hidden;
  background: white;
  height: auto;
  width: 480px;
  padding: 18px 10px;
  border-radius: 10px;
  box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.2);
}
.form_container {
  padding: 0px 30px 0px 30px;
  border-radius: 3px;
  width: 460px;
  height: 530px;
  overflow: hidden;
}

.form_container .fromSelector {
  position: relative;
}
.form_container .button-box {
  width: 220px;
  margin: 35px auto;
  position: relative;
  box-shadow: 0 0 20px 9px #cc24ff3b;
  border-radius: 30px;
}
.form_container #register {
  left: 0px;
  transition: 0.5s;
}
.form_container #login {
  margin-top: 50px;
  left: 450px;
}
.form_container .button-box #btn {
  top: 0;
  left: 0;
  position: absolute;
  width: 110px;
  height: 100%;
  background: linear-gradient(to right, #8a78f0, #7e6be7);
  border-radius: 30px;
  transition: 0.5s;
}
.form_container .button-box .toggle-btn {
  padding: 10px 30px;
  cursor: pointer;
  background: transparent;
  border: 0;
  outline: none;
  position: relative;
}
.closebtn {
  float: right;
  margin-right: 10px;
  color: gray;
  cursor: pointer;
}
.start-btn.show-modal {
  opacity: 0;
  visibility: hidden;
}
.modal-box.show-modal {
  top: 50%;
  opacity: 1;
  visibility: visible;
  transition: 0.4s;
  z-index: 12;
  overflow-y: hidden;
}
.modal-box .closebtn {
  position: absolute;
  top: 0;
  right: 0;
  background: #0569d4;
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
.modal-box .closebtn:hover {
  scale: 1.3;
  font-size: 20px;
}

.form_container .form_item {
  margin-bottom: 25px;
}

.form_container .form_wrap.form_grp {
  display: flex;
}

.form_container .form_wrap.form_grp .form_item {
  width: 100%;
}

.form_container .form_wrap.form_grp .form_item:first-child {
  margin-right: 4%;
}

.form_container .form_item label {
  display: block;
  margin-bottom: 5px;
}

.form_container .form_item input {
  width: 100%;
  padding: 10px;
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
</style>
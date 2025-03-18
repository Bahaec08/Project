<script setup>
import { onMounted, ref } from "vue";
import DropList from "./DropList.vue";
import { store } from "../../../../store";
import Modale from "../../Components/Modal.vue";
import Edit from "../../Components/Edit.vue";



const props = defineProps({
   user: Object,
 }); 




 const Open_1 = () => {
  store.open1 = !store.open1
}


const Open_2 = () => {
  store.open2 = !store.open2
}
 const openLogin = () => {
    store.userModel = true
 }

 const openRegister = () => {
    store.userModel = true
 }

onMounted(() => {

  const menu = document.getElementById("navbar-menu");
  var secNav = document.getElementById("secNav");

  const observer = new IntersectionObserver(observerCallBack);

  function observerCallBack(entries) {
    entries.forEach((e) => {
      if(!e.isIntersecting){
         secNav.classList.add("show")
        }
        else{ 
          store.open2 = false
          secNav.classList.remove("show");
      }
    });
  }
  observer.observe(menu);

});



</script>
<template>
    <Modale />
    <Edit />
  <nav id="navbar-menu" class="main-nav w-100">
    <ul>
      <li>
        <!-- <span class="logo">CarRentalLogo</span> -->
        <img src="/imgs/ekritn.png" id="ekriLogo" alt="" />
      </li>
      <li class="sub-menu">
        <ul>
          <li>
            <Link
              :href="route('home')"
              class="main-links current"
              rel="noopener noreferrer"
              >Home</Link
            >
          </li>
          <li>
            <Link
              href="/search"
              class="main-links current"
              rel="noopener noreferrer"
              >Search</Link
            >
          </li>
          <li>
            <a href="http://" class="main-links" rel="noopener noreferrer">How it Work</a>
          </li>
          <li>
            <a href="http://" class="main-links" rel="noopener noreferrer"
              >Why Choose Us</a
            >
          </li>
          <li>
            <a href="http://" class="main-links" rel="noopener noreferrer"
              >Work With Us</a
            >
          </li>
          <li>
            <a href="http://" class="main-links" rel="noopener noreferrer">Reviews</a>
          </li>
        </ul>
      </li>
      <li>
        <ul class="userspace center">
          <li v-show="!$page.props.user">
             <button @click="openRegister" class="main-button signup" role="button" aria-label="register">
                Register
            </button>
          </li>
          <li v-show="!$page.props.user">
            <button @click="openLogin" class="main-button login" role="button" aria-label="login" rel="noopener noreferrer">
              Login
            </button>
          </li>
          <li class="container-user" v-if="$page.props.user">
            <img @click="Open_1"  :src="'/storage/user/'+user.picture" alt="userPicture">
            <drop-list :open="store.open1" />
          </li>
          <!-- <li v-show="$page.props.user">
            <Link :href="route('logout')" method="post">Logout</Link>
          </li> -->
        </ul>
      </li>
    </ul>
  </nav>
  <nav id="secNav" class="fixed-nav main-nav w-100">
    <ul>
      <li>
        <!-- <span class="logo">CarRentalLogo</span> -->
        <img src="/imgs/ekritn.png" id="ekriLogo" alt="" />
      </li>
      <li class="sub-menu">
        <ul>
          <li>
            <Link
              :href="route('home')"
              class="main-links current"
              rel="noopener noreferrer"
              >Home</Link>
          </li>
          <li>
            <Link
              href="/search"
              class="main-links current"
              rel="noopener noreferrer"
              >Search</Link>
          </li>
          <li>
            <a href="http://" class="main-links" rel="noopener noreferrer">How it Work</a>
          </li>
          <li>
            <a href="http://" class="main-links" rel="noopener noreferrer"
              >Why Choose Us</a>
          </li>
          <li>
            <a href="http://" class="main-links" rel="noopener noreferrer"
              >Work With Us</a>
          </li>
          <li>
            <a href="http://" class="main-links" rel="noopener noreferrer">Reviews</a>
          </li>
        </ul>
      </li>
      <li>
        <ul class="userspace center">

          <li v-show="!$page.props.user">
             <button @click="openRegister" class="main-button signup" role="button" aria-label="register">
                Register
            </button>
          </li>
          <li v-show="!$page.props.user">
            <button @click="openLogin" class="main-button login" role="button" aria-label="login" rel="noopener noreferrer">
              Login
            </button>
          </li>
          <li class="container-user" v-if="$page.props.user">
            <img @click="Open_2"  :src="'/storage/user/'+user.picture" alt="userPicture">
            <drop-list :open="store.open2" />
          </li>
          <!-- <li v-show="$page.props.user">
            <Link :href="route('logout')" method="post">Logout</Link>
          </li> -->
        </ul>
      </li>
    </ul>
  </nav>
</template>
<style scoped>
.center{
  justify-content: flex-end;
}
ul{
  column-gap: 20px;
}
.container-user{
  position: relative;
}
img{
  border-radius: 50%;
}
</style>
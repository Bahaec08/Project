<script setup>
import NavBar from "./Partials/NavBar.vue";
import footerCom from "./Partials/footerCom.vue";
defineProps({
  user: Object
})
</script>
<template>
  <Head>
    <title>EKRI</title>
    <link rel="shortcut icon" href="imgs/ekri.png" type="image/x-icon">
  </Head>
    <NavBar :user="user" />
     <slot/>
  <footerCom/>
</template>


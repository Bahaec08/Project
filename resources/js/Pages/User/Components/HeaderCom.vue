<script setup>
  import { onMounted, ref } from 'vue';
  import Typed from "typed.js";

  const typed = ref(null);
  onMounted(() => {
    const options = {
        strings: ["<h1>Fast &amp; easy way <br> To rent A car</h1>"],
        typeSpeed: 40,
        // backSpeed: 60,
        // backDelay: 1500,
        loop: false,
      };
      new Typed(typed.value, options);
     })
</script>
<template>
  <!-- <register :isShow="isShow"></register> -->
  <header class="sec top-sec w-100" data-aos="fade-up">
      <div class="info-section">
        <div class="zone">
          <div ref="typed"></div>
        </div>
        <p>
          This website allows customers to easily rent cars for their desired duration through a
          user-friendly interface. <br />
          With a secure payment gateway, it provides a convenient and
          reliable rental experience
        </p>
        <nav class="carlist">
          <ul>
            <li>
              <div class="cartype selected">
                <div class="car"></div>
                <h5>Cars</h5>
              </div>
            </li>
            <li>
              <div class="cartype">
                <div class="pickup"></div>
                <h5>Cargo</h5>
              </div>
            </li>
          </ul>
        </nav>
      </div>
      <div class="rentzone">
      </div>
    </header>
</template>



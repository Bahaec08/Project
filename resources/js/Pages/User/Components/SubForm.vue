<script setup>
</script>
<template>
  <div>
    <div class="subscribefom" data-aos="fade-up">
      <h2>Work with us </h2>
        <p>If you are planning to start your own agency, <br/> partnering with us can be a great way to kickstart your business <br/> and take it to new heights</p>
        <Link :href="route('Agency.create')" class="work-btn" as="button" target="_blank">Sign up now</Link>
        <!-- <form action="" method="">
          <div class="inpgourp">
            <input id="email" type="text" name="subemail" placeholder="Enter your email address" value="">
          </div>
          <div class="inpgourp">
            <input type="submit" name="submit" id="Send" value="Subscribe">
          </div>
        </form> -->
  </div>
  </div>
</template>
<style scoped>
.work-btn{
  padding: .5rem 2rem;
  border: none;
  border-radius: 20px;
  font-size: .85rem;
  cursor: pointer;
  transition: background-color .3s linear, color .3s linear;
  color: white;
  background-color: rgb(138,120,240)
  }
</style>
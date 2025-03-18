
<template>
  <div class="container">
      <video autoplay loop src="/video/background.mp4" muted class="bg-video" typeof="video/mp4"></video>
      <div class="content">
          <h4>HOW DOES <br>IT WORKS</h4>
          <div class="box">
              <div class="el">
                <img src="/imgs/steps01.png" alt="" srcset="">
                <p>Choose Location</p>
              </div>
              <div class="el">
                <img src="/imgs/steps02.png" alt="" srcset="">
                <p>Pick up date</p>
              </div>
              <div class="el">
                <img src="/imgs/steps03.png" alt="" srcset="">
                <p>Take your Car</p>
              </div>
          </div>
      </div>
  </div>
</template>
<style scoped>
.container{
  position: relative;
  width: 100%;
  height: 710px;
  overflow: hidden;
  margin-top: 40px;
}
.container::after{
  content: '';
  position: absolute;
  width: 100%;
  height: 50%;
  background-color: white;
  bottom: -35%;
  left: 0;
  transform-origin: top left;
  transform: rotate(1.2deg) scale(1.1);
}
.bg-video{
  position: absolute;
  inset: 0;
  width: 100%;
  aspect-ratio: 1920 / 1012;
  z-index: -1;
} 
.content{
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .6);
  padding: 5rem 3.5rem;
  text-align: center;
}
.content h4{
  font-size: 2.6rem;
  line-height: 3rem;
  color: white;
  margin-bottom: 95px;
}
.box{
  display: flex;
  flex-direction: row;
  justify-content: space-around;
  width: 100%;
  column-gap: 35px
}
.box .el{
  display: flex;
  flex-direction: row;
  justify-content: flex-start;
  align-items: center;
}
.box .el p{
  font-size: 25px;
  color: rgb(231, 230, 230);
  margin-left: 10px;
}
</style>

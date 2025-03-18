<script setup>
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";
import "slick-carousel";
import { ref, onMounted } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

const slikeCom = ref(null);

onMounted(() => {
  $(slikeCom.value).slick({
    dots: true,
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: "linear",
    autoplay: true,
    autoplaySpeed: 2000,
  });
});

const reviewForm = useForm({
  content: ''
});

const submitReview = () => {
  reviewForm.post(route("sitereview"), {
    onSuccess: (page) => {
      reviewForm.reset();
    },
    onError: (error) => {},
  });
};

defineProps({
  reviews: Object
});
</script>
<template>
  <div class="Slide-container-sec">
    <h1 v-if="reviews.length != 0">What people say about us ?</h1>
    <div class="slikeCom" ref="slikeCom">
      <!-- <div class="SlidRiviewCard">
        <div class="SlidUserInfo">
            <div class="leftpart">
              <img src="imgs/user.png" alt="">
          <div class="SlidUserName">
            <span>
              <h3>Baha cherni</h3>
            </span>
          
            <div class="rating">
              <img src="imgs/star.png" alt="">
              <img src="imgs/star.png" alt="">
              <img src="imgs/star.png" alt="">
              <img src="imgs/star.png" alt="">
              <img src="imgs/star.png" alt="">
            </div>
          </div>
        </div>
        <div class="rightpart">
          <div class="SlideQuote">
            <img src="imgs/quoted.png" alt="">
          </div>
        </div>
        </div>
        <div class="SlidContent">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates repudiandae rerum porro quas quis ut.
          </p>
        </div>
      </div>
      
      <div class="SlidRiviewCard">
        <div class="SlidUserInfo">
            <div class="leftpart">
              <img src="imgs/user.png" alt="">
          <div class="SlidUserName">
            <span>
              <h3>Baha cherni</h3>
            </span>
          
            <div class="rating">
              <img src="imgs/star.png" alt="">
              <img src="imgs/star.png" alt="">
              <img src="imgs/star.png" alt="">
              <img src="imgs/star.png" alt="">
              <img src="imgs/star.png" alt="">
            </div>
          </div>
        </div>
        <div class="rightpart">
          <div class="SlideQuote">
            <img src="imgs/quoted.png" alt="">
          </div>
        </div>
        </div>
        <div class="SlidContent">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates repudiandae rerum porro quas quis ut, pariatur dolor.
          </p>
        </div>
      </div>

      <div class="SlidRiviewCard">
        <div class="SlidUserInfo">
            <div class="leftpart">
              <img src="imgs/user.png" alt="">
          <div class="SlidUserName">
            <span>
              <h3>Baha cherni</h3>
            </span>
          
            <div class="rating">
              <img src="imgs/star.png" alt="">
              <img src="imgs/star.png" alt="">
              <img src="imgs/star.png" alt="">
              <img src="imgs/star.png" alt="">
              <img src="imgs/star.png" alt="">
            </div>
          </div>
        </div>
        <div class="rightpart">
          <div class="SlideQuote">
            <img src="imgs/quoted.png" alt="">
          </div>
        </div>
        </div>
        <div class="SlidContent">
          <p>Lorem ipsum dolor sit amet consectetur
             adipisicing elit. Voluptates 
             repudiandae rerum porro quas quis 
             ut, pariatur dolor.
          </p>
        </div>
      </div>

      <div class="SlidRiviewCard">
        <div class="SlidUserInfo">
            <div class="leftpart">
              <img src="imgs/user.png" alt="">
          <div class="SlidUserName">
            <span>
              <h3>Baha cherni</h3>
            </span>
          
            <div class="rating">
              <img src="imgs/star.png" alt="">
              <img src="imgs/star.png" alt="">
              <img src="imgs/star.png" alt="">
              <img src="imgs/star.png" alt="">
              <img src="imgs/star.png" alt="">
            </div>
          </div>
        </div>
        <div class="rightpart">
          <div class="SlideQuote">
            <img src="imgs/quoted.png" alt="">
          </div>
        </div>
        </div>
        <div class="SlidContent">
          <p>Lorem ipsum dolor sit amet consectetur
             adipisicing elit.
          </p>
        </div>
      </div>  -->

      <div class="ekriRiviewCard" v-for="review in reviews" :key="review.id">
        <img :src="'/storage/user/'+review.picture" class="ekri-user-riview" alt="" />
        <div class="ekri-riview-container">
          <img src="imgs/quote.png" alt="" />
          <div class="ekri-riview-info">
            <p>{{ review.content }}</p>
          </div>
          <h4>
            {{ review.full_name }}
          </h4>
        </div>
      </div>
    </div>
    <div class="ekriReviewSlide" v-show="$page.props.user">
      <h2>Leave a review</h2>
      <div>
        <form @submit.prevent="submitReview">
          <div class="ekriRiviewContent">
            <!-- <input type="text" v-model="reviewForm.content"> -->
            <textarea
              v-model="reviewForm.content"
              cols="60"
              rows="2"
            ></textarea>
          </div>
          <div class="action">
            <input type="reset" class="button" id="reset" value="Reset" />
            <input
              type="submit"
              :disabled="reviewForm.processing"
              class="button"
              id="submit"
              value="Submit"
            />
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<style scoped>
.Slide-container-sec {
  display: flex;
  flex-direction: column;
  align-items: center;
  row-gap: 50px;
}
.ekriRiviewCard {
  display: flex !important;
  height: 300px;
  width: 800px;
}
.ekriRiviewCard .ekri-user-riview {
  height: 100%;
  flex: 1;
}
.ekriRiviewCard .ekri-riview-container {
  position: relative;
  flex: 4;
}

.ekriRiviewCard .ekri-riview-container .ekri-riview-info {
  background-color: white;
  margin-top: 20px;
  padding: 50px 30px;
  min-height: 100px;
  position: absolute;
  left: -20px;
  display: flex;
  align-items: center;
  width: 570px;
  box-shadow: 5px 5px 20px 9px #a893d156;
}
.ekriRiviewCard .ekri-riview-container h4 {
  margin: 220px 0px 0px 25px;
  color: #555;
  transition: all 0.3s;
  text-transform: uppercase;
}
.ekriRiviewCard .ekri-riview-container img {
  margin: 0px 0px -10px 480px;
  width: 40px;
}
.ekriRiviewCard .ekri-riview-container .ekri-riview-info p {
  font-size: 0.8em;
  font-weight: 500;
  line-height: 25px;
}
/* .ekriReviewSlide{
      background: red;
    } */
.ekriReviewSlide h2 {
  text-align: center;
  margin-bottom: 20px;
}
.ekriReviewSlide .ekriRiviewContent textarea {
  outline: none;
  border-radius: 2px;
  padding: 5px;
}
.ekriReviewSlide .action {
  display: flex;
  justify-content: space-between;
  padding: 5px 40px;
}
.ekriReviewSlide .action input {
  margin-top: 10px;
}

.ekriReviewSlide .action .button {
  border: 1px solid rgba(0, 0, 0, 0.2);
  height: 35px;
  line-height: 35px;
  width: 100px;
  border-radius: 19px;
}
</style>

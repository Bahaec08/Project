<script setup>
import {useForm} from "@inertiajs/inertia-vue3";
import {useSwalError, useSwalSuccess} from "@/Complosables/alert";
const form = useForm({
  ag_name: null,
  owner_name: null,
  ag_phone : null,
  ag_email: null,
  location: null,
  photo: null
})
const submitForm = () => {
  form.post(route("Agency.register"),{
    onSuccess: (page)=>{
      useSwalSuccess("Agency added successfully!")
      form.reset()
    },
    onError: (error)=>{
      useSwalError("Error")
    }
  })
}

</script>
<template>
  <Head>
    <title>JOIN EKRI.TN</title>
    <link rel="shortcut icon" href="imgs/ekri.png" type="image/x-icon">
  </Head>
  <div class="root">
    <div class='signup-container'>
      <div class='left-container'>
        
          <h1>
            POLITIC
          </h1>
          <div class="condition">
          <p>If you're interested in collaborating with us and earning profits, please fill out the application 
            form to request access to our site. Our site administrator will review your application and decide 
            whether to accept or reject it based on the license you provide. It's important to note that we will 
            receive a 5% commission on every car rental processed through your agency. By clicking the "Approve" 
            button, you are indicating your acceptance of our terms of service, which must be agreed upon before 
            submitting your application 
            </p>
            <input type="checkbox" name="" id="">
            I have read and accept the terms and conditions
        </div>
        
      </div>
      <div class='right-container'>
        <form @submit.prevent="submitForm">
        <header>
          <h1>Yay, Sign up here !</h1>
          <div class='set'>
            <div class='form-group'>
              <label for='agency-name'>Agency Name</label>
              <input class="input" v-model="form.ag_name" id='agency-name' placeholder="Enter name" type='text'>
            </div>
            <div class='form-group'>
              <label for='owner-name'>Owner Name</label>
              <input class="input" v-model="form.owner_name" id='owner-name' placeholder="Enter owner name" type='text'>
            </div>

          </div>
          <div class='set'>
            <div class='form-group'>
              <label for='phone-number'>Phone Number</label>
              <input class="input" v-model="form.ag_phone" type='number' id='phone-number' placeholder='Enter phone number'>
            </div>
            <div class='form-group'>
              <label for='email'>Email Address</label>
              <input class="input" v-model="form.ag_email" type='text' id='email' placeholder="Enter email" >
            </div>

          </div>
          <div class='set'>
            <div class='form-group'>
              <label for="exampleInpu5">Location</label>
              <select class="form-control" v-model="form.location">
                <option value="0">Choose location</option>
                <option value="Ariana">Ariana</option>
                <option value="Béja">Béja</option>
                <option value="Ben Arous">Ben Arous</option>
                <option value="Bizerte">Bizerte</option>
                <option value="Gabès">Gabès</option>
                <option value="Gafsa">Gafsa</option>
                <option value="Jendouba">Jendouba</option>
                <option value="Jendouba">Jendouba</option>
                <option value="Kairouan">Kairouan</option>
                <option value="Kasserine">Kasserine</option>
                <option value="Kébili">Kébili</option>
                <option value="Kef">Kef</option>
                <option value="Mahdia">Mahdia</option>
                <option value="Manouba">Manouba</option>
                <option value="Médenine">Médenine</option>
                <option value="Monastir">Monastir</option>
                <option value="Nabeul">Nabeul</option>
                <option value="Sfax">Sfax</option>
                <option value="Sidi Bouzid">Sidi Bouzid</option>
                <option value="Siliana">Siliana</option>
                <option value="Sousse">Sousse</option>
                <option value="Tataouine">Tataouine</option>
                <option value="Tozeur">Tozeur</option>
                <option value="Tunis">Tunis</option>
                <option value="Zaghouan">Zaghouan</option>
              </select>
            </div>
            <div class='photo'>
            <label for="exampleInputFile">License</label>
            <div class="input-group">
              <div class="custom-file">
                <input
                  type="file"
                  accept="image/*"
                  class="custom-file-input"
                  id="exampleInputFile"
                  @input="form.photo = $event.target.files[0]"
                />
              </div>
            </div>
          </div>
          </div>
  

        </header>
        <footer>
          <div class='set'>
            <input type="reset" class="button" id='reset' value="Reset">
            <input type="submit" :disabled="form.processing" class="button" id='submit' value="Submit">
          </div>
        </footer>

        </form>
      </div>
    </div>
  </div>
</template>
<style scoped>

.root {
  align-items: center;
  background: #ffffff;
  color: rgba(0, 0, 0, 0.8);
  display: grid;
  font-size: 14px;
  font-weight: 400;
  height: 100vh;
  justify-items: center;
}

.signup-container {
  display: grid;
  grid-template-areas: "left right";
  max-width: 900px;
}
.left-container .condition{
  padding: 0px 30px;
  text-align: left;
}
.left-container .condition p{
  margin: 25px 0px;
  line-height: 25px;
}
.left-container {
  background: #f1f2ff;
  overflow: hidden;
  padding: 40px 0 0 0;
  position: relative;
  text-align: center;
  width: 400px;
}
.left-container h1 {
  color: rgba(0, 0, 0, 0.8);
  display: inline-block;
  font-size: 24px;
}

.right-container {
  background: #eaf3f4;
  display: grid;
  grid-template-areas: "." ".";
  width: 550px;
}
.right-container h1:nth-of-type(1) {
  color: rgba(0, 0, 0, 0.8);
  font-size: 28px;
  font-weight: 600;
}
.right-container .set {
  display: flex;
  justify-content: space-between;
  margin: 20px 0;
  line-height: 25px;
}
.right-container .input {
  border: 1px solid rgba(0, 0, 0, 0.1);
  border-radius: 4px;
  height: 35px;
  line-height: 38px;
  padding-left: 5px;
}
.right-container input, .right-container label {
  color: rgba(0, 0, 0, 0.8);
}
.right-container header {
  padding: 30px 40px 10px 40px;
}
.right-container label, .right-container input {
  width: 220px;
}
.right-container footer {
  align-items: center;
  background: #eaf3f4;
  display: grid;
  padding: 5px 40px;
}
.right-container footer .button {
  border: 1px solid rgba(0, 0, 0, 0.2);
  height: 38px;
  line-height: 38px;
  width: 100px;
  border-radius: 19px;
}
.right-container footer #reset {
  background: #fff;
  transition: 0.2s all ease-in-out;
}
.right-container footer #reset:hover {
  background: #171A2B;
  color: white;
}
.right-container footer #submit {
  background: #807182;
  border: 1px solid transparent;
  color: #fff;
}
.right-container footer #submit:hover {
  background: #171A2B;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-size: 15px;
}
.custom-file{
  width: 100%;
}
</style>

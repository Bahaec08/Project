<script setup>
   // import 'jquery'
    import 'bootstrap/dist/css/bootstrap.css'
    import 'bootstrap/dist/js/bootstrap.js'
    import { useForm } from '@inertiajs/inertia-vue3';
    import {  useSwalSuccess } from '../../Complosables/alert';

    const loginAgency = useForm({
        email: null,
        password: null,
        //remember: false,
    })

//     const submitAgency =()=>{
//     form.post('login',{
//     onSuccess: (page)=>{
//       useSwalSuccess("User created and logged in")
//     },
//     onError: (error)=>{
//     }
//   })
//}
</script>

<template>
    <section class="text-center">
    <div class="p-5 bg-image"
    style="
            background-image: url(imgs/fill.jpg);
            height: 300px;
            "></div>

    <div class="card mx-4 mx-md-5 shadow-5-strong" style="
            margin-top: -100px;
            background: hsla(0, 0%, 100%, 0.8);
            backdrop-filter: blur(30px);">
        <div class="card-body py-5 px-md-5">

        <div class="row d-flex justify-content-center">
            <div class="col-lg-4">
            <h2 class="fw-bold mb-5">Login now</h2>
            <form @submit.prevent="loginAgency.post('/login')">

                <div class="form-outline mb-4">
                <input type="email" id="form3Example3" class="form-control" v-model="loginAgency.email" placeholder="Email address"/>
                </div>

                <div class="form-outline mb-4">
                <input type="password" id="form3Example4" class="form-control" v-model="loginAgency.password" placeholder="Password"/>
                </div>

                <div class="form-check d-flex justify-content-center mb-4">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33"  />
                <label class="form-check-label" for="form2Example33">
                    Subscribe to our newsletter
                </label>
                </div>
                <input type="submit" class="btn btn-primary btn-block mb-4" :disabled="loginAgency.processing" style="width:365px;" value="Log in">

            </form>
            </div>
        </div>
        </div>
    </div>
    </section>

 </template>


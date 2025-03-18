<script setup>
import { Link, usePage } from '@inertiajs/inertia-vue3';
import { computed, onMounted } from 'vue';
import { store } from '../../../../store.js';
import { Inertia } from '@inertiajs/inertia';



const fullName = computed(() => {
    return  usePage().props.value.user.firstName + ' ' +  usePage().props.value.user.lastName
})
const props = defineProps({
    user: Object,
    open: Boolean
})

onMounted(() => {
    $('#edit-popup').click(() => {
        document.documentElement.style.overflow = 'hidden';   
    });
})


const logout = () => {
    store.open1 = false
    store.open2 = false
    Inertia.get(route('user.logout'))
}


</script>

<template>
    <div v-if="open" class="dropzone">
        
        <div>
            {{  fullName }}
        </div>
        <button @click="store.isAppear = true;" class="transparent" id="edit-popup">
            <font-awesome-icon class="icons" :icon="['fas', 'user-pen']" />
            Edit profile
        </button>

        <Link class="transparent"  @click="logout" as="button"> <font-awesome-icon class="rotate icons" :icon="['fas', 'right-from-bracket']" /> Logout</Link>
    </div>
</template>
<style scoped>
.dropzone{
    position: absolute;
    top: 55px;
    right: -10px;
    padding: 10px 20px;
    background: rgb(246,242,249);
    width: 150px;
    /* box-shadow: 0 5px 25px rgba(0,0,0,0.1); */
    border-radius: 7px;
    transition: 0.5s;
}
.rotate{
    transform: scaleX(-1);
}

.dropzone::after{
    content: '';
    position: absolute;
    top: -5px;
    right: 20px;
    width: 20px;
    height: 20px;
    background: rgb(246,242,249);
    transform: rotate(45deg);
    z-index: -1;
}
.transparent{
    background-color: transparent;
    border: 0;
    cursor: pointer;
    margin: 5px 0;
}

</style>>
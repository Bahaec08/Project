<script setup>

import {computed} from "vue";

 
  const props = defineProps({
    links: {
      type: Object,
      required: true
    },

    prev: {
      type: String,
      default: ""
    },

    next: {
      type: String,
      default: ""
    }
  })

const computedLinks = computed(()=>{
  props.links.shift();
  props.links.pop();
  return props.links;
})
</script>
<template>
    <!-- <div class="card-footer clearfix d-flex justify-content-around">  -->
      <ul  class="pagination pagination-sm m-0 ">
        <li class="page-item" :class="{'disabled' : props.prev == null}">
          <Link class="page-link" :href="props.prev">«</Link>
        </li>
        <li class="page-item" :class="{'active': link.active}" v-for="link in computedLinks" :key="link.id">
          <Link class="page-link" :href="link.url">{{ link.label }}</Link>
        </li>
        <li class="page-item" :class="{'disabled' : props.next == null}">
          <Link class="page-link" :href="props.next">»</Link>
        </li>
      </ul>
     <!-- </div>  -->

</template>

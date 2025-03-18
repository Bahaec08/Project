<template>
  <div></div>
</template>

<script>
import { useSwalError } from "../Complosables/alert";


export default {
  mounted() {
    useSwalError(this.message);
    this.$emit('close')
  },
  props: {
    message: {
      type: String,
      required: true,
    },
  }
};

</script>
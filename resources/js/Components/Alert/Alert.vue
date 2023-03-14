<template>
    <div v-if="message && showAlert"  role="alert"
         class="bg-green-600 text-white rounded fixed right-0 top-0 px-4 py-2 mr-4 mt-4 z-10">
          {{ message}}
    </div>

</template>

<script setup>
import {onMounted, ref, watch} from "vue";


const props = defineProps({
    message: String
})
 const showAlert = ref(false);

//setTimeout(() => showAlert.value = false,2000)
 onMounted(() =>{
     showAlert.value = true;
     setTimeout(() =>{
         showAlert.value = false
     },2000)
 })
</script>







<template>
    <div class="dropzone" id="image-upload">
        <div class="dz-message" data-dz-message>
            <div>Drop images here to upload </div>
            <div>You can only upload 3 images</div>
        </div>
    </div>
</template>

<script setup>
import Dropzone from "dropzone";
import "dropzone/dist/dropzone.css";
import {onMounted} from "vue";

const props = defineProps({
    /*control the size of the file*/
    maxFilesize :{
        type:Number,
        default: 1024
    },

    /*control the quantity of the file*/
    maxFiles:{
        type: Number,
        default: 5
    }
})

onMounted(() =>{
    let dropzone = new Dropzone("#image-upload",{
        /**pass configuration*/
        url: "/upload-images",
        headers:{
            "X-CSRF-TOKEN" : document.querySelector("meta[name='csrf-token']")?.content,
        },

        maxFilesize: props.maxFilesize,
        maxFiles   : props.maxFiles,

        acceptedFiles: '.jpg,.jpeg,.png',
        addRemoveLinks:true

    });
})

</script>

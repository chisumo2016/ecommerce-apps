<template>
    <div class="dropzone" id="image-upload">
        <div class="dz-message" data-dz-message>
            <div>Drop image<span v-if="maxFiles>1">s</span> here to upload</div>
            <div v-if="maxFiles>=1">You can only upload {{ maxFiles }} image<span v-if="maxFiles>1">s</span></div>
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
        default: 1 //mb
    },

    modelType:{
        type:String,
        required:true
    },
    modelId:{
        type:Number,
        required: true
    },

})

onMounted(() =>{
    let dropzone = new Dropzone("#image-upload",{
        /**pass configuration*/
        //url: "/upload-images",
        url: route('images.store'),
        headers:{
            "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']")?.content,
        },

        paramName: "image",
        maxFilesize:  props.maxFilesize,
        maxFiles    : props.maxFiles,

        acceptedFiles: ".jpeg,.jpg,.png",
        addRemoveLinks: true,

    });

    /**Sending **/

    dropzone.on("sending", (file, xhr , fd) =>{
        fd.append("modelType", props.modelType); //modelType passing these as props to
        fd.append("modelId", props.modelId);
    });
});

</script>

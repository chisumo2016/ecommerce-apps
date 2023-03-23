<template>
    <div>
        <TextInput v-if="label"
               :value="label" />

        <editor api-key="svnd57jmsrot7ryfjd7ou9t43u72xzmkhwvut4btgefbl85j"
                :model-value="modelValue"
                @update:model-value="$emit('update:modelValue', $event)"
                :init="config"
                v-bind="$attrs" />

        <InputError v-if="errorMessage"
                    class="mt-1"
                    :message="errorMessage" />
    </div>
</template>

<script setup>

import Editor from "@tinymce/tinymce-vue";
import {ref} from "vue";
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';



defineProps({
    modelValue: {},
    label: {
        type: String,
        default: "",
    },
    errorMessage: {
        type: String,
        default: "",
    },
});
const config = ref({
    height: 300,
});
</script>


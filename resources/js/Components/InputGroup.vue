<template>
    <div>
        <InputLabel v-if="label" :value="label" />

        <TextInput
            :type="type"
            v-bind="$attrs"
            :model-value="modelValue"
            @update:model-value="$emit('update:modelValue', $event)"
            class="mt-1 block w-full"
        />

        <InputError class="mt-2"  v-if="errorMessage" :message="form.errors.name" />
    </div>
</template>

<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';

defineProps({
    modelValue: {},

    type:{
        type:String,
        default:"text",
    },
    label:{
        type:String,
        default: '',
    },
    errorMessage:{
        type:String,
        default:'',
    }
})
</script>

<style scoped>

</style>

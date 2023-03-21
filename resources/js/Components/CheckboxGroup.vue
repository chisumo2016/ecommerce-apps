<template>
    <InputLabel>
        <Checkbox :value="value"  @update:checked="$emit('update:checked', $event)" v-bind="$attrs"/>
    </InputLabel>
    <InputError  v-if="errorMessage"  class="mt-1" :message="errorMessage"/>
</template>

<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError";

defineProps({
    value: {},
    label: {
        type: String,
        default: "",
    },
    errorMessage: {
        type: String,
        default: "",
    },
});
</script>

<style scoped>

</style>

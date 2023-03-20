<template>
    <Card class="mb-4">
        <template #header>
            filters
        </template>
        <form class="grid grid-cols-4 gap-8">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    type="text"
                    class="mt-1 block w-full"
                    v-model="filters.name"
                />
            </div>
        </form>
    </Card>
</template>

<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Card from "@/Components/Card/Card.vue";
import {ref, watch} from "vue";

const props = defineProps({
    modelValue:{
        type: Object,
        default: () =>({}),
    }
});

const emits = defineEmits(["update:modelValue"]);
const filters = ref({ ...props.modelValue});

watch(filters,()=>{
    emits("update:modelValue" , filters.value)
},{
    deep: true,
})
</script>

<style scoped>

</style>

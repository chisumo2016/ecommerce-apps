<template>
    <Card class="mb-4">
        <template #header>
            filters
        </template>

        <form class="grid grid-cols-4 gap-8">
            <InputGroup label="Name" v-model="filters.name"/>
            <SelectGroup label="Category" v-model="filters.parentId" :items="categories"/>
            <SelectGroup label="Active" v-model="filters.active" :items="[{id: 1, name: 'Yes'}, {id: 0, name: 'No'}]"/>
        </form>
    </Card>
</template>

<script setup>
import Card from "@/Components/Card/Card.vue";
import {ref, watch} from "vue";
import InputGroup from "@/Components/InputGroup.vue";
import SelectGroup from "@/Components/SelectGroup.vue";

const props = defineProps({
    modelValue:{
        type: Object,
        default: () =>({}),
    },
    categories: Array,
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



<!--<div>-->
<!--<InputLabel for="name" value="Name" />-->

<!--<TextInput-->
<!--    type="text"-->
<!--    class="mt-1 block w-full"-->
<!--    v-model="filters.name"-->
<!--/>-->
<!--</div>-->

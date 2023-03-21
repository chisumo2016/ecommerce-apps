<template>
    <Card class="mb-4">
        <template #header>
            filters
        </template>

        <form class="grid grid-cols-4 gap-8">
            <InputGroup label="Name" v-model="filters.name"/>
            <InputGroup label="Email" v-model="filters.email" type="email"/>
            <SelectGroup label="Role" v-model="filters.roleId" :items="roles"/>
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
    roles: Array
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

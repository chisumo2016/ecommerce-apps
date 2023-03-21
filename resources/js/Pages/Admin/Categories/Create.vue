
<template>
    <Head title="title" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ title }}</h2>
        </template>

        <Container>
            <Card>
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-4 gap-6">
                       <InputGroup label="Name" v-model="form.name" :error-message="form.errors.name" required/>
                       <InputGroup label="Slug" v-model="form.slug" :error-message="form.errors.slug" required/>

                       <SelectGroup label="Parent Category" v-model="form.parentId"  :items="rootCategories" :error-message="form.errors.parentId"/>
                       <div class="mt-9">
                           <Checkbox label="Active" v-model:checked="form.active" />
                       </div>
<!--                       <SelectGroup label="Active" v-model="form.active"  :items="[{id: 1, name: 'Yes'}, {id: 0, name: 'No'}]" :error-message="form.errors.active" without-select required/>-->
                    </div>

                    <div class="mt-4">
                        <PrimaryButton type="submit" :disabled="form.processing">
                            {{ form .processing ? 'Saving...': 'Save'}}
                        </PrimaryButton>
                    </div>
                </form>
            </Card>
        </Container>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head , useForm} from '@inertiajs/vue3';
import Container from "@/Components/Container.vue";
import Card from "@/Components/Card/Card.vue";

import kebabCase from "lodash/kebabCase";
import replace from "lodash/replace";

// import InputLabel from '@/Components/InputLabel.vue';
// import TextInput from '@/Components/TextInput.vue';
// import InputError from '@/Components/InputError.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {onMounted, watch} from "vue";
import InputGroup from "@/Components/InputGroup.vue";
import SelectGroup from "@/Components/SelectGroup.vue";
import Checkbox from "@/Components/Checkbox.vue";


const props =defineProps({
    edit:{
        type: Boolean,
        default: false
    },
    title:{
        type: String
    },

    item:{
        type: Object,
        default:() => ({})
    },

    routeResourceName:{
        type : String,
        required: true
    },
    rootCategories:{
        type: Array,
        required: true
    },
})

const form = useForm({
    name: '',
    slug: '',
    active: true,
    parentId: '',
});

const submit = () => {
    props.edit ?
        form.put(route(`${props.routeResourceName}.update`, { id: props.item.id })) : form.post(route(`${props.routeResourceName}.store`));
};

onMounted(() =>{
    if (props.edit){
        form.name = props.item.name;
        form.slug = props.item.slug;
        form.active = props.item.active;
        form.parentId = props.item.parent_id;

    }
})
watch(
    () => form.name,
    (name) => {
        if (!props.edit) {
            form.slug = kebabCase(replace(name, /&./, "and"));
        }
    }
);
</script>

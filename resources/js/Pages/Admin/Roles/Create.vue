
<template>
    <Head title="title" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ title }}</h2>
        </template>

        <Container>
            <Card>
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="name" value="Name" />

                        <TextInput
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                        />

                        <InputError class="mt-2" :message="form.errors.name" />
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

import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {onMounted} from "vue";


const props =defineProps({
    edit:{
        type: Boolean,
        default: false
    },
    title:{
        type: String
    },
    role:{
        type: Object,
        default:() => ({})
    },
})

const form = useForm({
    name: '',
});

const submit = () => {
    props.edit ? form.put(route('roles.update', { id: props.role.id })) :

    form.post(route('roles.store'));
};

onMounted(() =>{
    if (props.edit){
        form.name = props.role.name
    }
})
</script>

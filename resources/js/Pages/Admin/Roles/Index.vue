
<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Roles</h2>
        </template>

        <Container>
            <PrimaryButton :href="route('roles.create')">Add New </PrimaryButton>
            <Card class="mt-4">
                <Table :headers="headers"
                       :items="roles">
                    <template v-slot="{ item }">
                        <Td>
                            {{ item.name }}
                        </Td>
                        <Td>
                            {{ item.created_at_formatted }}
                        </Td>
                        <Td>
                            <Actions :edit-link="route('roles.edit',{ id: item.id})"
                                @deleteClicked="showDeleteModal(item)"
                            />
                        </Td>
                    </template>
<!--                    <tr-->
<!--                        v-for="role in roles.data" :key="role.id"-->
<!--                        class="border-b dark:border-neutral-500">-->

<!--                    </tr>-->
                </Table>
            </Card>
        </Container>

    </AuthenticatedLayout>

    <!--Modal -->
    <Modal v-model="deleteModal" size="sm" :title="`Delete ${itemToDelete.name}`">
        Are you sure you want to delete this item ?
        <template #footer>
            <PrimaryButton
                @click="handleDeleteItem" :disabled="isDeleting">
                <span v-if="isDeleting">Deleting</span>
                <span v-else>Delete</span>
            </PrimaryButton>
        </template>
    </Modal>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Container from "@/Components/Container.vue";
import Card from "@/Components/Card/Card.vue";
import Table from "@/Components/Table/Table.vue";
import Td from "@/Components/Table/Td.vue";
import Actions from "@/Components/Table/Actions.vue";

import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from "vue";
import Modal from "@/Components/Modal/Modal.vue";
import { Inertia } from '@inertiajs/inertia'


defineProps({
    roles: {
        type: Object,
        default: () =>({})
    },

    headers :{
        type: Array,
        default: () => []
    },

    items: {
        type: Object,
        default: () => ({}),
    },
})

const deleteModal = ref(false);
const itemToDelete = ref({});
const isDeleting = ref(false)


function  showDeleteModal(item){
    deleteModal.value = true;
    itemToDelete.value = item
}

function  handleDeleteItem(){
    Inertia.delete(route("roles.destroy",{ id: itemToDelete.value.id }),{
        onBefore: () => {
            isDeleting.value = true;
        },
        onSuccess:()=>{
            deleteModal.value = false;
            itemToDelete.value = {};
        },
        onFinish: () =>{
            isDeleting.value = false;
        }
    })
}
</script>


<template>
    <Head :title="title" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ title}}</h2>
        </template>

        <Container>
            <!--   <Filters v-model="filters" :categories="rootCategories"/>-->
            <AddNew>
                <PrimaryButton v-if="can.create" :href="route(`${routeResourceName}.create`)">Add New </PrimaryButton>

                <template #filters>
                    <Filters  v-model="filters"
                              :categories="rootCategories"
                              class="mt-4"/>
                </template>
            </AddNew>

            <Card class="mt-4" :is-loading="isLoading">
                <Table :headers="headers"
                       :items="items">
                    <template v-slot="{ item }">
                        <Td>
                            {{ item.name }}
                        </Td>
                        <Td>
                            <Button v-if="item.children_count>0"
                                    :href="route(`${routeResourceName}.index`, {parentId: item.id})"
                                    small>
                                {{ item.children_count }}
                            </Button>
                            <span v-else>{{ item.children_count }}</span>
                        </Td>
                        <Td>
                            <Button :color="item.active ? 'green' : 'red'"
                                    small>
                                {{ item.active ? 'Active' : 'Inactive' }}
                            </Button>
                        </Td>
                        <Td>
                            {{ item.created_at_formatted }}
                        </Td>
                        <Td>
                            <Actions
                                :edit-link="route(`${routeResourceName}.edit`,{ id: item.id})"
                                :show-edit="item.can.edit"
                                :show-delete="item.can.delete"
                                @deleteClicked="showDeleteModal(item)"/>
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
import Modal from "@/Components/Modal/Modal.vue";
import useDeleteItems from "@/Composables/useDeleteItems.js";
import useFilters from "@/Composables/useFilters.js";
import Button from "@/Components/Button.vue";
import Filters from "@/Pages/Admin/Categories/Filters.vue";
import FilterIcon from "@/Components/Icons/Filter.vue";
import {ref} from "vue";
import AddNew from "@/Components/AddNew.vue";



const props = defineProps({
    items: {
        type: Object,
        default: () =>({})
    },

    headers :{
        type: Array,
        default: () => []
    },

    filters: {
        type: Object,
        default: () => ({}),
    },

    routeResourceName: {
        type: String,
        required: true
    },

    title:{
        type: String,
        required: true
    },

    can: Object,
    rootCategories: Array, //passed from user controller
})

/**Delete role - returning the object**/
const  {
    deleteModal,
    itemToDelete,
    isDeleting,
    showDeleteModal,
    handleDeleteItem
} = useDeleteItems({
    routeResourceName : props.routeResourceName
    //routeResourceName : "roles"
});

/**Filters module**/
const { filters , isLoading} = useFilters({
    filters : props.filters,
    routeResourceName : props.routeResourceName
    //routeResourceName : "roles"
});

const showFilters = ref(false)
</script>

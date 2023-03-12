
<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Roles</h2>
        </template>

        <Container>
            <Card>
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
                            <Actions :show-delete="false"/>
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
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Container from "@/Components/Container.vue";
import Card from "@/Components/Card/Card.vue";
import Table from "@/Components/Table/Table.vue";
import Td from "@/Components/Table/Td.vue";
import Actions from "@/Components/Table/Actions.vue";

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
</script>

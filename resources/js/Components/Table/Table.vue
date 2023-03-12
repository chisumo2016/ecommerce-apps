<template>
   <div class="sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm font-light">
                        <thead class="border-b font-medium dark:border-neutral-500">
                        <tr>
                            <Th
                                v-for="header in headers"
                                :key="header.label">
                                {{ header . label }}
                            </Th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b dark:border-neutral-500"
                            v-for="item in items.data"
                            :key="item.id">
                            <slot :item="item"></slot>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</template>

<script setup>
import Th from "@/Components/Table/Th.vue";


defineProps({
    headers :{
        type: Array,
        default: () => [],
    },

    items: {
        type: Object,
        default: () => ({}),
    },
})
</script>

<style scoped>

</style>

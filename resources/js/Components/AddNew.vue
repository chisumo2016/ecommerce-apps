<template>
    <div>
        <div class="flex items-center justify-between">
            <slot/>

            <Button
                v-if="$slots.filters"
                color="white"
                @click="showFilters =! showFilters">

                <FilterIcon class="w-4 h-4"/>
            </Button>
        </div>
        <!---- Filters--->
        <slot v-if="showFilters" name="filters" />
    </div>


</template>

<script setup>
import Button from "@/Components/Button.vue";
import FilterIcon from "@/Components/Icons/Filter.vue";
import {ref} from "vue";

const showFilters = ref(false)
</script>


<script setup>
const emit = defineEmits(['filter-events'])

function filterEvent(status) {
    emit('filter-events', status)
}
</script>

<template>
    <ul id="filter1" class="filter-switch inline-flex items-center relative h-10 p-1 space-x-1 bg-gray-200 rounded-md font-semibold text-blue-600 my-4">
        <li class="filter-switch-item flex relative h-8 bg-gray-300x" @click="filterEvent(-1)">
            <input type="radio" name="filter1" id="status-filter-all" class="sr-only" checked>
            <label for="status-filter-all" class="h-8 py-1 px-2 text-sm leading-6 text-gray-600 hover:text-gray-800 bg-white rounded shadow">
                All
            </label>
        </li>
        <li class="filter-switch-item flex relative h-8 bg-gray-300x" @click="filterEvent(0)">
            <input type="radio" name="filter1" id="status-filter-upcoming" class="sr-only">
            <label for="status-filter-upcoming" class="h-8 py-1 px-2 text-sm leading-6 text-gray-600 hover:text-gray-800 bg-white rounded shadow">
                Upcoming
            </label>
        </li>
        <li class="filter-switch-item flex relative h-8 bg-gray-300x" @click="filterEvent(1)">
            <input type="radio" name="filter1" id="status-filter-completed" class="sr-only">
            <label for="status-filter-completed" class="h-8 py-1 px-2 text-sm leading-6 text-gray-600 hover:text-gray-800 bg-white rounded shadow">
                Completed
            </label>
        </li>
    </ul>
</template>

<style scoped>
    .filter-switch label {
        cursor: pointer;
    }

    .filter-switch-item input:not(:checked) + label {
        --tw-bg-opacity: 0;
        box-shadow: none;
    }
</style>

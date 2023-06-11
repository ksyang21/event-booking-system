<script setup>

</script>

<template>
    <ul id="filter1" class="filter-switch inline-flex items-center relative h-10 p-1 space-x-1 bg-gray-200 rounded-md font-semibold text-blue-600 my-4">
        <li class="filter-switch-item flex relative h-8 bg-gray-300x">
            <input type="radio" name="filter1" id="filter1-0" class="sr-only" checked>
            <label for="filter1-0" class="h-8 py-1 px-2 text-sm leading-6 text-gray-600 hover:text-gray-800 bg-white rounded shadow">
                All
            </label>
            <div aria-hidden="true" class="filter-active"></div>
        </li>
        <li class="filter-switch-item flex relative h-8 bg-gray-300x">
            <input type="radio" name="filter1" id="filter1-1" class="sr-only">
            <label for="filter1-1" class="h-8 py-1 px-2 text-sm leading-6 text-gray-600 hover:text-gray-800 bg-white rounded shadow">
                Upcoming
            </label>
        </li>
        <li class="filter-switch-item flex relative h-8 bg-gray-300x">
            <input type="radio" name="filter1" id="filter1-3" class="sr-only">
            <label for="filter1-3" class="h-8 py-1 px-2 text-sm leading-6 text-gray-600 hover:text-gray-800 bg-white rounded shadow">
                Complete
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

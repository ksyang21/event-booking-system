<script setup>
import {h} from 'vue';
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {NButton, NDropdown, NIcon} from 'naive-ui'
import {Pen, Trash, CheckCircle} from '@vicons/fa';

defineProps({
    title: String,
    description: String,
    date: String,
    time: String,
    location: String,
    capacity: Number
})
const renderIcon = (icon) => {
    return () => {
        return h(NIcon, null, {
            default: () => h(icon)
        });
    };
};

const options = [
    {
        label: "Edit",
        key: "edit",
        icon: renderIcon(Pen)
    },
    {
        label: "Delete",
        key: "delete",
        icon: renderIcon(Trash)
    },
    {
        type: 'divider',
        key: 'd1'
    },
    {
        label: "Check as Completed",
        key: "checked",
        icon: renderIcon(CheckCircle)
    },
];

function log(key) {
    console.log(key)
}

function getDayOfWeek(dateString) {
    const dateParts = dateString.split('-');
    const year = parseInt(dateParts[0]);
    const month = parseInt(dateParts[1]) - 1; // Months in JavaScript are zero-based
    const day = parseInt(dateParts[2]);

    const date = new Date(year, month, day);
    const daysOfWeek = ['Sun', 'Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat'];
    const dayOfWeekIndex = date.getDay();

    return daysOfWeek[dayOfWeekIndex].toUpperCase();
}
</script>

<template>
    <div class="border border-slate-100 shadow-md rounded-md mt-3 w-100 p-3">
        <div class="flex items-center border-b-2 pb-3">
            <div class="flex flex-col items-center px-5 border-r-2 border-gray-400 min-w-[8rem] max-w-[8rem] w-[8rem]">
                <p class="text-sm">{{ getDayOfWeek(date) }}</p>
                <p class="text-lg">{{ date }}</p>
            </div>
            <div class="flex flex-col px-5 min-w-[12rem] max-w-[12rem] w-[12rem]">
                <p class="text-xs">
                    <font-awesome-icon icon="clock" class="text-gray-400 mr-3"></font-awesome-icon>
                    {{ time }}
                </p>
                <p class="text-xs mt-3">
                    <font-awesome-icon icon="location-dot" class="text-gray-400 mr-3"></font-awesome-icon>
                    {{ location }}
                </p>
                <p class="text-xs mt-3">
                    <font-awesome-icon icon="user" class="text-gray-400 mr-3"></font-awesome-icon>
                    {{ capacity }}
                </p>
            </div>
            <p class="text-2xl">{{ title }}</p>
            <div class="ml-auto">
                <n-dropdown trigger="hover" :options="options" @select="log">
                    <n-button>Action
                        <font-awesome-icon icon="chevron-down" class="ml-2"></font-awesome-icon>
                    </n-button>
                </n-dropdown>
            </div>
        </div>
        <div class="mt-4 ml-4">
            <p class="text-lg">Details</p>
            <p class="text-gray-500 mt-2">{{ description }}</p>
        </div>
    </div>
</template>

<style scoped>
</style>

<script setup>
import {h, inject} from 'vue';
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {NButton, NDropdown, NIcon} from 'naive-ui'
import {Pen, Trash, CheckCircle} from '@vicons/fa';

const props = defineProps({
    event: Object,
})

const Swal = inject('$swal')

const emit = defineEmits(['remove'])

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
        key: "completed",
        icon: renderIcon(CheckCircle),
        props: {
            onClick: () => {
                Swal.fire({
                    icon: 'info',
                    html: `Are you sure you want to mark <b>${props.event.title}</b> as completed?`,
                    showCancelButton: true
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        let eventId = props.event.id;
                        let response = await completeEvent(eventId);
                        if (response.data.status === 1) {
                            emit('remove-item', eventId, response.data.message)
                        }
                    }
                })
            }
        }
    },
];

async function completeEvent(eventId) {
    try {
        return await axios.put(`/api/events/${eventId}/update-status`);
    } catch (error) {
        console.log(error.response.data.message);
    }
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
                <p class="text-sm">{{ getDayOfWeek(event.date) }}</p>
                <p class="text-lg">{{ event.date }}</p>
            </div>
            <div class="flex flex-col px-5 min-w-[12rem] max-w-[12rem] w-[12rem]">
                <p class="text-xs">
                    <font-awesome-icon icon="clock" class="text-gray-400 mr-3"></font-awesome-icon>
                    {{ event.time }}
                </p>
                <p class="text-xs mt-3">
                    <font-awesome-icon icon="location-dot" class="text-gray-400 mr-3"></font-awesome-icon>
                    {{ event.location }}
                </p>
                <p class="text-xs mt-3">
                    <font-awesome-icon icon="user" class="text-gray-400 mr-3"></font-awesome-icon>
                    {{ event.capacity }}
                </p>
            </div>
            <p class="text-2xl">{{ event.title }}</p>
            <div class="ml-auto">
                <n-dropdown trigger="hover" :options="options" :size="'large'">
                    <n-button>Action
                        <font-awesome-icon icon="chevron-down" class="ml-2"></font-awesome-icon>
                    </n-button>
                </n-dropdown>
            </div>
        </div>
        <div class="mt-4 ml-4">
            <p class="text-lg">Details</p>
            <p class="text-gray-500 mt-2">{{ event.description }}</p>
        </div>
    </div>
</template>

<style scoped>
</style>

<script setup>
import {h, inject} from 'vue';
import {FontAwesomeIcon, FontAwesomeLayers} from "@fortawesome/vue-fontawesome";
import {NButton, NDropdown, NIcon} from 'naive-ui'
import {Pen, Trash, CheckCircle} from '@vicons/fa';

const props = defineProps({
    event: Object,
    showStatus: Boolean
})
const emit = defineEmits(['remove-item'])

const Swal = inject('$swal')

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
        icon: renderIcon(Trash),
        props: {
            onClick: () => {
                Swal.fire({
                    icon: 'info',
                    html: `Are you sure you want to delete <b>${props.event.title}</b>?`,
                    showCancelButton: true,
                    confirmButtonColor: '#d71d28'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        let eventId = props.event.id;
                        let response = await deleteEvent(eventId);
                        if (response.data.status === 1) {
                            emit('remove-item', eventId, response.data.message)
                        }
                    }
                })
            },
        }
    },
    {
        type: 'divider',
        key: 'd1'
    },
    {
        label: "Mark as Completed",
        key: "completed",
        icon: renderIcon(CheckCircle),
        props: {
            onClick: () => {
                Swal.fire({
                    icon: 'info',
                    html: `Are you sure you want to mark <b>${props.event.title}</b> as completed?`,
                    showCancelButton: true,
                    confirmButtonColor: '#18a058',
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
        return await axios.put(`/api/events/${eventId}/complete-event`);
    } catch (error) {
        console.log(error.response.data.message);
    }
}

async function deleteEvent(eventId) {
    try {
        return await axios.delete(`/api/events/${eventId}`);
    } catch (error) {
        console.log({Error: error});
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

function getStatusText(status) {
    switch (status) {
        case 0:
            return 'Upcoming';
        case 1 :
            return 'Completed';
        default:
            return 'Unknown';
    }
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
                <div v-if="showStatus">
                    <div class="flex flex-col" v-if="event.status === 0">
                        <div class="flex items-center ml-auto mr-4 mb-3">
                            <font-awesome-icon icon="pen-to-square" class="text-blue-600 cursor-pointer"/>
                            <font-awesome-icon icon="trash" class="ml-2 text-red-500 cursor-pointer"/>
                        </div>
                        <p class="mx-2 rounded-full bg-orange-300 py-1 px-3 text-sm">
                            <font-awesome-icon icon="hourglass-start" />
                            Upcoming
                        </p>
                    </div>
                    <p v-if="event.status === 1" class="mr-2 rounded-full bg-green-300 py-1 px-3 text-sm">
                        <font-awesome-icon icon="check-circle"/>
                        Completed
                    </p>
                </div>
                <n-dropdown v-else trigger="hover" :options="options" :size="'large'">
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

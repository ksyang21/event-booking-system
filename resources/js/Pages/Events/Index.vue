<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import StatusFilter from "@/Components/Dashboard/StatusFilter.vue";
import EventListItem from "@/Components/Dashboard/EventListItem.vue";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {Link} from "@inertiajs/vue3";
import {inject, ref} from "vue";

const props = defineProps({
    events: Array
})

const Swal = inject('$swal')
const events = ref(props.events)
const filteredEvents = ref(props.events)
const eventStatus = ref(-1)

function removeEvent(eventId, message) {
    events.value = events.value.filter(event => event.id !== eventId)
    filterEvents(eventStatus.value)
    Swal.fire({
        text: message,
        icon: "success",
        timer: 1500,
        showConfirmButton: false,
        allowEnterKey: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        position: 'top-end',
        toast: true
    })
}

function filterEvents(status) {
    eventStatus.value = status
    if (status < 0) {
        filteredEvents.value = events.value
    } else {
        filteredEvents.value = events.value.filter(event => event.status === status)
    }
}
</script>
<template>
    <AppLayout title="Create">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                All Events
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="py-6 px-8 bg-white border-b border-gray-200">
                        <div class="flex items-center">
                            <h1 class="text-3xl font-semibold">
                                Events
                            </h1>
                            <Link :href="route('events.create')"
                                  class="ml-auto rounded-full bg-green-500 py-2 px-6 hover:bg-green-600 text-white">
                                <font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon>
                                New Event
                            </Link>
                        </div>
                    </div>
                    <div class="p-6 pt-0 lg:p-8 lg:pt-0 bg-white">
                        <div class="ml-auto">
                            <StatusFilter :extra-class="'ml-auto'" @filter-events="filterEvents"></StatusFilter>
                        </div>
                        <p class="text-xl font-semibold" v-if="filteredEvents.length > 0">
                            Total <span class="text-blue-500">{{ filteredEvents.length }}</span> event<span
                            v-if="filteredEvents.length > 1">s</span> recorded
                        </p>
                        <p class="text-lg" v-if="filteredEvents.length === 0">
                            No event records found.
                            <Link :href="route('events.create')"
                                  class="ml-2 underline text-blue-500 hover:text-blue-600">
                                Go create one now!
                            </Link>
                        </p>
                        <ul class="scale-100" v-if="filteredEvents.length > 0">
                            <li v-for="(event, index) in filteredEvents" :key="index">
                                <EventListItem :event="event" :show-status="true" @remove-item="removeEvent"/>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>


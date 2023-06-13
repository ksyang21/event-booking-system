<script setup>
import {inject, ref} from "vue";
import EventListItem from "@/Components/EventListItem.vue";
// import StatusFilter from "@/Components/Dashboard/StatusFilter.vue";

const props = defineProps({
    upcomingEvents: Array,
});

const Swal = inject('$swal')
let events = ref(props.upcomingEvents)

function removeEvent(eventId, message) {
    events.value = events.value.filter(event => event.id !== eventId)
    Swal.fire({
        text: message,
        icon: "success",
        timer: 1500,
        showConfirmButton: false,
        allowEnterKey: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
    })
}
</script>

<template>
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <h1 class="text-3xl font-semibold">
                Event Booking System
            </h1>

            <p class="mt-8 text-2xl font-medium text-gray-900">
                Welcome back, {{ $page.props.auth.user.name }}!
            </p>

            <!--            <StatusFilter class="mt-6"/>-->

            <div class="mt-7">
                <div v-if="events.length > 0">
                    <p class="text-xl font-semibold" v-if="events.length > 0">
                        You have <span class="text-blue-500">{{ events.length }}</span> upcoming event<span
                        v-if="events.length > 1">s</span>.
                    </p>

                    <ul class="scale-100">
                        <li v-for="(event, index) in events" :key="index">
                            <EventListItem :event="event" @remove-item="removeEvent"/>
                        </li>
                    </ul>
                </div>
                <div v-else>
                    <p class="text-lg">No upcoming event</p>
                </div>
            </div>
        </div>
    </div>
</template>

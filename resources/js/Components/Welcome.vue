<script setup>
import {inject, ref} from "vue";
import EventListItem from "@/Components/Dashboard/EventListItem.vue";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import {Link} from "@inertiajs/vue3";
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
        position: 'top-end',
        toast: true
    })
}

async function seedEvents() {
    await axios.get(`/api/seed-events`)
    Swal.fire({
        title: "Done seeding!",
        icon: "success",
        timer: 1500,
        showConfirmButton: false,
        allowEnterKey: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
    }).then(
        getUpcomingEvents()
    )
}

async function getUpcomingEvents() {
    let response = await axios.get('/api/get-upcoming-events')
    events.value = response.data.data
}
</script>

<template>
    <div class="p-6 lg:p-8 bg-white">
        <div class="flex items-center">
            <h1 class="text-3xl font-semibold">
                Event Booking System
            </h1>
            <div class="ml-auto hidden md:flex">
                <a href="javascript:void(0)" class="ml-2 rounded-full bg-slate-300 py-2 px-6 hover:bg-slate-400"
                   @click="seedEvents">
                    Seed Event
                </a>
                <Link :href="route('events.create')"
                      class="ml-2 rounded-full bg-green-500 py-2 px-6 hover:bg-green-600 text-white">
                    <font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon>
                    New Event
                </Link>
            </div>
        </div>

        <div class="flex items-center mt-8">
            <p class="text-2xl font-medium text-gray-900 flex items-center">
                Welcome back,
                <img v-if="$page.props.jetstream.managesProfilePhotos" class="h-8 w-8 rounded-full object-cover mx-2"
                     :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                {{ $page.props.auth.user.name }} !
            </p>
            <Link :href="route('events.index')"
                  class="ml-auto rounded-full bg-blue-400 py-2 px-6 hover:bg-blue-600 text-white">
                View All
            </Link>
        </div>

        <!--            <StatusFilter class="mt-6"/>-->

        <div class="mt-7">
            <div v-if="events.length > 0">
                <div class="hidden md:flex items-center">
                    <p class="text-xl font-semibold" v-if="events.length > 0">
                        You have <span class="text-blue-500">{{ events.length }}</span> upcoming event<span
                        v-if="events.length > 1">s</span>.
                    </p>
                </div>

                <ul class="scale-100">
                    <li v-for="(event, index) in events" :key="index">
                        <EventListItem :event="event" :show-status="false" @remove-item="removeEvent"/>
                    </li>
                </ul>
            </div>
            <div v-else>
                <p class="text-lg">No upcoming event</p>
            </div>
        </div>
    </div>
</template>

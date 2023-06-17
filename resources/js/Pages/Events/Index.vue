<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import StatusFilter from "@/Components/Dashboard/StatusFilter.vue";
import EventListItem from "@/Components/Dashboard/EventListItem.vue";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    events: Array
})
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
                    <div class="p-6 lg:p-8 bg-white">
                        <div class="flex items-center">
                            <p class="text-xl font-semibold" v-if="events.length > 0">
                                Total <span class="text-blue-500">{{ events.length }}</span> event<span
                                v-if="events.length > 1">s</span> recorded.
                            </p>
                            <div class="ml-auto">
                                <StatusFilter :extra-class="'ml-auto'"></StatusFilter>
                            </div>
                        </div>
                        <ul class="scale-100">
                            <li v-for="(event, index) in events" :key="index">
                                <EventListItem :event="event" :show-status="true"/>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>


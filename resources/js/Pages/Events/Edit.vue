<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import EventForm from "@/Components/Events/EventForm.vue";

const props = defineProps({
    event: {
        type: Object,
        required: true,
    },
})

</script>
<template>
    <AppLayout title="Edit">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Event
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <EventForm :event="event" :action="'edit'" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

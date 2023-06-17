<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import {usePage} from "@inertiajs/vue3";
import {computed, inject} from "vue";

defineProps({
    upcomingEvents: Array,
    session: Array
})

const Swal = inject('$swal')
const message = computed(() => usePage().props.alert.success)
if (message.value) {
    Swal.fire({
        text: message.value,
        icon: "success",
        timer: 1500,
        showConfirmButton: false,
        allowEscapeKey: false,
        position: 'top-end',
        toast: true
    })
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome :upcoming-events="upcomingEvents"/>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

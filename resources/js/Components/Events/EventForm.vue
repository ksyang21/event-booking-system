<script setup>
import {reactive, ref} from "vue";
import {Link} from "@inertiajs/vue3";
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import {router} from '@inertiajs/vue3';
import moment from "moment/moment.js";
// import moment from "moment/moment.js";

const form = reactive({
    date: new Date(),
    time: new Date(),
    title: '',
    description: '',
    location: '',
    capacity: 0,
    submitFail: false,
})

let submitFail = ref(false)

/**
 * Setup VueDatePicker
 */
function validateForm() {
    submitFail.value = (!form.title || !form.location || form.capacity < 0 || !form.capacity)
}

function handleSubmit() {
    validateForm()
    if (!submitFail.value) {
        // Submit form
        // Change form.date to Date format to store in DB
        form.date = moment(form.date).format('YYYY-MM-DD')
        // Change form.time to time format to store in DB
        form.time = moment(form.time).format('H:m:00')
        router.post('/events', form)
    }
}

function quickFill() {
    form.date = new Date()
    form.time = new Date()
    form.title = 'Brainstorm Fest'
    form.description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    form.location = 'Meeting room 1'
    form.capacity = 2
}
</script>

<template>
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
        <div class="flex items-center">
            <h1 class="text-3xl font-semibold">
                New Event
            </h1>
            <div class="ml-auto">
                <a href="javascript:void(0)" class="rounded-full bg-slate-300 py-2 px-6 hover:bg-slate-400"
                   @click="quickFill">
                    Quick Fill
                </a>
            </div>
        </div>
    </div>
    <form class="w-full" @submit.prevent="handleSubmit">
        <div class="p-6 lg:p-8 bg-white">
            <div class="flex flex-wrap -mx-3 mb-3">
                <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="date">
                        <font-awesome-icon icon="calendar" class="mx-1"></font-awesome-icon>
                        Date
                    </label>
                    <VueDatePicker v-model="form.date" id="date" placeholder="Select event date" auto-apply
                                   :enable-time-picker="false" :clearable="false"/>
                    <p class="text-red-600 text-xs italic" v-if="submitFail && !form.date">Please select event date</p>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="time">
                        <font-awesome-icon icon="clock" class="mx-1"></font-awesome-icon>
                        Time
                    </label>
                    <VueDatePicker v-model="form.time" id="time" placeholder="Select event time" auto-apply time-picker
                                   :clearable="false"/>
                    <p class="text-red-600 text-xs italic" v-if="submitFail && !form.time">Please select event time</p>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-3">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
                        <font-awesome-icon icon="paper-plane" class="mx-1"></font-awesome-icon>
                        Title
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="title" type="text" placeholder="Event title" v-model="form.title">
                    <p class="text-red-600 text-xs italic" v-if="submitFail && !form.title">Title cannot be empty</p>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-3">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
                        <font-awesome-icon icon="file-lines" class="mx-1"></font-awesome-icon>
                        Description <span class="text-gray-400"> ( Optional )</span>
                    </label>
                    <textarea
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="description" placeholder="Event description" v-model="form.description" rows="5"/>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 mb-5">
                <div class="w-full md:w-2/3 px-3 mb-3 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="location">
                        <font-awesome-icon icon="location-dot" class="mx-1"></font-awesome-icon>
                        Location
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="location" type="text" placeholder="Event location" v-model="form.location">
                    <p class="text-red-600 text-xs italic" v-if="submitFail && !form.location">Location cannot be empty</p>
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="capacity">
                        <font-awesome-icon icon="user" class="mx-1"></font-awesome-icon>
                        Capacity
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="capacity" type="number" placeholder="Number of participants" v-model="form.capacity" min="0">
                    <p class="text-red-600 text-xs italic" v-if="submitFail && form.capacity <= 0">Please enter number of
                        participants</p>
                </div>
            </div>
            <div class="flex items-center mt-10">
                <Link :href="route('dashboard')" class="hover:underline hover:text-blue-500">
                    <font-awesome-icon icon="angle-left" class="mx-1"></font-awesome-icon>
                    Back to Dashboard
                </Link>
                <button class="ml-auto rounded-full bg-green-500 py-2 px-6 hover:bg-green-600 text-white" type="submit">
                    Create
                </button>
            </div>
        </div>
    </form>
</template>

<style scoped>

</style>

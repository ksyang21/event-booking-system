<template>
    <div>
        <h1>Events</h1>
        <ul>
            <li v-for="event in events" :key="event.id">
                <a :href="`/events/${event.id}`">{{ event.title }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        events: {
            type: Array,
            required: true,
        },
    },
};
</script>

<template>
    <div>
        <h1>{{ event.title }}</h1>
        <p>{{ event.description }}</p>
        <!-- Display other event details -->
    </div>
</template>

<script>
export default {
    props: {
        event: {
            type: Object,
            required: true,
        },
    },
};
</script>

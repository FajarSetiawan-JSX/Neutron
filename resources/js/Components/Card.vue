<script setup>
const props = defineProps(['variant'])
</script>

<template>
    <section :class="`rounded-xl ${props.variant ?? props.variant}`">
        <slot />
    </section>
</template>
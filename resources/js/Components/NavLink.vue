<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
    decorative: {
        type: String,
        required: false,
    }
});

const classes = computed(() =>
    props.active
        ? 'w-full rounded-xl px-3 py-2 flex items-center gap-3 bg-red-500 text-white'
        : 'w-full rounded-xl px-3 py-2 flex items-center gap-3 hover:bg-red-50 transition'
);
</script>

<template>
    <Link :href="href" :class="`${classes} ${props.decorative ? props.decorative : ''}`">
        <slot />
    </Link>
</template>

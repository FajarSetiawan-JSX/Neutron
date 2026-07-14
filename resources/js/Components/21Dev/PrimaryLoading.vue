<script setup>
const props = defineProps({
    size: {
        type: Number,
        default: 40,
    },
    class: {
        type: String,
        default: "stroke-red-500",
    },
});
</script>

<template>
    <div
        role="status"
        aria-live="polite"
        :class="[
            'flex items-center justify-center',
            props.class
        ]"
    >
        <svg
            :width="size"
            :height="size"
            viewBox="-2 -2 44 44"
            aria-hidden="true"
        >
            <!-- Background -->
            <path
                class="stroke-gray-300 dark:stroke-gray-700 opacity-50 fill-none"
                stroke-width="4"
                pathLength="100"
                d="M29.76 18.72 c0 7.28-3.92 13.6-9.84 16.96 c-2.88 1.68-6.24 2.64-9.84 2.64 c-3.6 0-6.88-0.96-9.76-2.64 c0-7.28 3.92-13.52 9.84-16.96 c2.88-1.68 6.24-2.64 9.76-2.64 S26.88 17.04 29.76 18.72 c5.84 3.36 9.76 9.68 9.84 16.96 c-2.88 1.68-6.24 2.64-9.76 2.64 c-3.6 0-6.88-0.96-9.84-2.64 c-5.84-3.36-9.76-9.68-9.76-16.96 c0-7.28 3.92-13.6 9.76-16.96 C25.84 5.12 29.76 11.44 29.76 18.72z"
            />

            <!-- Animated -->
            <path
                :class="`loader-path fill-none ${props.class}`"
                stroke-width="4"
                stroke-linecap="round"
                stroke-dasharray="15 85"
                pathLength="100"
                d="M29.76 18.72 c0 7.28-3.92 13.6-9.84 16.96 c-2.88 1.68-6.24 2.64-9.84 2.64 c-3.6 0-6.88-0.96-9.76-2.64 c0-7.28 3.92-13.52 9.84-16.96 c2.88-1.68 6.24-2.64 9.76-2.64 S26.88 17.04 29.76 18.72 c5.84 3.36 9.76 9.68 9.84 16.96 c-2.88 1.68-6.24 2.64-9.76 2.64 c-3.6 0-6.88-0.96-9.84-2.64 c-5.84-3.36-9.76-9.68-9.76-16.96 c0-7.28 3.92-13.6 9.76-16.96 C25.84 5.12 29.76 11.44 29.76 18.72z"
            />
        </svg>

        <span class="sr-only">
            Loading...
        </span>
    </div>
</template>

<style scoped>
.loader-path {
    animation: infinity-loader-travel 2s linear infinite;
}

@keyframes infinity-loader-travel {
    from {
        stroke-dashoffset: 0;
    }

    to {
        stroke-dashoffset: -100;
    }
}
</style>
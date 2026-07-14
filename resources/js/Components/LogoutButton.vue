<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <Link
        :href="route('logout')"
        method="post"
        as="button"
        class="w-full rounded-xl px-3 py-2 flex items-center gap-3 hover:bg-red-50 transition text-left"
    >
        <slot />
    </Link>
</template>
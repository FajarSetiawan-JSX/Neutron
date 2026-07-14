<script setup>
import { usePage } from '@inertiajs/vue3';

const user = usePage().props?.auth?.user;
</script>

<template>
    <div class="px-5 py-2 border-t border-red-100">
        <div class="rounded-2xl bg-gradient-to-r from-red-500 to-red-600 p-5 mb-2.5 text-white">
            <h2 class="font-bold text-sm">
                Welcome {{ user?.name }}👋
            </h2>
            <p class="text-sm text-red-100 mt-2">
                Have a productive day.
            </p>
        </div>
        <p class="text-xs text-red-200 font-anonymous text-center">2026 A site by Fajar Setiawan</p>
    </div>
</template>
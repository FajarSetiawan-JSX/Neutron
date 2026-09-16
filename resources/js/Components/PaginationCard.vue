```vue
<script setup>
import { ChevronLeft, ChevronRight } from "lucide-vue-next";
import { computed } from "vue";

const emit = defineEmits(["next", "page", "prev"]);
const props = defineProps(["links", "name"]);
const pages = computed(() => {
    const current = props?.links?.current_page ?? 1;
    const last = props?.links?.last_page ?? 1;
    if (last <= 5) {
        return Array.from({ length: last }, (_, i) => i + 1);
    }

    const result = [];

    result.push(1);

    if (current > 3) {
        result.push("...");
    }

    const start = Math.max(2, current - 1);
    const end = Math.min(last - 1, current + 1);

    for (let i = start; i <= end; i++) {
        result.push(i);
    }

    if (current < last - 2) {
        result.push("...");
    }

    result.push(last);

    return result;
});
const mobilePages = computed(() => {
    const current = props?.links?.current_page ?? 1;
    const last = props?.links?.last_page ?? 1;
    if (last <= 1) {
        return [1];
    }
    if (last <= 2) {
        return Array.from({ length: last }, (_, i) => i + 1);
    }
    if (current === last) {
        return [last];
    }
    if (current === last - 1) {
        return [current, last];
    }
    return [current, "...", last];
});
</script>

<template>
    <div
        class="flex flex-col gap-3 border border-zinc-200 bg-white px-4 py-4 shadow-sm sm:flex-row sm:items-center sm:justify-between sm:px-6"
    >
        <!-- Info -->
        <p class="text-sm text-slate-400">
            Menampilkan
            <span class="font-semibold text-slate-500">
                {{ props?.links?.from }}-{{ props?.links?.to }}
            </span>
            dari
            <span class="font-semibold text-red-500">
                {{ props?.links?.total }}
            </span>
            {{ props.name }}
        </p>

        <!-- ================= DESKTOP ================= -->
        <div class="hidden items-center gap-2 sm:flex">
            <!-- Previous -->
            <button
                type="button"
                :disabled="props?.links?.current_page === 1"
                @click="
                    emit(
                        'prev',
                        props?.links?.current_page - 1
                    )
                "
                :class="
                    props?.links?.current_page === 1
                        ? 'opacity-50'
                        : 'opacity-100 hover:border-red-500 hover:text-red-500'
                "
                class="flex h-10 w-10 items-center justify-center rounded-lg border border-zinc-200 text-zinc-400 transition"
            >
                <ChevronLeft :size="18" />
            </button>

            <!-- Pages -->
            <template
                v-for="(page, index) in pages"
                :key="index"
            >
                <!-- Dots -->
                <span
                    v-if="page === '...'"
                    class="flex h-10 w-10 items-center justify-center text-sm text-zinc-400"
                >
                    ...
                </span>

                <!-- Page -->
                <button
                    v-else
                    type="button"
                    @click="emit('page', page)"
                    class="flex h-10 w-10 items-center justify-center rounded-lg border text-sm font-semibold transition"
                    :class="
                        page === props?.links?.current_page
                            ? 'border-red-600 bg-red-600 text-white shadow-lg shadow-red-500/20'
                            : 'border-zinc-200 bg-white text-zinc-600 hover:border-red-500 hover:text-red-500'
                    "
                >
                    {{ page }}
                </button>
            </template>

            <!-- Next -->
            <button
                type="button"
                :disabled="
                    props?.links?.last_page ===
                    props?.links?.current_page
                "
                @click="
                    emit(
                        'next',
                        props?.links?.current_page + 1
                    )
                "
                :class="
                    props?.links?.last_page ===
                    props?.links?.current_page
                        ? 'opacity-50'
                        : 'opacity-100 hover:border-red-500 hover:text-red-500'
                "
                class="flex h-10 w-10 items-center justify-center rounded-lg border border-zinc-200 text-zinc-400 transition"
            >
                <ChevronRight :size="18" />
            </button>
        </div>

        <!-- ================= MOBILE ================= -->
        <div class="flex items-center gap-1 sm:hidden mx-auto">
            <button
                type="button"
                :disabled="
                    props?.links?.current_page === 1
                "
                @click="
                    emit(
                        'prev',
                        props?.links?.current_page - 1
                    )
                "
                :class="
                    props?.links?.current_page === 1
                        ? 'opacity-50'
                        : 'opacity-100 hover:border-red-500 hover:text-red-500'
                "
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-zinc-200 text-zinc-400 transition"
            >
                <ChevronLeft :size="17" />
            </button>

            <!-- Mobile Pages -->
            <template
                v-for="(page, index) in mobilePages"
                :key="index"
            >
                <!-- Dots -->
                <span
                    v-if="page === '...'"
                    class="flex h-9 w-7 shrink-0 items-center justify-center text-sm text-zinc-400"
                >
                    ...
                </span>

                <!-- Page -->
                <button
                    v-else
                    type="button"
                    @click="emit('page', page)"
                    class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border text-sm font-semibold transition"
                    :class="
                        page === props?.links?.current_page
                            ? 'border-red-600 bg-red-600 text-white'
                            : 'border-zinc-200 bg-white text-zinc-600 hover:border-red-500 hover:text-red-500'
                    "
                >
                    {{ page }}
                </button>
            </template>

            <!-- Next -->
            <button
                type="button"
                :disabled="
                    props?.links?.last_page ===
                    props?.links?.current_page
                "
                @click="
                    emit(
                        'next',
                        props?.links?.current_page + 1
                    )
                "
                :class="
                    props?.links?.last_page ===
                    props?.links?.current_page
                        ? 'opacity-50'
                        : 'opacity-100 hover:border-red-500 hover:text-red-500'
                "
                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-zinc-200 text-zinc-400 transition"
            >
                <ChevronRight :size="17" />
            </button>
        </div>
    </div>
</template>

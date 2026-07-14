<script setup>
import { ChevronLeft, ChevronRight } from "lucide-vue-next";
import { computed } from "vue";
const emit = defineEmits(['next', 'page', 'prev'])
const props = defineProps(['links', 'name']);
const pages = computed(() => {
    return props.links?.links?.slice(1, -1) ?? []
})

</script>

<template>
    <div
        class="flex items-center justify-between border border-zinc-200 bg-white px-6 py-4 shadow-sm"
    >
        <!-- Info -->
        <p class="text-sm text-slate-400">
            Menampilkan
            <span class="font-semibold text-slate-500">{{props?.links?.from}}-{{ props?.links?.to }}</span>
            dari
            <span class="font-semibold text-red-500">{{ props?.links?.total }}</span>
            {{ props.name }}
        </p>

        <!-- Pagination -->
        <div class="flex items-center gap-2">
            <!-- Prev -->
            <button type="button" 
                :disabled="props?.links?.current_page === 1" @click="emit('prev', props?.links?.current_page - 1)"
                :class="props?.links?.current_page === 1 ? 'opacity-50' : 'opacity-100 hover:border-red-500 hover:text-red-500'"
                class="flex h-10 w-10 items-center justify-center rounded-lg border border-zinc-200 text-zinc-400 transition"
            >
                <ChevronLeft :size="18" />
            </button>

            <!-- Pages -->
            <button type="button"   
                v-for="page in pages" :key="page"
                @click="emit('page', page.page)"
                class="flex h-10 w-10 items-center justify-center rounded-lg border text-sm font-semibold transition"
                :class="
                    page.page === props?.links?.current_page
                        ? 'border-red-600 bg-red-600 text-white shadow-lg shadow-red-500/20'
                        : 'border-zinc-200 bg-white text-zinc-600 hover:border-red-500 hover:text-red-500'
                "
            >
                {{ page.page }}
            </button>

            <button type="button" 
                :disabled="props?.links?.last_page == props?.links?.current_page" @click="emit('next', props?.links?.current_page + 1)"
                :class="props?.links?.last_page == props?.links?.current_page ? 'opacity-50' : 'opacity-100 hover:border-red-500 hover:text-red-500'"
                class="flex h-10 w-10 items-center justify-center rounded-lg border border-zinc-200 text-zinc-400 transition">
                <ChevronRight :size="18" />
            </button>

            <!-- Next -->
            
        </div>
    </div>
</template>
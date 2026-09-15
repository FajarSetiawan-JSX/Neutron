<script setup>
import { onMounted, onUnmounted, ref } from 'vue'

const loadingText = ref('Initializing')

const states = [
    'Loading...',
    'Fetching Data..',
    'Syncing...',
    'Processing..',
    'Optimizing...',
]

let interval = null
let i = 0

onMounted(() => {
    interval = setInterval(() => {
        i = (i + 1) % states.length
        loadingText.value = states[i]
    }, 1000)
})

onUnmounted(() => {
    clearInterval(interval)
})
</script>

<template>
    <Teleport to="body">
        <div class="fixed h-screen inset-0 flex justify-center items-center z-[9999] bg-black/90 overflow-y-auto">
            <div class="flex min-h-[200px] flex-col items-center justify-center gap-8">
                <div class="relative flex h-20 w-20 items-center justify-center">
                    <div class="absolute inset-0 animate-pulse rounded-full bg-emerald-400/15 blur-xl dark:bg-cyan-500/10"/>
                    <div class="absolute inset-0 animate-[spin_10s_linear_infinite] rounded-full border border-dashed border-emerald-500/40 dark:border-cyan-500/20"/>
                    <div class="absolute inset-1 animate-[spin_2s_linear_infinite] rounded-full border-2 border-transparent border-t-emerald-500 shadow-[0_0_6px_rgba(16,185,129,0.5)] dark:border-t-cyan-400 dark:shadow-[0_0_10px_rgba(34,211,238,0.4)]"/>
                    <div class="absolute inset-3 animate-[spin_3s_linear_infinite_reverse] rounded-full border-2 border-transparent border-b-green-600 shadow-[0_0_6px_rgba(22,163,74,0.4)] dark:border-b-purple-500 dark:shadow-[0_0_10px_rgba(168,85,247,0.4)]"/>
                    <div class="absolute inset-5 animate-[spin_1s_ease-in-out_infinite] rounded-full border border-transparent border-l-green-700/60 dark:border-l-white/50"/>
                    <div class="absolute inset-0 animate-[spin_4s_linear_infinite]">
                        <div class="absolute left-1/2 top-0 h-1 w-1 -translate-x-1/2 rounded-full bg-emerald-600 shadow-[0_0_4px_rgba(16,185,129,0.9)] dark:bg-cyan-400 dark:shadow-[0_0_6px_rgba(34,211,238,0.8)]"/>
                    </div>
                    <div class="absolute h-2 w-2 animate-pulse rounded-full bg-emerald-700 shadow-[0_0_6px_rgba(16,185,129,0.6)] dark:bg-white dark:shadow-[0_0_10px_rgba(255,255,255,0.8)]"/>
                </div>

                <!-- Text -->
                <div class="flex h-8 flex-col items-center justify-center gap-1">
                    <Transition
                        enter-active-class="transition-all duration-500"
                        enter-from-class="translate-y-2 opacity-0"
                        enter-to-class="translate-y-0 opacity-100"
                        leave-active-class="transition-all duration-500"
                        leave-from-class="translate-y-0 opacity-100"
                        leave-to-class="-translate-y-2 opacity-0"
                    >
                        <span :key="loadingText" class="text-[10px] font-medium uppercase tracking-[0.3em] text-emerald-700 dark:text-cyan-200/70">
                            {{ loadingText }}
                        </span>
                    </Transition>
                </div>
            </div>
        </div> 
    </Teleport>
</template>
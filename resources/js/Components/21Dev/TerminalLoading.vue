<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue'

const props = defineProps({
    rows: {
        type: Number,
        default: 5,
    },

    cols: {
        type: Number,
        default: 40,
    },

    blockWidth: {
        type: Number,
        default: 3,
    },

    speed: {
        type: Number,
        default: 50,
    },

    color: {
        type: String,
        default: 'text-rose-500',
    },

    bgColor: {
        type: String,
        default: 'bg-rose-500',
    },

    charEmpty: {
        type: String,
        default: '.',
    },

    charTrail: {
        type: Array,
        default: () => ['▓', '▒', '░'],
    },
})

const position = ref(1)
const direction = ref(1)

let interval = null

const maxPosition = computed(() => {
    return Math.max(1, props.cols - props.blockWidth - 1)
})

const rowString = computed(() => {
    const chars = new Array(props.cols).fill(props.charEmpty)

    if (direction.value === 1) {
        for (let i = 0; i < props.charTrail.length; i++) {
            const index = position.value - 1 - i

            if (index >= 0 && index < props.cols) {
                chars[index] = props.charTrail[i]
            }
        }
    } else {
        for (let i = 0; i < props.charTrail.length; i++) {
            const index =
                position.value +
                props.blockWidth +
                i

            if (index >= 0 && index < props.cols) {
                chars[index] = props.charTrail[i]
            }
        }
    }

    return chars.join('')
})

const blockStyle = computed(() => ({
    width: `calc(${props.blockWidth} * (1ch + 0.3em))`,
    left: `calc(${position.value} * (1ch + 0.3em))`,
}))

onMounted(() => {
    interval = setInterval(() => {
        const next = position.value + direction.value

        if (next >= maxPosition.value) {
            direction.value = -1
            position.value = maxPosition.value
            return
        }

        if (next <= 1) {
            direction.value = 1
            position.value = 1
            return
        }

        position.value = next
    }, Math.max(16, props.speed))
})

onUnmounted(() => {
    if (interval) {
        clearInterval(interval)
        interval = null
    }
})
</script>

<template>
    <div
        role="status"
        aria-live="polite"
        aria-label="Loading"
        :class="[
            'terminal-loader',
            'relative block w-fit max-w-full min-w-0 overflow-hidden',
            'select-none font-mono text-xs leading-[0.9] tracking-[0.3em]',
            'sm:text-sm',
            color,
        ]"
    >
        <div
            v-for="row in rows"
            :key="row"
            class="whitespace-pre"
        >
            {{ rowString }}
        </div>

        <div
            aria-hidden="true"
            :class="[
                'pointer-events-none absolute top-0 bottom-0',
                bgColor,
            ]"
            :style="blockStyle"
        />
    </div>
</template>

<style scoped>
.terminal-loader {
    /*
     * Isolasi layout dan paint komponen dari parent.
     * Animasi tidak boleh mempengaruhi layout di luar component.
     */
    contain: layout paint;
}
</style>
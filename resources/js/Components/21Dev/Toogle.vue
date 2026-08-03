<script setup>
import { computed } from 'vue'

const model = defineModel({
    type: [Boolean, Number],
    default: 0
})

const checked = computed({
    get: () => Number(model.value) === 1,
    set: (value) => {
        model.value = value ? 1 : 0
    }
})

const props = defineProps({
    variant: {
        type: String,
        default: 'minimal'
    },
    disabled: {
        type: Boolean,
        default: false
    }
})

const isMinimal = computed(() => props.variant === 'minimal')
</script>

<template>
    <!-- Minimal -->
    <label
        v-if="isMinimal"
        class="relative inline-block h-[1.8em] w-[3.7em] text-[17px]"
    >
        <input
            v-model="checked"
            type="checkbox"
            :disabled="disabled"
            class="peer sr-only"
        >

        <span
            class="
                absolute inset-0 cursor-pointer rounded-full bg-gray-300 transition
                peer-checked:bg-green-300
                dark:bg-gray-700
                dark:peer-checked:bg-green-900

                before:absolute
                before:bottom-[0.2em]
                before:left-[0.2em]
                before:h-[1.4em]
                before:w-[1.4em]
                before:rounded-full
                before:bg-gray-400
                before:transition-all
                before:duration-300
                before:content-['']

                peer-checked:before:translate-x-[1.9em]
                peer-checked:before:bg-green-500/70
                dark:peer-checked:before:bg-green-500
            "
        />
    </label>

    <!-- Orange -->
    <input
        v-else
        v-model="checked"
        type="checkbox"
        :disabled="disabled"
        class="
            ease before:ease
            relative h-6 w-12
            appearance-none
            rounded-full
            bg-stone-300
            transition
            duration-300

            before:absolute
            before:left-[calc(1.5em_-_1.6em)]
            before:top-[calc(1.5em_-_1.6em)]
            before:block
            before:h-[1.7em]
            before:w-[1.6em]
            before:cursor-pointer
            before:rounded-full
            before:border
            before:border-stone-400
            before:bg-white
            before:transition-all
            before:duration-300
            before:content-['']

            checked:bg-orange-600
            checked:before:translate-x-full
            checked:before:border-orange-500

            hover:before:shadow-[0_0_0_8px_rgba(0,0,0,.15)]
            checked:hover:before:shadow-[0_0_0_8px_rgba(236,72,72,.15)]
        "
    >
</template>
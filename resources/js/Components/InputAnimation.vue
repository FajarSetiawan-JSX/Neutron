<script setup lang="ts">
import { computed, ref } from "vue"
import { Motion } from "motion-v"

interface Props {
  modelValue: string
  label: string
  class?: string
  type?: string
  placeholder?: string
  disabled?: boolean
}

const props = withDefaults(defineProps<Props>(), {
  type: "text"
})

const emit = defineEmits<{
  (e: "update:modelValue", value: string): void
}>()

const isFocused = ref(false)

const showLabel = computed(() => {
  return isFocused.value || props.modelValue.length > 0
})

function onInput(event: Event) {
  const target = event.target as HTMLInputElement
  emit("update:modelValue", target.value)
}

const containerVariants = {
  initial: {},
  animate: {
    transition: {
      staggerChildren: 0.05
    }
  }
}

const letterVariants = {
  initial: {
    y: 0,
    color: "inherit"
  },
  animate: {
    y: "-120%",
    color: "var(--color-white)",
    transition: {
      type: "spring",
      stiffness: 300,
      damping: 20
    }
  }
}
</script>

<template>
  <div :class="['relative', props.class]">

    <Motion
      tag="div"
      class="absolute top-1/2 -translate-y-1/2 pointer-events-none text-white"
      :variants="containerVariants"
      initial="initial"
      :animate="showLabel ? 'animate' : 'initial'"
    >
      <Motion
        v-for="(char,index) in label.split('')"
        :key="index"
        tag="span"
        class="inline-block text-sm"
        :variants="letterVariants"
        :style="{ willChange: 'transform' }"
      >
        {{ char === ' ' ? '\u00A0' : char }}
      </Motion>
    </Motion>

    <input
      :value="modelValue"
      :type="type"
      :disabled="disabled"
      :placeholder="placeholder"
      @input="onInput"
      @focus="isFocused=true"
      @blur="isFocused=false"
      class="outline-none border-b-2 py-2 w-full text-base font-medium text-white bg-transparent placeholder-transparent"
    />

  </div>
</template>
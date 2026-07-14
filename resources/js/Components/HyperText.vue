<script setup lang="ts">
import { ref, watch, onMounted, onBeforeUnmount } from "vue"
import { Motion } from "motion-v"

interface Props {
  text: string
  duration?: number
  class?: string
  delay?: number
}

const props = withDefaults(defineProps<Props>(), {
  duration: 800,
})

const alphabets = "ABCDEFGHIJKLMNOPQRSTUVWXYZ".split("")

const displayText = ref<string[]>([])

let interval: ReturnType<typeof setInterval> | null = null

function getRandomLetter() {
  return alphabets[Math.floor(Math.random() * alphabets.length)]
}

function stopAnimation() {
  if (interval) {
    clearInterval(interval)
    interval = null
  }
}

function startAnimation() {
  stopAnimation()

  // Awal semua huruf random
  displayText.value = props.text.split("").map((char) =>
    char === " " ? " " : getRandomLetter()
  )

  let currentIndex = 0

  interval = setInterval(() => {
    displayText.value = displayText.value.map((letter, index) => {
      if (props.text[index] === " ") return " "

      if (index <= currentIndex) {
        return props.text[index]
      }

      return getRandomLetter()
    })

    currentIndex++

    if (currentIndex >= props.text.length) {
      displayText.value = props.text.split("")
      stopAnimation()
    }
  }, props.duration / props.text.length)
}

watch(
  () => props.text,
  () => {
    startAnimation()
  }
)

onMounted(() => {
    setTimeout(()=>{
        startAnimation()
    }, props.delay)
})

onBeforeUnmount(() => {
  stopAnimation()
})
</script>

<template>
  <div class="flex cursor-default overflow-hidden py-2">
    <Motion
      v-for="(letter, index) in displayText"
      :key="index"
      tag="span"
      :initial="{
        opacity: 0,
        y: -10
      }"
      :animate="{
        opacity: 1,
        y: 0
      }"
      :exit="{
        opacity: 0,
        y: 3
      }"
      :class="[
        'font-mono',
        letter === ' ' ? 'w-3' : '',
        props.class
      ]"
    >
      {{ letter }}
    </Motion>
  </div>
</template>
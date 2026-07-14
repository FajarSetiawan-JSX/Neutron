<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const canvas = ref(null)

let ctx = null
let animationId = null
let timer = 0
let circles = []

function initCircles() {

    if (!canvas.value) return

    circles = []

    const w = canvas.value.width
    const h = canvas.value.height

    const total =
        window.innerWidth < 640
            ? 80
            : window.innerWidth < 1024
            ? 150
            : 300

    for (let i = 0; i < total; i++) {

        circles.push({

            x:
                Math.random() * (w * 2) + w,

            y:
                Math.random() * h,

            radius:
                w / 1000,

        })

    }

}

function draw() {

    if (!canvas.value) return

    timer++

    ctx.clearRect(
        0,
        0,
        canvas.value.width,
        canvas.value.height
    )

    ctx.fillStyle = "#ffffff"

    const move = canvas.value.width / 80
    const grow = canvas.value.width / 1000

    circles.forEach(circle => {

        if (timer < 65) {

            circle.x -= move
            circle.radius += grow

        }
        else if (timer < 500) {

            circle.x -= move * .02
            circle.radius += grow * .2

        }

        ctx.beginPath()

        ctx.arc(

            circle.x,
            circle.y,
            circle.radius,
            0,
            Math.PI * 2

        )

        ctx.fill()

    })

    if (timer >= 500) {

        cancelAnimationFrame(animationId)

        return

    }

    animationId =
        requestAnimationFrame(draw)

}
function resizeCanvas() {

    if (!canvas.value) return

    canvas.value.width = window.innerWidth
    canvas.value.height = window.innerHeight

    timer = 0

    initCircles()

    if (animationId) {

        cancelAnimationFrame(animationId)

    }

    draw()

}

onMounted(() => {

    if (!canvas.value) return

    ctx = canvas.value.getContext("2d")

    resizeCanvas()

    window.addEventListener(
        "resize",
        resizeCanvas
    )

})

onUnmounted(() => {

    window.removeEventListener(
        "resize",
        resizeCanvas
    )

    if (animationId) {

        cancelAnimationFrame(animationId)

    }

})
</script>

<template>

<canvas
    ref="canvas"
    class="circle-canvas"
/>

</template>

<style scoped>

.circle-canvas{

    position:absolute;

    inset:0;

    width:100%;

    height:100%;

    display:block;

    pointer-events:none;

    z-index:1;

}

</style>
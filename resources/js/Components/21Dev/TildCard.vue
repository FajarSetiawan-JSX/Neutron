<script setup>
import { ref } from "vue";

const props = defineProps({
    maxRotate: {
        type: Number,
        default: 12,
    },

    scale: {
        type: Number,
        default: 1.04,
    },

    perspective: {
        type: Number,
        default: 1000,
    },

    glare: {
        type: Boolean,
        default: true,
    }
});

const card = ref(null);

const style = ref({});
const glareStyle = ref({});

const move = (e) => {
    if (window.innerWidth < 768) return;

    const rect = card.value.getBoundingClientRect();

    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    const centerX = rect.width / 2;
    const centerY = rect.height / 2;

    const rotateY = ((x - centerX) / centerX) * props.maxRotate;
    const rotateX = -((y - centerY) / centerY) * props.maxRotate;

    style.value = {
        transform: `
            perspective(${props.perspective}px)
            rotateX(${rotateX}deg)
            rotateY(${rotateY}deg)
            scale(${props.scale})
        `
    };

    glareStyle.value = {
        opacity: 1,
        background: `
            radial-gradient(
                circle at ${x}px ${y}px,
                rgba(255,255,255,.45),
                rgba(255,255,255,.12) 25%,
                transparent 65%
            )
        `
    };
};

const leave = () => {
    style.value = {
        transform: `
            perspective(${props.perspective}px)
            rotateX(0deg)
            rotateY(0deg)
            scale(1)
        `
    };

    glareStyle.value = {
        opacity: 0
    };
};
</script>

<template>
    <div
        ref="card"
        class="tilt-card"
        :style="style"
        @mousemove="move"
        @mouseleave="leave"
    >
        <div
            v-if="glare"
            class="tilt-glare"
            :style="glareStyle"
        />

        <div class="relative z-10 h-full">
            <slot/>
        </div>
    </div>
</template>

<style scoped>

.tilt-card{

    position:relative;

    transform-style:preserve-3d;

    transition:
        transform .18s ease,
        box-shadow .25s ease;

    will-change:transform;

}

.tilt-card:hover{

    box-shadow:
        0 25px 45px rgba(0,0,0,.18),
        0 10px 18px rgba(239,68,68,.12);

}

.tilt-glare{

    position:absolute;
    inset:0;

    border-radius:inherit;

    pointer-events:none;

    opacity:0;

    transition:opacity .2s;

    mix-blend-mode:screen;

}

</style>
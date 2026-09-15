<script setup>
import { computed } from 'vue'

const props = defineProps({
    /**
     * Ukuran visual loader.
     * Tidak mengubah ukuran layout secara liar.
     */
    scale: {
        type: Number,
        default: 0.8,
    },

    /**
     * Durasi satu siklus animasi.
     */
    duration: {
        type: Number,
        default: 3,
    },

    /**
     * Warna box.
     */
    primary: {
        type: String,
        default: '#000000',
    },

    /**
     * Warna sisi box.
     */
    primaryLight: {
        type: String,
        default: '#333333',
    },

    /**
     * Warna mask/background.
     *
     * Bisa diganti sesuai background halaman.
     */
    maskColor: {
        type: String,
        default: '#e5e7eb',
    },

    /**
     * Accessible label.
     */
    label: {
        type: String,
        default: 'Loading',
    },

    /**
     * Tambahan class pada wrapper.
     */
    class: {
        type: String,
        default: '',
    },
})

const boxes = Array.from({ length: 8 }, (_, i) => i)

const styleVars = computed(() => ({
    '--loader-duration': `${props.duration}s`,
    '--loader-scale': props.scale,
    '--loader-primary': props.primary,
    '--loader-primary-light': props.primaryLight,
    '--loader-mask': props.maskColor,
}))
</script>

<template>
    <!--
        Wrapper ini yang menentukan ukuran layout.

        Animation di dalam tidak boleh menentukan tinggi/width
        parent secara dinamis.
    -->
    <div
        role="status"
        aria-live="polite"
        :aria-label="label"
        :class="[
            'box-loader-wrapper',
            'relative isolate',
            'flex items-center justify-center',
            'overflow-hidden',
            'shrink-0',
            props.class,
        ]"
        :style="styleVars"
    >
        <span class="sr-only">
            {{ label }}
        </span>

        <div class="box-loader-stage">
            <div class="box-loader">
                <div
                    v-for="box in boxes"
                    :key="box"
                    :class="['box', `box${box}`]"
                    aria-hidden="true"
                >
                    <div></div>
                </div>

                <div class="ground" aria-hidden="true">
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/*
|--------------------------------------------------------------------------
| OUTER WRAPPER
|--------------------------------------------------------------------------
|
| Ini yang penting untuk mencegah loader merusak layout.
|
| Ukuran layout tidak mengikuti transform animation.
|
*/

.box-loader-wrapper {
    /*
     * Ukuran area yang benar-benar ditempati component.
     */
    width: 220px;
    height: 260px;

    /*
     * Pisahkan formatting/layout component dari parent.
     */
    contain: layout paint;

    /*
     * Jangan biarkan 3D animation membuat scrollbar parent.
     */
    overflow: hidden;

    /*
     * Prevent flex/grid shrinking.
     */
    flex: 0 0 auto;
}

/*
|--------------------------------------------------------------------------
| STAGE
|--------------------------------------------------------------------------
*/

.box-loader-stage {
    position: relative;

    width: 200px;
    height: 320px;

    /*
     * Scale visual loader tanpa mengubah ukuran layout wrapper.
     */
    transform: scale(var(--loader-scale));
    transform-origin: center center;

    transform-style: preserve-3d;
}

/*
|--------------------------------------------------------------------------
| MAIN LOADER
|--------------------------------------------------------------------------
*/

.box-loader {
    --duration: var(--loader-duration);

    --primary: var(--loader-primary);
    --primary-light: var(--loader-primary-light);
    --primary-rgba: rgba(0, 0, 0, 0);

    width: 200px;
    height: 320px;

    position: relative;

    transform-style: preserve-3d;

    /*
     * Animation boleh keluar dari box internal,
     * tetapi tidak boleh keluar dari wrapper component.
     */
}

/*
|--------------------------------------------------------------------------
| MASK
|--------------------------------------------------------------------------
*/

.box-loader::before,
.box-loader::after {
    --r: 20.5deg;

    content: '';

    width: 320px;
    height: 140px;

    position: absolute;

    right: 32%;
    bottom: -11px;

    /*
     * Jangan hardcode background halaman.
     */
    background: var(--loader-mask);

    transform: translateZ(200px) rotate(var(--r));

    animation:
        mask var(--duration) linear forwards infinite;

    pointer-events: none;
}

.box-loader::after {
    --r: -20.5deg;

    right: auto;
    left: 32%;
}

/*
|--------------------------------------------------------------------------
| GROUND
|--------------------------------------------------------------------------
*/

.ground {
    position: absolute;

    left: -50px;
    bottom: -120px;

    transform-style: preserve-3d;

    transform:
        rotateY(-47deg)
        rotateX(-15deg)
        rotateZ(15deg)
        scale(1);
}

.ground > div {
    transform:
        rotateX(90deg)
        rotateY(0deg)
        translate(-48px, -120px)
        translateZ(100px)
        scale(0);

    width: 200px;
    height: 200px;

    background: var(--primary);

    background:
        linear-gradient(
            45deg,
            var(--primary) 0%,
            var(--primary) 50%,
            var(--primary-light) 50%,
            var(--primary-light) 100%
        );

    transform-style: preserve-3d;

    animation:
        ground var(--duration) linear forwards infinite;
}

.ground > div::before,
.ground > div::after {
    --rx: 90deg;
    --ry: 0deg;
    --x: 44px;
    --y: 162px;
    --z: -50px;

    content: '';

    width: 156px;
    height: 300px;

    opacity: 0;

    background:
        linear-gradient(
            var(--primary),
            var(--primary-rgba)
        );

    position: absolute;

    transform:
        rotateX(var(--rx))
        rotateY(var(--ry))
        translate(
            var(--x),
            var(--y)
        )
        translateZ(var(--z));

    animation:
        ground-shine var(--duration)
        linear forwards infinite;
}

.ground > div::after {
    --rx: 90deg;
    --ry: 90deg;
    --x: 0;
    --y: 177px;
    --z: 150px;
}

/*
|--------------------------------------------------------------------------
| BOX
|--------------------------------------------------------------------------
*/

.box {
    --x: 0;
    --y: 0;

    position: absolute;

    animation:
        var(--duration)
        linear forwards infinite;

    transform:
        translate(
            var(--x),
            var(--y)
        );
}

.box > div {
    background-color: var(--primary);

    width: 48px;
    height: 48px;

    position: relative;

    transform-style: preserve-3d;

    animation:
        var(--duration)
        ease forwards infinite;

    transform:
        rotateY(-47deg)
        rotateX(-15deg)
        rotateZ(15deg)
        scale(0);
}

.box > div::before,
.box > div::after {
    --rx: 90deg;
    --ry: 0deg;
    --z: 24px;
    --y: -24px;
    --x: 0;

    content: '';

    position: absolute;

    background-color: inherit;

    width: inherit;
    height: inherit;

    transform:
        rotateX(var(--rx))
        rotateY(var(--ry))
        translate(
            var(--x),
            var(--y)
        )
        translateZ(var(--z));

    filter: brightness(
        var(--b, 1.2)
    );
}

.box > div::after {
    --rx: 0deg;
    --ry: 90deg;
    --x: 24px;
    --y: 0;
    --b: 1.4;
}

/*
|--------------------------------------------------------------------------
| BOX POSITIONS
|--------------------------------------------------------------------------
*/

.box0 {
    --x: -220px;
    --y: -120px;

    left: 58px;
    top: 108px;

    animation-name: box-move0;
}

.box0 > div {
    animation-name: box-scale0;
}

.box1 {
    --x: -260px;
    --y: 120px;

    left: 25px;
    top: 120px;

    animation-name: box-move1;
}

.box1 > div {
    animation-name: box-scale1;
}

.box2 {
    --x: 120px;
    --y: -190px;

    left: 58px;
    top: 64px;

    animation-name: box-move2;
}

.box2 > div {
    animation-name: box-scale2;
}

.box3 {
    --x: 280px;
    --y: -40px;

    left: 91px;
    top: 120px;

    animation-name: box-move3;
}

.box3 > div {
    animation-name: box-scale3;
}

.box4 {
    --x: 60px;
    --y: 200px;

    left: 58px;
    top: 132px;

    animation-name: box-move4;
}

.box4 > div {
    animation-name: box-scale4;
}

.box5 {
    --x: -220px;
    --y: -120px;

    left: 25px;
    top: 76px;

    animation-name: box-move5;
}

.box5 > div {
    animation-name: box-scale5;
}

.box6 {
    --x: -260px;
    --y: 120px;

    left: 91px;
    top: 76px;

    animation-name: box-move6;
}

.box6 > div {
    animation-name: box-scale6;
}

.box7 {
    --x: -240px;
    --y: 200px;

    left: 58px;
    top: 87px;

    animation-name: box-move7;
}

.box7 > div {
    animation-name: box-scale7;
}

/*
|--------------------------------------------------------------------------
| BOX MOVEMENT
|--------------------------------------------------------------------------
*/

@keyframes box-move0 {
    12% {
        transform: translate(var(--x), var(--y));
    }

    25%,
    52% {
        transform: translate(0, 0);
    }

    80% {
        transform: translate(0, -32px);
    }

    90%,
    100% {
        transform: translate(0, 188px);
    }
}

@keyframes box-move1 {
    16% {
        transform: translate(var(--x), var(--y));
    }

    29%,
    52% {
        transform: translate(0, 0);
    }

    80% {
        transform: translate(0, -32px);
    }

    90%,
    100% {
        transform: translate(0, 188px);
    }
}

@keyframes box-move2 {
    20% {
        transform: translate(var(--x), var(--y));
    }

    33%,
    52% {
        transform: translate(0, 0);
    }

    80% {
        transform: translate(0, -32px);
    }

    90%,
    100% {
        transform: translate(0, 188px);
    }
}

@keyframes box-move3 {
    24% {
        transform: translate(var(--x), var(--y));
    }

    37%,
    52% {
        transform: translate(0, 0);
    }

    80% {
        transform: translate(0, -32px);
    }

    90%,
    100% {
        transform: translate(0, 188px);
    }
}

@keyframes box-move4 {
    28% {
        transform: translate(var(--x), var(--y));
    }

    41%,
    52% {
        transform: translate(0, 0);
    }

    80% {
        transform: translate(0, -32px);
    }

    90%,
    100% {
        transform: translate(0, 188px);
    }
}

@keyframes box-move5 {
    32% {
        transform: translate(var(--x), var(--y));
    }

    45%,
    52% {
        transform: translate(0, 0);
    }

    80% {
        transform: translate(0, -32px);
    }

    90%,
    100% {
        transform: translate(0, 188px);
    }
}

@keyframes box-move6 {
    36% {
        transform: translate(var(--x), var(--y));
    }

    49%,
    52% {
        transform: translate(0, 0);
    }

    80% {
        transform: translate(0, -32px);
    }

    90%,
    100% {
        transform: translate(0, 188px);
    }
}

@keyframes box-move7 {
    40% {
        transform: translate(var(--x), var(--y));
    }

    52%,
    53% {
        transform: translate(0, 0);
    }

    80% {
        transform: translate(0, -32px);
    }

    90%,
    100% {
        transform: translate(0, 188px);
    }
}

/*
|--------------------------------------------------------------------------
| BOX SCALE
|--------------------------------------------------------------------------
*/

@keyframes box-scale0 {
    6% {
        transform:
            rotateY(-47deg)
            rotateX(-15deg)
            rotateZ(15deg)
            scale(0);
    }

    14%,
    100% {
        transform:
            rotateY(-47deg)
            rotateX(-15deg)
            rotateZ(15deg)
            scale(1);
    }
}

@keyframes box-scale1 {
    10% {
        transform:
            rotateY(-47deg)
            rotateX(-15deg)
            rotateZ(15deg)
            scale(0);
    }

    18%,
    100% {
        transform:
            rotateY(-47deg)
            rotateX(-15deg)
            rotateZ(15deg)
            scale(1);
    }
}

@keyframes box-scale2 {
    14% {
        transform:
            rotateY(-47deg)
            rotateX(-15deg)
            rotateZ(15deg)
            scale(0);
    }

    22%,
    100% {
        transform:
            rotateY(-47deg)
            rotateX(-15deg)
            rotateZ(15deg)
            scale(1);
    }
}

@keyframes box-scale3 {
    18% {
        transform:
            rotateY(-47deg)
            rotateX(-15deg)
            rotateZ(15deg)
            scale(0);
    }

    26%,
    100% {
        transform:
            rotateY(-47deg)
            rotateX(-15deg)
            rotateZ(15deg)
            scale(1);
    }
}

@keyframes box-scale4 {
    22% {
        transform:
            rotateY(-47deg)
            rotateX(-15deg)
            rotateZ(15deg)
            scale(0);
    }

    30%,
    100% {
        transform:
            rotateY(-47deg)
            rotateX(-15deg)
            rotateZ(15deg)
            scale(1);
    }
}

@keyframes box-scale5 {
    26% {
        transform:
            rotateY(-47deg)
            rotateX(-15deg)
            rotateZ(15deg)
            scale(0);
    }

    34%,
    100% {
        transform:
            rotateY(-47deg)
            rotateX(-15deg)
            rotateZ(15deg)
            scale(1);
    }
}

@keyframes box-scale6 {
    30% {
        transform:
            rotateY(-47deg)
            rotateX(-15deg)
            rotateZ(15deg)
            scale(0);
    }

    38%,
    100% {
        transform:
            rotateY(-47deg)
            rotateX(-15deg)
            rotateZ(15deg)
            scale(1);
    }
}

@keyframes box-scale7 {
    34% {
        transform:
            rotateY(-47deg)
            rotateX(-15deg)
            rotateZ(15deg)
            scale(0);
    }

    42%,
    100% {
        transform:
            rotateY(-47deg)
            rotateX(-15deg)
            rotateZ(15deg)
            scale(1);
    }
}

/*
|--------------------------------------------------------------------------
| GROUND
|--------------------------------------------------------------------------
*/

@keyframes ground {
    0%,
    65% {
        transform:
            rotateX(90deg)
            rotateY(0deg)
            translate(-48px, -120px)
            translateZ(100px)
            scale(0);
    }

    75%,
    90% {
        transform:
            rotateX(90deg)
            rotateY(0deg)
            translate(-48px, -120px)
            translateZ(100px)
            scale(1);
    }

    100% {
        transform:
            rotateX(90deg)
            rotateY(0deg)
            translate(-48px, -120px)
            translateZ(100px)
            scale(0);
    }
}

@keyframes ground-shine {
    0%,
    70% {
        opacity: 0;
    }

    75%,
    87% {
        opacity: 0.2;
    }

    100% {
        opacity: 0;
    }
}

/*
|--------------------------------------------------------------------------
| MASK
|--------------------------------------------------------------------------
*/

@keyframes mask {
    0%,
    65% {
        opacity: 0;
    }

    66%,
    100% {
        opacity: 1;
    }
}

/*
|--------------------------------------------------------------------------
| MOBILE
|--------------------------------------------------------------------------
*/

@media (max-width: 480px) {
    .box-loader-wrapper {
        width: 180px;
        height: 220px;
    }

    .box-loader-stage {
        transform:
            scale(
                calc(var(--loader-scale) * 0.7)
            );
    }
}

/*
|--------------------------------------------------------------------------
| REDUCED MOTION
|--------------------------------------------------------------------------
*/

@media (prefers-reduced-motion: reduce) {
    .box-loader *,
    .box-loader::before,
    .box-loader::after {
        animation-play-state: paused !important;
    }
}
</style>
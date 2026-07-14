<script setup>
import { Head, router } from "@inertiajs/vue3";
import { ArrowLeft, House } from "lucide-vue-next";
import { onMounted, onUnmounted, ref } from "vue";
import CharactersAnimation from "@/Components/21Dev/CharactersAnimation.vue";
import CircleAnimation from "@/Components/21Dev/CircleAnimation.vue";
const props = defineProps({
    status: {
        type: String,
        default: "404",
    },
    title: {
        type: String,
        default: "500",
    },
    message: {
        type: String,
        default:
            "The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.",
    },
    homeRoute: {
        type: String,
        default: "/",
    },
});

const showContent = ref(false);

const mouseX = ref(0);
const mouseY = ref(0);

function handleMouse(e) {
    mouseX.value = (e.clientX / window.innerWidth - 0.5) * 30;
    mouseY.value = (e.clientY / window.innerHeight - 0.5) * 30;
}

onMounted(() => {
    window.addEventListener("mousemove", handleMouse);
});

onUnmounted(() => {
    window.removeEventListener("mousemove", handleMouse);
});
onMounted(() => {
    setTimeout(() => {
        showContent.value = true;
    }, 1200);
});

function goBack() {
    window.history.back();
}

function goHome() {
    router.visit(props.homeRoute);
}
</script>

<template>
    <Head :title="title" />

    <div
        class="relative flex h-screen w-full items-center justify-center overflow-hidden bg-black"
    >
        <!-- Canvas -->
        <CircleAnimation />
        <div class="stars">

        <span
            v-for="i in 18"
            :key="i"
            class="star"
            :style="{
                top:(i*5)+'%',
                animationDelay:(i*.8)+'s',
                animationDuration:(5+i*.4)+'s'
            }"
        />

    </div>

            <!-- =========================
            Aurora Background
    ========================= -->

    <div class="aurora aurora-1"></div>

    <div class="aurora aurora-2"></div>

    <div class="aurora aurora-3"></div>
    <div class="grid-bg"></div>
    <!-- =========================
            Noise
    ========================= -->

    <div class="noise"></div>

    <!-- =========================
            Glow Ring
    ========================= -->

    <div class="glow-ring"></div>

    <!-- =========================
            Floating Light
    ========================= -->

    <div class="floating-light left"></div>

    <div class="floating-light right"></div>

        <!-- Characters -->
        <CharactersAnimation />

        <!-- Content -->

        <Transition
            enter-active-class="duration-700 ease-out"
            enter-from-class="opacity-0 scale-90 translate-y-10"
            enter-to-class="opacity-100 scale-100 translate-y-0"
        >
            <div
                v-if="showContent"
                class="relative z-50 flex w-[92%] max-w-4xl flex-col items-center text-center"
            >
            <div class="shine"></div>
                <!-- Badge -->

                <div
                    class="mb-5 px-5 py-2 text-sm tracking-[0.35em] text-black backdrop-blur-xl"
                >
                    ERROR
                </div>

                <!-- 404 -->

                <h1
                    class="bg-gradient-to-b from-white to-zinc-400 bg-clip-text text-8xl font-black text-transparent md:text-[170px]"
                >
                    {{ props.status }}
                </h1>

                <!-- Title -->

                <h2
                    class="mt-2 text-3xl font-bold text-black md:text-5xl"
                >
                    {{ props.title }}
                </h2>

                <!-- Description -->

                <p
                    class="mt-5 max-w-2xl leading-8 text-zinc-400"
                >
                    {{ message }}
                </p>

                <!-- Buttons -->

                <div
                    class="mt-12 flex flex-col gap-5 sm:flex-row"
                >
                    <!-- Back -->

                    <button
                        @click="goBack"
                        class="group flex items-center gap-3 rounded-xl border border-zinc-700 bg-zinc-900 px-8 py-4 font-semibold text-white transition-all duration-300 hover:scale-105 hover:border-white"
                    >
                        <ArrowLeft
                            class="transition-transform duration-300 group-hover:-translate-x-1"
                            :size="20"
                        />

                        Go Back
                    </button>

                    <!-- Home -->

                    <button
                        @click="goHome"
                        class="group flex items-center gap-3 rounded-xl bg-white px-8 py-4 font-semibold text-black transition-all duration-300 hover:scale-105"
                    >
                        <House
                            class="transition-transform duration-300 group-hover:scale-110"
                            :size="20"
                        />

                        Go Home
                    </button>
                </div>
            </div>
        </Transition>

        <!-- Background Glow -->

        <div
            class="absolute left-1/2 top-1/2 h-[600px] w-[600px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-violet-600/20 blur-[180px]"
        />

        <div
            class="absolute bottom-0 left-0 h-[350px] w-[350px] rounded-full bg-fuchsia-600/10 blur-[150px]"
        />

        <div
            class="absolute right-0 top-0 h-[300px] w-[300px] rounded-full bg-cyan-500/10 blur-[140px]"
        />
    </div>
</template>

<style scoped>

html,
body{
    overflow:hidden;
}
/* =====================================
            AURORA
===================================== */

.aurora{

    position:absolute;

    border-radius:9999px;

    filter:blur(130px);

    animation:
        float 10s ease-in-out infinite;

    opacity:.55;

}

.aurora-1{

    width:520px;
    height:520px;

    background:#7c3aed;

    left:-120px;
    top:-120px;

}

.aurora-2{

    width:420px;
    height:420px;

    background:#2563eb;

    right:-80px;
    top:10%;

    animation-delay:2s;

}

.aurora-3{

    width:480px;
    height:480px;

    background:#ec4899;

    bottom:-120px;

    left:40%;

    animation-delay:4s;

}

/* =====================================
            GLOW RING
===================================== */

.glow-ring{

    position:absolute;

    width:700px;
    height:700px;

    border-radius:9999px;

    border:1px solid rgba(255,255,255,.05);

    box-shadow:

        inset 0 0 120px rgba(255,255,255,.04),

        0 0 100px rgba(139,92,246,.2);

    animation:
        rotateRing 25s linear infinite;

}

/* =====================================
            FLOAT LIGHT
===================================== */

.floating-light{

    position:absolute;

    width:250px;
    height:250px;

    border-radius:9999px;

    filter:blur(90px);

    opacity:.45;

}

.floating-light.left{

    left:10%;

    bottom:8%;

    background:#8b5cf6;

}

.floating-light.right{

    right:10%;

    top:18%;

    background:#06b6d4;

}

/* =====================================
            NOISE
===================================== */

.noise{

    position:absolute;

    inset:0;

    opacity:.04;

    background-image:

    radial-gradient(#fff 1px, transparent 0);

    background-size:14px 14px;

    animation:
        noiseMove 12s linear infinite;

}
/* =====================================
            GLASS CARD
===================================== */

.glass-card{

    padding:70px;

    border-radius:34px;

    overflow:hidden;

    backdrop-filter:blur(20px);

    background:

        linear-gradient(

            180deg,

            rgba(255,255,255,.08),

            rgba(255,255,255,.03)

        );

    border:1px solid rgba(255,255,255,.08);

    box-shadow:

        0 30px 100px rgba(0,0,0,.45),

        inset 0 0 40px rgba(255,255,255,.04);

    transition:

        transform .18s linear;

}

/* =====================================
            SHINE
===================================== */

.shine{

    position:absolute;

    inset:-250px;

    background:

        linear-gradient(

            115deg,

            transparent 20%,

            rgba(255,255,255,.14),

            transparent 70%

        );

    transform:rotate(25deg);

    animation:

        shine 7s linear infinite;

}

/* =====================================
            BUTTON
===================================== */

.glass-card button{

    transition:

        .35s;

}

.glass-card button:hover{

    transform:

        translateY(-4px)
        scale(1.05);

}

/* =====================================
            TITLE
===================================== */

.glass-card h1{

    text-shadow:

        0 0 30px rgba(255,255,255,.15);

}

/* =====================================
            KEYFRAME
===================================== */
/* =====================================
            GRID
===================================== */

.grid-bg{

    position:absolute;

    inset:0;

    opacity:.07;

    background-image:

        linear-gradient(rgba(255,255,255,.12) 1px,transparent 1px),

        linear-gradient(90deg,rgba(255,255,255,.12) 1px,transparent 1px);

    background-size:55px 55px;

    animation:gridMove 25s linear infinite;

}

/* =====================================
            STARS
===================================== */

.stars{

    position:absolute;

    inset:0;

    overflow:hidden;

    pointer-events:none;

}

.star{

    position:absolute;

    left:-10%;

    width:180px;

    height:2px;

    border-radius:999px;

    background:

        linear-gradient(

            to right,

            white,

            transparent

        );

    animation:

        shooting linear infinite;

    opacity:.75;

}

/* =====================================
            KEYFRAME
===================================== */

@keyframes shooting{

    from{

        transform:

            translateX(0)
            translateY(0)
            rotate(-25deg);

    }

    to{

        transform:

            translateX(150vw)
            translateY(40vh)
            rotate(-25deg);

    }

}

@keyframes gridMove{

    from{

        transform:

            translateY(0);

    }

    to{

        transform:

            translateY(55px);

    }

}
@keyframes shine{

    from{

        transform:

            translateX(-120%)
            rotate(25deg);

    }

    to{

        transform:

            translateX(120%)
            rotate(25deg);

    }

}

/* =====================================
            MOBILE
===================================== */

@media(max-width:768px){

.glass-card{

    padding:40px 25px;

}

}

/* =====================================
            KEYFRAME
===================================== */

@keyframes float{

    0%{

        transform:
        translateY(0)
        scale(1);

    }

    50%{

        transform:
        translateY(-40px)
        scale(1.08);

    }

    100%{

        transform:
        translateY(0)
        scale(1);

    }

}

@keyframes rotateRing{

    from{

        transform:
        rotate(0deg);

    }

    to{

        transform:
        rotate(360deg);

    }

}

@keyframes noiseMove{

    from{

        transform:
        translate(0);

    }

    to{

        transform:
        translate(-80px,-40px);

    }

}
</style>
<script setup>
const props = defineProps({
    image: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        default: "",
    },
    subtitle: {
        type: String,
        default: "",
    },
    width: {
        type: Number,
        default: 320,
    },
    height: {
        type: Number,
        default: 320,
    },
});
</script>

<template>
    <div
        class="glow-container"
        :style="{
            '--card-width': width + 'px',
            '--card-height': height + 'px'
        }"
    >
        <span class="glow"></span>

        <div class="glow-content">
            <img
                :src="image"
                :alt="title"
                class="absolute inset-0 w-full h-full object-cover rounded-[28px]"
            />

            <div
                class="absolute inset-0 rounded-[28px]"
            />

            <div class="absolute bottom-6 left-6 z-20 text-white">
                <h2
                    v-if="title"
                    class="text-2xl font-bold"
                >
                    {{ title }}
                </h2>

                <p
                    v-if="subtitle"
                    class="text-white/70 mt-1"
                >
                    {{ subtitle }}
                </p>
            </div>

            <slot />
        </div>
    </div>
</template>

<style scoped>
.glow-container{
    --card-radius:32px;
    --border-width:3px;
    --card-color:#0000;
    --animation-speed:5s;
    --hue:0;

    width:var(--card-width);
    height:var(--card-height);

    position:relative;
    display:flex;
    justify-content:center;
    align-items:center;
}

.glow-content{
    position:absolute;
    inset:0;
    overflow:hidden;
    border-radius:calc(var(--card-radius) - 4px);
    background:var(--card-color);
}

.glow-content::before{
    content:"";
    position:absolute;
    inset:-2px;
    z-index:-1;

    border-radius:var(--card-radius);

    background:
    conic-gradient(
        from 0deg,
        #ff006a,
        #0059ff,
        #00ff84,
        #ffe600,
        #ff006a
    );

    filter:blur(2px);

    animation:spin var(--animation-speed) linear infinite;
}

.glow{
    position:absolute;
    width:160px;
    height:160px;
    border-radius:9999px;

    background:hsl(var(--hue),100%,60%);
    filter:blur(70px);

    animation:
        orbit var(--animation-speed) linear infinite,
        hue var(--animation-speed) linear infinite;
}

.glow-container:hover .glow{
    transform:scale(1.3);
    transition:.35s;
}

.glow-container:hover .glow-content::before{
    filter:blur(6px);
}

@keyframes orbit{
    from{
        transform:rotate(0deg)
        translateX(calc(var(--card-width)/2.2))
        rotate(0deg);
    }

    to{
        transform:rotate(360deg)
        translateX(calc(var(--card-width)/2.2))
        rotate(-360deg);
    }
}

@keyframes hue{
    from{
        filter:hue-rotate(0deg) blur(70px);
    }

    to{
        filter:hue-rotate(360deg) blur(70px);
    }
}

@keyframes spin{
    from{
        transform:rotate(0deg);
    }

    to{
        transform:rotate(360deg);
    }
}
</style>
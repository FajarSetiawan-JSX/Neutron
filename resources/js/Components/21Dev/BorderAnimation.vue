<script setup>
const props = defineProps({
    duration: {
        type: Number,
        default: 4,
    },

    class: {
        type: String,
        default: "",
    },
});
</script>

<template>
    <div
        class="animated-border"
        :style="{
            '--duration': duration + 's',
        }"
    >
        <div
            class="animated-border-content"
            :class="props.class"
        >
            <slot />
        </div>
    </div>
</template>

<style scoped>

.animated-border{

    position:relative;

    overflow:hidden;

    border-radius:24px;

    padding:1.5px;

    isolation:isolate;

}

.animated-border::before{

    content:"";

    position:absolute;

    inset:-180%;

    background:conic-gradient(

        from 0deg,

        transparent 0deg,

        transparent 320deg,

        #38bdf8 336deg,

        white 345deg,

        #38bdf8 354deg,

        transparent 360deg

    );

    animation:border-spin var(--duration) linear infinite;

}

.animated-border-content{

    position:relative;

    z-index:2;

    height:100%;

    border-radius:22px;

}

@keyframes border-spin{

    to{

        transform:rotate(360deg);

    }

}

</style>
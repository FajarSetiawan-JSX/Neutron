<script setup>
defineProps({
    text: {
        type: String,
        default: "Button",
    },
    type: {
        type: String,
        default: "button",
    },
    disabled: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <button
        v-bind="$attrs"
        :type="type"
        :disabled="disabled"
        class="rainbow-border relative rounded-xl transition-all duration-200 flex items-center justify-center gap-2.5 disabled:opacity-50 disabled:cursor-not-allowed"
    >
        <slot>
            {{ text }}
        </slot>
    </button>
</template>

<style scoped>
.rainbow-border::before,
.rainbow-border::after {
    content: "";
    position: absolute;
    left: -2px;
    top: -2px;
    width: calc(100% + 4px);
    height: calc(100% + 4px);
    border-radius: 14px;
    z-index: -1;
    background: linear-gradient(
        45deg,
        #fb0094,
        #0000ff,
        #00ff00,
        #ffff00,
        #ff0000,
        #fb0094,
        #0000ff,
        #00ff00,
        #ffff00,
        #ff0000
    );
    background-size: 400%;
    animation: rainbow 20s linear infinite;
}

.rainbow-border::after {
    filter: blur(40px);
}

@keyframes rainbow {
    0% {
        background-position: 0 0;
    }

    50% {
        background-position: 400% 0;
    }

    100% {
        background-position: 0 0;
    }
}
</style>
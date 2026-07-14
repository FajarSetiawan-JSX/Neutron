<script setup>
import { computed } from "vue";

const props = defineProps({
    color: {
        type: String,
        default: "default",
    },

    disabled: {
        type: Boolean,
        default: false,
    },

    type: {
        type: String,
        default: "button",
    },

    class: {
        type: String,
        default: "",
    },
});

const classes = computed(() => [
    "gradient-button",

    props.color !== "default"
        ? `gradient-button-${props.color}`
        : "",

    props.class,
]);
</script>

<template>
    <button
        :type="type"
        :disabled="disabled"
        :class="classes"
    >
        <slot />
    </button>
</template>

<style scoped>
.gradient-button {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;

    cursor: pointer;
    overflow: hidden;

    background: linear-gradient(
        135deg,
        #3b0764 0%,
        #7c3aed 25%,
        #ec4899 55%,
        #ef4444 100%
    );

    background-size: 200% 200%;

    transition:
        background-position .4s ease,
        filter .3s ease,
        transform .25s ease,
        box-shadow .3s ease;
}

.gradient-button:hover {

    background-position: right center;

    filter: brightness(1.15) saturate(1.2);

    transform: translateY(-2px);

    box-shadow:
        0 12px 30px rgba(236,72,153,.35);
}

.gradient-button:active{
    transform: scale(.97);
}

.gradient-button:disabled{
    opacity:.5;
    cursor:not-allowed;
    transform:none;
    box-shadow:none;
}

.gradient-button-blue{
    background:linear-gradient(
        135deg,
        #1e3a8a,
        #2563eb,
        #06b6d4,
        #67e8f9
    );

    background-size:200% 200%;
}

.gradient-button-blue:hover{

    background-position:right center;

    filter:brightness(1.15);

    box-shadow:
        0 12px 30px rgba(37,99,235,.35);
}

.gradient-button-green{

    background:linear-gradient(
        135deg,
        #166534,
        #16a34a,
        #22c55e,
        #86efac
    );

    background-size:200% 200%;
}

.gradient-button-green:hover{

    background-position:right center;

    filter:brightness(1.15);

    box-shadow:
        0 12px 30px rgba(22,163,74,.35);
}

.gradient-button-red{

    background:linear-gradient(
        135deg,
        #991b1b,
        #dc2626,
        #f43f5e,
        #fb7185
    );

    background-size:200% 200%;
}

.gradient-button-red:hover{

    background-position:right center;

    filter:brightness(1.15);

    box-shadow:
        0 12px 30px rgba(220,38,38,.35);
}

.gradient-button-purple{

    background:linear-gradient(
        135deg,
        #581c87,
        #7e22ce,
        #a855f7,
        #d8b4fe
    );

    background-size:200% 200%;
}

.gradient-button-purple:hover{

    background-position:right center;

    filter:brightness(1.15);

    box-shadow:
        0 12px 30px rgba(168,85,247,.35);
}
</style>
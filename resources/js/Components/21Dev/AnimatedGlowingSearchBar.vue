<script setup>
import { Search, SlidersHorizontal } from "lucide-vue-next";
import { computed } from "vue";

const props = defineProps({
    modelValue: {
        type: String,
        default: "",
    },

    placeholder: {
        type: String,
        default: "Search...",
    },

    width: {
        type: Number,
        default: 301,
    },

    disabled: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits([
    "update:modelValue",
    "search",
    "filter",
]);

const value = computed({
    get() {
        return props.modelValue;
    },

    set(v) {
        emit("update:modelValue", v);
        emit("search", v);
    },
});
</script>

<template>
    <div class="relative flex items-center justify-center">

        <div class="search-wrapper">

            <!-- Glow Layer 1 -->
            <div class="glow glow-1"></div>

            <!-- Glow Layer 2 -->
            <div class="glow glow-2"></div>

            <!-- Glow Layer 3 -->
            <div class="glow glow-3"></div>

            <!-- Glow Layer 4 -->
            <div class="glow glow-4"></div>

            <!-- Glow Layer 5 -->
            <div class="glow glow-5"></div>

            <!-- Glow Layer 6 -->
            <div class="glow glow-6"></div>

            <!-- SEARCH -->

            <div class="main-search">

                <!-- SEARCH ICON -->

                <Search
                    class="search-icon"
                    :size="20"
                />

                <!-- INPUT -->

                <input
                    v-model="value"
                    :placeholder="placeholder"
                    :disabled="disabled"
                    class="search-input"
                    :style="{ width: width + 'px' }"
                >

                <!-- MASK -->

                <div class="input-mask"></div>

                <!-- PINK LIGHT -->

                <div class="pink-mask"></div>

                <!-- FILTER ROTATE -->

                <div class="filter-bg"></div>

                <!-- FILTER BUTTON -->

                <!-- <button
                    class="filter-button"
                    @click="$emit('filter')"
                >
                    <SlidersHorizontal :size="18" />
                </button> -->
            </div>
        </div>
    </div>
</template>

<style scoped>
/* =====================================
        GLOW LAYER
===================================== */

.glow{
    position:absolute;
    inset:0;
    overflow:hidden;
    border-radius:16px;
    pointer-events:none;
}

.glow::before{

    content:"";

    position:absolute;

    left:50%;
    top:50%;

    width:800px;
    height:800px;

    transform:
        translate(-50%,-50%)
        rotate(var(--rotate));

    transition:
        transform 2s;

}

/* ===========================
        LAYER 1
=========================== */

.glow-1::before{

    --rotate:60deg;

    background:
        conic-gradient(
            #000,
            #402fb5 5%,
            #000 38%,
            #000 50%,
            #cf30aa 60%,
            #000 87%
        );

}

.search-wrapper:hover .glow-1::before{

    transform:
        translate(-50%,-50%)
        rotate(-120deg);

}

.search-wrapper:focus-within .glow-1::before{

    transition:4s;

    transform:
        translate(-50%,-50%)
        rotate(420deg);

}

/* ===========================
        LAYER 2
=========================== */

.glow-2::before{

    --rotate:82deg;

    background:
        conic-gradient(
            transparent,
            #18116a,
            transparent 10%,
            transparent 50%,
            #6e1b60,
            transparent 60%
        );

}

.search-wrapper:hover .glow-2::before{

    transform:
        translate(-50%,-50%)
        rotate(-98deg);

}

.search-wrapper:focus-within .glow-2::before{

    transition:4s;

    transform:
        translate(-50%,-50%)
        rotate(442deg);

}

/* ===========================
        LAYER 3
=========================== */

.glow-3::before{

    --rotate:83deg;

    filter:brightness(1.4);

    background:
        conic-gradient(
            transparent,
            #a099d8,
            transparent 8%,
            transparent 50%,
            #dfa2da,
            transparent 58%
        );

}

.search-wrapper:hover .glow-3::before{

    transform:
        translate(-50%,-50%)
        rotate(-97deg);

}

.search-wrapper:focus-within .glow-3::before{

    transition:4s;

    transform:
        translate(-50%,-50%)
        rotate(443deg);

}

/* ===========================
        LAYER 4
=========================== */

.glow-4::before{

    --rotate:70deg;

    filter:brightness(1.3);

    background:
        conic-gradient(
            #1c191c,
            #402fb5 5%,
            #1c191c 14%,
            #1c191c 50%,
            #cf30aa 60%,
            #1c191c 64%
        );

}

.search-wrapper:hover .glow-4::before{

    transform:
        translate(-50%,-50%)
        rotate(-110deg);

}

.search-wrapper:focus-within .glow-4::before{

    transition:4s;

    transform:
        translate(-50%,-50%)
        rotate(430deg);

}

/* ===========================
        BLUR
=========================== */

.glow-1{
    filter:blur(3px);
}

.glow-2{
    filter:blur(3px);
}

.glow-3{
    filter:blur(2px);
}

.glow-4{
    filter:blur(.5px);
}

.glow-5,
.glow-6{
    display:none;
}

/* ===========================
        HOVER
=========================== */

.search-wrapper:hover{

    transform:translateY(-2px);

}

.search-wrapper{

    transition:.35s;

}

/* ===========================
        RESPONSIVE
=========================== */

@media (max-width:640px){

.search-input{

    width:100% !important;

}

.search-wrapper{

    width:100%;

}

.main-search{

    width:100%;

}

}
.search-wrapper{
    position:relative;
    display:flex;
    align-items:center;
    justify-content:center;
}

.main-search{
    position:relative;
    display:flex;
    align-items:center;
    justify-content:center;
}

/* ==========================
        INPUT
========================== */

.search-input{
    width:301px;
    height:56px;

    padding-left:58px;
    padding-right:58px;

    border:none;
    outline:none;

    border-radius:14px;

    background:#010201;

    color:white;

    font-size:17px;

    transition:.4s;
}

.search-input::placeholder{
    color:#8b8b95;
}

.search-input:focus{
    box-shadow:
    inset 0 0 0 1px rgba(255,255,255,.05);
}

/* ==========================
        SEARCH ICON
========================== */

.search-icon{
    position:absolute;

    left:18px;

    color:#d7d7e4;

    z-index:20;

    pointer-events:none;
}

/* ==========================
        FILTER
========================== */

.filter-button{

    position:absolute;

    right:8px;

    width:40px;
    height:40px;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:10px;

    background:
        linear-gradient(
            to bottom,
            #161329,
            #000,
            #1d1b4b
        );

    border:1px solid rgba(255,255,255,.05);

    color:#d7d7e4;

    z-index:5;

    transition:.35s;
}

.filter-button:hover{

    color:white;

    transform:scale(1.08);

}

.filter-bg{

    position:absolute;

    right:7px;
    top:7px;

    width:42px;
    height:42px;

    overflow:hidden;

    border-radius:10px;
}

.filter-bg::before{

    content:"";

    position:absolute;

    width:600px;
    height:600px;

    left:50%;
    top:50%;

    transform:
    translate(-50%,-50%);

    background:
        conic-gradient(
            transparent,
            #3d3a4f,
            transparent 50%,
            transparent,
            #3d3a4f,
            transparent
        );

    animation:
        spin 5s linear infinite;
}

/* ==========================
        MASK
========================== */

.input-mask{

    position:absolute;

    left:70px;
    top:18px;

    width:100px;
    height:20px;

    background:
        linear-gradient(
            to right,
            transparent,
            black
        );

    pointer-events:none;

    transition:.3s;
}

.main-search:focus-within .input-mask{

    opacity:0;

}

.pink-mask{

    position:absolute;

    top:10px;
    left:5px;

    width:30px;
    height:20px;

    background:#cf30aa;

    filter:blur(22px);

    opacity:.8;

    transition:2s;
}

.search-wrapper:hover .pink-mask{

    opacity:0;

}

@keyframes spin{

    from{

        transform:
        translate(-50%,-50%)
        rotate(0deg);

    }

    to{

        transform:
        translate(-50%,-50%)
        rotate(360deg);

    }

}

</style>
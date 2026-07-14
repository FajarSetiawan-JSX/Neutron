<script setup>
</script>

<template>
    <div class="gradient-border">
        <div class="gradient-content">
            <slot />
        </div>
    </div>
</template>

<style scoped>
/* ===========================
        OUTER (BORDER)
=========================== */

.gradient-border{
    position:relative;

    display:inline-block;

    padding:2px;

    border-radius:15px;

    overflow:hidden;

    background:linear-gradient(
        120deg,
        #ff2d7a,
        #8b5cf6,
        #38bdf8,
        #ff2d7a
    );

    background-size:300% 300%;

    animation:borderGradient 6s linear infinite;
}

/* ===========================
        INNER
=========================== */

.gradient-content{
    width:100%;
    height:100%;

    background:#ffffff;

    border-radius:13px;

    overflow:hidden;
}

/* ===========================
        ANIMATION
=========================== */

@keyframes borderGradient{

    0%{
        background-position:0% 50%;
    }

    50%{
        background-position:100% 50%;
    }

    100%{
        background-position:0% 50%;
    }

}
</style>
<script setup>
import { onMounted, onUnmounted, ref } from 'vue'

const characters = ref(null)

const figures = [
    {
        top: '0%',
        src: 'https://raw.githubusercontent.com/RicardoYare/imagenes/9ef29f5bbe075b1d1230a996d87bca313b9b6a63/sticks/stick0.svg',
        transform: 'rotateZ(-90deg)',
        speedX: 1500,
    },
    {
        top: '10%',
        src: 'https://raw.githubusercontent.com/RicardoYare/imagenes/9ef29f5bbe075b1d1230a996d87bca313b9b6a63/sticks/stick1.svg',
        speedX: 3000,
        speedRotate: 2000,
    },
    {
        top: '20%',
        src: 'https://raw.githubusercontent.com/RicardoYare/imagenes/9ef29f5bbe075b1d1230a996d87bca313b9b6a63/sticks/stick2.svg',
        speedX: 5000,
        speedRotate: 1000,
    },
    {
        top: '25%',
        src: 'https://raw.githubusercontent.com/RicardoYare/imagenes/9ef29f5bbe075b1d1230a996d87bca313b9b6a63/sticks/stick0.svg',
        speedX: 2500,
        speedRotate: 1500,
    },
    {
        top: '35%',
        src: 'https://raw.githubusercontent.com/RicardoYare/imagenes/9ef29f5bbe075b1d1230a996d87bca313b9b6a63/sticks/stick0.svg',
        speedX: 2000,
        speedRotate: 300,
    },
    {
        bottom: '5%',
        src: 'https://raw.githubusercontent.com/RicardoYare/imagenes/9ef29f5bbe075b1d1230a996d87bca313b9b6a63/sticks/stick3.svg',
        speedX: 0,
    },
]

function createCharacters() {

    if (!characters.value) return

    characters.value.innerHTML = ''

    figures.forEach((figure, index) => {

        const img = document.createElement('img')

        img.src = figure.src

        img.className = 'character'

        img.style.position = 'absolute'

        img.style.width = '18%'

        img.style.height = '18%'

        if (figure.top)
            img.style.top = figure.top

        if (figure.bottom)
            img.style.bottom = figure.bottom

        if (figure.transform)
            img.style.transform = figure.transform

        characters.value.appendChild(img)

        if (index === 5) return
                img.animate(
            [
                { left: "100%" },
                { left: "-20%" },
            ],
            {
                duration: figure.speedX,
                easing: "linear",
                fill: "forwards",
            }
        )

        if (index === 0) return

        if (figure.speedRotate) {

            img.animate(
                [
                    {
                        transform: "rotate(0deg)",
                    },
                    {
                        transform: "rotate(-360deg)",
                    },
                ],
                {
                    duration: figure.speedRotate,
                    iterations: Infinity,
                    easing: "linear",
                }
            )

        }

    })

}

onMounted(() => {

    createCharacters()

    window.addEventListener(
        "resize",
        createCharacters
    )

})

onUnmounted(() => {

    window.removeEventListener(
        "resize",
        createCharacters
    )

})
</script>

<template>

<div
    ref="characters"
    class="characters-wrapper"
/>

</template>

<style scoped>

.characters-wrapper{

    position:absolute;

    inset:0;

    width:100%;

    height:100%;

    overflow:hidden;

    pointer-events:none;

    z-index:15;

}

.characters-wrapper :deep(.character){

    object-fit:contain;

    user-select:none;

    -webkit-user-drag:none;

    will-change:transform,left;

}

</style>
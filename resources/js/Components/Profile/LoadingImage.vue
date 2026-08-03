<script setup>
import { Teleport } from "vue";
import PrimaryLoading from "../21Dev/PrimaryLoading.vue";

</script>

<template>
    <Teleport to="body">
        <div class="fixed max-h-screen inset-0 z-[9999] bg-black/50 overflow-y-auto flex items-center justify-center">
            <div>
                <PrimaryLoading :size="120" />
                <p class="text-black font-anonymous text-2xl my-2.5">Uploading photo</p>
            </div>
        </div> 
    </Teleport>
</template>
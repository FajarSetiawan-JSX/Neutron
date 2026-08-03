<script setup>
import { ref, watch } from 'vue';

const props = defineProps(['links']);
const emit = defineEmits(['next', 'prev'])
const links = ref({})
function next(value){
    if(value){
        value = value + 1;
        emit('next', value)
    }
}
function prev(value){
    if(value){
        value = value - 1;
        emit('prev', value)
    }
}
watch(()=>props.links, (newlinks)=>{
    if(newlinks){
        links.value = newlinks;
    }
},{immediate:true});
</script>

<template>
    <section class="w-full flex justify-between items-center">
        <button type="button" @click="prev(links?.current_page)" :disabled="links?.current_page === 1" :class="links?.current_page === 1 ? 'opacity-50 cursor-not-allowed' : 'opacity-100 cursor-pointer hover:bg-slate-100'" class="px-2.5 py-1 rounded-lg outline-1 outline-gray-300 flex items-center gap-x-2 font-anonymous text-black active:scale-95 transition-all duration-300">
            <svg class="fill-current" width="15px" height="15px" viewBox="-78.5 0 512 512" xmlns="http://www.w3.org/2000/svg" ><title>left</title><path d="M257 64L291 98 128 262 291 426 257 460 61 262 257 64Z" /></svg>
            <span>Previous</span>
        </button>
        <div class="font-anonymous font-semibold text-black">
            <span class="text-black/50">{{ links?.from }}</span> / <span class="text-black/50">{{ links?.to }}</span> of <span class="text-black/50">{{ links?.total }}</span>
        </div>
        <button type="button" @click="next(links?.current_page)" :disabled="links?.current_page === links?.last_page" :class="links?.current_page === links?.last_page ? 'opacity-50 cursor-not-allowed' : 'opacity-100 cursor-pointer hover:bg-slate-100'" class="px-2.5 py-1 rounded-lg outline-1 outline-gray-300 flex items-center gap-x-2 font-anonymous text-black active:scale-95 transition-all duration-300">
            <span>Next</span>
            <svg class="fill-current" width="15px" height="15px" viewBox="-77 0 512 512" xmlns="http://www.w3.org/2000/svg" ><title>right</title><path d="M98 460L64 426 227 262 64 98 98 64 294 262 98 460Z" /></svg>
        </button>
    </section>
</template>
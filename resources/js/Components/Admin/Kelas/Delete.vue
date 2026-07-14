<script setup>
import CardBorderAnimation from "@/Components/21Dev/CardBorderAnimation.vue";
import GradientButton from "@/Components/21Dev/GradientButton.vue";
import { ref, Teleport, watch } from "vue";
import axios from 'axios';
import { Trash2, TriangleAlert } from "lucide-vue-next";
import { eror, success } from '@/Helper.js/Toast';
import PrimaryLoading from "@/Components/21Dev/PrimaryLoading.vue";

const emit = defineEmits(['close', 'success']);
const props = defineProps(['id']);
const loading = ref(false);
const id = ref('');
async function hapus() {
    try{
        loading.value = true;
        const response = await axios.delete(`/api/Admin/kelas/${id.value}`);
        success('Berhasil menghapus kelas 🥲');
        emit('success')
    }catch(error){
        eror(error?.response?.status, error?.response?.statusText);
    }finally{
        loading.value = false;
    }
}
watch(()=>props.id, (newmapel)=>{
    if(newmapel){
        id.value = newmapel;
    }
},{immediate:true})
</script>

<template>
    <Teleport to="body">
        <div @click="emit('close')" class="fixed h-screen inset-0 flex justify-center items-center z-[9999] bg-black/50 overflow-y-auto">
            <CardBorderAnimation @click.stop data-aos="zoom-in">
                <form @submit.prevent="hapus">
                    <div class="rounded-xl bg-black p-6 w-md">
                        <div class="flex justify-center">
                            <TriangleAlert class="w-16 h-15 text-red-500" />
                        </div>
                        <div class="my-4">
                            <h1 class="text-white font-primary text-xl font-semibold text-center mb-2">Hapus Mata Kelas?</h1>
                            <p class="text-center text-white/70 font-primary text-sm font-semibold">Pengajar tidak dapat mengunduh file rapor PDF dan siswa akan kehilangan kelas. Harap pastikan tidak ada pengajar & siswa dikelas ini.</p>
                        </div>
                        <div class="mt-10 flex justify-end gap-3">
                            <GradientButton color="red" type="submit" :disabled="loading" :class="loading ? 'opacity-50 cursor-not-allowed' : 'opacity-100 cursor-pointer'" class="flex items-center justify-center w-full gap-2 font-primary py-3 px-6 text-white rounded-xl">
                                <Trash2 v-if="!loading" class="w-5 h-5"/>
                                <PrimaryLoading v-else :size="20" :class="'stroke-white'" />
                                {{ loading ? '' : 'Hapus kelas' }}
                            </GradientButton>
                        </div>
                    </div>
                </form>
            </CardBorderAnimation>
        </div> 
    </Teleport>
</template>
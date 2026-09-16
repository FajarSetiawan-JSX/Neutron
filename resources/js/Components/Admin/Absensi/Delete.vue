<script setup>
import CardBorderAnimation from "@/Components/21Dev/CardBorderAnimation.vue";
import GradientButton from "@/Components/21Dev/GradientButton.vue";
import { ref, Teleport, watch } from "vue";
import axios from 'axios';
import { Trash2, TriangleAlert } from "lucide-vue-next";
import { eror, success } from '@/Helper.js/Toast';
import PrimaryLoading from "@/Components/21Dev/PrimaryLoading.vue";

const emit = defineEmits(['close', 'success']);
const props = defineProps(['ta']);
const loading = ref(false);
async function hapus() {
    try{
        loading.value = true;
        const response = await axios.delete(`/api/Admin/absensi/${props?.ta?.id}`);
        success('Berhasil menghapus presensi 🥲');
        emit('success')
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
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
                            <h1 class="text-white font-primary text-xl font-semibold text-center mb-2">Hapus Presensi TA {{ props?.ta?.tahun }}?</h1>
                            <p class="text-center text-white/70 font-primary text-sm font-semibold">Harap lakukan pengunduhan dokumen laporan terlebih dahulu dan pastikan Tahun Ajaran <span class="text-white">{{ props?.ta?.tahun }} sudah dinyatakan berakhir.</span> Developer membangun sistem ini dengan integrasi data. Langkah ini akan menghapus pertemuan, absensi dan nilai. Apakah yakin menghapus presensi TA <span class="text-red-500">{{ props?.ta?.tahun }}</span> ? kalo udah dihapus ga bisa direstore loh ya</p>
                        </div>
                        <div class="mt-10 flex justify-end gap-3">
                            <GradientButton color="red" type="submit" :disabled="loading" :class="loading ? 'opacity-50 cursor-not-allowed' : 'opacity-100 cursor-pointer'" class="flex items-center justify-center w-full gap-2 font-primary py-3 px-6 text-white rounded-xl">
                                <Trash2 v-if="!loading" class="w-5 h-5"/>
                                <PrimaryLoading v-else :size="20" :class="'stroke-white'" />
                                {{ loading ? '' : 'Hapus Absensi' }}
                            </GradientButton>
                        </div>
                    </div>
                </form>
            </CardBorderAnimation>
        </div> 
    </Teleport>
</template>
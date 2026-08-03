<script setup>
import CardBorderAnimation from "@/Components/21Dev/CardBorderAnimation.vue";
import GradientButton from "@/Components/21Dev/GradientButton.vue";
import { onMounted, ref, Teleport } from "vue";
import axios from 'axios';
import { Trash2, TriangleAlert } from "lucide-vue-next";
import { eror, success } from '@/Helper.js/Toast';
import PrimaryLoading from "@/Components/21Dev/PrimaryLoading.vue";

const emit = defineEmits(['close', 'success']);
const props = defineProps(['siswa']);
const loading = ref(false);
async function hapus() {
    try{
        loading.value = true;
        const response = await axios.delete(`/api/Admin/siswa/${props?.siswa?.id}`);
        //success('Berhasil menghapus siswa 🥲');
        eror('Fitur maintenance', 'Maaf developer lagi pusing 😁');
        emit('success')
    }catch(error){
        eror(error?.response?.status, error?.response?.statusText);
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
                            <h1 class="text-white font-primary text-xl font-semibold text-center mb-2">Hapus {{ props?.siswa?.nama }}?</h1>
                            <p class="text-center text-white/70 font-primary text-sm font-semibold">Menghapus siswa berarti menghapus semua data yang berkaitan termasuk Log siswa.</p>
                        </div>
                        <div class="mt-10 flex justify-end gap-3">
                            <GradientButton color="red" type="submit" :disabled="loading" :class="loading ? 'opacity-50 cursor-not-allowed' : 'opacity-100 cursor-pointer'" class="flex items-center justify-center w-full gap-2 font-primary py-3 px-6 text-white rounded-xl">
                                <Trash2 v-if="!loading" class="w-5 h-5"/>
                                <PrimaryLoading v-else :size="20" :class="'stroke-white'" />
                                {{ loading ? '' : 'Hapus siswa' }}
                            </GradientButton>
                        </div>
                    </div>
                </form>
            </CardBorderAnimation>
        </div> 
    </Teleport>
</template>
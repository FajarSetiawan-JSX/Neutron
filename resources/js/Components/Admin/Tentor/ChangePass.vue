<script setup>
import CardBorderAnimation from "@/Components/21Dev/CardBorderAnimation.vue";
import GradientButton from "@/Components/21Dev/GradientButton.vue";
import { ref, Teleport, watch } from "vue";
import axios from 'axios';
import { Trash2, TriangleAlert, RotateCcwKey } from "lucide-vue-next";
import { eror, success } from '@/Helper.js/Toast';
import PrimaryLoading from "@/Components/21Dev/PrimaryLoading.vue";

const emit = defineEmits(['close', 'success']);
const props = defineProps(['tentor']);
const loading = ref(false);
const data = ref({});
async function hapus() {
    try{
        loading.value = true
        const response = await axios.patch(`/api/Admin/tentor/reset/${data?.value.id}`);
        success(`Berhasil mengatur ulang password ${data?.value.nama ?? ''}`);
        emit('success');
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
watch(()=>props.tentor, (newmapel)=>{
    if(newmapel){
        data.value = newmapel
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
                            <RotateCcwKey class="w-16 h-15 text-emerald-500" />
                        </div>
                        <div class="my-4">
                            <h1 class="text-white font-primary text-xl font-semibold text-center mb-2">Reset Password {{ data?.nama }} ?</h1>
                            <p class="text-center text-white/70 font-primary text-sm font-semibold">Mohon untuk tidak menyalahgunakan hak akses akun Admin.</p>
                        </div>
                        <div class="mt-10 flex justify-end gap-3">
                            <GradientButton color="red" type="submit" :disabled="loading" :class="loading ? 'opacity-50 cursor-not-allowed' : 'opacity-100 cursor-pointer'" class="flex items-center justify-center w-full gap-2 font-primary py-3 px-6 text-white rounded-xl">
                                <RotateCcwKey v-if="!loading" class="w-5 h-5"/>
                                <PrimaryLoading v-else :size="20" :class="'stroke-white'" />
                                {{ loading ? '' : 'Reset Password' }}
                            </GradientButton>
                        </div>
                    </div>
                </form>
            </CardBorderAnimation>
        </div> 
    </Teleport>
</template>
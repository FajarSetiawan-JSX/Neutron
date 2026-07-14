<script setup>
import CardBorderAnimation from "@/Components/21Dev/CardBorderAnimation.vue";
import GradientButton from "@/Components/21Dev/GradientButton.vue";
import { onMounted, ref, Teleport, watch } from "vue";
import axios from 'axios';
import { RefreshCcw, TriangleAlert } from "lucide-vue-next";
import { eror, success } from '@/Helper.js/Toast';
import PrimaryLoading from "@/Components/21Dev/PrimaryLoading.vue";

const emit = defineEmits(['close', 'success']);
const props = defineProps(['data']);
const loading = ref(false);

const tahun = ref('');
const id = ref(null);
async function update() {
    try{
        loading.value = true;
        const response = await axios.patch(`/api/Admin/tahunajaran/${id.value}`);
        success('Berhasil mengaktifkan Tahun Ajaran 🫡');
        emit('success')
    }catch(error){
        console.log(error.response)
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
watch(()=>props.data, (newdata)=>{
    if(newdata){
        tahun.value = newdata.tahun;
        id.value = newdata.id;
        console.log(newdata);
    }
},{immediate:true})
</script>

<template>
    <Teleport to="body">
        <div @click="emit('close')" class="fixed h-screen inset-0 flex justify-center items-center z-[9999] bg-black/50 overflow-y-auto">
            <CardBorderAnimation @click.stop data-aos="zoom-in">
                <form @submit.prevent="update">
                    <div class="rounded-xl bg-black p-6 w-md">
                        <span class="text-white/50 font-primary font-semibold text-sm">Tahun Ajaran</span>
                        <div class="text-center text-white text-2xl font-bold">
                            {{ tahun }}
                        </div>
                        <div class="mt-5">
                            <TriangleAlert class="w-10 h-10 mx-auto text-yellow-500" />
                            <p class="text-slate-400 mt-3 text-xs md:text-sm">*Harap berhati hati saat anda mengubah status Tahun Ajaran. Tindakan ini mempengaruhi keseluruhan data siswa pada kelas dan tentor yang mengajar. Harap pastikan bahwa Tahun Ajaran ini sudah sesuai dengan kalender akademik yang sedang berlangsung. <br>Hati hati ya benerinnya susah 😁</p>
                        </div>
                        <div class="mt-10 flex justify-end gap-3">
                            <GradientButton color="red" type="submit" :disabled="loading" :class="loading ? 'opacity-50 cursor-not-allowed' : 'opacity-100 cursor-pointer'" class="flex items-center justify-center w-full gap-2 font-primary py-3 px-6 text-white rounded-xl">
                                <RefreshCcw v-if="!loading" class="w-5 h-5"/>
                                <PrimaryLoading v-else :size="20" :class="'stroke-white'" />
                                {{ loading ? '' : 'Aktifkan Tahun Ajaran' }}
                            </GradientButton>
                        </div>
                    </div>
                </form>
            </CardBorderAnimation>
        </div> 
    </Teleport>
</template>
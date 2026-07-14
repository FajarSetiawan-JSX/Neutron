<script setup>
import CardBorderAnimation from "@/Components/21Dev/CardBorderAnimation.vue";
import GradientButton from "@/Components/21Dev/GradientButton.vue";
import { onMounted, ref, Teleport } from "vue";
import axios from 'axios';
import { Plus, TriangleAlert } from "lucide-vue-next";
import { eror, success } from '@/Helper.js/Toast';
import PrimaryLoading from "@/Components/21Dev/PrimaryLoading.vue";

const emit = defineEmits(['close', 'success']);
const loading = ref(false);
const years = [
    '2026 / 2027',
    '2027 / 2028',
    '2028 / 2029',
    '2029 / 2030',
    '2030 / 2031',
    '2031 / 2032',
    '2032 / 2033',
    '2033 / 2034',
    '2034 / 2035',
    '2035 / 2036'
]
const tahun = ref('');
const err = ref({});
async function create() {
    try{
        loading.value = true;
        const response = await axios.post('/api/Admin/tahunajarans', {
            tahun: tahun.value
        });
        success('Berhasil membuat Tahun Ajaran Baru 🫡');
        emit('success')
    }catch(error){
        if(error?.response?.status === 422){
            err.value = error?.response?.data?.errors
        }
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
                <form @submit.prevent="create">
                    <div class="rounded-xl bg-black p-6 w-md">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                Tahun Ajaran Baru
                            </label>

                            <select
                                v-model="tahun"
                                class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white outline-none transition focus:ring-2 focus:ring-purple-700"
                            >
                                <option disabled value="">Pilih Tahun Ajaran</option>
                                <option v-for="(year, index) in years" :key="index" :value="year">{{ year }}</option>
                            </select>
                            <p v-if="err?.tahun" class="text-red-500 mt-1 text-xs md:text-sm">{{ err?.tahun[0] }}</p>
                        </div>
                        <div class="mt-5">
                            <TriangleAlert class="w-10 h-10 mx-auto text-yellow-500" />
                            <p class="text-slate-400 mt-3 text-xs md:text-sm">*Setiap anda membuat tahun ajaran baru, sistem secara otomatis mengaktifkan tahun ajaran baru yang baru saja anda buat. Tahun ajaran sebelumnya atau yang berstatus aktif akan secara otomatis berganti off.</p>
                        </div>
                        <div class="mt-10 flex justify-end gap-3">
                            <GradientButton color="red" type="submit" :disabled="loading" :class="loading ? 'opacity-50 cursor-not-allowed' : 'opacity-100 cursor-pointer'" class="flex items-center justify-center w-full gap-2 font-primary py-3 px-6 text-white rounded-xl">
                                <Plus v-if="!loading" class="w-5 h-5"/>
                                <PrimaryLoading v-else :size="20" :class="'stroke-white'" />
                                {{ loading ? '' : 'Tambah Tahun Ajaran Baru' }}
                            </GradientButton>
                        </div>
                    </div>
                </form>
            </CardBorderAnimation>
        </div> 
    </Teleport>
</template>
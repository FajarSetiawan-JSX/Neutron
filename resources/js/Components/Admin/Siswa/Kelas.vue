<script setup>
import CardBorderAnimation from "@/Components/21Dev/CardBorderAnimation.vue";
import GradientButton from "@/Components/21Dev/GradientButton.vue";
import { onMounted, ref, Teleport } from "vue";
import axios from 'axios';
import { FileCog, School } from "lucide-vue-next";
import { eror, success } from '@/Helper.js/Toast';
import PrimaryLoading from "@/Components/21Dev/PrimaryLoading.vue";

const emit = defineEmits(['close', 'success']);
const props = defineProps(['siswa', 'ta', 'kelases']);
const loading = ref(false);
const form = ref({
    siswa: '',
    kelas: null
})
function toggleKelas(id) {
    form.value.kelas = form.value.kelas === id ? null : id;
}
const err = ref({});
async function create() {
    try{
        loading.value = true;
        const response = await axios.post('/api/Admin/siswa/kelas', form.value);
        success(`${response?.data?.message}`);
        emit('success')
    }catch(error){
        if(error?.response?.status === 422){
            err.value = error?.response?.data?.errors
        }
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
onMounted(()=>{
    form.value.siswa = props?.siswa?.id ?? '';
    form.value.kelas = props?.siswa?.id_kelas ?? null;
})
</script>

<template>
    <Teleport to="body">
        <div @click="emit('close')" class="fixed h-screen inset-0 flex justify-center items-center z-[9999] bg-black/50 overflow-y-auto">
            <CardBorderAnimation @click.stop data-aos="zoom-in">
                <form @submit.prevent="create">
                    <div class="rounded-xl bg-black p-6 w-md lg:w-xl xl:w-2xl grid grid-cols-1 gap-3">
                        <div class="bg-black">
                            <div class="my-1.5 text-white">
                                <School size="40" class="mx-auto" />
                                <h1 class="font-primary text-lg text-white/80 capitalize text-center">{{ props?.siswa?.nama }}</h1>
                                <p class="text-white/70 text-xs text-center tracking-widest">Detail kelas tersedia Tahun Ajaran {{ props?.ta?.tahun }}</p>
                            </div>
                            <h2 class="uppercase text-white/60 text-xs font-primary mt-7 mb-2 tracking-widest">pilih kelas</h2>
                            <template v-if="props?.kelases?.length > 0">
                                <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                                    <label v-for="kelas in props?.kelases" :key="kelas.id" :for="kelas.id" class="mb-2 flex items-center gap-x-1.5 text-sm font-medium text-gray-300 max-w-max">
                                        <input type="checkbox" :value="kelas.id" :checked="form.kelas === kelas.id" @change="toggleKelas(kelas.id)" :id="kelas.id">
                                        {{ kelas?.nama }}
                                    </label>
                                </div>
                                <p v-if="err?.kelas" class="text-red-500 mt-1 text-xs md:text-sm">{{ err?.kelas[0] }}</p>

                            </template>
                            <template v-else>
                                <div class="w-full p-8">
                                    <h4 class="font-anonymous text-sm text-center text-red-500">0 Data kelas</h4>
                                </div>
                            </template>
                        </div>
                        <div class="mt-5 flex justify-end gap-3">
                            <GradientButton color="red" type="submit" :disabled="loading" :class="loading ? 'opacity-50 cursor-not-allowed' : 'opacity-100 cursor-pointer'" class="flex items-center justify-center w-full gap-2 font-primary py-3 px-6 text-white rounded-xl">
                                <FileCog v-if="!loading" class="w-5 h-5"/>
                                <PrimaryLoading v-else :size="20" :class="'stroke-white'" />
                                {{ loading ? '' : 'Atur kelas siswa' }}
                            </GradientButton>
                        </div>
                    </div>
                </form>
            </CardBorderAnimation>
        </div> 
    </Teleport>
</template>
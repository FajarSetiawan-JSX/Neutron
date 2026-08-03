<script setup>
import CardBorderAnimation from "@/Components/21Dev/CardBorderAnimation.vue";
import GradientButton from "@/Components/21Dev/GradientButton.vue";
import { onMounted, ref, Teleport } from "vue";
import axios from 'axios';
import { Plus, BriefcaseBusiness, School } from "lucide-vue-next";
import { eror, success } from '@/Helper.js/Toast';
import PrimaryLoading from "@/Components/21Dev/PrimaryLoading.vue";

const emit = defineEmits(['close', 'success']);
const props = defineProps(['tentor', 'kelas']);
const getloading = ref(false);
const loading = ref(false);
const kelases = ref([]);
const data = ref([]);
const err = ref({});
async function create() {
    try{
        loading.value = true;
        const response = await axios.post('/api/Admin/tentor/kelas', {
            tentor: props?.tentor?.id,
            kelas: data.value
        });
        success(response?.data?.message);
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
async function get(tentor_id) {
    try{
        getloading.value = true;
        const response = await axios.get(`/api/Admin/tentor/kelas/${tentor_id}`);
        kelases.value = response?.data?.kelases;
    }catch(error){
        eror(error?.response?.status, error?.response?.statusText);
    }finally{
        getloading.value = false;
    }
}
onMounted(()=>{
    get(props?.tentor?.id);
    props?.kelas ? data.value = props?.kelas : data.value = [];
})
</script>

<template>
    <Teleport to="body">
        <div @click="emit('close')" class="fixed h-screen inset-0 flex justify-center items-center z-[9999] bg-black/50 overflow-y-auto">
            <CardBorderAnimation @click.stop data-aos="zoom-in">
                <form @submit.prevent="create">
                    <div class="rounded-xl bg-black p-6 w-md md:w-lg lg:w-xl xl:w-2xl">
                        <div class="text-white">
                            <div class="text-white/70 font-primary text-sm mb-5">
                                <School size="40" class="text-white mx-auto mb-2" />
                                <h1 class="text-center">Pilih <span class="text-white">{{ props?.tentor?.nama ?? 'Tentor' }}</span> sebagai wali kelas</h1>
                            </div>
                            <section v-if="!getloading">
                                <h2 class="font-primary tracking-widest uppercase text-white/60 text-xs mb-3">Tugaskan ke</h2>
                                <div v-if="kelases.length > 0" class="grid grid-cols-2 lg:grid-cols-3 gap-3">
                                    <label v-for="kelas in kelases" :key="kelas.id" :for="kelas.id" class="mb-2 flex items-center gap-x-1 text-sm font-medium text-gray-300 max-w-max">
                                        <input type="checkbox" v-model="data" :value="kelas.id" name="" :id="kelas.id">
                                        {{ kelas?.nama }}
                                    </label>
                                </div>
                                <div v-else class="w-full p-8">
                                    <h4 class="font-anonymous text-sm text-center text-red-500">Semua kelas telah memiliki tentor wali</h4>
                                </div>
                            </section>
                            <section v-else>
                                <div class="w-full h-60 flex items-center justify-center">
                                    <PrimaryLoading size="50" :class="'stroke-emerald-500'" />
                                </div>
                            </section>
                        </div>
                        <div class="mt-10 flex justify-end gap-3">
                            <GradientButton color="red" type="submit" :disabled="loading || getloading || kelases.length <= 0" :class="loading || getloading || kelases.length <= 0 ? 'opacity-50 cursor-not-allowed' : 'opacity-100 cursor-pointer'" class="flex items-center justify-center w-full gap-2 font-primary py-3 px-6 text-white rounded-xl">
                                <BriefcaseBusiness v-if="!loading" class="w-5 h-5"/>
                                <PrimaryLoading v-else :size="20" :class="'stroke-white'" />
                                {{ loading ? '' : 'Atur kelas wali' }}
                            </GradientButton>
                        </div>
                    </div>
                </form>
            </CardBorderAnimation>
        </div> 
    </Teleport>
</template>
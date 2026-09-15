<script setup>
import CardBorderAnimation from "@/Components/21Dev/CardBorderAnimation.vue";
import GradientButton from "@/Components/21Dev/GradientButton.vue";
import { onMounted, ref, Teleport } from "vue";
import axios from 'axios';
import { ShoppingCart, Users } from "lucide-vue-next";
import { eror, success } from '@/Helper.js/Toast';
import PrimaryLoading from "@/Components/21Dev/PrimaryLoading.vue";
import { usePage } from "@inertiajs/vue3";

const user = usePage().props.auth.user;
const props = defineProps(['ta', 'tingkat', 'siswa']);
const emit = defineEmits(['close', 'success']);
//const props = defineProps(['tentor', 'ta', 'tingkat']);
const loading = ref(false);
const loadingRombel = ref(false);
const form = ref({
    tahun: '',
    siswa: '',
    rombel: []
})
const rombels = ref([]);
const err = ref({});
async function create() {
    try{
        loading.value = true;
        const response = await axios.post('/api/Admin/rombel/checkout/', form.value);
        success('Berhasil menambahkan rombel 🫡');
        emit('success')
    }catch(error){
        if(error?.response?.status === 422){
            err.value = error?.response?.data?.errors
        }
        console.log(error?.response);
        eror(error?.response?.status, error?.response?.statusText);
    }finally{
        loading.value = false;
    }
}
async function get() {
    try{
        loadingRombel.value = true;
        const response = await axios.get(`/api/Admin/siswa/${props.siswa.id}/rombel/${props.ta.id}/saran`);
        console.log(response?.data?.rombels);
        rombels.value = response?.data?.rombels ?? []
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message)
    }finally{
        loadingRombel.value = false;
    }
}
onMounted(()=>{
    form.value.tahun = props?.ta?.id;
    form.value.siswa = props?.siswa?.id;
    get();
})
</script>

<template>
    <Teleport to="body">
        <div @click="emit('close')" class="fixed h-screen inset-0 flex justify-center items-center z-[9999] bg-black/50 overflow-y-auto">
            <CardBorderAnimation @click.stop data-aos="zoom-in">
                <form @submit.prevent="create">
                    <div class="rounded-xl bg-black p-6 w-md">
                        <div class="my-3">
                            <h1 class="text-center font-primary text-xl text-slate-100">Rombel Tersedia</h1>
                            <p class="text-center text-sm text-slate-300">Tahun Ajaran <span class="text-white">{{ props?.ta?.tahun }}</span></p>
                        </div>
                        <div class="max-h-80 overflow-y-auto py-1 space-y-2 pl-1 scroll-premium">
                            <template v-if="loadingRombel">
                                <PrimaryLoading size="50" class="stroke-emerald-500" />
                                <p class="text-center font-anonymous text-sm text-white">Loading rombel</p>
                            </template>
                            <template v-else>
                                <template v-if="rombels.length > 0">

                                    <div v-for="rombel in rombels" :key="rombel?.id" class="w-full p-3 rounded-xl flex items-center justify-between bg-sky-100">
                                        <div class="flex items-center justify-start gap-x-4">
                                            <input type="checkbox" name="" id="" class="rounded-sm" v-model="form.rombel" :value="rombel?.id">
                                            <div class="flex items-center justify-start gap-x-2">
                                                <img
                                                    :src="rombel?.avatar ? `/storage/${rombel?.avatar}` : `https://ui-avatars.com/api/?name=${rombel?.tentor}&background=0EA5E9&color=fff`"
                                                    class="w-10 h-10 rounded-full"
                                                />
                                                <div class="font-primary">
                                                    <h1 class="text-sm text-sky-800 flex items-center justify-start flex-wrap max-w-sm">{{ rombel?.nama }} - <span class="italic">{{ rombel?.tingkat }} {{ rombel?.jenjang }}</span></h1>
                                                    <h2 class="text-xs text-sky-700">{{ rombel?.tentor }} - <span class="italic">{{ rombel?.mapel }}</span></h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <Users size="20" class="text-slate-500 mx-auto" />
                                            <span class="text-sm text-slate-900">{{ rombel?.siswa }} siswa</span>
                                        </div>
                                    </div>

                                </template>
                                <template v-else>
                                    <p class="text-center font-anonymous text-sm text-red-500">0 data rombel</p>
                                </template>
                            </template>
                        </div>
                        <div class="mt-5 flex justify-end gap-3">
                            <GradientButton color="red" type="submit" :disabled="loading || loadingRombel" :class="loading || loadingRombel ? 'opacity-50 cursor-not-allowed' : 'opacity-100 cursor-pointer'" class="flex items-center justify-center w-full gap-2 font-primary py-3 px-6 text-white rounded-xl">
                                <ShoppingCart v-if="!loading" class="w-5 h-5"/>
                                <PrimaryLoading v-else :size="20" :class="'stroke-white'" />
                                {{ loading ? '' : 'Checkout Rombel' }}
                            </GradientButton>
                        </div>
                    </div>
                </form>
            </CardBorderAnimation>
        </div> 
    </Teleport>
</template>

<style scoped>
.scroll-premium {
    scrollbar-width: thin;
    scrollbar-color: #ff2d3d transparent;
}

.scroll-premium::-webkit-scrollbar {
    width: 8px;
}

.scroll-premium::-webkit-scrollbar-track {
    background: transparent;
    margin: 8px 0;
}

.scroll-premium::-webkit-scrollbar-thumb {
     background: linear-gradient(
        to bottom,
        #ff6b6b,
        #ff2d3d,
        #dc2626
    );
    border-radius: 999px;
    border: 2px solid transparent;
    background-clip: content-box;
    transition: .25s;
}

.scroll-premium::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(
        to bottom,
        #ff8787,
        #ff4d5a,
        #ef4444
    );
    background-clip: content-box;
}

.scroll-premium::-webkit-scrollbar-corner {
    background: transparent;
}
</style>
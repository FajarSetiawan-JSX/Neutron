<script setup>
import CardBorderAnimation from "@/Components/21Dev/CardBorderAnimation.vue";
import GradientButton from "@/Components/21Dev/GradientButton.vue";
import { onMounted, ref, Teleport } from "vue";
import axios from 'axios';
import { RefreshCcw } from "lucide-vue-next";
import { eror, success } from '@/Helper.js/Toast';
import PrimaryLoading from "@/Components/21Dev/PrimaryLoading.vue";

const emit = defineEmits(['close', 'success']);
const props = defineProps(['rombel', 'ta', 'tingkat', 'tentor']);
const loading = ref(false);
const loadingTingkat = ref(false);
const form = ref({
    nama: '',
    tingkat: '',
    subjek: '',
    deskripsi: ''
})
const err = ref({});
async function create() {
    try{
        loading.value = true;
        const response = await axios.patch(`/api/Admin/rombel/${props?.rombel?.id}`, form.value);
        success('Berhasil memperbarui rombel 🫡');
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

onMounted(()=>{
    console.log(props.rombel);

    form.value.nama = props?.rombel?.nama;
    form.value.deskripsi = props?.rombel?.deskripsi;
    form.value.subjek = props?.rombel?.subjek_id;
    form.value.tingkat = props.rombel.tingkat_id;
})
</script>

<template>
    <Teleport to="body">
        <div @click="emit('close')" class="fixed h-screen inset-0 flex justify-center items-center z-[9999] bg-black/50 overflow-y-auto">
            <CardBorderAnimation @click.stop data-aos="zoom-in">
                <form @submit.prevent="create">
                    <div class="rounded-xl bg-black p-6 w-md">
                        <div class="my-2 flex items-center justify-center">
                            <div>
                                <h1 class="font-primary text-white/80 text-xs tracking-widest">Tahun Ajaran</h1>
                                <p class="text-sm font-anonymous text-white">{{ props?.ta?.tahun }}</p>
                            </div>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                Nama Rombel
                            </label>

                            <input v-model="form.nama"
                                type="text"
                                placeholder="Contoh: IPA 1 SMA 1"
                                class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white placeholder:text-gray-500 outline-none transition focus:outline-0 focus:ring-2 focus:ring-purple-700"
                            />
                            <p v-if="err?.nama" class="text-red-500 mt-1 text-xs md:text-sm">{{ err?.nama[0] }}</p>
                        </div>
                        <div class="my-2">
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                Tingkat
                            </label>
                            <select v-model="form.tingkat" class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white outline-none transition focus:ring-2 focus:ring-purple-700">
                                <option disabled value="">Pilih Tingkat</option>
                                <option v-for="tingkat in props.tingkat" :key="tingkat?.id" :value="tingkat?.id">Tingkat {{ tingkat?.tingkat }} - {{ tingkat?.jenjang?.slug }}</option>
                            </select>
                            <p v-if="err?.tingkat" class="text-red-500 mt-1 text-xs md:text-sm">{{ err?.tingkat[0] }}</p>
                        </div>
                        <div class="my-2">
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                Subjek Mapel
                            </label>
                            <select v-model="form.subjek" class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white outline-none transition focus:ring-2 focus:ring-purple-700">
                                <option disabled value="">Pilih Mapel</option>
                                <option v-for="subjek in props?.tentor?.mapel" :key="subjek.id" :value="subjek.id">{{ subjek?.mapel?.nama }}</option>
                            </select>
                            <p v-if="err?.subjek" class="text-red-500 mt-1 text-xs md:text-sm">{{ err?.subjek[0] }}</p>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                Deskripsi
                            </label>

                            <textarea v-model="form.deskripsi"
                                type="text"
                                placeholder="Contoh: Kelas unggulan untuk siswa kelas IX dengan fokus persiapan ujian dan olimpiade."
                                class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white placeholder:text-gray-500 outline-none transition focus:outline-0 focus:ring-2 focus:ring-purple-700"
                            />
                            <p v-if="err?.deskripsi" class="text-red-500 mt-1 text-xs md:text-sm">{{ err?.deskripsi[0] }}</p>
                        </div>
                        <div class="mt-10 flex justify-end gap-3">
                            <GradientButton color="red" type="submit" :disabled="loading && loadingTingkat" :class="loading && loadingTingkat ? 'opacity-50 cursor-not-allowed' : 'opacity-100 cursor-pointer'" class="flex items-center justify-center w-full gap-2 font-primary py-3 px-6 text-white rounded-xl">
                                <RefreshCcw v-if="!loading" class="w-5 h-5"/>
                                <PrimaryLoading v-else :size="20" :class="'stroke-white'" />
                                {{ loading ? '' : 'Perbarui Rombel' }}
                            </GradientButton>
                        </div>
                    </div>
                </form>
            </CardBorderAnimation>
        </div> 
    </Teleport>
</template>
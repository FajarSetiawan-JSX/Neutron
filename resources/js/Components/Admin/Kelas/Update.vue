<script setup>
import CardBorderAnimation from "@/Components/21Dev/CardBorderAnimation.vue";
import GradientButton from "@/Components/21Dev/GradientButton.vue";
import { ref, Teleport, watch } from "vue";
import axios from 'axios';
import { SquarePen } from "lucide-vue-next";
import { eror, success } from '@/Helper.js/Toast';
import PrimaryLoading from "@/Components/21Dev/PrimaryLoading.vue";

const emit = defineEmits(['close', 'success']);
const props = defineProps(['mapel']);
const loading = ref(false);
const loadingTingkat = ref(false);
const form = ref({
    nama: '',
    tingkat: '',
    deskripsi: ''
})
const tingkats = ref({});
const err = ref({});
async function update() {
    try{
        loading.value = true;
        const response = await axios.patch(`/api/Admin/kelas/${form.value.id}`, form.value);
        success('Berhasil memperbarui kelas 🫡');
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
async function getTingkat() {
    try{
        loadingTingkat.value = true;
        const response = await axios.get('/api/Admin/tingkat');
        tingkats.value = response?.data?.data;
    }catch(error){
        eror(error?.response?.status, error?.response?.statusText);
    }finally{
        loadingTingkat.value = false;
    }
}
watch(()=>props.mapel, (newmapel)=>{
    if(newmapel){
        getTingkat();
        err.value = {};
        form.value.id = newmapel.id;
        form.value.nama = newmapel.nama;
        form.value.tingkat = newmapel.tingkat;
        form.value.deskripsi = newmapel.deskripsi;
    }
},{immediate:true})
</script>

<template>
    <Teleport to="body">
        <div @click="emit('close')" class="fixed h-screen inset-0 flex justify-center items-center z-[9999] bg-black/50 overflow-y-auto">
            <CardBorderAnimation @click.stop data-aos="zoom-in">
                <form @submit.prevent="update">
                    <div class="rounded-xl bg-black p-6 w-md">
                        <h2 class="font-primary text-3xl font-semibold text-white mb-3">Update Kelas</h2>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                Nama Kelas
                            </label>

                            <input v-model="form.nama"
                                type="text"
                                placeholder="Contoh: 1 SMA 1"
                                class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white placeholder:text-gray-500 outline-none transition focus:outline-0 focus:ring-2 focus:ring-purple-700"
                            />
                            <p v-if="err?.nama" class="text-red-500 mt-1 text-xs md:text-sm">{{ err?.nama[0] }}</p>
                        </div>
                        <div class="my-2">
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                Tingkat
                            </label>
                            <template v-if="!loadingTingkat">
                                <select
                                    v-model="form.tingkat"
                                    class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white outline-none transition focus:ring-2 focus:ring-purple-700"
                                >
                                    <option disabled value="">Pilih Tingkat</option>
                                    <option v-for="tingkat in tingkats" :key="tingkat.id" :value="tingkat.id">Tingkat {{ tingkat.tingkat }} - {{ tingkat.jenjang }}</option>
                                </select>
                                <p v-if="err.tingkat" class="text-red-500 mt-1 text-xs md:text-sm">{{ err.tingkat[0] }}</p>
                            </template>
                            <template v-else>
                                <div class="py-2.5 w-full flex justify-center items-center rounded-lg bg-[#1d1d1d]">
                                    <div class="max-w-max">
                                        <PrimaryLoading :size="40" :class="'stroke-emerald-300'" />
                                        <p class="my-1 text-white/50 text-xs font-anonymous">Mengambil data tingkat</p>
                                    </div>
                                </div>
                            </template>
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
                                <SquarePen v-if="!loading" class="w-5 h-5"/>
                                <PrimaryLoading v-else :size="20" :class="'stroke-white'" />
                                {{ loading ? '' : 'Perbarui kelas' }}
                            </GradientButton>
                        </div>
                    </div>
                </form>
            </CardBorderAnimation>
        </div> 
    </Teleport>
</template>
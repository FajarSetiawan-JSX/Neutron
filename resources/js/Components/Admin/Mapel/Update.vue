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
const form = ref({
    id: '',
    nama: '',
    inisial: ''
})
const err = ref({});
async function update() {
    try{
        loading.value = true;
        const response = await axios.patch(`/api/Admin/mapel/${form.value.id}`, form.value);
        success('Berhasil memperbarui mapel 🫡');
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
watch(()=>props.mapel, (newmapel)=>{
    if(newmapel){
        err.value = {};
        form.value.id = newmapel.id;
        form.value.nama = newmapel.nama;
        form.value.inisial = newmapel.inisial;
    }
},{immediate:true})
</script>

<template>
    <Teleport to="body">
        <div @click="emit('close')" class="fixed h-screen inset-0 flex justify-center items-center z-[9999] bg-black/50 overflow-y-auto">
            <CardBorderAnimation @click.stop data-aos="zoom-in">
                <form @submit.prevent="update">
                    <div class="rounded-xl bg-black p-6 w-md">
                        <h2 class="font-primary text-3xl font-semibold text-white mb-3">Update Mapel</h2>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                Nama Mapel
                            </label>

                            <input v-model="form.nama"
                                type="text"
                                placeholder="Contoh: Ilmu Pengetahuan Alam"
                                class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white placeholder:text-gray-500 outline-none transition focus:outline-0 focus:ring-2 focus:ring-purple-700"
                            />
                            <p v-if="err?.nama" class="text-red-500 mt-1 text-xs md:text-sm">{{ err?.nama[0] }}</p>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                Inisial
                            </label>

                            <input v-model="form.inisial"
                                type="text"
                                placeholder="Contoh: IPA"
                                class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white placeholder:text-gray-500 outline-none transition focus:outline-0 focus:ring-2 focus:ring-purple-700"
                            />
                            <p v-if="err.inisial" class="text-red-500 mt-1 text-xs md:text-sm">{{ err.inisial[0] }}</p>
                        </div>
                        <div class="mt-10 flex justify-end gap-3">
                            <GradientButton color="red" type="submit" :disabled="loading" :class="loading ? 'opacity-50 cursor-not-allowed' : 'opacity-100 cursor-pointer'" class="flex items-center justify-center w-full gap-2 font-primary py-3 px-6 text-white rounded-xl">
                                <SquarePen v-if="!loading" class="w-5 h-5"/>
                                <PrimaryLoading v-else :size="20" :class="'stroke-white'" />
                                {{ loading ? '' : 'Perbarui mapel' }}
                            </GradientButton>
                        </div>
                    </div>
                </form>
            </CardBorderAnimation>
        </div> 
    </Teleport>
</template>
<script setup>
import CardBorderAnimation from "@/Components/21Dev/CardBorderAnimation.vue";
import GradientButton from "@/Components/21Dev/GradientButton.vue";
import { onMounted, ref, Teleport } from "vue";
import axios from 'axios';
import { Plus, Presentation } from "lucide-vue-next";
import { eror, success } from '@/Helper.js/Toast';
import PrimaryLoading from "@/Components/21Dev/PrimaryLoading.vue";

const emit = defineEmits(['close', 'success']);
const props = defineProps(['rombel']);
const loading = ref(false);
const form = ref({
    materi: ''
})
const err = ref({});
async function create() {
    try{
        err.value = {};
        loading.value = true;
        const response = await axios.post(`/api/Tentor/${props?.rombel?.id}/pertemuan`, form.value);
        success('Berhasil membuat Pertemuan Baru 🫡');
        emit('success', response?.data?.data)
        //console.log(response?.data.);
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
                        <div class="mb-5">
                            <div class="flex items-center justify-center font-primary text-lg text-white gap-x-1.5 mb-1">
                                <Presentation size="20" />
                                <span>Pertemuan Baru</span>
                            </div>
                            <h1 class="text-center text-white text-xl font-semibold">{{ props?.rombel?.name }}</h1>
                        </div>
                        <div class="text-white font-primary text-sm">
                            <label for="materi" class="block mb-1.5 text-md">Materi</label>
                            <textarea id="materi" v-model="form.materi" class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white outline-none transition focus:ring-2 focus:ring-purple-700"></textarea>
                            <p v-if="err?.materi" class="text-sm text-red-400">{{ err?.materi[0] }}</p>
                        </div>
                        <div class="mt-5 flex justify-end gap-3">
                            <GradientButton color="red" type="submit" :disabled="loading" :class="loading ? 'opacity-50 cursor-not-allowed' : 'opacity-100 cursor-pointer'" class="flex items-center justify-center w-full gap-2 font-primary py-3 px-6 text-white rounded-xl">
                                <Plus v-if="!loading" class="w-5 h-5"/>
                                <PrimaryLoading v-else :size="20" :class="'stroke-white'" />
                                {{ loading ? '' : 'Tambah Pertemuan Baru' }}
                            </GradientButton>
                        </div>
                    </div>
                </form>
            </CardBorderAnimation>
        </div> 
    </Teleport>
</template>
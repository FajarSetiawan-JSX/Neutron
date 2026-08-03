<script setup>
import CardBorderAnimation from "@/Components/21Dev/CardBorderAnimation.vue";
import GradientButton from "@/Components/21Dev/GradientButton.vue";
import { ref, Teleport } from "vue";
import { Plus, UserRoundPlus } from "lucide-vue-next";
import PrimaryLoading from "@/Components/21Dev/PrimaryLoading.vue";
import { eror } from "@/Helper.js/Toast";
import axios from 'axios';

const emit = defineEmits(['close', 'succes']);
const loading = ref(false);
const form = ref({
    nama: '',
    email: '',
    phone: ''
})
function reset(){
    form.value.nama = '';
    form.value.email = '';
    form.value.phone = '';
    err.value = {};
}
const err = ref({});
async function create() {
    err.value = {};
    try{
        loading.value = true;
        const response = await axios.post('/api/Admin/tentor', form.value);
        reset()
        emit("succes");
    }catch(error){
        console.log(error?.response);
        if(error?.response?.status === 422){
            err.value = error?.response?.data?.errors
        }
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
</script>

<template>
    <Teleport to="body">
        <div class="fixed max-h-screen flex items-center justify-center inset-0 z-[9999] bg-black/50">
            <CardBorderAnimation data-aos="zoom-in">
                <form @submit.prevent="create">
                    <div class="rounded-xl bg-black p-6">
                        <div class="my-3 text-white font-primary">
                            <UserRoundPlus size="40" class="mx-auto"/>
                            <h1 class="text-center text-white/70">Pengajar Baru</h1>
                        </div>
                        <div class="space-y-3">
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-300">
                                    Nama Lengkap
                                </label>
                                <input v-model="form.nama"
                                    type="text"
                                    placeholder="Contoh: Nama Pengajar, S.Pd."
                                    class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white placeholder:text-gray-500 outline-none transition focus:outline-0 focus:ring-2 focus:ring-purple-700"
                                />
                                <p v-if="err?.nama" class="text-red-500 mt-1 text-xs md:text-sm">{{ err.nama[0] }}</p>
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-300">
                                    Alamat Email
                                </label>
                                <input v-model="form.email"
                                    type="email"
                                    placeholder="budi@gmail.com"
                                    class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white placeholder:text-gray-500 outline-none transition focus:outline-0 focus:ring-2 focus:ring-purple-700"
                                />
                                <p v-if="err?.email" class="text-red-500 mt-1 text-xs md:text-sm">{{ err?.email[0] }}</p>
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-300">
                                    Phone (WhatsApp)
                                </label>
                                <input v-model="form.phone"
                                    type="text"
                                    placeholder="0812xxxxxxxx"
                                    class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white placeholder:text-gray-500 outline-none transition focus:outline-0 focus:ring-2 focus:ring-purple-700"
                                />
                                <p v-if="err?.phone" class="text-red-500 mt-1 text-xs md:text-sm">{{ err?.phone[0] }}</p>
                            </div>
                        </div>
                        
                        <div class="mt-10 flex justify-end gap-3">
                            <button type="button" @click="emit('close')" :disabled="loading" class="rounded-lg border border-white/10 bg-[#1d1d1d] px-6 py-3 text-gray-300 transition hover:bg-[#2a2a2a]">
                                Batal
                            </button>
                            <GradientButton color="red" type="submit" :disabled="loading" :class="loading ? 'opacity-50 cursor-not-allowed' : 'opacity-100 cursor-pointer'" class="flex items-center justify-center gap-2 font-primary py-3 px-6 text-white rounded-xl">
                                <Plus v-if="!loading" class="w-5 h-5"/>
                                <PrimaryLoading v-else :size="20" :class="'stroke-white'" />
                                {{ loading ? 'Menambah Pengajar Baru' : 'Tambah Pengajar Baru' }}
                            </GradientButton>
                        </div>
                    </div>
                </form>
            </CardBorderAnimation>
        </div> 
    </Teleport>
</template>
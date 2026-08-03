<script setup>
import CardBorderAnimation from "@/Components/21Dev/CardBorderAnimation.vue";
import GradientButton from "@/Components/21Dev/GradientButton.vue";
import { onMounted, ref, Teleport } from "vue";
import axios from 'axios';
import { CircleFadingArrowUp } from "lucide-vue-next";
import { eror, success } from '@/Helper.js/Toast';
import PrimaryLoading from "@/Components/21Dev/PrimaryLoading.vue";

const emit = defineEmits(['close', 'success']);
const props = defineProps(['siswa']);
const loading = ref(false);
const form = ref({
    nama: '',
    nis: '',
    phone: '',
    sekolah: '',
    alamat: ''
})
const err = ref({});
async function update() {
    try{
        loading.value = true;
        const response = await axios.patch(`/api/Admin/siswa/${props?.siswa?.id}`, form.value);
        success('Berhasil menambah siswa baru 🫡');
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
    if(props?.siswa){
        form.value.nama = props?.siswa?.nama;
        form.value.nis = props?.siswa?.nis;
        form.value.sekolah = props?.siswa?.sekolah;
        form.value.phone = props?.siswa?.phone;
        form.value.alamat = props?.siswa?.alamat;
    }
})
</script>

<template>
    <Teleport to="body">
        <div @click="emit('close')" class="fixed h-screen inset-0 flex justify-center items-center z-[9999] bg-black/50 overflow-y-auto">
            <CardBorderAnimation @click.stop data-aos="zoom-in">
                <form @submit.prevent="update">
                    <div class="rounded-xl bg-black p-6 w-md grid grid-cols-1 gap-3">
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                Nama
                            </label>

                            <input v-model="form.nama"
                                type="text"
                                placeholder="nama siswa baru"
                                class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white placeholder:text-gray-500 outline-none transition focus:outline-0 focus:ring-2 focus:ring-purple-700"
                            />
                            <p v-if="err?.nama" class="text-red-500 mt-1 text-xs md:text-sm">{{ err?.nama[0] }}</p>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                NIS
                            </label>

                            <input v-model="form.nis"
                                type="text"
                                placeholder="Contoh: 112233"
                                class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white placeholder:text-gray-500 outline-none transition focus:outline-0 focus:ring-2 focus:ring-purple-700"
                            />
                            <p v-if="err?.nis" class="text-red-500 mt-1 text-xs md:text-sm">{{ err?.nis[0] }}</p>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                Asal Sekolah
                            </label>

                            <input v-model="form.sekolah"
                                type="text"
                                placeholder="Sekolah siswa"
                                class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white placeholder:text-gray-500 outline-none transition focus:outline-0 focus:ring-2 focus:ring-purple-700"
                            />
                            <p v-if="err?.sekolah" class="text-red-500 mt-1 text-xs md:text-sm">{{ err?.sekolah[0] }}</p>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                Nomor Telp orang tua (WhatsApp)
                            </label>

                            <input v-model="form.phone"
                                type="text"
                                placeholder="Contoh: 08xxxxxxxxx"
                                class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white placeholder:text-gray-500 outline-none transition focus:outline-0 focus:ring-2 focus:ring-purple-700"
                            />
                            <p v-if="err?.phone" class="text-red-500 mt-1 text-xs md:text-sm">{{ err?.phone[0] }}</p>
                        </div>
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-300">
                                Alamat
                            </label>
                            <textarea name="" id="" v-model="form.alamat" placeholder="Alamat rumah siswa" class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white placeholder:text-gray-500 outline-none transition focus:outline-0 focus:ring-2 focus:ring-purple-700"></textarea>
                            <p v-if="err?.alamat" class="text-red-500 mt-1 text-xs md:text-sm">{{ err?.alamat[0] }}</p>
                        </div>
                        <div class="mt-5 flex justify-end gap-3">
                            <GradientButton color="red" type="submit" :disabled="loading" :class="loading ? 'opacity-50 cursor-not-allowed' : 'opacity-100 cursor-pointer'" class="flex items-center justify-center w-full gap-2 font-primary py-3 px-6 text-white rounded-xl">
                                <CircleFadingArrowUp v-if="!loading" class="w-5 h-5"/>
                                <PrimaryLoading v-else :size="20" :class="'stroke-white'" />
                                {{ loading ? '' : 'Update data siswa' }}
                            </GradientButton>
                        </div>
                    </div>
                </form>
            </CardBorderAnimation>
        </div> 
    </Teleport>
</template>
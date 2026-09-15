<script setup>
import CardBorderAnimation from "@/Components/21Dev/CardBorderAnimation.vue";
import { computed, onMounted, ref, Teleport } from "vue";
import { Pencil, Trash2, Info, Shapes, BookOpenText, MessageCircleMore, AppWindowMac, MessagesSquare, ChartCandlestick, FingerprintPattern, Link, CirclePile} from "lucide-vue-next";
import Toogle from "@/Components/21Dev/Toogle.vue";
import { eror,success } from "@/Helper.js/Toast";
import axios from 'axios';
import Menu from "@/Components/Menu.vue";

const props = defineProps(['siswa']);
const emit = defineEmits(['close', 'kelas', 'active', 'mapel', 'hapus', 'update']);
const active = computed({
    get: () => props.siswa.status === 1,
    set: (val) => {
        props.siswa.status = val ? 1 : 0;
    }
});
const loading = ref(false);
async function status() {
    try{
        loading.value = true;
        const response = await axios.patch(`/api/Admin/siswa/status/${props?.siswa?.id}`, {
            status: active.value
        });
        success('Berhasil mengubah status siswa.');
        // emit('active');
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
function kelas(){
    emit("kelas");
}
</script>

<template>
    <Teleport to="body">
        <div @click="emit('close')" class="fixed h-screen inset-0 flex justify-center items-center z-[9999] bg-black/50 overflow-y-auto">
            <CardBorderAnimation @click.stop data-aos="zoom-in" data-aos-offset="0">
                <div class="bg-black text-white font-primary flex justify-center items-center gap-x-2">
                    <AppWindowMac size="30" />
                    <h2 class=" text-2xl text-center py-2.5">Menu</h2>
                </div>
                <h1 class="text-center font-primary text-lg text-white bg-black">{{ props?.siswa?.nama }}</h1>
                <div class="flex justify-center items-center bg-black py-2">
                    <Toogle v-model="active" :disabled="loading" @change="status" />
                </div>
                <div class="grid grid-cols-1 gap-2 bg-black w-sm">
                    <button data-aos="fade-up" data-aos-offset="0" @click="emit('update')" class="flex w-full items-center gap-3 px-4 py-3 text-sm text-white transition hover:bg-yellow-500/10">
                        <Pencil class="h-4 w-4 text-yellow-400" />
                        Edit
                    </button>
                    <Menu :href="route('admin.siswa.detail', props?.siswa?.nis)" data-aos="fade-up" data-aos-delay="200" data-aos-offset="0" :class="'flex w-full items-center gap-3 px-4 py-3 text-sm text-white transition hover:bg-emerald-500/10'">
                        <Info class="h-4 w-4 text-emerald-400" />
                        Informasi
                    </Menu>
                    <button type="button" data-aos="fade-up" data-aos-delay="400" data-aos-offset="0" @click="kelas" class="flex w-full items-center gap-3 px-4 py-3 text-sm text-white transition hover:bg-sky-500/10">
                        <Shapes class="h-4 w-4 text-sky-400" />
                        Kelas
                    </button>
                    <button data-aos="fade-up" data-aos-delay="600" data-aos-offset="0" @click="emit('mapel')" class="flex w-full items-center gap-3 px-4 py-3 text-sm text-white transition hover:bg-purple-500/10">
                        <BookOpenText class="h-4 w-4 text-purple-400" />
                        Mapel
                    </button>
                    <Menu :href="route('admin.siswa.rombel', props?.siswa?.nis)" data-aos="fade-up" data-aos-delay="800" data-aos-offset="0" @click="console.log('hapus kelas')" class="flex w-full items-center gap-3 px-4 py-3 text-sm text-white transition hover:bg-cyan-500/10">
                        <CirclePile class="h-4 w-4 text-cyan-400" />
                        Rombel
                    </Menu>
                    <a :href="`https://wa.me/${siswa.phone}`" target="_blank" data-aos="fade-up" data-aos-delay="1000" data-aos-offset="0" class="flex w-full items-center gap-3 px-4 py-3 text-sm text-white transition hover:bg-teal-500/10">
                        <MessagesSquare class="h-4 w-4 text-teal-400" />
                        Chat {{ siswa?.nama }}
                    </a>
                    <a :href="`https://wa.me/${siswa.phone_ortu}`" target="_blank" data-aos="fade-up" data-aos-delay="1200" data-aos-offset="0" class="flex w-full items-center gap-3 px-4 py-3 text-sm text-white transition hover:bg-amber-500/10">
                        <MessageCircleMore class="h-4 w-4 text-amber-400" />
                        Chat Orang Tua
                    </a>
                    <button data-aos="fade-up" data-aos-delay="1400" data-aos-offset="0" @click="emit('hapus')" class="flex w-full items-center gap-3 px-4 py-3 text-sm text-red-400 transition hover:bg-red-500/10">
                        <Trash2 class="h-4 w-4" />
                        Hapus
                    </button>
                </div>
            </CardBorderAnimation>
        </div> 
    </Teleport>
</template>
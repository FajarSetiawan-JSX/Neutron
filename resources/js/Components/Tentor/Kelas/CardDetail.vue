<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { MoreVertical, UserRound, School, MapPin, Phone, Eye, Download, PhoneCall } from 'lucide-vue-next'
import axios from 'axios';
import { eror } from '@/Helper.js/Toast';
import Loading from '../Pertemuan/Loading.vue';

const props = defineProps(['siswa']);
const loadingdownload = ref(false);
const showMenu = ref(false)
const menuRef = ref(null)
const handleClickOutside = (event) => {
    if (
        menuRef.value &&
        !menuRef.value.contains(event.target)
    ) {
        showMenu.value = false
    }
}

async function download() {
    try{
        loadingdownload.value = true;
        const response = await axios.get(`/api/Tentor/download/${props?.siswa?.id}`, {
            responseType: 'blob'
        });
        const url = URL.createObjectURL(response.data);
        const link = document.createElement('a');
        link.href = url;
        link.download = 'rapot.pdf';
        document.body.appendChild(link);
        link.click();
        link.remove();
        URL.revokeObjectURL(url);
    }catch(error){
        console.log(error.response)
        const data = JSON.parse(await error.response.data.text());
        eror(error?.response?.status, data?.message);
    }finally{
        loadingdownload.value = false;
    }
}
onMounted(() => {
    document.addEventListener('click', handleClickOutside)
})

onBeforeUnmount(() => {
    document.removeEventListener('click', handleClickOutside)
})
</script>

<template>
    <div class="w-full rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
        <div class="flex items-start justify-between gap-3">
            <div class="flex min-w-0 items-center gap-3">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-100 text-sm font-semibold text-red-500">
                    AS
                </div>
                <div class="min-w-0">
                    <h3 class="text-base font-semibold leading-5 text-slate-800">
                        {{ props?.siswa?.nama }}
                    </h3>
                    <template v-if="props.siswa.status == 1">
                        <span class="mt-1 inline-flex rounded-full bg-emerald-50 px-2 py-0.5 text-[11px] font-medium text-emerald-500">
                            Aktif
                        </span>
                    </template>
                    <template v-else>
                        <span class="mt-1 inline-flex rounded-full bg-red-50 px-2 py-0.5 text-[11px] font-medium text-red-500">
                            Nonaktif
                        </span>
                    </template>
                </div>
            </div>
            <div ref="menuRef" class="relative shrink-0">
                <button type="button" @click.stop="showMenu = !showMenu" class="rounded-lg p-1.5 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700">
                    <MoreVertical class="h-5 w-5" />
                </button>
                <div v-if="showMenu" class="absolute right-0 top-full z-50 mt-1 w-40 overflow-hidden rounded-lg border border-slate-200 bg-white py-1 shadow-lg">
                    <button type="button" @click="showMenu = false" class="flex w-full items-center gap-3 px-3 py-2.5 text-left text-sm text-slate-700 transition hover:bg-slate-50">
                        <Eye class="h-4 w-4 text-slate-500" />
                        <span>Detail</span>
                    </button>

                    <button type="button" @click="download" class="flex w-full items-center gap-3 px-3 py-2.5 text-left text-sm text-slate-700 transition hover:bg-slate-50">
                        <Download class="h-4 w-4 text-slate-500" />
                        <span>Unduh</span>
                    </button>

                    <button type="button" class="flex w-full items-center gap-3 px-3 py-2.5 text-left text-sm text-slate-700 transition hover:bg-slate-50" @click="showMenu = false">
                        <PhoneCall class="h-4 w-4 text-slate-500" />
                        <span>Kirim</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="mt-4 space-y-3">
            <div class="flex items-start gap-3">
                <UserRound class="mt-0.5 h-4 w-4 shrink-0 text-slate-400" />
                <div class="min-w-0">
                    <p class="text-xs text-slate-400">
                        NIS
                    </p>
                    <p class="break-all text-sm font-medium text-slate-700">
                        {{ props?.siswa?.nis }}
                    </p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <School class="mt-0.5 h-4 w-4 shrink-0 text-slate-400" />
                <div class="min-w-0">
                    <p class="text-xs text-slate-400">
                        Sekolah
                    </p>

                    <p class="text-sm font-medium text-slate-700">
                        {{ props?.siswa?.sekolah }}
                    </p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <MapPin class="mt-0.5 h-4 w-4 shrink-0 text-slate-400" />
                <div class="min-w-0">
                    <p class="text-xs text-slate-400">
                        Alamat
                    </p>
                    <p class="text-sm font-medium leading-5 text-slate-700">
                        {{ props?.siswa?.alamat }}
                    </p>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-start gap-3">
                    <Phone class="mt-0.5 h-4 w-4 shrink-0 text-slate-400" />
                    <div class="min-w-0">
                        <p class="text-xs text-slate-400">
                            No. HP Siswa
                        </p>
                        <p class="text-sm font-medium text-slate-700">
                            +{{ props?.siswa?.phone }}
                        </p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <Phone class="mt-0.5 h-4 w-4 shrink-0 text-slate-400" />
                    <div class="min-w-0">
                        <p class="text-xs text-slate-400">
                            No. HP Orang Tua
                        </p>
                        <p class="text-sm font-medium text-slate-700">
                            +{{ props?.siswa?.phone_ortu }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Loading v-if="loadingdownload" />
</template>
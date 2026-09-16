<script setup>
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { GraduationCap, ChevronRight, BookDown, CalendarDays, Phone, Calendar, NotepadText, ChartCandlestick, RotateCcw, ChevronDown, Search } from "lucide-vue-next";
import GradientButton from '@/Components/21Dev/GradientButton.vue';
import { Bar } from "vue-chartjs";
import { Chart as ChartJS, CategoryScale, LinearScale, BarElement, Tooltip, Legend, } from "chart.js";
import { useCounter } from '@/Helper.js/counter';
import axios from 'axios';
import { eror } from '@/Helper.js/Toast';
import BoxLoading3D from '@/Components/21Dev/BoxLoading3D.vue';
import { formatDate } from '@/Helper.js/DateTime';
import Loading from '@/Components/Tentor/Pertemuan/Loading.vue';

const props = defineProps(['siswa', 'ta', 'kelas', 'avg', 'hadir', 'tidak', 'persentase', 'label', 'data', 'phone', 'ortu']);
const countavg = useCounter();
const counthadir = useCounter();
const counttidak = useCounter();
const loadingdownload = ref(false);
const countpersentase = useCounter();
const w = ref(0);
const open = ref(null);
const rombels = ref([]);
const loading = ref(false);
async function get() {
    try{
        loading.value = true;
        const response = await axios.get(`/api/Admin/siswa/${props?.ta?.id}`, {
            params: {
                start: form.value.start,
                end: form.value.end
            }
        });
        rombels.value = response?.data?.data;
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
const form = ref({
    ta: props?.ta?.id,
    siswa: props?.siswa?.id,
    start: '',
    end: ''
});
function mencari(){
    if(!form.value.start || !form.value.end){
        eror('Oops!', 'pilih tanggal dulu 😁');
    }
    if (form.value.start > form.value.end) {
        return eror('Oops!', 'tanggal mulai tidak boleh lebih besar dari tanggal akhir 😁');
    }
    get();
}
async function download() {
    try{
        loadingdownload.value = true;
        const response = await axios.post(`/api/Admin/download/${form?.value?.siswa}`, form.value, {
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
function toggleRombel(id) {
    open.value = open.value === id ? null : id;
}
const colors = [
    "#ef4444", // merah
    "#3b82f6", // biru
    "#22c55e", // hijau
    "#f59e0b", // kuning
    "#8b5cf6", // ungu
    "#06b6d4", // cyan
    "#ec4899", // pink
    "#14b8a6", // teal
    "#f97316", // orange
    "#84cc16", // lime
];
const backgroundColor = Array.from({ length: 12 }, () => {
    return colors[Math.floor(Math.random() * colors.length)];
});
const data = ref({
    labels: props?.label,
    datasets: [
        {
            data: [],
            label: 'Rata - rata',
            backgroundColor: backgroundColor,
            borderRadius: 8,
        },
    ],
});

const options = {
    responsive: true,
    maintainAspectRatio: false,
    animation: {
        duration: 1500,
        easing: "easeOutQuart",
    },
    plugins: {
        legend: {
            display: false,
        },
    },

    scales: {
        x: {
            grid: {
                display: false,
            },
        },

        y: {
            beginAtZero: true,
            ticks: {
                stepSize: 2,
            },
        },
    },
};
ChartJS.register( CategoryScale, LinearScale, BarElement, Tooltip, Legend);
const user = usePage().props?.auth?.user;

onMounted(()=>{
    get();
    countavg.start(props?.avg);
    counthadir.start(props?.hadir);
    counttidak.start(props?.tidak);
    countpersentase.start(props.persentase);
    const target = Math.round(props?.persentase);
    const hitung = setInterval(()=>{
        w.value += 1;
        if(w.value >= target){
            w.value = target;
            clearInterval(hitung);
        }
    }, 20)
    setTimeout(() => {
        data.value = {
            ...data.value,
            datasets: [
                {
                    ...data.value.datasets[0],
                    data: props?.data,
                },
            ],
        };
    }, 100);
})
</script>

<template>
    <Head title="Detail Siswa" />

    <Auth>
        <template #aside>
            Informasi Siswa
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Informasi Siswa
                </h1>
            </div>
            <div class="flex items-center gap-3">
                <button class="w-10 h-10 rounded-xl bg-red-50 hover:bg-red-500 hover:text-white transition">
                    🔔
                </button>
                <img
                    :src="user?.avatar ? `/storage/${user?.avatar}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(user?.name)}&background=DC2626&color=fff`"
                    class="w-10 h-10 rounded-full"
                />
                <div class="text-sm font-primary text-white hidden md:grid md:grid-cols-1">
                    <span>{{ user?.name }}</span>
                    <span class="text-white/70">{{ user?.email }}</span>
                </div>
            </div>
        </template>

        <section class="flex items-center justify-between mb-7">
            <div class="font-primary text-sm flex items-center gap-x-3.5 text-slate-900">
                <div class="text-slate-500 font-primary text-sm flex items-center gap-x-2">
                    <GraduationCap size="20" class="text-slate-500" /> Siswa
                </div>
                <ChevronRight size="20" />
                <span>Informasi</span>
            </div>
        </section>

        <section class="relative overflow-hidden rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
            <div class="pointer-events-none absolute -right-20 -top-24 h-64 w-64 rounded-full bg-rose-100/50"/>
            <div class="relative flex flex-col gap-4 sm:flex-row sm:items-center">
                <div class="relative mx-auto shrink-0 sm:mx-0">
                    <img :src="`https://ui-avatars.com/api/?name=${encodeURIComponent(props?.siswa?.nama)}&background=DC2626&color=fff`" alt="Budi Santoso" class="h-16 w-16 rounded-full object-cover ring-4 ring-slate-50"/>
                    <span :class="props?.siswa?.status == 1 ? 'bg-emerald-500' : 'bg-red-500'" class="absolute bottom-0.5 right-0.5 h-3.5 w-3.5 rounded-full border-2 border-white"/>
                </div>
                <div class="min-w-0 flex-1 text-center sm:text-left">
                    <div class="flex flex-wrap items-center justify-center gap-2 sm:justify-start">
                        <h2 class="text-base font-bold text-slate-900">
                            {{ props?.siswa?.nama }}
                        </h2>
                        <span class="rounded-md bg-slate-50 px-2 py-0.5 text-[9px] font-medium text-slate-400">
                            NIS : {{ props?.siswa?.nis }}
                        </span>
                    </div>
                    <p class="mt-1 text-xs text-slate-700">
                        {{ props?.siswa?.sekolah }}
                    </p>
                    <p class="mt-1 text-xs text-slate-500">
                        {{ props?.siswa?.alamat }}
                    </p>
                    <!-- Badges -->
                    <div class="mt-3 flex flex-wrap justify-center gap-2 sm:justify-start">
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-slate-100 bg-slate-50 px-2.5 py-1 text-[10px] font-medium text-slate-500">
                            <CalendarDays :size="11" :stroke-width="1.8"/>
                            {{ props?.kelas?.nama }}
                        </span>
                        <span class="inline-flex max-w-full items-center gap-1.5 rounded-full border border-slate-100 bg-slate-50 px-2.5 py-1 text-[10px] font-medium text-slate-500">
                            <Phone :size="11" :stroke-width="1.8" class="shrink-0"/>
                            <span class="truncate">
                                +{{ props?.phone }}
                            </span>
                        </span>
                        <span class="inline-flex max-w-full items-center gap-1.5 rounded-full border border-slate-100 bg-yellow-100 px-2.5 py-1 text-[10px] font-medium text-yellow-500">
                            <Phone :size="11" :stroke-width="1.8" class="shrink-0"/>
                            <span class="truncate">
                                +{{ props?.ortu }}
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <section class="my-5">
            <form action="" @submit.prevent="download">
            <div class="flex items-center justify-between flex-wrap p-3 gap-y-3 rounded-lg shadow-lg bg-white">
                <div>
                    <GradientButton type="submit" :color="'red'" class="text-white px-2.5 py-1 rounded-lg flex items-center gap-x-1">
                        <BookDown size="20" />
                        Unduh Laporan
                    </GradientButton>
                </div>
                <div class="flex items-center justify-start flex-wrap gap-y-3 gap-x-1.5">
                    <input type="date" name="" id="" v-model="form.start" class="rounded-lg border-0 ring-1 ring-slate-300 active:ring-slate-500">
                    -
                    <input type="date" name="" id="" v-model="form.end" class="rounded-lg border-0 ring-1 ring-slate-300 active:ring-slate-500">
                    <button type="reset" class="p-2 bg-emerald-200 hover:bg-emerald-300 rounded-lg group transition-all duration-300"><RotateCcw size="20" class="group-hover:text-emerald-600 text-emerald-400" /></button>
                    <GradientButton color="red" type="button" @click="mencari" class="flex items-center justify-center gap-2 font-primary py-2 px-6 text-white rounded-xl">
                        <Search class="w-5 h-5"/> Cari rekap
                    </GradientButton>
                </div>
            </div>
            </form>
        </section>

        <section class="grid grid-cols-1 xl:grid-cols-5 gap-4">
            <div class="rounded-2xl bg-white shadow-xl p-5 xl:col-span-4">
                <div class="flex items-center justify-start gap-x-3">
                    <div class="p-1.5 rounded-xl bg-emerald-300">
                        <ChartCandlestick size="30" class="text-emerald-500" />
                    </div>
                    <div>
                        <span class="text-2xl font-primary text-slate-700 font-semibold block">Draf nilai</span>
                        <span class="text-sm font-primary text-slate-500 block">Tahun Ajaran {{ props?.ta?.tahun }}</span>
                    </div>
                </div>
                <div class="w-full h-80">
                    <Bar :data="data" :options="options" class="max-h-80" />
                </div>
                <div class="flex items-center justify-start gap-x-2.5">
                    <NotepadText size="20" />
                    <h5 class="font-primary text-lg">Detail nilai & presensi {{ props?.ta?.tahun }}</h5>
                </div>
                <template v-if="loading">
                    <div class="flex items-center justify-center">
                        <BoxLoading3D />
                    </div>
                </template>
                <template v-else>
                    <template v-if="rombels.length > 0">
                        <div class="grid grid-cols-1 gap-4 my-5">
                            <div v-for="(rombel, index) in rombels" :key="index"  class="grid grid-cols-1 gap-2 px-5 bg-slate-100 py-2 rounded-lg shadow-sm">
                                <button type="button" @click="toggleRombel(index)" class="flex items-center justify-between cursor-pointer">
                                    <h6 class="font-semibold text-xl font-primary">{{ rombel?.mapel }}</h6>
                                    <div class="flex items-center justify-end gap-x-2">
                                        <p class="text-md font-primary">{{ rombel?.nama }}</p>
                                        <ChevronDown size="20" :class="open == index ? 'rotate-180' : 'rotate-0'" class="transition-transform duration-300" />
                                    </div>
                                </button>
                                <Transition name="collapse">
                                    <div v-if="open == index" class="overflow-hidden">
                                        <div class="pl-5">
                                            <div v-for="(nilai, index) in rombel?.nilai" :key="index" class="my-1.5">
                                                <div class="flex items-center justify-between font-primary text-sm">
                                                    <p class="uppercase">{{ nilai?.ujian }} <span class="text-xs italic capitalize">{{ formatDate(nilai?.tanggal) }}</span></p>
                                                    <span class="font-anonymous">{{ nilai?.nilai }}</span>
                                                </div>
                                                <div class="w-full rounded-lg bg-slate-200">
                                                    <div class="bg-gradient-to-r from-rose-400 to-emerald-500 h-2 rounded-lg" :style="{width: `${nilai?.nilai}%`}" />
                                                </div>
                                                <p v-if="nilai?.catatan" class="text-xs font-primary">{{ nilai?.catatan }}</p>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-3 gap-3 my-3">
                                            <div class="flex items-center justify-center">
                                                <div class="p-3 rounded-lg bg-teal-200">
                                                    <h1 class="text-center font-primary text-xl font-semibold text-teal-500">{{ rombel?.hadir }}</h1>
                                                    <h2 class="text-teal-400">Hadir</h2>
                                                </div>
                                            </div>

                                            <div class="flex items-center justify-center">
                                                <div class="p-3 rounded-lg bg-red-200">
                                                    <h1 class="text-center font-primary text-xl font-semibold text-red-500">{{ rombel?.tidak }}</h1>
                                                    <h2 class="text-red-400">Alfa</h2>
                                                </div>
                                            </div>

                                            <div class="flex items-center justify-center">
                                                <div class="p-3 rounded-lg bg-slate-200">
                                                    <h1 class="text-center font-primary text-xl font-semibold text-slate-500">{{ rombel?.total }}</h1>
                                                    <h2 class="text-slate-400">Total</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </Transition>
                            </div>
                        </div>
                    </template>
                    <template v-else>
                        <h1 class="text-center font-anonymous text-md text-red-500 my-2">Belum memiliki rekap di tahun ajaran {{ props?.ta?.tahun }}</h1>
                    </template>
                </template>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-1 gap-4">
                <div class="bg-white rounded-2xl shadow-2xl p-3 max-h-max">
                    <div class="flex items-center justify-start gap-x-2.5 font-primary">
                        <div class="p-2 bg-red-200 rounded-lg">
                            <Calendar size="20" class="text-red-400" />
                        </div>
                        <h4 class="text-md">Ringkasan Kehadiran</h4>
                    </div>
                    <div class="mt-6 flex items-center justify-between text-xs font-primary">
                        <span>Tahun Ajaran {{ props?.ta?.tahun }}</span>
                        <span class="font-anonymous text-red-500 text-sm">{{ countpersentase.count }}%</span>
                    </div>
                    <div class="w-full rounded-2xl bg-slate-300 mt-2">
                        <div class="h-2 rounded-2xl bg-red-400" :style="{width: `${w}%`}" />
                    </div>
                    <div class="my-5 grid grid-cols-2 gap-5 font-primary">
                        <div class="bg-slate-100 rounded-2xl flex items-center justify-center p-3">
                            <div>
                                <span class="text-3xl xl:text-lg block text-center">{{ counthadir.count }}</span>
                                <span class="text-sm font-anonymous">Hadir</span>
                            </div>
                        </div>
                        <div class="bg-slate-100 rounded-2xl flex items-center justify-center p-3">
                            <div>
                                <span class="text-3xl xl:text-lg block text-center text-red-400">{{ counttidak.count }}</span>
                                <span class="text-sm font-anonymous">Alfa</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative h-[132px] overflow-hidden rounded-xl bg-rose-600 px-4 py-4 text-white shadow-sm font-primary">
                    <GraduationCap :size="64" :stroke-width="1.5" class="pointer-events-none absolute -right-1 -top-1 opacity-15"/>
                    <div class="relative z-10">
                        <p class="text-md font-semibold">
                            Rata-Rata Keseluruhan
                        </p>

                        <p class="mt-2 text-[9px] font-medium uppercase tracking-wide text-white/75">
                            TOTAL NILAI
                        </p>

                        <p class="mt-0.5 text-2xl font-bold leading-none">
                            {{ countavg.count }}
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <template v-if="loadingdownload">
            <Loading />
        </template>
    </Auth>
</template>

<style scoped>
.collapse-enter-active,
.collapse-leave-active {
    transition:
        max-height 0.3s ease,
        opacity 0.3s ease;
    overflow: hidden;
}

.collapse-enter-from,
.collapse-leave-to {
    max-height: 0;
    opacity: 0;
}

.collapse-enter-to,
.collapse-leave-from {
    max-height: 500px;
    opacity: 1;
}
</style>
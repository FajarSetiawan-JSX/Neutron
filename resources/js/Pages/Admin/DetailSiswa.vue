<script setup>
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { GraduationCap, ChevronRight, BookDown, CalendarDays, Mail, Calendar, NotepadText, ChartCandlestick } from "lucide-vue-next";
import GradientButton from '@/Components/21Dev/GradientButton.vue';
import { Bar } from "vue-chartjs";
import { Chart as ChartJS, CategoryScale, LinearScale, BarElement, Tooltip, Legend, } from "chart.js";

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
const targetData = [90, 77, 88, 67, 89, 87, 94, 66, 84, 87, 100,];
const backgroundColor = Array.from({ length: 12 }, () => {
    return colors[Math.floor(Math.random() * colors.length)];
});
const data = ref({
    labels: ["IPA", "IPS", "MTK", "FIS", "KIM", "BIO", "INF", "IDN", "ENG", "EKO", "SOS"],
    datasets: [
        {
            data: [0, 0, 0, 0, 0],
            label: 'Nilai',
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

const search = ref('');

onMounted(()=>{
    setTimeout(() => {
        data.value = {
            ...data.value,
            datasets: [
                {
                    ...data.value.datasets[0],
                    data: targetData,
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
            <div class="flex-1 max-w-md mx-8">
                <AnimatedGlowingSearchBar v-model="search" />
                <!-- <input type="text" placeholder="Search..." class="w-full rounded-xl border border-red-200 bg-red-50 px-4 py-2 outline-none focus:border-red-500"> -->
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
            <div>
                <GradientButton type="button" :color="'red'" class="text-white px-2.5 py-1 rounded-lg flex items-center gap-x-1">
                    <BookDown size="20" />
                    Unduh Laporan
                </GradientButton>
            </div>
        </section>

        <section class="relative overflow-hidden rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
            <div class="pointer-events-none absolute -right-20 -top-24 h-64 w-64 rounded-full bg-rose-100/50"/>
            <div class="relative flex flex-col gap-4 sm:flex-row sm:items-center">
                <div class="relative mx-auto shrink-0 sm:mx-0">
                    <img src="https://i.pravatar.cc/150?img=32" alt="Budi Santoso" class="h-16 w-16 rounded-full object-cover ring-4 ring-slate-50"/>
                    <span class="absolute bottom-0.5 right-0.5 h-3.5 w-3.5 rounded-full border-2 border-white bg-emerald-500"/>
                </div>
                <div class="min-w-0 flex-1 text-center sm:text-left">
                    <div class="flex flex-wrap items-center justify-center gap-2 sm:justify-start">
                        <h2 class="text-base font-bold text-slate-900">
                            Budi Santoso
                        </h2>
                        <span class="rounded-md bg-slate-50 px-2 py-0.5 text-[9px] font-medium text-slate-400">
                            NIS : 10123456
                        </span>
                    </div>
                    <p class="mt-1 text-xs text-slate-500">
                        Siswa Reguler • Angkatan 2023
                    </p>
                    <!-- Badges -->
                    <div class="mt-3 flex flex-wrap justify-center gap-2 sm:justify-start">
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-slate-100 bg-slate-50 px-2.5 py-1 text-[10px] font-medium text-slate-500">
                            <CalendarDays :size="11" :stroke-width="1.8"/>
                            Kelas XII IPA 2
                        </span>
                        <span class="inline-flex max-w-full items-center gap-1.5 rounded-full border border-slate-100 bg-slate-50 px-2.5 py-1 text-[10px] font-medium text-slate-500">
                            <Mail :size="11" :stroke-width="1.8" class="shrink-0"/>
                            <span class="truncate">
                                budi.santoso@siswa.neutron.id
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid grid-cols-1 xl:grid-cols-5 gap-4 my-5">
            <div class="rounded-2xl bg-white shadow-xl p-5 xl:col-span-4">
                <div class="flex items-center justify-start gap-x-3">
                    <div class="p-1.5 rounded-xl bg-emerald-300">
                        <ChartCandlestick size="30" class="text-emerald-500" />
                    </div>
                    <span class="text-2xl font-primary text-slate-700 font-semibold">Draf nilai</span>
                </div>
                <div class="w-full h-80">
                    <Bar :data="data" :options="options" class="max-h-80" />
                </div>
                <div class="flex items-center justify-start gap-x-2.5">
                    <NotepadText size="20" />
                    <h5 class="font-primary text-lg">Detail nilai</h5>
                </div>
                <div class="grid grid-cols-1 gap-4 my-5">
                    <div class="grid grid-cols-1 gap-2 px-5">
                        <div>
                            <h6 class="font-semibold text-xl font-primary">IPA</h6>
                        </div>
                        <div>
                            <div class="flex items-center justify-between font-primary text-sm ml-5">
                                <span>UTS</span>
                                <span class="font-anonymous">67</span>
                            </div>
                            <div class="w-full rounded-lg bg-slate-200 ml-5">
                                <div class="bg-emerald-400 h-2 rounded-lg" style="width: 90%;" />
                            </div>
                        </div>
                        <div>
                            <div class="flex items-center justify-between font-primary text-sm ml-5">
                                <span>UAS</span>
                                <span class="font-anonymous">50</span>
                            </div>
                            <div class="w-full rounded-lg bg-slate-200 ml-5">
                                <div class="bg-yellow-400 h-2 rounded-lg" style="width: 90%;" />
                            </div>
                        </div>
                    </div>
                </div>
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
                        <span>Tahun Ajaran 2026 / 2027</span>
                        <span class="font-anonymous text-red-500 text-sm">90%</span>
                    </div>
                    <div class="w-full rounded-2xl bg-slate-300 mt-2">
                        <div class="h-2 rounded-2xl bg-red-400" style="width: 90%;" />
                    </div>
                    <div class="my-5 grid grid-cols-2 gap-5 font-primary">
                        <div class="bg-slate-100 rounded-2xl flex items-center justify-center p-3">
                            <div>
                                <span class="text-3xl xl:text-lg block text-center">56</span>
                                <span class="text-sm font-anonymous">Hadir</span>
                            </div>
                        </div>
                        <div class="bg-slate-100 rounded-2xl flex items-center justify-center p-3">
                            <div>
                                <span class="text-3xl xl:text-lg block text-center text-red-400">6</span>
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
                            88.5
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </Auth>
</template>
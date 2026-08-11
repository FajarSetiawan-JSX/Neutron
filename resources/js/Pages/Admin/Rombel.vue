<script setup>
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { ChartColumn, Globe, Plus } from "lucide-vue-next";
import { Bar } from "vue-chartjs";
import { Chart as ChartJS, CategoryScale, LinearScale, BarElement, Tooltip, Legend, } from "chart.js";
import { onMounted, ref } from 'vue';
import GradientButton from '@/Components/21Dev/GradientButton.vue';
import Search from '@/Components/21Dev/Search.vue';
import Card from '@/Components/Admin/Rombel/Card.vue';
import PrimaryLoading from '@/Components/21Dev/PrimaryLoading.vue';
import axios from 'axios';
import { eror, success } from '@/Helper.js/Toast';
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
const targetData = [302, 250, 370, 410, 227, 302, 250, 370, 410, 227, 330, 270];
const backgroundColor = Array.from({ length: 12 }, () => {
    return colors[Math.floor(Math.random() * colors.length)];
});
const data = ref({
    labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Ags", "Sep", "Okt", "Nov", "Des"],
    datasets: [
        {
            data: [0, 0, 0, 0, 0],
            label: 'Rombel',
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
const modalcreate = ref(false);
const rombels = ref([]);
const loading = ref(false);

async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get('/api/Admin/');
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
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
    <Head title="Rombel" />
    <Auth>
        <template #aside>
            Rombel
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Rombel
                </h1>
            </div>
            <div class="hidden md:block flex-1 max-w-md mx-8">
                <AnimatedGlowingSearchBar />
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

        <section class="p-5 rounded-lg bg-white shadow-xl">
            <div class="flex items-center justify-start gap-x-3 font-primary text-2xl">
                <div class="p-2 rounded-xl bg-red-200">
                    <ChartColumn size="20" class="text-red-400" />
                </div>
                <span class="text-lg font-semibold">Grafik Jumlah Rombel</span>
            </div>
            <h1 class="text-sm font-anonymous text-slate-400">Tahun Ajaran 2026 / 2027</h1>
            <div class="h-80 my-3">
                <Bar :data="data" :options="options" class="h-80" />
            </div>
        </section>

        <section class="my-5 grid grid-cols-1">
            <div class="w-full rounded-xl shadow-xl max-h-max bg-red-500 max-w-max">
                <div class="rounded-xl w-full bg-white ml-1 p-3 flex gap-x-3">
                    <div class="p-1.5 bg-red-200 rounded-xl">
                        <Globe size="40" class="text-red-400" />
                    </div>
                    <div class="font-primary text-lg font-semibold">
                        <h2>Total Rombel</h2>
                        <p class="mt-2 font-anonymous text-sm text-red-400">25</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="my-5">
            <h3 class="font-semibold text-xl font-primary">TOP 3 Pengajar</h3>
            <p class="text-xs mb-10">Pengajar dengan jumlah siswa rombel terbanyak pada Tahun Ajaran 2026/2027</p>
            <div class="my-5 grid grid-cols-1 md:grid-cols-3 gap-16">
                <div class="flex items-end">
                    <div class="bg-[#AEB7C2] rounded-xl shadow-xl h-52 w-full">
                        <div class="bg-white rounded-xl h-full mt-1">
                            <div class="flex items-center justify-center max-w-max max-h-max mx-auto">
                                <img
                                    :src="user?.avatar ? `/storage/${user?.avatar}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(user?.name)}&background=DC2626&color=fff`"
                                    class="w-16 h-16 rounded-full border-2 border-white -translate-y-1/2"
                                />
                            </div>
                            <h1 class="text-2xl font-primary text-center">Budi Santoso S.Pd</h1>
                            <div class="text-center text-xs font-primary">
                                <p class="text-lg font-anonymous">25</p>
                                <p>siswa</p>
                                <p>dari total 9 Rombel</p>
                            </div>
                            <div class="flex items-center justify-center">
                                <svg width="40px" height="40px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                        viewBox="0 0 494.4 494.4" style="enable-background:new 0 0 494.4 494.4;" xml:space="preserve">
                                    <path style="fill:#90AEAF;" d="M247.2,494.4c-132,0-240-108-240-240s108-240,240-240s240,108,240,240S379.2,494.4,247.2,494.4z"/>
                                    <circle style="fill:#7D979E;" cx="247.2" cy="240" r="224.8"/>
                                    <g>
                                        <path style="fill:#688389;" d="M48.8,267.2c0-124,100.8-224.8,224.8-224.8c55.2,0,105.6,20,144.8,52.8
                                            c-40.8-48.8-102.4-80-171.2-80C123.2,15.2,22.4,116,22.4,240c0,68.8,31.2,130.4,80,172C68.8,372.8,48.8,322.4,48.8,267.2z"/>
                                        <path style="fill:#688389;" d="M406.4,81.6c88,88,88,230.4,0,318.4S176,488,88,400"/>
                                    </g>
                                    <path style="fill:#B6CBCE;" d="M247.2,480c-132,0-240-108-240-240s108-240,240-240s240,108,240,240S379.2,480,247.2,480z
                                        M247.2,30.4c-116,0-209.6,94.4-209.6,209.6c0,116,94.4,209.6,209.6,209.6S456.8,355.2,456.8,240S363.2,30.4,247.2,30.4z"/>
                                    <g>
                                        <path style="fill:#A3BFC1;" d="M487.2,240c0-60.8-22.4-116-59.2-157.6c-42.4-36.8-97.6-59.2-158.4-59.2c-40.8,0-78.4,10.4-112,28
                                            c27.2-13.6,57.6-20.8,89.6-20.8c63.2,0,120.8,28.8,159.2,73.6c44.8,38.4,72.8,95.2,72.8,159.2c0,32-7.2,62.4-20,89.6
                                            C476.8,319.2,487.2,280.8,487.2,240z"/>
                                        <path style="fill:#A3BFC1;" d="M29.6,263.2c0,60.8,22.4,116,59.2,157.6c42.4,36.8,97.6,59.2,157.6,59.2c40.8,0,78.4-10.4,112-28
                                            c-27.2,12.8-57.6,20-89.6,20c-63.2,0-120.8-28.8-159.2-73.6C64.8,360,36,303.2,36,239.2c0-32,7.2-62.4,20-89.6
                                            C40,184,29.6,222.4,29.6,263.2z"/>
                                    </g>
                                    <g>
                                        <path style="fill:#C7E0E2;" d="M248.8,22.4c0,0.8-0.8,1.6-1.6,1.6l0,0c-0.8,0-1.6-0.8-1.6-1.6V7.2c0-0.8,0.8-1.6,1.6-1.6l0,0
                                            c0.8,0,1.6,0.8,1.6,1.6V22.4z"/>
                                        <path style="fill:#C7E0E2;" d="M248.8,473.6c0,0.8-0.8,1.6-1.6,1.6l0,0c-0.8,0-1.6-0.8-1.6-1.6v-15.2c0-0.8,0.8-1.6,1.6-1.6l0,0
                                            c0.8,0,1.6,0.8,1.6,1.6V473.6z"/>
                                        <path style="fill:#C7E0E2;" d="M402.4,88c-0.8,0.8-1.6,0.8-2.4,0l0,0c-0.8-0.8-0.8-1.6,0-2.4l11.2-11.2c0.8-0.8,1.6-0.8,2.4,0l0,0
                                            c0.8,0.8,0.8,1.6,0,2.4L402.4,88z"/>
                                        <path style="fill:#C7E0E2;" d="M84,406.4c-0.8,0.8-1.6,0.8-2.4,0l0,0c-0.8-0.8-0.8-1.6,0-2.4l11.2-11.2c0.8-0.8,1.6-0.8,2.4,0l0,0
                                            c0.8,0.8,0.8,1.6,0,2.4L84,406.4z"/>
                                        <path style="fill:#C7E0E2;" d="M464.8,242.4c-0.8,0-1.6-0.8-1.6-1.6l0,0c0-0.8,0.8-1.6,1.6-1.6H480c0.8,0,1.6,0.8,1.6,1.6l0,0
                                            c0,0.8-0.8,1.6-1.6,1.6H464.8z"/>
                                        <path style="fill:#C7E0E2;" d="M14.4,242.4c-0.8,0-1.6-0.8-1.6-1.6l0,0c0-0.8,0.8-1.6,1.6-1.6h15.2c0.8-0.8,1.6,0,1.6,0.8l0,0
                                            c0,0.8-0.8,1.6-1.6,1.6H14.4V242.4z"/>
                                        <path style="fill:#C7E0E2;" d="M400,396c-0.8-0.8-0.8-1.6,0-2.4l0,0c0.8-0.8,1.6-0.8,2.4,0l11.2,11.2c0.8,0.8,0.8,1.6,0,2.4l0,0
                                            c-0.8,0.8-1.6,0.8-2.4,0L400,396z"/>
                                        <path style="fill:#C7E0E2;" d="M80.8,76.8c-0.8-0.8-0.8-1.6,0-2.4l0,0c0.8-0.8,1.6-0.8,2.4,0l11.2,11.2c0.8,0.8,0.8,1.6,0,2.4l0,0
                                            c-0.8,0.8-1.6,0.8-2.4,0L80.8,76.8z"/>
                                        <path style="fill:#C7E0E2;" d="M140,51.2c0.8,0.8,0,2.4-0.8,2.4l0,0c-0.8,0.8-2.4,0-2.4-0.8l-8-13.6c-0.8-0.8,0-2.4,0.8-2.4l0,0
                                            c0.8-0.8,2.4,0,2.4,0.8L140,51.2z"/>
                                        <path style="fill:#C7E0E2;" d="M365.6,441.6c0.8,0.8,0,2.4-0.8,2.4l0,0c-0.8,0.8-2.4,0-2.4-0.8l-8-13.6c-0.8-0.8,0-2.4,0.8-2.4l0,0
                                            c0.8-0.8,2.4,0,2.4,0.8L365.6,441.6z"/>
                                        <path style="fill:#C7E0E2;" d="M305.6,30.4c0,0.8-1.6,1.6-2.4,1.6l0,0c-0.8,0-1.6-1.6-1.6-2.4l4-15.2c0-0.8,1.6-1.6,2.4-1.6l0,0
                                            c0.8,0,1.6,1.6,1.6,2.4L305.6,30.4z"/>
                                        <path style="fill:#C7E0E2;" d="M188.8,465.6c0,0.8-1.6,1.6-2.4,1.6l0,0c-0.8,0-1.6-1.6-1.6-2.4l4-15.2c0-0.8,1.6-1.6,2.4-1.6l0,0
                                            c0.8,0,1.6,1.6,1.6,2.4L188.8,465.6z"/>
                                        <path style="fill:#C7E0E2;" d="M436.8,132.8c-0.8,0.8-2.4,0-2.4-0.8l0,0c-0.8-0.8,0-2.4,0.8-2.4l13.6-8c0.8-0.8,2.4,0,2.4,0.8l0,0
                                            c0.8,0.8,0,2.4-0.8,2.4L436.8,132.8z"/>
                                        <path style="fill:#C7E0E2;" d="M46.4,358.4c-0.8,0.8-2.4,0-2.4-0.8l0,0c-0.8-0.8,0-2.4,0.8-2.4l13.6-8c0.8-0.8,2.4,0,2.4,0.8l0,0
                                            c0.8,0.8,0,2.4-0.8,2.4L46.4,358.4z"/>
                                        <path style="fill:#C7E0E2;" d="M456.8,298.4c-0.8,0-1.6-1.6-1.6-2.4l0,0c0-0.8,1.6-1.6,2.4-1.6l15.2,4c0.8,0,1.6,1.6,1.6,2.4l0,0
                                            c0,0.8-1.6,1.6-2.4,1.6L456.8,298.4z"/>
                                        <path style="fill:#C7E0E2;" d="M21.6,181.6c-0.8,0-1.6-1.6-1.6-2.4l0,0c0-0.8,1.6-1.6,2.4-1.6l15.2,4c0.8,0,1.6,1.6,1.6,2.4l0,0
                                            c0,0.8-1.6,1.6-2.4,1.6L21.6,181.6z"/>
                                        <path style="fill:#C7E0E2;" d="M60,129.6c0.8,0.8,1.6,1.6,0.8,2.4l0,0c-0.8,0.8-1.6,1.6-2.4,0.8l-13.6-8c-0.8-0.8-1.6-1.6-0.8-2.4
                                            l0,0c0.8-0.8,1.6-1.6,2.4-0.8L60,129.6z"/>
                                        <path style="fill:#C7E0E2;" d="M450.4,355.2c0.8,0.8,1.6,1.6,0.8,2.4l0,0c-0.8,0.8-1.6,1.6-2.4,0.8l-13.6-8
                                            c-0.8-0.8-1.6-1.6-0.8-2.4l0,0c0.8-0.8,1.6-1.6,2.4-0.8L450.4,355.2z"/>
                                        <path style="fill:#C7E0E2;" d="M192.8,29.6c0,0.8,0,2.4-1.6,2.4l0,0c-0.8,0-2.4,0-2.4-1.6l-4-15.2c0-0.8,0-2.4,1.6-2.4l0,0
                                            c0.8,0,2.4,0,2.4,1.6L192.8,29.6z"/>
                                        <path style="fill:#C7E0E2;" d="M309.6,464.8c0,0.8,0,2.4-1.6,2.4l0,0c-0.8,0-2.4,0-2.4-1.6l-4-15.2c0-0.8,0-2.4,1.6-2.4l0,0
                                            c0.8,0,2.4,0,2.4,1.6L309.6,464.8z"/>
                                        <path style="fill:#C7E0E2;" d="M357.6,52.8c-0.8,0.8-1.6,1.6-2.4,0.8l0,0c-0.8-0.8-1.6-1.6-0.8-2.4l8-13.6c0.8-0.8,1.6-1.6,2.4-0.8
                                            l0,0c0.8,0.8,1.6,1.6,0.8,2.4L357.6,52.8z"/>
                                        <path style="fill:#C7E0E2;" d="M132,443.2c-0.8,0.8-1.6,1.6-2.4,0.8l0,0c-0.8-0.8-1.6-1.6-0.8-2.4l8-13.6c0.8-0.8,1.6-1.6,2.4-0.8
                                            l0,0c0.8,0.8,1.6,1.6,0.8,2.4L132,443.2z"/>
                                        <path style="fill:#C7E0E2;" d="M457.6,185.6c-0.8,0-2.4,0-2.4-1.6l0,0c0-0.8,0-2.4,1.6-2.4l15.2-4c0.8,0,2.4,0,2.4,1.6l0,0
                                            c0,0.8,0,2.4-1.6,2.4L457.6,185.6z"/>
                                        <path style="fill:#C7E0E2;" d="M22.4,302.4c-0.8,0-2.4,0-2.4-1.6l0,0c0-0.8,0-2.4,1.6-2.4l15.2-4c0.8,0,2.4,0,2.4,1.6l0,0
                                            c0,0.8,0,2.4-1.6,2.4L22.4,302.4z"/>
                                        <path style="fill:#C7E0E2;" d="M307.2,315.2H260c33.6-33.6,58.4-64,58.4-101.6c0-34.4-23.2-71.2-73.6-71.2c-24,0-46.4,8-64,23.2
                                            c-5.6,4.8-7.2,12-4,18.4l8,18.4c1.6,4,5.6,8,10.4,8.8c4.8,0.8,9.6,0,13.6-3.2c5.6-4.8,16.8-12.8,30.4-12.8c16,0,22.4,6.4,22.4,21.6
                                            c0,22.4-20,44.8-66.4,88.8l-20,20c-3.2,3.2-4.8,7.2-4.8,11.2v16c0,8.8,7.2,15.2,15.2,15.2h121.6c8.8,0,15.2-7.2,15.2-15.2v-21.6
                                            C322.4,321.6,315.2,315.2,307.2,315.2z"/>
                                    </g>
                                    <path style="fill:#B6CBCE;" d="M194.4,304.8l-20,20c-3.2,3.2-4.8,7.2-4.8,11.2v16c0,8.8,7.2,15.2,15.2,15.2h121.6
                                        c8.8,0,15.2-7.2,15.2-15.2v-21.6c0-8.8-7.2-15.2-15.2-15.2h-47.2c33.6-33.6,58.4-64,58.4-101.6c0-12-3.2-24-8.8-34.4l-50.4,50.4
                                        C252.8,247.2,232.8,268.8,194.4,304.8z"/>
                                    <path style="fill:#688389;" d="M232.8,88.8c0,7.2-6.4,19.2-13.6,19.2c-7.2,0-13.6-12-13.6-19.2s6.4-13.6,13.6-13.6
                                        C226.4,75.2,232.8,81.6,232.8,88.8z"/>
                                    <circle style="fill:#B6CBCE;" cx="219.2" cy="88.8" r="13.6"/>
                                    <path style="fill:#A3BFC1;" d="M228.8,79.2c5.6,5.6,5.6,13.6,0,19.2s-13.6,5.6-19.2,0"/>
                                    <path style="fill:#688389;" d="M288.8,88.8c0,7.2-6.4,19.2-13.6,19.2s-13.6-12-13.6-19.2s6.4-13.6,13.6-13.6
                                        C282.4,75.2,288.8,81.6,288.8,88.8z"/>
                                    <circle style="fill:#B6CBCE;" cx="275.2" cy="88.8" r="13.6"/>
                                    <path style="fill:#A3BFC1;" d="M284.8,79.2c5.6,5.6,5.6,13.6,0,19.2s-13.6,5.6-19.2,0"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="bg-[#F4B942] rounded-xl shadow-xl h-60">
                    <div class="bg-white rounded-xl h-full mt-1">
                        <div class="flex items-center justify-center">
                            <img
                                :src="user?.avatar ? `/storage/${user?.avatar}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(user?.name)}&background=DC2626&color=fff`"
                                class="w-20 h-20 rounded-full border-2 border-yellow-100 -translate-y-1/2"
                            />
                        </div>
                        <h1 class="text-2xl font-primary text-center">Budi Santoso S.Pd</h1>
                        <div class="text-center text-xs font-primary">
                            <p class="text-lg font-anonymous">25</p>
                            <p>siswa</p>
                            <p>dari total 9 Rombel</p>
                        </div>
                        <div class="flex items-center justify-center">
                            <svg width="60px" height="60px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 474.752 474.752" style="enable-background:new 0 0 474.752 474.752;" xml:space="preserve">
                                <g>
                                    <polyline style="fill:#E04F5F;" points="107.04,215.528 0,360.52 101.2,340.44 110.16,438.6 208.256,304.472 	"/>
                                    <polyline style="fill:#E04F5F;" points="367.712,215.528 474.752,360.52 373.552,340.44 364.592,438.6 266.496,304.472 	"/>
                                </g>
                                <ellipse style="fill:#F2B851;" cx="235.344" cy="177.512" rx="142.336" ry="141.36"/>
                                <ellipse style="fill:#D89D3D;" cx="235.344" cy="177.512" rx="91.312" ry="90.688"/>
                                <g>
                                    <path style="fill:#FFFFFF;" d="M218.208,225.656h-18.304v-68.944c-6.672,6.256-14.56,10.88-23.632,13.856v-16.592
                                        c4.768-1.568,9.952-4.528,15.568-8.896c5.6-4.352,9.44-9.456,11.52-15.264h14.848V225.656z"/>
                                    <path style="fill:#FFFFFF;" d="M234.896,165.88l7.008-0.672c0.416,2.352,1.28,4.08,2.576,5.184c1.28,1.104,3.024,1.664,5.216,1.664
                                        c2.336,0,4.08-0.496,5.248-1.472s1.76-2.128,1.76-3.44c0-0.848-0.256-1.568-0.752-2.16c-0.48-0.592-1.36-1.104-2.592-1.552
                                        c-0.848-0.288-2.768-0.816-5.76-1.552c-3.856-0.96-6.576-2.144-8.144-3.536c-2.192-1.968-3.28-4.352-3.28-7.184
                                        c0-1.824,0.512-3.52,1.552-5.104s2.512-2.784,4.448-3.616s4.288-1.248,7.024-1.248c4.48,0,7.856,0.992,10.112,2.944
                                        c2.272,1.968,3.472,4.592,3.584,7.872l-7.216,0.32c-0.304-1.84-0.976-3.152-1.984-3.968s-2.528-1.2-4.56-1.2
                                        c-2.096,0-3.728,0.432-4.928,1.296c-0.768,0.56-1.136,1.296-1.136,2.224c0,0.848,0.352,1.568,1.072,2.16
                                        c0.912,0.768,3.104,1.568,6.624,2.384c3.504,0.832,6.096,1.68,7.776,2.56c1.664,0.896,2.992,2.096,3.936,3.632
                                        s1.424,3.424,1.424,5.68c0,2.048-0.56,3.968-1.696,5.744c-1.136,1.776-2.736,3.104-4.816,3.984s-4.672,1.312-7.776,1.312
                                        c-4.512,0-7.968-1.04-10.384-3.136C236.816,172.92,235.36,169.88,234.896,165.88z"/>
                                    <path style="fill:#FFFFFF;" d="M278.032,177.496v-29.664H267.44V141.8h28.352v6.032h-10.56v29.664H278.032z"/>
                                </g>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="flex items-end">
                    <div class="bg-[#C98B62] rounded-xl shadow-xl h-44 w-full">
                        <div class="bg-white rounded-xl h-full mt-1">
                            <div class="flex items-center justify-center max-w-max max-h-max mx-auto">
                                <img
                                    :src="user?.avatar ? `/storage/${user?.avatar}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(user?.name)}&background=DC2626&color=fff`"
                                    class="w-12 h-12 rounded-full border-2 border-[#C98B62] -translate-y-1/2"
                                />
                            </div>
                            <h1 class="text-lg font-primary text-center">Budi Santoso S.Pd</h1>
                            <div class="text-center text-xs font-primary">
                                <p class="text-md font-anonymous">25</p>
                                <p>siswa</p>
                                <p>dari total 9 Rombel</p>
                            </div>
                            <div class="flex items-center justify-center">
                                <svg width="40px" height="40px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                    viewBox="0 0 494.4 494.4" style="enable-background:new 0 0 494.4 494.4;" xml:space="preserve">
                                <path style="fill:#D89E77;" d="M247.2,494.4c-132,0-240-108-240-240s108-240,240-240s240,108,240,240S379.2,494.4,247.2,494.4z"/>
                                <circle style="fill:#D88B56;" cx="247.2" cy="240" r="224.8"/>
                                <g>
                                    <path style="fill:#CC7E48;" d="M48.8,267.2c0-124,100.8-224.8,224.8-224.8c55.2,0,105.6,20,144.8,52.8
                                        c-40.8-48.8-102.4-80-171.2-80C123.2,15.2,22.4,116,22.4,240c0,68.8,31.2,130.4,80,172C68.8,372.8,48.8,322.4,48.8,267.2z"/>
                                    <path style="fill:#CC7E48;" d="M406.4,81.6c88,88,88,230.4,0,318.4S176,488,88,400"/>
                                </g>
                                <path style="fill:#F7C6A4;" d="M247.2,480c-132,0-240-108-240-240s108-240,240-240s240,108,240,240S379.2,480,247.2,480z
                                    M247.2,30.4c-116,0-209.6,94.4-209.6,209.6c0,116,94.4,209.6,209.6,209.6S456.8,355.2,456.8,240S363.2,30.4,247.2,30.4z"/>
                                <g>
                                    <path style="fill:#E8B18B;" d="M487.2,240c0-60.8-22.4-116-59.2-157.6c-42.4-36.8-97.6-59.2-158.4-59.2c-40.8,0-78.4,10.4-112,28
                                        c27.2-13.6,57.6-20.8,89.6-20.8c63.2,0,120.8,28.8,159.2,73.6c44.8,38.4,72.8,95.2,72.8,159.2c0,32-7.2,62.4-20,89.6
                                        C476.8,319.2,487.2,280.8,487.2,240z"/>
                                    <path style="fill:#E8B18B;" d="M29.6,263.2c0,60.8,22.4,116,59.2,157.6c42.4,36.8,97.6,59.2,157.6,59.2c40.8,0,78.4-10.4,112-28
                                        c-27.2,12.8-57.6,20-89.6,20c-63.2,0-120.8-28.8-159.2-73.6C64.8,360,36,303.2,36,239.2c0-32,7.2-62.4,20-89.6
                                        C40,184,29.6,222.4,29.6,263.2z"/>
                                </g>
                                <g>
                                    <path style="fill:#FFDCC5;" d="M248.8,22.4c0,0.8-0.8,1.6-1.6,1.6l0,0c-0.8,0-1.6-0.8-1.6-1.6V7.2c0-0.8,0.8-1.6,1.6-1.6l0,0
                                        c0.8,0,1.6,0.8,1.6,1.6V22.4z"/>
                                    <path style="fill:#FFDCC5;" d="M248.8,473.6c0,0.8-0.8,1.6-1.6,1.6l0,0c-0.8,0-1.6-0.8-1.6-1.6v-15.2c0-0.8,0.8-1.6,1.6-1.6l0,0
                                        c0.8,0,1.6,0.8,1.6,1.6V473.6z"/>
                                    <path style="fill:#FFDCC5;" d="M402.4,88c-0.8,0.8-1.6,0.8-2.4,0l0,0c-0.8-0.8-0.8-1.6,0-2.4l11.2-11.2c0.8-0.8,1.6-0.8,2.4,0l0,0
                                        c0.8,0.8,0.8,1.6,0,2.4L402.4,88z"/>
                                    <path style="fill:#FFDCC5;" d="M84,406.4c-0.8,0.8-1.6,0.8-2.4,0l0,0c-0.8-0.8-0.8-1.6,0-2.4l11.2-11.2c0.8-0.8,1.6-0.8,2.4,0l0,0
                                        c0.8,0.8,0.8,1.6,0,2.4L84,406.4z"/>
                                    <path style="fill:#FFDCC5;" d="M464.8,242.4c-0.8,0-1.6-0.8-1.6-1.6l0,0c0-0.8,0.8-1.6,1.6-1.6H480c0.8,0,1.6,0.8,1.6,1.6l0,0
                                        c0,0.8-0.8,1.6-1.6,1.6H464.8z"/>
                                    <path style="fill:#FFDCC5;" d="M14.4,242.4c-0.8,0-1.6-0.8-1.6-1.6l0,0c0-0.8,0.8-1.6,1.6-1.6h15.2c0.8-0.8,1.6,0,1.6,0.8l0,0
                                        c0,0.8-0.8,1.6-1.6,1.6H14.4V242.4z"/>
                                    <path style="fill:#FFDCC5;" d="M400,396c-0.8-0.8-0.8-1.6,0-2.4l0,0c0.8-0.8,1.6-0.8,2.4,0l11.2,11.2c0.8,0.8,0.8,1.6,0,2.4l0,0
                                        c-0.8,0.8-1.6,0.8-2.4,0L400,396z"/>
                                    <path style="fill:#FFDCC5;" d="M80.8,76.8c-0.8-0.8-0.8-1.6,0-2.4l0,0c0.8-0.8,1.6-0.8,2.4,0l11.2,11.2c0.8,0.8,0.8,1.6,0,2.4l0,0
                                        c-0.8,0.8-1.6,0.8-2.4,0L80.8,76.8z"/>
                                    <path style="fill:#FFDCC5;" d="M140,51.2c0.8,0.8,0,2.4-0.8,2.4l0,0c-0.8,0.8-2.4,0-2.4-0.8l-8-13.6c-0.8-0.8,0-2.4,0.8-2.4l0,0
                                        c0.8-0.8,2.4,0,2.4,0.8L140,51.2z"/>
                                    <path style="fill:#FFDCC5;" d="M365.6,441.6c0.8,0.8,0,2.4-0.8,2.4l0,0c-0.8,0.8-2.4,0-2.4-0.8l-8-13.6c-0.8-0.8,0-2.4,0.8-2.4l0,0
                                        c0.8-0.8,2.4,0,2.4,0.8L365.6,441.6z"/>
                                    <path style="fill:#FFDCC5;" d="M305.6,30.4c0,0.8-1.6,1.6-2.4,1.6l0,0c-0.8,0-1.6-1.6-1.6-2.4l4-15.2c0-0.8,1.6-1.6,2.4-1.6l0,0
                                        c0.8,0,1.6,1.6,1.6,2.4L305.6,30.4z"/>
                                    <path style="fill:#FFDCC5;" d="M188.8,465.6c0,0.8-1.6,1.6-2.4,1.6l0,0c-0.8,0-1.6-1.6-1.6-2.4l4-15.2c0-0.8,1.6-1.6,2.4-1.6l0,0
                                        c0.8,0,1.6,1.6,1.6,2.4L188.8,465.6z"/>
                                    <path style="fill:#FFDCC5;" d="M436.8,132.8c-0.8,0.8-2.4,0-2.4-0.8l0,0c-0.8-0.8,0-2.4,0.8-2.4l13.6-8c0.8-0.8,2.4,0,2.4,0.8l0,0
                                        c0.8,0.8,0,2.4-0.8,2.4L436.8,132.8z"/>
                                    <path style="fill:#FFDCC5;" d="M46.4,358.4c-0.8,0.8-2.4,0-2.4-0.8l0,0c-0.8-0.8,0-2.4,0.8-2.4l13.6-8c0.8-0.8,2.4,0,2.4,0.8l0,0
                                        c0.8,0.8,0,2.4-0.8,2.4L46.4,358.4z"/>
                                    <path style="fill:#FFDCC5;" d="M456.8,298.4c-0.8,0-1.6-1.6-1.6-2.4l0,0c0-0.8,1.6-1.6,2.4-1.6l15.2,4c0.8,0,1.6,1.6,1.6,2.4l0,0
                                        c0,0.8-1.6,1.6-2.4,1.6L456.8,298.4z"/>
                                    <path style="fill:#FFDCC5;" d="M21.6,181.6c-0.8,0-1.6-1.6-1.6-2.4l0,0c0-0.8,1.6-1.6,2.4-1.6l15.2,4c0.8,0,1.6,1.6,1.6,2.4l0,0
                                        c0,0.8-1.6,1.6-2.4,1.6L21.6,181.6z"/>
                                    <path style="fill:#FFDCC5;" d="M60,129.6c0.8,0.8,1.6,1.6,0.8,2.4l0,0c-0.8,0.8-1.6,1.6-2.4,0.8l-13.6-8c-0.8-0.8-1.6-1.6-0.8-2.4
                                        l0,0c0.8-0.8,1.6-1.6,2.4-0.8L60,129.6z"/>
                                    <path style="fill:#FFDCC5;" d="M450.4,355.2c0.8,0.8,1.6,1.6,0.8,2.4l0,0c-0.8,0.8-1.6,1.6-2.4,0.8l-13.6-8
                                        c-0.8-0.8-1.6-1.6-0.8-2.4l0,0c0.8-0.8,1.6-1.6,2.4-0.8L450.4,355.2z"/>
                                    <path style="fill:#FFDCC5;" d="M192.8,29.6c0,0.8,0,2.4-1.6,2.4l0,0c-0.8,0-2.4,0-2.4-1.6l-4-15.2c0-0.8,0-2.4,1.6-2.4l0,0
                                        c0.8,0,2.4,0,2.4,1.6L192.8,29.6z"/>
                                    <path style="fill:#FFDCC5;" d="M309.6,464.8c0,0.8,0,2.4-1.6,2.4l0,0c-0.8,0-2.4,0-2.4-1.6l-4-15.2c0-0.8,0-2.4,1.6-2.4l0,0
                                        c0.8,0,2.4,0,2.4,1.6L309.6,464.8z"/>
                                    <path style="fill:#FFDCC5;" d="M357.6,52.8c-0.8,0.8-1.6,1.6-2.4,0.8l0,0c-0.8-0.8-1.6-1.6-0.8-2.4l8-13.6c0.8-0.8,1.6-1.6,2.4-0.8
                                        l0,0c0.8,0.8,1.6,1.6,0.8,2.4L357.6,52.8z"/>
                                    <path style="fill:#FFDCC5;" d="M132,443.2c-0.8,0.8-1.6,1.6-2.4,0.8l0,0c-0.8-0.8-1.6-1.6-0.8-2.4l8-13.6c0.8-0.8,1.6-1.6,2.4-0.8
                                        l0,0c0.8,0.8,1.6,1.6,0.8,2.4L132,443.2z"/>
                                    <path style="fill:#FFDCC5;" d="M457.6,185.6c-0.8,0-2.4,0-2.4-1.6l0,0c0-0.8,0-2.4,1.6-2.4l15.2-4c0.8,0,2.4,0,2.4,1.6l0,0
                                        c0,0.8,0,2.4-1.6,2.4L457.6,185.6z"/>
                                    <path style="fill:#FFDCC5;" d="M22.4,302.4c-0.8,0-2.4,0-2.4-1.6l0,0c0-0.8,0-2.4,1.6-2.4l15.2-4c0.8,0,2.4,0,2.4,1.6l0,0
                                        c0,0.8,0,2.4-1.6,2.4L22.4,302.4z"/>
                                    <path style="fill:#FFDCC5;" d="M292.8,246.4c12-11.2,18.4-26.4,18.4-43.2c0-29.6-21.6-60.8-69.6-60.8c-25.6,0-48,9.6-59.2,17.6
                                        c-5.6,4-8,11.2-5.6,17.6l6.4,18.4c1.6,4.8,5.6,8,9.6,9.6c4.8,1.6,9.6,0.8,13.6-2.4c6.4-4.8,18.4-9.6,28.8-9.6
                                        c17.6,0,17.6,9.6,17.6,13.6c0,13.6-20,16.8-27.2,16.8h-14.4c-8.8,0-15.2,7.2-15.2,15.2v19.2c0,8.8,7.2,15.2,15.2,15.2h14.4
                                        c8,0,33.6,1.6,33.6,23.2c0,2.4,0,8.8-5.6,14.4s-15.2,7.2-22.4,7.2c-13.6,0-28-5.6-33.6-9.6c-4-2.4-8.8-3.2-13.6-1.6s-8,4.8-9.6,9.6
                                        l-7.2,20c-2.4,6.4,0,14.4,6.4,18.4c11.2,7.2,32.8,15.2,57.6,15.2c58.4,0,84.8-37.6,84.8-72.8C318.4,276.8,308.8,258.4,292.8,246.4z
                                        "/>
                                </g>
                                <path style="fill:#F7C6A4;" d="M212.8,274.4h14.4c8,0,33.6,1.6,33.6,23.2c0,2.4,0,8.8-5.6,14.4s-15.2,7.2-22.4,7.2
                                    c-13.6,0-28-5.6-33.6-9.6c-4-2.4-8.8-3.2-13.6-1.6s-8,4.8-9.6,9.6l-7.2,20c-2.4,6.4,0,14.4,6.4,18.4c11.2,7.2,32.8,15.2,57.6,15.2
                                    c58.4,0,84.8-37.6,84.8-72.8c0-20.8-9.6-39.2-25.6-51.2c12-11.2,18.4-26.4,18.4-43.2c0-8-1.6-15.2-4.8-22.4L212.8,274.4L212.8,274.4
                                    z"/>
                                <path style="fill:#CC7E48;" d="M218.4,88.8c0,7.2-6.4,19.2-13.6,19.2c-7.2,0-13.6-12-13.6-19.2s6.4-13.6,13.6-13.6
                                    C212,75.2,218.4,81.6,218.4,88.8z"/>
                                <circle style="fill:#F7C6A4;" cx="204.8" cy="88.8" r="13.6"/>
                                <path style="fill:#E8B18B;" d="M214.4,79.2c5.6,5.6,5.6,13.6,0,19.2s-13.6,5.6-19.2,0"/>
                                <path style="fill:#CC7E48;" d="M260.8,88.8c0,7.2-6.4,19.2-13.6,19.2s-13.6-12-13.6-19.2s6.4-13.6,13.6-13.6S260.8,81.6,260.8,88.8z
                                    "/>
                                <circle style="fill:#F7C6A4;" cx="247.2" cy="88.8" r="13.6"/>
                                <path style="fill:#E8B18B;" d="M256.8,79.2c5.6,5.6,5.6,13.6,0,19.2s-13.6,5.6-19.2,0"/>
                                <path style="fill:#CC7E48;" d="M303.2,88.8c0,7.2-6.4,19.2-13.6,19.2S276,96,276,88.8s6.4-13.6,13.6-13.6
                                    C296.8,75.2,303.2,81.6,303.2,88.8z"/>
                                <circle style="fill:#F7C6A4;" cx="289.6" cy="88.8" r="13.6"/>
                                <path style="fill:#E8B18B;" d="M299.2,79.2c5.6,5.6,5.6,13.6,0,19.2s-13.6,5.6-19.2,0"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="my-5">
            <div class="md:flex md:items-center md:justify-between grid grid-cols-1 gap-2.5 p-3 border-1 border-slate-100 bg-white shadow-md">
                <div>
                    <Search v-model="search" placeholder="Cari siswa..." />
                </div>
                <div class="flex items-center justify-end gap-x-3">
                    <select name="" id="" class="rounded-lg">
                        <option selected disabled value="">Filter TA</option>
                        <option value="">2026 / 2027</option>
                    </select>
                    <GradientButton color="red" type="button" @click="modalcreate = true" class="flex items-center justify-center gap-2 font-primary py-3 px-6 text-white rounded-xl">
                        <Plus class="w-5 h-5"/> Tambah Rombel
                    </GradientButton>
                </div>
            </div>
        </section>
        <section class="my-5">
            <Card />
        </section>
        <section class="my-5 flex items-center justify-center h-60">
            <div>
                <PrimaryLoading size="50" :class="'stroke-emerald-500'" />
                <p class="font-anonymous text-md text-center my-5">Fetching data</p>
            </div>
        </section>

    </Auth>
</template>
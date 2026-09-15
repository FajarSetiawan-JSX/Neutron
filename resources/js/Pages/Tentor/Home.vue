<script setup>
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import PrimaryLoading from '@/Components/21Dev/PrimaryLoading.vue';
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { CircleCheckBig } from "lucide-vue-next";
import { Bar, Pie, Line } from "vue-chartjs";
import { Chart as ChartJS, CategoryScale, LinearScale, PointElement, LineElement, BarElement, Tooltip, Legend, Title, ArcElement, Filler, } from "chart.js";
import { useCounter } from '@/Helper.js/counter';

const totalsiswakelas = useCounter();
const totalrombel = useCounter();
const totalsiswarombel = useCounter();

const props = defineProps(['siswawali', 'totalrombel', 'siswarombel', 'datarombel', 'labelrombel', 'datakelas', 'labelkelas', 'datamapel', 'labelmapel', 'ta']);
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

const Rombeldata = ref({
    labels: props?.labelrombel,
    datasets: [
        {
            label: "Total Siswa",
            data: [],
            borderColor: "#0ea5e9",
            backgroundColor: "rgba(14, 165, 233, 0.15)",
            borderWidth: 2,
            pointRadius: 4,
            pointHoverRadius: 6,
            tension: 0,
            fill: true,
        },
    ],
});
const Rombeloptions = {
    responsive: true,
    maintainAspectRatio: false,

    animation: {
        duration: 1500,
        easing: "easeOutQuart",
    },

    plugins: {
        legend: {
            display: false,
            position: "top",
        },

        tooltip: {
            enabled: true,
        },
    },

    scales: {
        y: {
            beginAtZero: true,
        },
    },
};

const Kelasdata = ref({
    labels: props?.labelkelas,
    datasets: [
        {
            data: [],
            label: 'Siswa',
            backgroundColor: backgroundColor,
            borderRadius: 8,
        },
    ],
});
const Kelasoptions = {
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

const Mapeldata = ref({
    labels: props?.labelmapel,
    datasets: [
        {
            data: [],
            label: ["Total Siswa"],
            backgroundColor: backgroundColor,
            borderRadius: 2,
        },
    ],
});
const Mapeloptions = {
    responsive: true,
    maintainAspectRatio: false,
    animation: {
        duration: 1500,
        easing: "easeOutQuart",
    },
    plugins: {
        legend: {
            display: true,
            position: "left", // left | right | top | bottom
            align: "center",
        },
        tooltip: {
            enabled: true,
        },
    },
};
ChartJS.register( CategoryScale, LinearScale, PointElement, LineElement, BarElement, Tooltip, Legend, Title, ArcElement, Filler);

const user = usePage().props?.auth?.user;
const showline = ref(false);

onMounted(()=>{
    totalrombel.start(props?.totalrombel, 50);
    totalsiswakelas.start(props?.siswawali, 50);
    totalsiswarombel.start(props?.siswarombel, 50);
    setTimeout(()=>{
        showline.value = true
    }, 1000);

    setTimeout(() => {
        Rombeldata.value = {
            ...Rombeldata.value,
            datasets: [
                {
                    ...Rombeldata.value.datasets[0],
                    data: props?.datarombel,
                },
            ],
        };
    }, 100);

    setTimeout(() => {
        Kelasdata.value = {
            ...Kelasdata.value,
            datasets: [
                {
                    ...Kelasdata.value.datasets[0],
                    data: props?.datakelas,
                },
            ],
        };
    }, 100);

    setTimeout(() => {
        Mapeldata.value = {
            ...Mapeldata.value,
            datasets: [
                {
                    ...Mapeldata.value.datasets[0],
                    data: props?.datamapel,
                },
            ],
        };
    }, 100);
})
</script>

<template>
    <Head title="Home" />
    <Auth>
        <template #aside>
            Home
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Home
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
        <section>
            <div :class="showline ? 'pl-2' : 'pl-0'" class="w-full bg-red-500 transition-all duration-300 lg:rounded-r-2xl overflow-hidden shadow-sm">
                <div class="w-full bg-white p-5 lg:flex lg:items-center lg:justify-between">
                    <div class="font-primary mb-5 lg:mb-0">
                        <h1 class="text-2xl font-semibold">Selamat Datang</h1>
                        <p class="text-sm text-slate-500">Pantau jadwal, kelas, dan aktivitas mengajarmu dengan mudah.</p>
                        <p class="mt-5 text-md text-white px-3 py-1 rounded-full bg-black max-w-max flex items-center justify-start gap-x-1">Tahun Ajaran {{ props?.ta?.tahun }} <CircleCheckBig class="text-red-500" /> </p>
                    </div>
                    <div class="flex items-center justify-between flex-wrap gap-x-2 max-w-sm">
                        <div>
                            <h2 class="font-semibold text-2xl text-red-500 text-center">{{ totalsiswakelas.count }}</h2>
                            <p class="text-slate-500 text-xs">siswa wali</p>
                            <div class="w-full h-0.5 bg-red-400" />
                        </div>

                        <div>
                            <h2 class="font-semibold text-2xl text-teal-500 text-center">{{ totalrombel.count }}</h2>
                            <p class="text-slate-500 text-xs">Rombel</p>
                            <div class="w-full h-0.5 bg-teal-400" />
                        </div>

                        <div>
                            <h2 class="font-semibold text-2xl text-indigo-500 text-center">{{ totalsiswarombel.count }}</h2>
                            <p class="text-slate-500 text-xs">siswa rombel</p>
                            <div class="w-full h-0.5 bg-indigo-400" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="my-5">
            <div class="p-3 rounded-xl bg-white shadow-lg">
                <h3 class="font-primary text-lg font-semibold">Rombel anda saat ini</h3>
                <Line :data="Rombeldata" :options="Rombeloptions" class="max-h-80" />
            </div>
        </section>

        <section>
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">
                <div class="w-full p-3 rounded-lg shadow-lg bg-white">
                    <h3 class="font-primary text-lg font-semibold">Mata Pelajaran</h3>
                    <Pie :data="Mapeldata" :options="Mapeloptions" class="max-h-80" />
                </div>

                <div class="w-full p-3 rounded-lg shadow-lg bg-white">
                    <h3 class="font-primary text-lg font-semibold">Kelas anda</h3>
                    <Bar :data="Kelasdata" :options="Kelasoptions" class="max-h-80" />
                </div>
            </div>
        </section>
    </Auth>
</template>
<script setup>
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import { usePage } from '@inertiajs/vue3';
import CardBorderAnimation from '@/Components/21Dev/CardBorderAnimation.vue';
import { Calendar, GraduationCap, Speech, Album, School } from "lucide-vue-next";
import { Bar, PolarArea } from "vue-chartjs";
import { Chart as ChartJS, CategoryScale, LinearScale, BarElement, RadialLinearScale, ArcElement, Tooltip, Legend, } from "chart.js";
import { onMounted, ref } from 'vue';

const user = usePage().props?.auth?.user;
const props = defineProps(['tahun', 'siswa', 'tentor', 'mapel', 'kelas', 'labelmapel', 'datamapel', 'labelkelas', 'datakelas']);
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
const datamapel = ref({
    labels: props?.labelmapel,
    datasets: [
        {
            data: [],
            label: ["Jumlah siswa"],
            backgroundColor: backgroundColor,
            borderRadius: 0,
        },
    ],
});
const datakelas = ref({
    labels: props?.labelkelas,
    datasets: [
        {
            label: 'Total siswa',
            data: [0],
            backgroundColor: [
                "#ef4444",
                "#3b82f6",
                "#22c55e",
                "#f59e0b",
                "#8b5cf6"
            ],
            borderWidth: 0,
        }
    ]
});

const optionsmapel = {
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
const optionsKelas = {
    responsive: true,
    maintainAspectRatio: false,

    plugins: {
        legend: {
            position: 'left',
            labels: {
                usePointStyle: true,
                pointStyle: 'circle',
                padding: 20
            }
        },

        tooltip: {
            enabled: true
        }
    },

    scales: {
        r: {
            beginAtZero: true,

            ticks: {
                display: false
            },

            grid: {
                color: '#E5E7EB'
            },

            angleLines: {
                color: '#E5E7EB'
            },

            pointLabels: {
                display: false
            }
        }
    }
}
ChartJS.register( CategoryScale, LinearScale, BarElement,RadialLinearScale, ArcElement, Tooltip, Legend);

onMounted(()=>{
    setTimeout(() => {
        datamapel.value = {
            ...datamapel.value,
            datasets: [
                {
                    ...datamapel.value.datasets[0],
                    data: props?.datamapel,
                },
            ],
        };
        datakelas.value = {
            ...datakelas.value,
            datasets: [
                {
                    ...datakelas.value.datasets[0],
                    data: props?.datakelas
                }
            ]
        }
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
        <section >
            <div style="background-image: url('/assets/hero.png');" class="w-full min-h-80 bg-[#0F0F0F] rounded-lg relative bg-contain bg-no-repeat bg-left flex items-center">
                <div data-aos="zoom-in" style="background-image: url('/assets/brain.jpg');" class="w-80 h-80 absolute right-0 bg-[#0F0F0F] bg-cover" />
                <div class="p-3 font-primary text-white z-10">
                    <h1 data-aos="fade-down" class="text-white/50 font-anonymous">System overview</h1>
                    <h2 data-aos="fade-up" class="text-2xl">Hello, Administrator!</h2>
                    <p data-aos="fade-down" class="text-3xl text-white/80 max-w-sm lg:max-w-xl mb-2">Monitor your platform in real time, manage users efficiently, and gain valuable insights to make better decisions.</p>
                    <CardBorderAnimation data-aos="fade-up">
                        <div class="p-3 rounded-lg font-primary max-w-max bg-black text-white z-50">
                        <p class="font-anonymous text-xs">Academic Calender</p>
                        <div class="flex items-center gap-x-1.5">
                            <p class="text-sm">Tahun Ajaran {{ props?.tahun?.tahun }}</p>
                            <div class="bg-red-500 text-white rounded-full">
                                <svg class="fill-current" width="15px" height="15px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <title>Check</title>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <g id="Check">
                                            <rect id="Rectangle" fill-rule="nonzero" x="0" y="0" width="24" height="24">

                                </rect>
                                            <circle id="Oval" stroke="#0C0310" stroke-width="2" stroke-linecap="round" cx="12" cy="12" r="9">

                                </circle>
                                            <path d="M8.5,12.5 L10.151,14.5638 C10.3372,14.7965 10.6843,14.8157 10.895,14.605 L15.5,10" id="Path" stroke="#0C0310" stroke-width="2" stroke-linecap="round">

                                </path>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                    </CardBorderAnimation>
                </div>
            </div>
        </section>
        <section class="my-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-2.5">
            <div data-aos="zoom-in"  data-aos-offset="0" class="rounded-lg bg-emerald-500 shadow-lg font-primary overflow-hidden max-h-max">
                <div class="ml-1 rounded-lg bg-white w-full flex items-center p-3 gap-x-4">
                    <div class="p-2 rounded-lg bg-emerald-100">
                        <GraduationCap size="40" class="text-emerald-300" />
                    </div>
                    <div class="text-black">
                        <p class="font-anonymous text-xs text-slate-500">Total Studets</p>
                        <p class="text-lg">Across All Classes {{ props?.siswa }}</p>
                    </div>
                </div>
            </div>
            <div data-aos="zoom-in" data-aos-delay="200" data-aos-offset="0" class="rounded-lg bg-red-900 shadow-lg font-primary overflow-hidden max-h-max">
                <div class="ml-1 rounded-lg bg-white w-full flex items-center p-3 gap-x-4">
                    <div class="p-2 rounded-lg bg-red-200">
                        <Speech size="40" class="text-red-400" />
                    </div>
                    <div class="text-black">
                        <p class="font-anonymous text-xs text-slate-500">Total tutors</p>
                        <p class="text-lg">Across All Levels {{ props?.tentor }}</p>
                    </div>
                </div>
            </div>
            <div data-aos="zoom-in" data-aos-delay="400" data-aos-offset="0" class="rounded-lg bg-sky-500 shadow-lg font-primary overflow-hidden max-h-max">
                <div class="ml-1 rounded-lg bg-white w-full flex items-center p-3 gap-x-4">
                    <div class="p-2 rounded-lg bg-sky-200">
                        <Album size="40" class="text-sky-400" />
                    </div>
                    <div class="text-black">
                        <p class="font-anonymous text-xs text-slate-500">Total School Subjects</p>
                        <p class="text-lg">{{ props?.mapel }}</p>
                    </div>
                </div>
            </div>
            <div data-aos="zoom-in" data-aos-delay="600" data-aos-offset="0" class="rounded-lg bg-yellow-500 shadow-lg font-primary overflow-hidden max-h-max">
                <div class="ml-1 rounded-lg bg-white w-full flex items-center p-3 gap-x-4">
                    <div class="p-2 rounded-lg bg-yellow-200">
                        <School size="40" class="text-yellow-400" />
                    </div>
                    <div class="text-black">
                        <p class="font-anonymous text-xs text-slate-500">Total classes</p>
                        <p class="text-lg">{{ props?.kelas }}</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="grid grid-cols-1 gap-5 font-primary text-lg xl:grid-cols-5">
            <div class="p-5 rounded-lg shadow-lg xl:col-span-3">
                <h3>Top 5 Mata Pelajaran</h3>
                <Bar :data="datamapel" :options="optionsmapel" class="max-h-80" />
            </div>
            <div class="p-5 rounded-lg shadow-lg max-w-md xl:col-span-2">
                <PolarArea :data="datakelas" :options="optionsKelas" class="max-h-80" />
            </div>
        </section>
    </Auth>
</template>
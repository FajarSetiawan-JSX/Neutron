<script setup>
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import GradientButton from '@/Components/21Dev/GradientButton.vue';
import { Plus, SquarePen } from "lucide-vue-next";
import TildCard from '@/Components/21Dev/TildCard.vue';
import { Bar } from "vue-chartjs";
import { Chart as ChartJS, CategoryScale, LinearScale, BarElement, Tooltip, Legend, } from "chart.js";
import { onMounted, ref } from 'vue';
import PrimaryLoading from '@/Components/21Dev/PrimaryLoading.vue';
import { eror, success } from '@/Helper.js/Toast';
import axios from 'axios';
import { formatDate, formatTime } from '@/Helper.js/DateTime';
import PaginationSimple from '@/Components/PaginationSimple.vue';
import Create from '@/Components/Admin/Tahun/Create.vue';
import Update from '@/Components/Admin/Tahun/Update.vue';

const user = usePage().props?.auth?.user;
const props = defineProps(['tahun', 'label', 'jumlah']);
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
const backgroundColor = Array.from({ length: 5 }, () => {
    return colors[Math.floor(Math.random() * colors.length)];
});
const data = ref({
    labels: ["", "", "", "", ""],
    datasets: [
        {
            data: [0, 0, 0, 0, 0],
            label: ["Siswa"],
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
ChartJS.register(
    CategoryScale,
    LinearScale,
    BarElement,
    Tooltip,
    Legend
);
const loading = ref(false);
const datas = ref({});
const thn = ref({});
const links = ref({});
const modalcreate = ref(false);
const modalupdate = ref(false);
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get('/api/Admin/tahunajarans', {params: {
            page: page
        }})
        datas.value = response?.data?.data;
        links.value = response?.data?.meta;
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message)
    }finally{
        loading.value = false;
    }
}
function handlenext(value){
    if(value){
        get(value)
    }
}
function handleprev(value){
    if(value){
        get(value)
    }
}
function handlesucces(){
    modalcreate.value = false
    get()
}
function handleupdate(data){
    if(data){
        thn.value = data;
        modalupdate.value = true;
    }
}
function handlesuccesupdate(){
    thn.value = {};
    modalupdate.value = false;
    get();
}
function handlecloseupdate(){
    thn.value = {};
    modalupdate.value = false;
}
onMounted(()=>{
    get()
    setTimeout(() => {
        data.value = {
            labels: props.label,
            datasets: [
                {
                    ...data.value.datasets[0],
                    data: props.jumlah,
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
            Tahun Ajaran
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Tahun Ajaran
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
            <div class="w-full rounded-xl bg-cover bg-center overflow-hidden relative" style="background-image: url('/assets/tahun.png');">
                <div class="bg-linear-to-b from-red-500/65 to-black w-full absolute inset-0" />
                <div class="relative z-10 p-5"> 
                    <div class="h-20 md:h-28 lg:h-32" />
                    <div>
                        <h3 data-aos="fade-down" class="font-semibold text-lg md:text-xl lg:text-2xl font-primary text-white z-50 max-w-max px-2.5 bg-black/50 py-1.5 backdrop-opacity-10 rounded-full">Tahun Ajaran</h3>
                        <h4 data-aos="fade-up" class="text-white font-primary text-4xl font-bold my-3 px-2.5">{{ props?.tahun?.tahun }}</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2.5">
                            <div data-aos="fade-left" class="text-xs md:text-sm font-primary text-white/50 font-normal">
                                Buat dan kelola Tahun Ajaran sebagai dasar pengelolaan kelas dan siswa. Tahun ajaran baru memudahkan proses kenaikan kelas, pembentukan kelas, serta menjaga riwayat data akademik tetap terorganisir.
                            </div>
                            <div data-aos="fade-right" class="md:flex md:justify-end md:items-center">
                                <GradientButton color="black" type="button" @click="modalcreate = true" class="flex items-center justify-center gap-2 font-primary py-3 px-6 text-white rounded-xl">
                                    <Plus class="w-5 h-5"/> Buat Tahun Ajaran Baru
                                </GradientButton>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="my-7">
            <Bar :data="data" :options="options" />
        </section>
        <section>
            <h5 class="mb-5 font-bold text-2xl font-primary text-black">Records Tahun Ajaran</h5>
            <div v-if="!loading" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-2">
                <template v-if="datas.length > 0">
                    <TildCard v-for="data in datas" :key="data.id" class="group rounded-xl p-3 hover:shadow-xl transition-all duration-300 hover:-translate-y-1 bg-linear-to-b from-black to-red-900 w-full relative">
                        <div class="relative z-10 p-4"> 
                            <div class="flex justify-between mb-4">
                                <h1 class="text-white font-bold font-primary text-xl">{{ data.tahun }}</h1>
                                <div :class="data.active ? 'bg-emerald-500' : 'bg-white/50'" class="px-2 py-0.5 rounded-full backdrop-blur-sm text-white text-sm">
                                    {{ data.active ?'Active' : 'Off' }}
                                </div>
                            </div>
                            <p class="text-white my-1.5"><span class="text-orange-500 font-anonymous text-2xl font-bold">{{ data?.siswa }}</span> Total siswa</p>
                            <p class="text-white font-primary text-sm">{{ formatDate(data.tanggal) }}</p>
                            <button type="button" @click="handleupdate(data)" class="mt-4 flex justify-start items-center gap-x-2.5 text-white font-semibold text-sm hover:cursor-pointer hover:text-emerald-300 group">
                                <SquarePen size="20" class="group-hover:text-emerald-300 text-white" />
                                <p>Aktifkan Tahun Ajaran</p>
                            </button>
                        </div>
                    </TildCard>
                    <PaginationSimple class="sm:col-span-2 md:col-span-3 xl:col-span-4 my-3.5" :links="links" @next="handlenext" @prev="handleprev" />
                </template>
                <template v-else>
                    <div class="sm:col-span-2 md:col-span-3 xl:col-span-4 font-anonymous text-2xl text-center font-bold flex items-center justify-center h-52 text-red-500">
                        0 Record Tahun Ajaran
                    </div>
                </template>
            </div>
            <div v-else class="flex justify-center items-center h-60">
                <div>
                    <PrimaryLoading :size="80" :class="'stroke-emerald-500'"/>
                    <h5 class="font-anonymous text-red-500 mt-3.5">Fetching data</h5>
                </div>
            </div>
        </section>
        
        <Create v-if="modalcreate" @close="modalcreate = false" @success="handlesucces" />
        <Update v-if="modalupdate" @close="handlecloseupdate" @success="handlesuccesupdate" :data="thn" />
    </Auth>
</template>
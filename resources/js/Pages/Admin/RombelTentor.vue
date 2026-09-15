<script setup>
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import GradientButton from '@/Components/21Dev/GradientButton.vue';
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import {ChevronRight, Plus} from "lucide-vue-next";
import { usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { Bar } from "vue-chartjs";
import { Chart as ChartJS, CategoryScale, LinearScale, BarElement, Tooltip, Legend, } from "chart.js";
import { eror } from '@/Helper.js/Toast';
import axios from 'axios';
import Create from '@/Components/Admin/RombelTentor/Create.vue';
import PaginationCard from '@/Components/PaginationCard.vue';
import BoxLoading3D from '@/Components/21Dev/BoxLoading3D.vue';
import Card from '@/Components/Admin/RombelTentor/Card.vue';
import Update from '@/Components/Admin/RombelTentor/Update.vue';
import Delete from '@/Components/Admin/RombelTentor/Delete.vue';

const user = usePage().props?.auth?.user;
const props = defineProps(['tentor', 'ta', 'tingkat', 'data', 'label']);

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
            label: 'Siswa',
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

const modalcreate = ref(false);
const modalupdate = ref(false);
const modaldelete = ref(false);
const loading = ref(false);
const search = ref(false);
const tingkat = ref(false);
const rombels = ref([]);
const record = ref({});
const links = ref({});
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(`/api/Admin/rombels/${props?.tentor?.id}`);
        rombels.value = response?.data?.data;
        links.value = response?.data?.meta;
    }catch(error){
        console.log(error?.response);
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}

function handleprevpage(page){
    if(page){
        get(page);
    }
}
function handlenextpage(page){
    if(page){
        get(page);
    }
}
function handlepage(page){
    if(page){
        get(page);
    }
}
function handlesuccescreate(){
    get();
    modalcreate.value = false;
}
function handleupdate(value){
    if(value){
        modalupdate.value = true;
        record.value = value;
    }
}
function handlecloseupdate(){
    modalupdate.value = false;
    record.value = {}
}
function handleclosedelete(){
    modaldelete.value = false;
    record.value = {}
}
function handledelete(value){
    if(value){
        modaldelete.value = true;
        record.value = value;
    }
}
function handlesuccesupdate(){
    modalupdate.value = false;
    record.value = {};
    get()
}

function handlesuccesdelete(){
    modaldelete.value = false;
    record.value = '';
    get();
}

onMounted(()=>{
    get()
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
    <Head title="Rombel Tentor" />
    <Auth>
        <template #aside>
            Rombel Tentor
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Rombel Tentor
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

        <section>
            <div class="text-xs lg:text-sm font-primary uppercase tracking-wider text-slate-400 flex items-center gap-x-2"><span data-aos="fade-left" class="text-xs">Rombel</span> <ChevronRight size="20" /> <span data-aos="fade-right" class="px-2 py-1 rounded-lg bg-red-200 text-red-500 text-xs">{{ props?.tentor?.name }}</span></div>
            <div data-aos="fade-up" data-aos-offset="0" class="mb-1 mt-3 font-primary text-3xl font-semibold text-slate-900">
                Rombel TA {{ props?.ta?.tahun }}
            </div>
            <div class="flex flex-wrap items-center justify-between gap-x-3 mb-2">
                <p data-aos="fade-down" data-aos-offset="0" class="text-slate-400 text-sm font-primary">Kelola Rombel {{ props?.tentor?.name }} untuk Tahun Ajaran {{ props?.ta?.tahun }}</p>
            </div>
        </section>

        <section class="my-6">
            <div class="w-full p-5 shadow-xl rounded-lg">
                <Bar :data="data" :options="options" class="h-80" />
            </div>
        </section>

        <section class="my-5">
            <div class="p-3 bg-white rounded-xl flex items-center justify-end flex-wrap font-primary gap-2.5">
                <select v-model="tingkat" class="appearance-none max-w-max rounded-lg border border-slate-300 px-3 py-2 pr-10 focus:outline-none focus:ring-0">
                    <option selected disabled value="">Filter Tingkat</option>
                    <option v-for="tingkat in props?.tingkat" :key="tingkat?.id" :value="tingkat?.id" class="uppercase">{{ tingkat?.tingkat }} - {{ tingkat?.jenjang?.slug }}</option>
                </select>
                <GradientButton color="sky" type="button" @click="modalcreate = true" class="flex items-center justify-center gap-2 font-primary py-3 px-6 text-white rounded-xl">
                    <Plus class="w-5 h-5"/> Tambah Rombel
                </GradientButton>
            </div>
        </section>

        <section class="my-5">
            <template v-if="!loading">
                <template v-if="rombels.length > 0">
                    <section class="my-5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                        <template v-for="rombel in rombels" :key="rombel.id">
                            <Card :rombel="rombel" @edit="handleupdate" @hapus="handledelete" />
                        </template>
                    </section>
                </template>
                <template v-else>
                    <h1 class="my-10 font-anonymous text-red-500 text-center">Tidak ada rombel yang tersedia</h1>
                </template>
            </template>
            <template v-else>
                <div class="flex items-center justify-center">
                    <div>
                        <BoxLoading3D />
                        <h1 class="my-5 font-anonymous text-red-500 text-center">Fetching data</h1>
                    </div>
                </div>
            </template>
        </section>

        <PaginationCard :links="links" :name="'Rombel'" @next="handlenextpage" @page="handlepage" @prev="handleprevpage" />

        <Create v-if="modalcreate" @close="modalcreate = false" @success="handlesuccescreate" :tentor="props?.tentor" :ta="props?.ta" :tingkat="props?.tingkat" />
        <Update v-if="modalupdate" @close="handlecloseupdate" @success="handlesuccesupdate" :tingkat="props?.tingkat" :rombel="record" :tentor="props?.tentor" :ta="props?.ta" />
        <Delete v-if="modaldelete" @close="handleclosedelete" @success="handlesuccesdelete" :rombel="record" />
    </Auth>
</template>
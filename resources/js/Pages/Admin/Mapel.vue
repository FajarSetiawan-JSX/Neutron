<script setup>
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import { usePage } from '@inertiajs/vue3';
import GradientButton from '@/Components/21Dev/GradientButton.vue';
import { Bar } from "vue-chartjs";
import { Chart as ChartJS, CategoryScale, LinearScale, BarElement, Tooltip, Legend, } from "chart.js";
import { onMounted, ref, watch } from 'vue';
import Card from '@/Components/Admin/Mapel/Card.vue';
import PrimaryLoading from '@/Components/21Dev/PrimaryLoading.vue';
import PaginationCard from '@/Components/PaginationCard.vue';
import Create from '@/Components/Admin/Mapel/Create.vue';
import axios from 'axios';
import { Plus } from "lucide-vue-next";
import { eror, success } from '@/Helper.js/Toast';
import Update from '@/Components/Admin/Mapel/Update.vue';
import Delete from '@/Components/Admin/Mapel/Delete.vue';

const user = usePage().props?.auth?.user;
const props = defineProps(['label', 'data']);
const modalcreate = ref(false);
const modalupdate = ref(false);
const modaldelete = ref(false);
const loading = ref(false);
const mapels = ref({});
const links = ref({});
const mpl = ref({}); // 1 data mepel untuk update mapel
const id = ref('') //id untuk hapus mapel
const search = ref('');

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
    labels: [],
    datasets: [
        {
            data: [],
            label: ["Jumlah siswa : "],
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
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get('/api/Admin/mapels', {
            params:{
                page: page,
                search: search.value
            }
        });
        mapels.value = response?.data?.data;
        links.value = response?.data?.meta;
    }catch(error){
        eror(error?.response?.status, error?.response?.statusText);
    }finally{
        loading.value = false;
    }
}

//function emit
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
function handleupdate(mapel){
    if(mapel){
        modalupdate.value = true;
        mpl.value = mapel;
    }
}
function handledelete(value){
    if(value){
        modaldelete.value = true;
        id.value = value;
    }
}
function handlesuccesupdate(){
    modalupdate.value = false;
    mpl.value = {};
    get()
}
function handlesuccesdelete(){
    modaldelete.value = false;
    id.value = '';
    get();
}
// penutup function emit

watch(()=>search.value, (newsearch)=>{
    if(newsearch){
        setTimeout(()=>{
            get();
        }, 1000)
    }
},{immediate:true})
onMounted(() => {
    get()
    setTimeout(() => {
        data.value = {
            labels: props.label,
            datasets: [
                {
                    ...data.value.datasets[0],
                    data: props.data,
                },
            ],
        };
    }, 100);
});
</script>

<template>
    <Head title="Mapel" />
    <Auth>
        <template #aside>
            Mapel
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Mapel
                </h1>
            </div>
            <div class="hidden md:block flex-1 max-w-md mx-8">
                <AnimatedGlowingSearchBar />
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
            <div class="flex items-center md:justify-between">
                <div>
                    <h3 class="text-2xl md:text-4xl font-semibold font-primary text-black mb-1.5">Menejemen Mapel</h3>
                    <p class="md:text-sm text-xs font-primary text-black/50">Kelola Mata Pelajaran dengan statistik akurat.</p>
                </div>
                <GradientButton color="blue" type="button" @click="modalcreate = true" class="flex items-center justify-center gap-2 font-primary py-3 px-6 text-white rounded-xl">
                    <Plus class="w-5 h-5"/> Tambah Mapel
                </GradientButton>
            </div>
        </section>

        <section class="my-6 grid grid-cols-1 gap-3 sm:gap-4 md:gap-6 lg:gap-8 xl:gap-10">
            <Bar :data="data" :options="options" />
        </section>
        <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-2.5 sm:gap-3.5 md:gap-5 lg:gap-7">
            <template v-if="loading">
                <div class="sm:col-span-2 xl:col-span-3 flex items-center justify-center gap-x-2.5">
                    <PrimaryLoading />
                    <h5 class="font-anonymous">Fetching data</h5>
                </div>
            </template>
            <template v-else>
                <template v-if="mapels.length > 0">
                    <template v-for="mapel in mapels" :key="mapel.id">
                        <Card :mapel="mapel" @update="handleupdate" @hapus="handledelete" />
                    </template>
                </template>
                <template v-else>
                    <div class="sm:col-span-2 xl:col-span-3 flex items-center justify-center gap-x-2.5 h-24">
                        <h5 class="font-anonymous text-red-500 text-2xl">Data Mapel kosong</h5>
                    </div>
                </template>
            </template>
            
        </section>
        <section v-if="!loading || mapels.length > 0" class="my-3.5">
            <PaginationCard :links="links" :name="'Mapel'" @next="handlenextpage" @page="handlepage" @prev="handleprevpage" />
        </section>
        <Create v-if="modalcreate" @close="modalcreate = false" @success="handlesuccescreate" />
        <Update v-if="modalupdate" :mapel="mpl" @close="modalupdate = false" @success="handlesuccesupdate" />
        <Delete v-if="modaldelete" :id="id" @close="modaldelete = false" @success="handlesuccesdelete" />
    </Auth>
</template>
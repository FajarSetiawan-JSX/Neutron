<script setup>
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import { usePage } from '@inertiajs/vue3';
import Card from '@/Components/Admin/Tentor/Card.vue';
import { Plus } from "lucide-vue-next";
import GradientButton from '@/Components/21Dev/GradientButton.vue';
import PaginationCard from '@/Components/PaginationCard.vue';
import { Chart as ChartJS, ArcElement, Tooltip, Legend, } from "chart.js";
import { Doughnut } from "vue-chartjs";
import { UsersRound } from "lucide-vue-next";
import { onMounted, ref } from 'vue';
import { useCounter } from '@/Helper.js/counter';
import Create from '@/Components/Admin/Tentor/Create.vue';
import { eror, success } from '@/Helper.js/Toast';
import PrimaryLoading from '@/Components/21Dev/PrimaryLoading.vue';
import axios from 'axios';

const count = useCounter();
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
const data = {
    labels: ["IPA","B Inggris", "Fisika", "Kimia", "Biologi"],
    datasets: [
        {
            data: [1,2,3,4,5],
            backgroundColor,
            borderWidth: 1,
            hoverOffset: 0,
            cutout: "72%",
        },
    ],
};

const options = {
    responsive: true,
    maintainAspectRatio: false,
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
const centerTextPlugin = {
  id: "centerText",
  afterDraw(chart) {
    const { ctx } = chart;
    const meta = chart.getDatasetMeta(0);

    if (!meta.data.length) return;

    const { x, y } = meta.data[0];

    ctx.save();
    ctx.textAlign = "center";
    ctx.textBaseline = "middle";
    ctx.font = "bold 52px Inter";
    ctx.fillStyle = "#1f2937";
    ctx.fillText("📖", x, y);
    ctx.restore();
  },
};
ChartJS.register( ArcElement, Tooltip, Legend, centerTextPlugin);

const user = usePage().props?.auth?.user;
const loading = ref(false);
const search = ref('');
const tentors = ref({});
const links = ref({});
const modalcreate = ref(false);
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get('/api/Admin/tentors', {
            params:{
                page: page,
                search: search.value
            }
        });
        tentors.value = response?.data?.data;
        links.value = response?.data?.meta;
    }catch(error){
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
    modalcreate.value = false;
    success('Berhasil menambah pengajar baru🫡');
}

function wali(){
    get();
}
onMounted(()=>{
    get()
    count.start(16, 80);
})
</script>

<template>
    <Head title="Tentor" />
    <Auth>
        <template #aside>
            Tentor
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Tentor
                </h1>
            </div>
            <div class="hidden md:block flex-1 max-w-md mx-8">
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

        <section>
            <div class="flex items-center md:justify-between">
                <div>
                    <h3 class="text-2xl md:text-4xl font-semibold font-primary text-black mb-1.5">Menejemen Pengajar</h3>
                    <p class="md:text-sm text-xs font-primary text-black/50">Kelola pengajar anda dengan performa terbaik.</p>
                </div>
                <GradientButton color="red" type="button" @click="modalcreate = true" class="flex items-center justify-center gap-2 font-primary py-3 px-6 text-white rounded-xl">
                    <Plus class="w-5 h-5"/> Tambah Pengajar
                </GradientButton>
            </div>
        </section>

        <section class="my-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3 sm:gap-4 md:gap-6 lg:gap-8 xl:gap-10">
            <div class="p-5 aurora-card sm:col-span-2 h-full rounded-lg shadow-lg hover:shadow-2xl transition duration-800">
                <Doughnut
                    :data="data"
                    :options="options"
                />
            </div>
            <div class="p-5">
                <div class="bg-red-800 p-3 rounded-lg font-primary text-white flex flex-col gap-y-4">
                    <UsersRound :size="22" :color="'white'" />
                    <p class="font-semibold text-md">TOTAL PENGAJAR</p>
                    <h5 class="text-4xl font-bold">{{ count.count }}</h5>
                </div>
            </div>
        </section>
        <template v-if="!loading">
            <template v-if="tentors.length > 0">
                <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2.5 md:gap-5 mb-3">
                    <Card v-for="tentor in tentors" :key="tentor.id" :tentor="tentor" @kelas="wali" @mapel="wali" />
                </section>
            </template>
            <template v-else>
                <h1 class="my-5 font-anonymous text-red-500 text-center">Tidak ada data tentor</h1>
            </template>
        </template>
        <template v-else>
            <div class="h-60 w-full flex items-center justify-center">
                <div>
                    <PrimaryLoading size="50" :class="'stroke-emerald-500'" />
                    <h1 class="my-5 font-anonymous text-red-500 text-center">Fetching data</h1>
                </div>
            </div>
        </template>
        <PaginationCard :links="links" :name="'Tentor'" @next="handlenextpage" @page="handlepage" @prev="handleprevpage" />
        <Create v-if="modalcreate" @close="modalcreate = false" @succes="handlesuccescreate" />
    </Auth>
</template>

<style scoped>
.aurora-card{
    position: relative;
    overflow: hidden;
    background: #ffffff;
    isolation: isolate;
}

.aurora-card::before,
.aurora-card::after{
    content:"";
    position:absolute;
    width:380px;
    height:380px;
    border-radius:50%;
    filter:blur(90px);
    opacity:.45;
    animation:auroraMove 10s ease-in-out infinite;
    z-index:-1;
}

.aurora-card::before{
    top:-140px;
    left:-120px;
    background:#ffced7; /* merah */
}

.aurora-card::after{
    right:-120px;
    bottom:-140px;
    background:#82d8fd; /* biru */
    animation-delay:5s;
}

.aurora-card .aurora-3{
    position:absolute;
    width:320px;
    height:320px;
    border-radius:50%;
    background:#facc15; /* kuning */
    filter:blur(90px);
    opacity:.35;
    top:20%;
    left:35%;
    animation:auroraMove2 12s ease-in-out infinite;
    z-index:-1;
}

@keyframes auroraMove{

    0%{
        transform:translate(0,0) scale(1);
    }

    50%{
        transform:translate(70px,60px) scale(1.2);
    }

    100%{
        transform:translate(0,0) scale(1);
    }

}

@keyframes auroraMove2{

    0%{
        transform:translate(0,0);
    }

    50%{
        transform:translate(-70px,-50px);
    }

    100%{
        transform:translate(0,0);
    }

}
</style>
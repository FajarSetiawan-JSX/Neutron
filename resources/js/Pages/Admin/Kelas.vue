<script setup>
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import { usePage } from '@inertiajs/vue3';
import Card from '@/Components/Admin/Kelas/Card.vue';
import { Pie } from "vue-chartjs";
import { Chart as ChartJS, Title, Tooltip, Legend, ArcElement } from "chart.js";
import { onMounted, ref } from 'vue';
import GradientButton from '@/Components/21Dev/GradientButton.vue';
import { Plus } from "lucide-vue-next";
import Create from '@/Components/Admin/Kelas/Create.vue';
import Update from '@/Components/Admin/Kelas/Update.vue';
import Delete from '@/Components/Admin/Kelas/Delete.vue';
import PaginationCard from '@/Components/PaginationCard.vue';
import { eror,success } from '@/Helper.js/Toast';
import axios from 'axios';
import PrimaryLoading from '@/Components/21Dev/PrimaryLoading.vue';

const props = defineProps(['label', 'data', 'tingkat', 'jenjang', 'kelas']);
const modalcreate = ref(false);
const modalupdate = ref(false);
const modaldelete = ref(false);
const loading = ref(false);
const kelases = ref({});
const links = ref({});
const record = ref({});
const id = ref('');

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
    labels: [""],
    datasets: [
        {
            data: [],
            label: ["Total Siswa"],
            backgroundColor: backgroundColor,
            borderRadius: 2,
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
            display: true,
            position: "left", // left | right | top | bottom
            align: "center",
        },
        tooltip: {
            enabled: true,
        },
    },
};
ChartJS.register( Title, Tooltip, Legend, ArcElement );
async function get(page = 1) {
    try{
        loading.value = true
        const response = await axios.get('/api/Admin/kelases', {
            params:{
                page:page
            }
        })
        kelases.value = response?.data?.data;
        links.value = response?.data?.meta;
        console.log(response?.data);
    }catch(error){
        console.log(error?.response);
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
const user = usePage().props?.auth?.user;
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
function handleupdate(kelas){
    if(kelas){
        modalupdate.value = true;
        record.value = kelas;
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
    record.value = {};
    get()
}
function handlesuccesdelete(){
    modaldelete.value = false;
    id.value = '';
    get();
}
// penutup function emit

onMounted(()=>{
    get()
    setTimeout(() => {
        data.value = {
            labels: props?.label,
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
    <Head title="Home" />
    <Auth>
        <template #aside>
            Kelas
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Kelas
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
            <div class="flex items-center md:justify-between flex-wrap gap-y-2.5">
                <div>
                    <h3 class="text-2xl md:text-4xl font-semibold font-primary text-black mb-1.5">Ruang Kelas</h3>
                    <p class="md:text-sm text-xs font-primary text-black/50">Atur kelas, tingkat, serta distribusi siswa dengan mudah dan terstruktur.</p>
                </div>
                <GradientButton color="purple" type="button" @click="modalcreate = true" class="flex items-center justify-center gap-2 font-primary py-3 px-6 text-white rounded-xl">
                    <Plus class="w-5 h-5"/> Tambah Kelas
                </GradientButton>
            </div>
        </section>
        <section class="w-full grid grid-cols-1 lg:grid-cols-3 gap-8 my-5">
            <div class="bg-[#151210] lg:col-span-2 p-5 rounded-lg shadow-sm hover:shadow-2xl transition-all duration-500 hover:bg-[#26211D]">
                <div class="h-96">
                    <Pie :data="data" :options="options" />
                </div>
            </div>
            <div class="grid grid-cols-1 gap-3">
                <div data-aos="fade-up" class="rounded-lg bg-linear-to-r from-red-500 to-red-950 font-primary text-white p-4 overflow-hidden hover:-translate-y-1 transition-all duration-300">
                    <h1 class="font-semibold text-md">TOTAL KELAS</h1>
                    <h1 class="font-bold text-2xl">{{ props?.kelas }}</h1>
                </div>
                <div data-aos="zoom-in" class="relative rounded-lg bg-white overflow-hidden hover:scale-105 transition-all duration-300">
                    <div class="absolute inset-y-0 left-0 w-1 bg-red-500" />
                    <div class="p-4">
                        <h1 class="font-semibold text-md">TINGKAT</h1>
                        <h1 class="font-bold text-2xl text-red-500">{{ props?.tingkat }}</h1>
                    </div>
                </div>
                <div data-aos="fade-down" class="relative rounded-lg bg-white overflow-hidden hover:translate-y-1 transition-all duration-300">
                    <div class="absolute inset-y-0 left-0 w-1 bg-emerald-300" />
                    <div class="p-4">
                        <h1 class="font-semibold text-md">JENJANG</h1>
                        <h1 class="font-bold text-2xl text-emerald-300">{{ props?.jenjang }}</h1>
                    </div>
                </div>
            </div>
        </section>
        <template v-if="!loading">
            <template v-if="kelases.length > 0">
                <section class="my-5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    <template v-for="kelas in kelases" :key="kelas.id">
                        <Card :kelas="kelas" @update="handleupdate" @hapus="handledelete" />
                    </template>
                </section>
            </template>
            <template v-else>
                <h1 class="my-10 font-anonymous text-red-500 text-center">Tidak ada kelas yang tersedia</h1>
            </template>
        </template>
        <template v-else>
            <div>
                <PrimaryLoading size="50" :class="'stroke-emerald-500'" />
                <h1 class="my-5 font-anonymous text-red-500 text-center">Fetching data</h1>
            </div>
        </template>

        <PaginationCard :links="links" :name="'Kelas'" @next="handlenextpage" @page="handlepage" @prev="handleprevpage" />
        <Create v-if="modalcreate" @close="modalcreate = false" @success="handlesuccescreate" />
        <Update v-if="modalupdate" :kelas="record" @close="modalupdate = false" @success="handlesuccesupdate" />
        <Delete v-if="modaldelete" :id="id" @close="modaldelete = false" @success="handlesuccesdelete" />
    </Auth>
</template>
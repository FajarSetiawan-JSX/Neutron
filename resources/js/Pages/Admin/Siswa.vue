<script setup>
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import { usePage } from '@inertiajs/vue3';
import { ChessPawn, ChessBishop, ChessKing, Plus, OctagonAlert, CircleAlert } from "lucide-vue-next";
import { Bar } from "vue-chartjs";
import { Chart as ChartJS, CategoryScale, LinearScale, BarElement, Tooltip, Legend, } from "chart.js";
import { onMounted, ref, watch } from 'vue';
import GradientButton from '@/Components/21Dev/GradientButton.vue';
import { MoreVertical } from "lucide-vue-next";
import Menu from '@/Components/Admin/Siswa/Menu.vue';
import PaginationCard from '@/Components/PaginationCard.vue';
import Create from '@/Components/Admin/Siswa/Create.vue';
import { eror } from '@/Helper.js/Toast';
import axios from 'axios';
import PrimaryLoading from '@/Components/21Dev/PrimaryLoading.vue';
import Kelas from '@/Components/Admin/Siswa/Kelas.vue';
import Delete from '@/Components/Admin/Siswa/Delete.vue';
import Update from '@/Components/Admin/Siswa/Update.vue';
import Mapel from '@/Components/Admin/Siswa/Mapel.vue';

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
const props = defineProps(['tingkats', 'jenjangs', 'kelases', 'ta', 'sd', 'smp', 'sma', 'mapels']);
const user = usePage().props?.auth?.user;
const modalmenu = ref(false);
const modalcreate = ref(false);
const modalclass = ref(false);
const modalmapel = ref(false);
const modalhapus = ref(false);
const modalupdate = ref(false);
const siswa = ref({});
const loading = ref(false);
const siswas = ref([]);
const links = ref({});
const search = ref('');
const jenjang = ref('');
const tingkat = ref('');
const kelas = ref('');
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get('/api/Admin/siswas', {
            params: {
                page: page,
                search: search.value,
                jenjang: jenjang.value,
                tingkat: tingkat.value,
                kelas: kelas.value
            }
        })
        siswas.value = response?.data?.data;
        links.value = response?.data?.meta;
        console.log(response.data);
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message)
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
function showmenu(data){
    modalmenu.value = true;
    siswa.value = data;
}
function closemenu (){
    siswa.value = {};
    modalmenu.value = false;
}
function toggleactive(){
    siswa.value = {};
    modalmenu.value = false;
    get();
}
function openclass(){
    modalmenu.value = false;
    modalclass.value = true;
}
function closeclass(){
    modalclass.value = false;
    siswa.value = {};
}
function openmapel(){
    modalmenu.value = false;
    modalmapel.value = true;
}
function closemapel(){
    modalmapel.value = false;
    siswa.value = {};
}
function openhapus(){
    modalmenu.value = false;
    modalhapus.value = true;
}
function closehapus(){
    modalhapus.value = false;
    siswa.value = {};
}
function openupdate(){
    modalmenu.value = false;
    modalupdate.value = true;
}
function closeupdate(){
    modalupdate.value = false;
    siswa.value = {};
}
function successcreate(){
    modalcreate.value = false;
    get();
}
function succesclass(){
    siswa.value = {};
    modalclass.value = false;
    get()
}
function succeshapus(){
    modalhapus.value = false;
    siswa.value = {};
    //langsung ke kontroller dan ganti pesan sukses di komponen hapus
    //get()
}
function succesmapel(){
    siswa.value = {};
    modalmapel.value = false;
    get()
}
function succesupdate(){
    siswa.value = {};
    modalupdate.value = false;
    get()
}
onMounted(()=>{
    get()
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
watch(()=>search.value, (newsearch)=>{
    if(newsearch){
        setTimeout(()=>{
            get()
        }, 500)
    }
},{immediate:true});
watch(()=>jenjang.value, (newjenjang)=>{
    if(newjenjang){
        setTimeout(()=>{
            get()
        }, 500)
    }
},{immediate:true});
watch(()=>tingkat.value, (newtingkat)=>{
    if(newtingkat){
        setTimeout(()=>{
            get()
        }, 500)
    }
},{immediate:true});
watch(()=>kelas.value, (newkelas)=>{
    if(newkelas){
        setTimeout(()=>{
            get()
        }, 500)
    }
},{immediate:true});
</script>

<template>
    <Head title="Siswa" />
    <Auth>
        <template #aside>
            Siswa
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Siswa
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

        <section class="grid grid-cols-1 gap-3">
            <div class="p-3 rounded-lg shadow-lg">
                <h1 class="text-2xl font-primary text-center mb-2 font-semibold">Grafik kenaikan siswa baru tahun 2026</h1>
                <Bar :data="data" :options="options" class="max-h-80" />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div data-aos="zoom-in" data-aos-offset="0" class="rounded-lg bg-red-900 shadow-lg font-primary overflow-hidden max-h-max">
                    <div class="ml-1 rounded-lg bg-white w-full flex items-center p-3 gap-x-4">
                        <div class="p-2 rounded-lg bg-red-200">
                            <ChessPawn size="40" class="text-red-400" />
                        </div>
                        <div class="text-black">
                            <p class="text-xs text-slate-500">Sekolah Dasar</p>
                            <p class="text-lg text-red-400">Total {{ props?.sd }} siswa</p>
                        </div>
                    </div>
                </div>
                <div data-aos="zoom-in" data-aos-offset="0" data-aos-delay="200" class="rounded-lg bg-sky-500 shadow-lg font-primary overflow-hidden max-h-max">
                    <div class="ml-1 rounded-lg bg-white w-full flex items-center p-3 gap-x-4">
                        <div class="p-2 rounded-lg bg-sky-200">
                            <ChessBishop size="40" class="text-sky-400" />
                        </div>
                        <div class="text-black">
                            <p class="text-xs text-slate-500">Sekolah Menengah Pertama</p>
                            <p class="text-lg text-sky-500">Total {{ props?.smp }} siswa</p>
                        </div>
                    </div>
                </div>
                <div data-aos="zoom-in" data-aos-offset="0" data-aos-delay="400" class="rounded-lg bg-yellow-500 shadow-lg font-primary overflow-hidden max-h-max">
                    <div class="ml-1 rounded-lg bg-white w-full flex items-center p-3 gap-x-4">
                        <div class="p-2 rounded-lg bg-yellow-200">
                            <ChessKing size="40" class="text-yellow-400" />
                        </div>
                        <div class="text-black">
                            <p class="text-xs text-slate-500">Sekolah Menengah Atas</p>
                            <p class="text-lg text-yellow-400">Total {{ props?.sma }} Siswa</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="my-5">
            <div class="p-5 rounded-lg shadow-lg flex gap-x-2 bg-sky-100/50 max-w-max">
                <div class="p-2 bg-amber-100 rounded-lg max-h-max">
                    <CircleAlert size="30" class="text-amber-300" />
                </div>
                <div class="font-primary">
                    <h1 class="text-slate-900 text-lg">Informasi penting</h1>
                    <p class="my-1 text-sm text-slate-500 ml-1">Terdapat 5 siswa yang belum mengambil mata pelajaran apapun.</p>
                    <p class="my-1 text-sm text-slate-500 ml-1">Terdapat 5 siswa yang belum memiliki kelas.</p>
                    <p class="my-1 text-sm text-slate-500 ml-1">Terdapat 5 siswa yang berstatus off.</p>
                </div>
            </div>
        </section>

        <section class="my-5">
            <div class="p-3 bg-white rounded-t-xl flex items-center justify-end flex-wrap font-primary gap-2.5">
                <select v-model="jenjang" class="appearance-none max-w-max rounded-lg border border-slate-300 px-3 py-2 pr-10 focus:outline-none focus:ring-0">
                    <option selected disabled value="">Filter Jenjang</option>
                    <option v-for="jenjang in props.jenjangs" :key="jenjang?.id" :value="jenjang.id" class="uppercase">{{ jenjang.slug }}</option>
                </select>
                <select v-model="tingkat" class="appearance-none max-w-max rounded-lg border border-slate-300 px-3 py-2 pr-10 focus:outline-none focus:ring-0">
                    <option selected disabled value="">Filter Tingkat</option>
                    <option v-for="tingkat in props.tingkats" :key="tingkat?.id" :value="tingkat?.id" class="uppercase">{{ tingkat?.tingkat }} - {{ tingkat?.jenjang?.slug }}</option>
                </select>
                <select v-model="kelas" class="appearance-none max-w-max rounded-lg border border-slate-300 px-3 py-2 pr-10 focus:outline-none focus:ring-0">
                    <option selected disabled value="">Filter Kelas</option>
                    <option v-for="kelas in props.kelases" :key="kelas?.id" :value="kelas?.id" class="capitalize">{{ kelas?.nama }}</option>
                </select>
                <GradientButton type="button" @click="modalcreate = true" class="text-white px-2.5 py-1 rounded-lg flex items-center gap-x-1">
                    <Plus size="20" />
                    Tambah Siswa
                </GradientButton>
            </div>
            <div class="rounded-b-xl bg-white relative mb-5">
                <template v-if="!loading">
                    <div class="overflow-x-scroll custom-scroll">
                        <table class="min-w-[1000px] w-full">
                            <thead class="bg-slate-50 border border-slate-200 sticky top-0 z-30">
                                <tr class="text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                                    <th class="px-6 py-4">No</th>
                                    <th class="px-6 py-4">Nama Siswa</th>
                                    <th class="px-6 py-4">kontak</th>
                                    <th class="px-6 py-4">Sekolah Asal</th>
                                    <th class="px-6 py-4 text-center">Mapel</th>
                                    <th class="px-6 py-4 text-center">Kelas</th>
                                    <th class="px-6 py-4 text-center">Rombel</th>
                                    <th class="px-6 py-4 text-center">Status</th>
                                    <th class="px-6 py-4 text-center"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                <template v-if="siswas.length > 0">
                                    <tr v-for="(siswa, index) in siswas" :key="siswa?.id" class="hover:bg-slate-50 transition">
                                        <td class="px-6 py-4">
                                            {{ links?.from + index }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <img
                                                    :src="`https://ui-avatars.com/api/?name=${encodeURIComponent(siswa?.nama)}&background=EEF2FF&color=4F46E5&bold=true`"
                                                    :alt="siswa?.nama"
                                                    class="h-10 w-10 rounded-full object-cover"
                                                />
                                                <div>
                                                    <p class="font-medium text-slate-700">
                                                        {{ siswa?.nama }}
                                                    </p>
                                                    <p class="text-sm text-slate-400">
                                                        {{ siswa?.nis }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ siswa?.phone }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ siswa?.sekolah }}
                                        </td>
                                        <td :class="siswa.mapel === 0 ? 'text-red-500' : 'text-slate-800'" class="px-6 py-4 text-center flex justify-center items-center">
                                            {{ siswa?.mapel }}
                                        </td>

                                        <template v-if="siswa?.kelas">
                                            <td  class="px-6 py-4 text-center">
                                                {{ siswa.kelas }}
                                            </td>
                                        </template>
                                        <template v-else>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-center">
                                                    <OctagonAlert size="20" class="text-red-500" />
                                                </div>
                                            </td>
                                        </template>
                                        
                                        
                                        <td class="px-6 py-4 flex justify-center items-center">
                                            <OctagonAlert size="20" class="text-red-500" />
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span :class="siswa.status == 1 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-500'" class="rounded-full  px-3 py-1 text-xs font-semibold">
                                                {{ siswa.status == 1 ? 'Aktif' : 'Non aktif' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center relative">
                                            <button @click="showmenu(siswa)" type="button" class="rounded-lg p-2 text-black backdrop-blur transition hover:bg-black/20 hover:text-white">
                                                <MoreVertical class="h-5 w-5" />
                                            </button>
                                        </td> 
                                    </tr>
                                </template>
                                <template v-else>
                                    <tr class="hover:bg-slate-50 transition">
                                        <td colspan="9">
                                            <h1 class="my-10 font-anonymous text-center text-red-500 text-xl">0 Data siswa</h1>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </template>
                <template v-else>
                    <div class="w-full h-96 flex items-center justify-center">
                        <PrimaryLoading size="50" class="stroke-emerald-500" />
                    </div>
                </template>
            </div>
            <PaginationCard :links="links" :name="'Siswa'" @next="handlenextpage" @page="handlepage" @prev="handleprevpage" />
        </section>
        <Menu v-if="modalmenu" :siswa="siswa" @close="closemenu" @active="toggleactive" @kelas="openclass" @mapel="openmapel" @hapus="openhapus" @update="openupdate" />
        <Create v-if="modalcreate" @close="modalcreate = false" @success="successcreate" />
        <Update v-if="modalupdate" :siswa="siswa" @close="closeupdate" @success="succesupdate" />
        <Delete v-if="modalhapus" :siswa="siswa" @close="closehapus" @success="succeshapus" />
        <Kelas v-if="modalclass" :siswa="siswa" :ta="props?.ta" :kelases="props?.kelases" @close="closeclass" @success="succesclass" />
        <Mapel v-if="modalmapel" :siswa="siswa" :mapels="props?.mapels" @close="closemapel" @success="succesmapel" />
    </Auth>
</template>

<style scoped>
/* Chrome, Edge, Safari */
.custom-scroll::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.custom-scroll::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 999px;
}

.custom-scroll::-webkit-scrollbar-thumb {
    background: #94a3b8;
    border-radius: 999px;
    border: 2px solid #f1f5f9;
    transition: background .2s;
}

.custom-scroll::-webkit-scrollbar-thumb:hover {
    background: #64748b;
}

.custom-scroll::-webkit-scrollbar-corner {
    background: transparent;
}

/* Firefox */
.custom-scroll {
    scrollbar-width: thin;
    scrollbar-color: #94a3b8 #f1f5f9;
}
</style>
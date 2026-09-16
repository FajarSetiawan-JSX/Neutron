<script setup>
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import { usePage } from '@inertiajs/vue3';
import { Bar } from "vue-chartjs";
import { Chart as ChartJS, CategoryScale, LinearScale, BarElement, Tooltip, Legend, } from "chart.js";
import { onBeforeUnmount, onMounted, ref, watch } from 'vue';
import { Globe, Info, Trash2 } from "lucide-vue-next";
import GradientButton from '@/Components/21Dev/GradientButton.vue';
import PaginationCard from '@/Components/PaginationCard.vue';
import PrimaryLoading from '@/Components/21Dev/PrimaryLoading.vue';
import { eror, success } from '@/Helper.js/Toast';
import axios from 'axios';
import { formatDate } from '@/Helper.js/DateTime';
import Delete from '@/Components/Admin/Absensi/Delete.vue';
import { useCounter } from '@/Helper.js/counter';

const hadir = [212,331,323,223,129,299,340];
const tidak = [10,25,30,19,22,33,12];
const data = ref({
    labels: ["1", "2", "3", "4", "5", "6", "7"],
    datasets: [
        {
        label: 'Hadir',
        data: [20, 15, 18],
        backgroundColor: '#22c55e',
        },
        {
        label: 'Tidak Hadir',
        data: [12, 19, 14],
        backgroundColor: '#ef4444',
        }
    ]
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
const props = defineProps(['tahun', 'jenjang', 'tingkat', 'total', 'persentase']);
const counttotal = useCounter();
const countpersen = useCounter();
const w = ref(0);
const search = ref('');
const jenjang = ref('');
const tingkat = ref('');
const openMenu = ref(null);
const modaldelete = ref(false);
const absens = ref([]);
const links = ref({});
const loading = ref(false);
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get('/api/Admin/absensi', {
            params: {
                page: page,
                search: search.value,
                jenjang: jenjang.value,
                tingkat: tingkat.value
            }
        });
        console.log(response.data);
        absens.value = response?.data?.data;
        links.value = response?.data?.meta;
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message);
        console.log(error.response);
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
function toggleMenu(id) {
    openMenu.value = openMenu.value === id ? null : id;
}
function closeMenu() {
    openMenu.value = null;
}
function handlesuccessdelete(){
    modaldelete.value = false;
    get();
}
watch((search), (newsearch)=>{
    setTimeout(()=>{
        get()
    }, 1000)
},{immediate:true});
watch((jenjang), (newjenjang)=>{
    setTimeout(()=>{
        get()
    }, 1000)
},{immediate:true});
watch((tingkat), (newtingkat)=>{
    setTimeout(()=>{
        get()
    }, 1000)
},{immediate:true});
onMounted(()=>{
    get();
    counttotal.start(props?.total);
    countpersen.start(Number(props?.persentase).toFixed(4));
    const target = Math.round(props?.persentase);

    const hitung = setInterval(()=>{
        w.value += 1;
        if(w.value >= target){
            w.value = target;
            clearInterval(hitung);
        }
    }, 20);
    document.addEventListener('click', closeMenu);
    setTimeout(() => {
        data.value = {
            ...data.value,
            datasets: [
                {
                    ...data.value.datasets[0],
                    data: hadir,
                },
                {
                    ...data.value.datasets[1],
                    data: tidak,
                },
            ],
        };
    }, 100);
})
onBeforeUnmount(() => {
    document.removeEventListener('click', closeMenu);
});
</script>

<template>
    <Head title="Presensi" />
    <Auth>
        <template #aside>
            Presensi
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Presensi
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
        <section class="grid grid-cols-1 xl:grid-cols-5 gap-5">
            <div class="p-5 rounded-lg shadow-lg hover:bg-slate-100/50 hover:shadow-2xl transition-all duration-800 xl:col-span-4">
                <h1 class="font-primary font-semibold text-black">Global Presensi TA {{ props?.tahun?.tahun }}</h1>
                <h2 class="font-anonymous">Laporan 7 hari terakhir</h2>
                <Bar :data="data" :options="options" class="max-h-80" />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-1 gap-3">
                <div class="rounded-lg bg-emerald-200 shadow-lg max-h-max">
                    <div class="ml-1 rounded-lg bg-white p-3">
                        <div class="flex justify-start items-center gap-x-2 mb-2">
                            <div class="p-2 rounded-lg bg-emerald-100">
                                <Globe size="30" class="text-emerald-300" />
                            </div>
                            <div>
                                <h3 class="font-primary text-black text-lg">Total Global</h3>
                                <p class="font-anonymous text-slate-500 text-sm">{{ counttotal.count }} presensi</p>
                            </div>
                        </div>
                        <div class="w-full">
                            <p class="text-sm font-primary text-slate-400">Maksimal 1.000.000 presensi</p>
                            <div class="w-full rounded-full bg-slate-200">
                                <div :style="{width: `${w}%`}" class="bg-red-500 h-1 rounded-full my-1.5" />
                            </div>
                            <p class="font-anonymous text-black text-sm">{{ countpersen.count }}% mencapai batas maksimal</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg bg-sky-300 shadow-lg max-h-max">
                    <div class="ml-1 rounded-lg bg-sky-100 p-3">
                        <div class="flex justify-start items-start gap-x-2 mb-2">
                            <div class="p-2 rounded-lg bg-sky-300">
                                <Info size="30" class="text-sky-500" />
                            </div>
                            <div>
                                <h3 class="font-primary text-black text-lg">Informasi</h3>
                            </div>
                        </div>
                        <div>
                            <p class="font-primary text-slate-500 text-xs">Lakukan penghapusan data presensi global setiap pergantian Tahun Ajaran.</p>
                            <p class="font-primary text-slate-500 text-xs">Hal tersebut dilakukan guna menjaga sistem tetap optimal.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="my-3.5 relative overflow-visible">
            <div class="flex items-center justify-between flex-wrap bg-white p-3 rounded-t-lg">
                <div class="flex items-center justify-start gap-x-3">
                    <select name="" id="" v-model="tingkat" class="pl-2 py-1 rounded-lg bg-white border-0 ring-1 ring-slate-300 focus:ring-2 focus:ring-sky-300">
                        <option selected disabled value="">Filter Tingkat</option>
                        <option v-for="tingkat in props?.tingkat" :key="tingkat?.id" :value="tingkat?.id">{{ tingkat?.tingkat }}</option>
                    </select>
                    <select name="" id="" v-model="jenjang" class="pl-2 py-1 rounded-lg bg-white border-0 ring-1 ring-slate-300 focus:ring-2 focus:ring-sky-300">
                        <option selected disabled value="">Filter Jenjang</option>
                        <option v-for="jenjang in props?.jenjang" :key="jenjang?.id" :value="jenjang?.id">{{ jenjang?.slug }}</option>
                    </select>
                </div>
                <div class="flex items-center justify-end gap-x-3">
                    <GradientButton color="red" type="button" @click="modaldelete = true" class="px-3 py-1 rounded-lg text-white flex items-center gap-x-2">
                        <Trash2 size="20" />
                        Hapus semua presensi
                    </GradientButton>
                </div>
            </div>
            <div class="overflow-x-scroll bg-white mb-4">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-4">No</th>
                            <th scope="col" class="px-4 py-3">Nama</th>
                            <th scope="col" class="px-4 py-3">Nis</th>
                            <th scope="col" class="px-4 py-3">Mapel</th>
                            <th scope="col" class="px-4 py-3">Kelas Asal</th>
                            <th scope="col" class="px-4 py-3">Tipe</th>
                            <th scope="col" class="px-4 py-3">Tanggal</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="loading">
                            <tr>
                                <td colspan="8">
                                    <div class="my-5">
                                        <PrimaryLoading size="50" :class="'stroke-emerald-500'" />
                                        <h1 class="my-5 font-anonymous text-red-500 text-center">Fetching data kehadiran siswa</h1>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <template v-else>
                            <template v-if="absens.length > 0">
                                <tr v-for="(siswa, index) in absens" :key="siswa?.id" class="border-b">
                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ (links.current_page - 1) * links.per_page + index + 1 }}</th>
                                    <td class="px-4 py-3">{{ siswa?.nama }}</td>
                                    <td class="px-4 py-3">{{ siswa?.nis }}</td>
                                    <td class="px-4 py-3">{{ siswa?.mapel }}</td>
                                    <td class="px-4 py-3">{{ siswa?.kelas }}</td>
                                    <td class="px-4 py-3">{{ siswa?.tipe }}</td>
                                    <td class="px-4 py-3">{{ formatDate(siswa?.tanggal) }}</td>
                                    <!-- <td class="px-4 py-3 flex items-center justify-end relative">
                                        <button @click.stop="toggleMenu(siswa.id)" class="inline-flex items-center text-sm font-medium hover:bg-gray-100 p-1.5 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                            </svg>
                                        </button>
                                        <div v-if="openMenu === siswa.id" @click.stop class="absolute right-13 bottom-0  z-[99] w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                            <ul class="py-1 text-sm">
                                                <li>
                                                    <button @click="console.log('id siswa : ', siswa?.id)" type="button" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 text-gray-700">
                                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                                        </svg>
                                                        Detail
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </td> -->
                                </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="7">
                                        <h1 class="my-5 font-anonymous text-red-500 text-center">Tidak ada kehadiran siswa</h1>
                                    </td>
                                </tr>
                            </template>
                        </template>
                    </tbody>
                </table>
            </div>
            <PaginationCard :links="links" :name="'Kehadiran'" @next="handlenextpage" @page="handlepage" @prev="handleprevpage" />
        </section>
        <Delete v-if="modaldelete" @close="modaldelete = false" @success="handlesuccessdelete" :ta="props?.tahun" />
    </Auth>
</template>
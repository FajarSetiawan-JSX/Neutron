<script setup>
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import { CalendarDays, Layers, Users, BookOpen } from "lucide-vue-next";
import { onBeforeUnmount, onMounted, ref, watch } from 'vue';
import PaginationCard from '@/Components/PaginationCard.vue';
import { eror } from '@/Helper.js/Toast';
import PrimaryLoading from '@/Components/21Dev/PrimaryLoading.vue';

const user = usePage().props?.auth?.user;
const props = defineProps(['rombel']);
const search = ref('');
const loading = ref(false);
const siswas = ref([]);
const links = ref({});
const openMenu = ref(null);

function toggleMenu(id) {
    openMenu.value = openMenu.value === id ? null : id;
}

function closeMenu() {
    openMenu.value = null;
}
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(`/api/Admin/rombel/${props?.rombel?.id}`, {
            params:{
                page: page,
                search: search.value
            }
        });
        siswas.value = response?.data?.data ?? [];
        links.value = response?.data?.meta ?? {};
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
watch(()=>search.value, (newsearch)=>{
    if(newsearch){
        setTimeout(()=>{
            get()
        }, 500)
    }
},{immediate:true});
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
function handleOutsideClick() {
    openMenu.value = null;
}

onBeforeUnmount(() => {
    document.removeEventListener('click', handleOutsideClick);
});
onMounted(()=>{
    document.addEventListener('click', handleOutsideClick);
    get()
})
</script>

<template>
    <Head title="Rombel Detail" />
    <Auth>
        <template #aside>
            Rombel Detail
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Rombel Detail
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
            <div class="w-full overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm font-primary">
                <div class="relative overflow-hidden border-b border-slate-100 px-5 py-6 sm:px-7 sm:py-7">
                    <div class="pointer-events-none absolute -right-24 -top-32 h-72 w-72 rounded-full bg-gradient-to-br from-blue-100/70 via-purple-100/40 to-rose-100/70 blur-2xl"/>
                    <div class="pointer-events-none absolute -right-10 -top-10 h-48 w-48 rounded-full border-[35px] border-rose-100/30"/>
                    <div class="relative flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">
                        <div class="min-w-0">
                            <div class="mb-3 flex flex-wrap items-center gap-3">
                                <span class="inline-flex items-center gap-1.5 text-sm text-slate-500">
                                    <CalendarDays class="h-4 w-4 shrink-0" :stroke-width="1.8"/>
                                    Tahun Ajaran {{ props?.rombel?.tahun?.tahun }}
                                </span>
                            </div>
                            <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                                {{ props?.rombel?.name }}
                            </h2>
                            <p class="text-xs text-slate-500">{{ props?.rombel?.deskripsi ?? '' }}</p>
                            <div data-aos="fade-up" class="mt-2 flex flex-wrap items-center gap-x-2 gap-y-1 text-sm text-slate-500">
                                <div>
                                    <span class="font-sm font-semibold text-slate-700">
                                        {{ props?.rombel?.subjek?.tentor?.name }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-3 p-4 sm:grid-cols-2 lg:grid-cols-4 lg:p-5">
                    <div data-aos="zoom-in" data-aos-offset="0" class="flex min-h-[100px] items-center gap-4 rounded-xl border border-slate-100 bg-slate-50/70 p-4">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <Layers class="h-5 w-5" :stroke-width="1.8" />
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-medium text-slate-500">
                                Tingkat
                            </p>
                            <p class="mt-1 truncate text-sm font-semibold text-blue-600">
                                {{ props?.rombel?.tingkat?.tingkat }}
                            </p>
                        </div>
                    </div>
                    <div data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0" class="flex min-h-[100px] items-center gap-4 rounded-xl border border-slate-100 bg-slate-50/70 p-4">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <Users class="h-5 w-5" :stroke-width="1.8" />
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-medium text-slate-500">
                                Jumlah Siswa
                            </p>
                            <p class="mt-1 text-sm font-semibold text-emerald-600">
                                {{ props?.rombel?.siswa?.length }} Siswa
                            </p>
                        </div>
                    </div>
                    <div data-aos="zoom-in" data-aos-delay="600" data-aos-offset="0" class="flex min-h-[100px] items-center gap-4 rounded-xl border border-slate-100 bg-slate-50/70 p-4">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-purple-50 text-purple-600">
                            <BookOpen class="h-5 w-5" :stroke-width="1.8" />
                        </div>

                        <div class="min-w-0">
                            <p class="text-xs font-medium text-slate-500">
                                Mata Pelajaran
                            </p>
                            <p class="mt-1 line-clamp-2 text-sm font-semibold text-purple-600">
                                {{ props?.rombel?.subjek?.mapel?.nama }}
                            </p>
                        </div>
                    </div>
                    <div data-aos="zoom-in" data-aos-delay="900" data-aos-offset="0" class="flex min-h-[100px] items-center gap-4 rounded-xl border border-slate-100 bg-slate-50/70 p-4">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-600">
                            <CalendarDays class="h-5 w-5" :stroke-width="1.8" />
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-medium text-slate-500">
                                Pertemuan
                            </p>
                            <p class="mt-1 text-sm font-semibold text-orange-600">
                                {{ props?.rombel?.pertemuan?.length }} Pertemuan
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="my-5">
            <div class="max-w-screen-xl">
                <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="w-full md:w-1/2">
                            <h3 class="text-md font-semibold text-slate-800 font-primary">
                                Daftar Siswa
                            </h3>
                        </div>
                    </div>
                    <div class="overflow-x-auto custom-scroll">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-4 py-4">No</th>
                                    <th scope="col" class="px-4 py-3">Nama</th>
                                    <th scope="col" class="px-4 py-3">Nis</th>
                                    <th scope="col" class="px-4 py-3">Sekolah</th>
                                    <th scope="col" class="px-4 py-3">Kelas</th>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="loading">
                                    <tr>
                                        <td colspan="6">
                                            <div class="my-5">
                                                <PrimaryLoading size="50" :class="'stroke-emerald-500'" />
                                                <h1 class="my-5 font-anonymous text-red-500 text-center">Fetching data siswa</h1>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                                <template v-else>
                                    <template v-if="siswas.length > 0">
                                        <tr v-for="(siswa, index) in siswas" :key="siswa?.id" class="border-b">
                                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ (links.current_page - 1) * links.per_page + index + 1 }}</th>
                                            <td class="px-4 py-3">{{ siswa?.nama }}</td>
                                            <td class="px-4 py-3">{{ siswa?.nis }}</td>
                                            <td class="px-4 py-3 max-w-[12rem] truncate">{{ siswa?.sekolah }}</td>
                                            <td class="px-4 py-3">{{ siswa?.kelas }}</td>
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
                                                                Edit
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button type="button" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 text-red-500 dark:hover:text-red-400">
                                                                <svg class="w-4 h-4 mr-2" viewbox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" d="M6.09922 0.300781C5.93212 0.30087 5.76835 0.347476 5.62625 0.435378C5.48414 0.523281 5.36931 0.649009 5.29462 0.798481L4.64302 2.10078H1.59922C1.36052 2.10078 1.13161 2.1956 0.962823 2.36439C0.79404 2.53317 0.699219 2.76209 0.699219 3.00078C0.699219 3.23948 0.79404 3.46839 0.962823 3.63718C1.13161 3.80596 1.36052 3.90078 1.59922 3.90078V12.9008C1.59922 13.3782 1.78886 13.836 2.12643 14.1736C2.46399 14.5111 2.92183 14.7008 3.39922 14.7008H10.5992C11.0766 14.7008 11.5344 14.5111 11.872 14.1736C12.2096 13.836 12.3992 13.3782 12.3992 12.9008V3.90078C12.6379 3.90078 12.8668 3.80596 13.0356 3.63718C13.2044 3.46839 13.2992 3.23948 13.2992 3.00078C13.2992 2.76209 13.2044 2.53317 13.0356 2.36439C12.8668 2.1956 12.6379 2.10078 12.3992 2.10078H9.35542L8.70382 0.798481C8.62913 0.649009 8.5143 0.523281 8.37219 0.435378C8.23009 0.347476 8.06631 0.30087 7.89922 0.300781H6.09922ZM4.29922 5.70078C4.29922 5.46209 4.39404 5.23317 4.56282 5.06439C4.73161 4.8956 4.96052 4.80078 5.19922 4.80078C5.43791 4.80078 5.66683 4.8956 5.83561 5.06439C6.0044 5.23317 6.09922 5.46209 6.09922 5.70078V11.1008C6.09922 11.3395 6.0044 11.5684 5.83561 11.7372C5.66683 11.906 5.43791 12.0008 5.19922 12.0008C4.96052 12.0008 4.73161 11.906 4.56282 11.7372C4.39404 11.5684 4.29922 11.3395 4.29922 11.1008V5.70078ZM8.79922 4.80078C8.56052 4.80078 8.33161 4.8956 8.16282 5.06439C7.99404 5.23317 7.89922 5.46209 7.89922 5.70078V11.1008C7.89922 11.3395 7.99404 11.5684 8.16282 11.7372C8.33161 11.906 8.56052 12.0008 8.79922 12.0008C9.03791 12.0008 9.26683 11.906 9.43561 11.7372C9.6044 11.5684 9.69922 11.3395 9.69922 11.1008V5.70078C9.69922 5.46209 9.6044 5.23317 9.43561 5.06439C9.26683 4.8956 9.03791 4.80078 8.79922 4.80078Z" />
                                                                </svg>
                                                                Delete
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td> -->
                                        </tr>
                                    </template>
                                    <template v-else>
                                        <tr>
                                            <td colspan="5">
                                                <h1 class="my-5 font-anonymous text-red-500 text-center">Tidak ada data siswa</h1>
                                            </td>
                                        </tr>
                                    </template>
                                </template>
                            </tbody>
                        </table>
                    </div>
                    <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" />
                </div>
            </div>
        </section>
        <PaginationCard :links="links" :name="'Siswa'" @next="handlenextpage" @page="handlepage" @prev="handleprevpage" />
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
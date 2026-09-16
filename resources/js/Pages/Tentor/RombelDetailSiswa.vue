<script setup>
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { eror } from '@/Helper.js/Toast';
import { onBeforeUnmount, onMounted, ref, watch } from 'vue';
import PaginationCard from '@/Components/PaginationCard.vue';
import PrimaryLoading from '@/Components/21Dev/PrimaryLoading.vue';
import { ChevronRight } from "lucide-vue-next";
import Search from '@/Components/21Dev/Search.vue';

const user = usePage().props?.auth?.user;
const isOpen = ref(false);
const search = ref('');
const props = defineProps(['rombel']);
const loading = ref(false);
const siswas = ref([]);
const links = ref({});
const openMenu = ref(null);

function toggleMenu(id) {
    openMenu.value = openMenu.value === id ? null : id;
}
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(`/api/Tentor/rombel/${props?.rombel?.id}`, {
            params: {
                page: page,
                search: search.value
            }
        });
        siswas.value = response?.data?.data ?? []
        links.value = response?.data?.meta ?? {};
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
function closeMenu() {
    openMenu.value = null;
}
watch((search), (newsearch)=>{
    setTimeout(()=>{
        get()
    }, 1000)
}, {immediate:true})
onMounted(()=>{
    document.addEventListener('click', closeMenu);
    get()
    console.log(props.rombel);
})
onBeforeUnmount(() => {
    document.removeEventListener('click', closeMenu);
});
</script>

<template>
    <Head title="Rombel Detail" />
    <Auth>
        <template #aside>
            Rombel Detail Siswa
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Rombel Detail Siswa
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
            <div>
                <h3 class="text-lg lg:text-2xl font-semibold font-primary text-slate-500 mb-1.5 flex items-center justify-start gap-x-1">Rombel <span><ChevronRight size="20" /></span> <span class="text-black">{{ props?.rombel?.name }}</span></h3>
                <p class="md:text-sm text-xs font-primary text-black/50">Detail siswa rombel {{ props?.rombel?.name }} Tahun Ajaran {{ props?.rombel?.tahun?.tahun }}</p>
            </div>
        </section>
        

        <section class="my-5">
            <div class="p-3 shadow-sm bg-white flex items-center justify-between gap-x-3 my-5">
                <Search v-model="search" placeholder="Cari siswa..." />
            </div>
            <div class="max-w-screen-xl">
                <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="w-full md:w-1/2">
                            <h3 class="text-md font-semibold text-slate-500 font-primary">
                                Daftar Siswa Rombel <span class="text-slate-700">{{ props?.rombel?.name }}</span>
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
                                    <th scope="col" class="px-4 py-3">Kelas Asal</th>
                                    <!-- <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th> -->
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
                                            <td colspan="">
                                                <h1 class="my-5 font-anonymous text-red-500 text-center">Tidak ada siswa</h1>
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
            <div class="my-5">
                <PaginationCard :links="links" :name="'Siswa'" @next="handlenextpage" @page="handlepage" @prev="handleprevpage" />
            </div>
        </section>
    </Auth>
</template>

<style scoped>

</style>
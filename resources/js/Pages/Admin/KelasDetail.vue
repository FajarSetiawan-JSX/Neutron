<script setup>
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { eror } from '@/Helper.js/Toast';
import { onMounted, ref } from 'vue';
import { ChevronRight, BookOpenText, CloudUpload, Save } from "lucide-vue-next";
import PaginationCard from '@/Components/PaginationCard.vue';
import PrimaryLoading from '@/Components/21Dev/PrimaryLoading.vue';

const user = usePage().props?.auth?.user;
const props = defineProps(['kelas', 'ta']);
const loading = ref(false);
const siswas = ref([]);
const links = ref({})
async function get() {
    try{
        loading.value = true;
        const response = await axios.get(`/api/Admin/siswa/kelas/${props?.kelas?.id}/${props?.ta?.id}`);
        siswas.value = response?.data?.data ?? [];
        links.value = response?.data?.meta ?? {};
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message);
        console.log(error.response)
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
onMounted(()=>{
    get();
})
</script>

<template>
    <Head title="Kelas Detail" />
    <Auth>
        <template #aside>
            Kelas Detail
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Kelas Detail
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
            <div>
                <h3 class="text-lg lg:text-2xl font-semibold font-primary text-slate-500 mb-1.5 flex items-center justify-start gap-x-1">Kelas<span><ChevronRight size="20" /></span> <span class="text-black">{{ props?.kelas?.nama }}</span></h3>
                <p class="md:text-sm text-xs font-primary text-black/50">Detail kelas {{ props?.kelas?.nama }} Tahun Ajaran {{ props?.ta?.tahun }}</p>
            </div>
        </section>
        
        <section class="my-5">
            <div class="max-w-screen-xl">
                <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <div class="w-full md:w-1/2">
                            <h3 class="text-md font-semibold text-slate-500 font-primary">
                                Total Siswa Aktif <span class="text-slate-700"> {{ siswas?.length }}</span>
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
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-if="!loading">
                                    <template v-if="siswas.length > 0">
                                        <tr v-for="(siswa, index) in siswas" :key="siswa?.id" class="border-b">
                                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ (links.current_page - 1) * links.per_page + index + 1 }}</th>
                                            <td class="px-4 py-3">{{ siswa?.nama }}</td>
                                            <td class="px-4 py-3">{{ siswa?.nis }}</td>
                                            <td class="px-4 py-3 max-w-[12rem] truncate">{{ siswa?.sekolah }}</td>
                                            <td class="px-4 py-3">{{ siswa?.kelas }}</td>
                                        </tr>
                                    </template>
                                    <template v-else>
                                        <tr>
                                            <td colspan="6">
                                                <h1 class="my-5 font-anonymous text-red-500 text-center">Tidak ada siswa</h1>
                                            </td>
                                        </tr>
                                    </template>
                                </template>
                                <template v-else>
                                    <tr>
                                        <td colspan="5">
                                            <PrimaryLoading size="50" :class="'stroke-emerald-500'" />
                                            <h1 class="my-5 font-anonymous text-red-500 text-center">Fetching data</h1>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                    <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"/>
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
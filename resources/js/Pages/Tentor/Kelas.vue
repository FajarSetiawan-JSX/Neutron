<script setup>
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { eror } from '@/Helper.js/Toast';
import { onMounted, ref, watch } from 'vue';
import Card from '@/Components/Tentor/Kelas/Card.vue';
import PaginationCard from '@/Components/PaginationCard.vue';
import PrimaryLoading from '@/Components/21Dev/PrimaryLoading.vue';
import Search from '@/Components/21Dev/Search.vue';

const user = usePage().props?.auth?.user;
const props = defineProps(['tingkats']);
const loading = ref(false);
const search = ref('');
const tingkat = ref('');
const kelases = ref([]);
const links = ref({});
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(`/api/Tentor/kelases/${user?.id}`, {
            params: {
                page: page,
                search: search.value,
                tingkat: tingkat.value
            }
        });
        kelases.value = response?.data?.data ?? [];
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
watch((search), (newsearch)=>{
    setTimeout(()=>{
        get()
    }, 1000)
}, {immediate:true})
watch((tingkat), (newtingkat)=>{
    setTimeout(()=>{
        get()
    }, 1000)
}, {immediate:true})
onMounted(()=>{
    get()
})
</script>

<template>
    <Head title="Kelas" />
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
                <h3 class="text-2xl md:text-4xl font-semibold font-primary text-black mb-1.5">Kelas</h3>
                <p class="md:text-sm text-xs font-primary text-black/50">Pantau dan unduh laporan siswa anda secara sistematis dalam ruang kelas.</p>
            </div>
        </section>

        <section class="my-5">
            <div class="p-3 shadow-sm bg-white flex items-center justify-between my-5">
                <div>
                    <Search v-model="search" placeholder="Cari rombel..." />
                </div>
                <select name="" id="" v-model="tingkat" class="rounded-lg border-0 ring-1 ring-slate-500">
                    <option selected disabled value="">Filter Tingkat</option>
                    <option v-for="tingkat in props?.tingkats" :key="tingkat?.id" :value="tingkat?.id">{{ tingkat?.tingkat }}</option>
                </select>
            </div>

            <template v-if="!loading">
                <template v-if="kelases.length > 0">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        <Card v-for="kelas in kelases" :key="kelas.id" :kelas="kelas" />
                    </div>
                </template>
                <template v-else>
                    <h1 class="my-5 font-anonymous text-red-500 text-center">Tidak ada kelas yang tersedia</h1>
                </template>
            </template>
            <template v-else>
                <div>
                    <PrimaryLoading size="50" :class="'stroke-emerald-500'" />
                    <h1 class="my-5 font-anonymous text-red-500 text-center">Fetching classes data</h1>
                </div>
            </template>
            <div class="my-5">
                <PaginationCard :links="links" :name="'Kelas'" @next="handlenextpage" @page="handlepage" @prev="handleprevpage" />
            </div>
        </section>
    </Auth>
</template>
<script setup>
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { eror } from '@/Helper.js/Toast';
import { onMounted, ref } from 'vue';
import Card from '@/Components/Tentor/Rombel/Card.vue';
import PaginationCard from '@/Components/PaginationCard.vue';
import PrimaryLoading from '@/Components/21Dev/PrimaryLoading.vue';

const user = usePage().props?.auth?.user;
const props = defineProps(['ta']);
const loading = ref(false);
const rombels = ref([]);
const links = ref({});
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get('/api/Tentor/rombel');
        console.log(response?.data?.data);
        rombels.value = response?.data?.data ?? []
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
onMounted(()=>{
    get()
})
</script>

<template>
    <Head title="Rombel" />
    <Auth>
        <template #aside>
            Rombel
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Rombel
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

        <section>
            <div>
                <h3 class="text-2xl md:text-4xl font-semibold font-primary text-black mb-1.5">Rombel</h3>
                <p class="md:text-sm text-xs font-primary text-black/50">Mulai pembelajaran pada Tahun Ajaran <span class="text-black/70">{{ props?.ta?.tahun }}</span></p>
            </div>
        </section>

        <section class="my-5">
            <div class="p-3 shadow-sm bg-white flex items-center justify-end my-5">
                <select name="" id="" class="rounded-lg border-0 ring-1 ring-slate-500">
                    <option value="">Filter Tingkat</option>
                </select>
            </div>

            <template v-if="!loading">
                <template v-if="rombels.length > 0">
                    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">
                        <Card v-for="rombel in rombels" :key="rombel.id" :rombel="rombel" />
                    </div>
                </template>
                <template v-else>
                    <h1 class="my-5 font-anonymous text-red-500 text-center">Tidak ada rombel yang tersedia pada Tahun Ajaran {{ props?.ta?.tahun }}</h1>
                </template>
            </template>
            <template v-else>
                <div>
                    <PrimaryLoading size="50" :class="'stroke-emerald-500'" />
                    <h1 class="my-5 font-anonymous text-red-500 text-center">Fetching rombels data</h1>
                </div>
            </template>
            <div class="my-5">
                <PaginationCard :links="links" :name="'Rombel'" @next="handlenextpage" @page="handlepage" @prev="handleprevpage" />
            </div>
        </section>
    </Auth>
</template>
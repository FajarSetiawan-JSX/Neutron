<script setup>
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { eror } from '@/Helper.js/Toast';
import { onMounted, ref, watch } from 'vue';
import PaginationCard from '@/Components/PaginationCard.vue';
import PrimaryLoading from '@/Components/21Dev/PrimaryLoading.vue';
import CardDetail from '@/Components/Tentor/Kelas/CardDetail.vue';
import { CalendarDays, GraduationCap, User, UserCheck, Users } from "lucide-vue-next";
import { formatDate } from '@/Helper.js/DateTime';
import { useCounter } from '@/Helper.js/counter';
import Search from '@/Components/21Dev/Search.vue';

const total = useCounter();
const aktif = useCounter();
const persentase = ref(0);
const search = ref('')
const user = usePage().props?.auth?.user;
const props = defineProps(['kelas', 'total', 'aktif', 'ta']);
const loading = ref(false);
const siswas = ref([]);
const links = ref({});
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(`/api/Tentor/kelas/${props?.kelas?.id}/siswa/${props?.ta?.id}`, {
            params: {
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
}, 1000)
onMounted(()=>{
    total.start(props?.total);
    aktif.start(props?.aktif);
    setTimeout(()=>{
        persentase.value = (props?.aktif / props?.total) * 100;
    }, 500)
    get()
    console.log(props.kelas)
})
</script>

<template>
    <Head title="Kelas" />
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
                <h3 data-aos="fade-down" class="text-2xl md:text-4xl font-semibold font-primary text-black mb-1.5">Ruang Kelas</h3>
                <p data-aos="fade-up" class="md:text-sm text-xs font-primary text-black/50">Detail siswa kelas <span class="text-black/80">{{ props?.kelas?.nama }}</span> untuk Tahun Ajaran <span class="text-black/80">{{ props?.ta?.tahun }}</span></p>
            </div>
        </section>

        <section class="my-5">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                <div class="relative w-full overflow-hidden rounded-lg border border-slate-200 bg-white p-3 shadow-sm z-0 lg:col-span-2">
                    <GraduationCap :size="72" :stroke-width="1.5" class="absolute right-3 top-3 text-red-100 z-20"/>
                    <div class="relative z-10 flex items-start justify-between font-primary">
                        <div>
                            <div data-aos="fade-up" class="flex items-center gap-2">
                                <h3 class="text-3xl font-semibold text-slate-800">
                                    {{ props?.kelas?.nama }}
                                </h3>
                            </div>

                            <div data-aos="fade-down" class="mt-1 flex items-center gap-1 text-sm text-slate-400">
                                <CalendarDays :size="20" />
                                <span>Dibuat: {{ formatDate(props?.kelas?.created_at) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="relative z-10 mt-4 grid grid-cols-2 gap-2">
                        <div class="flex min-w-0 items-center gap-2 rounded-md bg-slate-50 px-2.5 py-2">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-50 text-red-400">
                                <GraduationCap :size="30" />
                            </div>

                            <div class="min-w-0">
                                <p class="text-sm text-slate-400">
                                    Tingkat
                                </p>
                                <p class="truncate text-md font-medium text-slate-700">
                                    {{ props?.kelas?.tingkat?.tingkat }}
                                </p>
                            </div>
                        </div>
                        <div class="flex min-w-0 items-center gap-2 rounded-md bg-slate-50 px-2.5 py-2">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-red-50 text-red-400">
                                <User :size="30" />
                            </div>

                            <div class="min-w-0">
                                <p class="text-sm text-slate-400">
                                    Wali kelas
                                </p>

                                <p class="truncate text-md font-medium text-slate-700">
                                    {{ props?.kelas?.wali?.wali?.name }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full rounded-lg border border-slate-200 bg-white p-3 shadow-sm">
                    <div data-aos="flip-up" class="flex items-center gap-2 font-primary">
                        <div class="flex h-7 w-7 items-center justify-center text-red-500">
                            <Users :size="20" />
                        </div>
                        <h3 class="text-md font-semibold text-slate-700">
                            Statistik Siswa
                        </h3>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-sm text-slate-500">
                            Total Siswa
                        </span>
                        <span class="text-md font-semibold text-slate-700">
                            {{ total.count }}
                        </span>
                    </div>
                    <div class="mt-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1">
                                <UserCheck :size="17" class="text-slate-400" />
                                <span class="text-sm text-slate-500">
                                    Siswa Aktif
                                </span>
                            </div>

                            <span class="text-md font-semibold text-red-500">
                                {{ aktif.count }}
                            </span>
                        </div>
                        <div class="mt-1.5 h-1 w-full overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full bg-red-500 transition-all duration-300" :style="{ width: `${persentase}%`}"/>
                        </div>
                        <p class="text-right text-sm font-anonymous">{{ persentase }} %</p>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="my-5">
            <div class="p-3 shadow-sm bg-white my-5">
                <Search v-model="search" placeholder="Cari siswa..." />
            </div>
            <template v-if="!loading">
                <template v-if="siswas.length > 0">
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                        <CardDetail v-for="siswa in siswas" :key="siswa?.id" :siswa="siswa" />
                    </div>
                </template>
                <template v-else>
                    <h1 class="my-5 font-anonymous text-red-500 text-center">Tidak ada siswa yang tersedia</h1>
                </template>
            </template>
            <template v-else>
                <div>
                    <PrimaryLoading size="50" :class="'stroke-emerald-500'" />
                    <h1 class="my-5 font-anonymous text-red-500 text-center">Fetching data</h1>
                </div>
            </template>
            <div class="my-5">
                <PaginationCard :links="links" :name="'Siswa'" @next="handlenextpage" @page="handlepage" @prev="handleprevpage" />
            </div>
        </section>
    </Auth>
</template>
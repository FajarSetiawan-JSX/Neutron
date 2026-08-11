<script setup>
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import GradientButton from '@/Components/21Dev/GradientButton.vue';
import PrimaryLoading from '@/Components/21Dev/PrimaryLoading.vue';
import Card from '@/Components/Admin/Ujian/Card.vue';
import PaginationCard from '@/Components/PaginationCard.vue';
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import {ChevronRight, Plus, GalleryVerticalEnd, ShieldCheck, ShieldX} from "lucide-vue-next";
import { onMounted, ref, watch } from 'vue';
import { eror, success } from '@/Helper.js/Toast';
import axios from 'axios';
import Delete from '@/Components/Admin/Ujian/Delete.vue';
import Create from '@/Components/Admin/Ujian/Create.vue';
import Update from '@/Components/Admin/Ujian/Update.vue';

const user = usePage().props?.auth?.user;
const props = defineProps(['total', 'active', 'nonactive'])
const modalcreate = ref(false);
const modaldelete = ref(false);
const modalupdate = ref(false);
const loading = ref(false);
const filter = ref('');
const ujians = ref({});
const links = ref({});
const data = ref({});
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get('/api/Admin/ujians', {
            params: {
                page: page,
                filter: filter.value
            }
        });
        ujians.value = response?.data?.data;
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
function hapus(ujian){
    data.value = ujian
    modaldelete.value = true;
}
function closehapus(){
    data.value = {};
    modaldelete.value = false;
}
function successhapus(){
    success('Berhasil menghapus tipe data')
    data.value = {};
    modaldelete.value = false;
    get();
}
function successcreate(){
    get();
    modalcreate.value = false;
}
function update(ujian){
    data.value = ujian;
    modalupdate.value = true;
}
function closeupdate(){
    data.value = {};
    modalupdate.value = false;
}
function successupdate(){
    modalupdate.value = false;
    data.value = {};
    get()
}
watch(()=>filter.value, (newfilter)=>{
        setTimeout(()=>{
            get()
        },1000)
}, {immediate:true})
onMounted(()=>{
    get();
})
</script>

<template>
    <Head title="Tipe Ujian" />

    <Auth>
        <template #aside>
            Tipe Ujian
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Tipe Ujian
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
            <div class="text-xs lg:text-sm font-primary uppercase tracking-wider text-slate-400 flex items-center gap-x-2"><span data-aos="fade-left" class="text-xs">Master data</span> <ChevronRight size="20" /> <span data-aos="fade-right" class="px-2 py-1 rounded-lg bg-red-200 text-red-500 text-xs">Tipe Ujian</span></div>
            <div data-aos="fade-up" data-aos-offset="0" class="mb-1 mt-3 font-primary text-3xl font-semibold text-slate-900">
                Manajemen Tipe Ujian
            </div>
            <div class="flex flex-wrap items-center justify-between gap-x-3 mb-2">
                <p data-aos="fade-down" data-aos-offset="0" class="text-slate-400 text-sm font-primary">Kustomisasi tipe ujian berdasarkan kurikulum saat ini dan ukur kemampuan siswa anda.</p>
                <GradientButton color="red" type="button" @click="modalcreate = true" class="flex items-center justify-center gap-2 font-primary py-3 px-6 text-white rounded-xl">
                    <Plus class="w-5 h-5"/> Tambah Ujian
                </GradientButton>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5 my-5">
                <div data-aos="zoom-in" data-aos-offset="0" class="bg-sky-500 rounded-lg w-full shadow-xl">
                    <div class="rounded-lg p-2 ml-1 bg-white w-full h-full flex items-center justify-start gap-x-2">
                        <div class="p-2 rounded-lg bg-sky-200">
                            <GalleryVerticalEnd size="30" class="text-sky-400" />
                        </div>
                        <div class="font-primary">
                            <h1 class="text-lg font-semibold">Total ujian</h1>
                            <h2 class="text-sm text-sky-400">{{ props?.total ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
                <div data-aos="zoom-in" data-aos-delay="300" data-aos-offset="0" class="bg-emerald-500 rounded-lg w-full shadow-xl">
                    <div class="rounded-lg p-2 ml-1 bg-white w-full h-full flex items-center justify-start gap-x-2">
                        <div class="p-2 rounded-lg bg-emerald-200">
                            <ShieldCheck size="30" class="text-emerald-400" />
                        </div>
                        <div class="font-primary">
                            <h1 class="text-sm font-semibold">Ujian active</h1>
                            <h2 class="text-sm text-emerald-400">{{ props?.active ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
                <div data-aos="zoom-in" data-aos-delay="600" data-aos-offset="0" class="bg-red-500 rounded-lg w-full shadow-xl">
                    <div class="rounded-lg p-2 ml-1 bg-white w-full h-full flex items-center justify-start gap-x-2">
                        <div class="p-2 rounded-lg bg-red-200">
                            <ShieldX size="30" class="text-red-400" />
                        </div>
                        <div class="font-primary">
                            <h1 class="text-sm font-semibold">Ujian non active</h1>
                            <h2 class="text-sm text-red-400">{{ props?.nonactive ?? 0 }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="my-5">
            <div class="flex items-center justify-between p-3 border-1 border-slate-100 bg-white shadow-md">
                <p class="font-primary text-md font-semibold">Daftar Tipe Ujian</p>
                <select v-model="filter" name="" id="" class="border-1 border-slate-200 rounded-lg">
                    <option disabled selected value="">Filter Status</option>
                    <option :value="1">Aktif</option>
                    <option :value="0">Non aktif</option>
                </select>
            </div>
        </section>
        
        <section class="my-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3 gap-5">
            <template v-if="!loading">
                <template v-if="ujians.length > 0">
                    <Card v-for="ujian in ujians" :key="ujian.id" :ujian="ujian" @hapus="hapus" @update="update" />
                </template>
                <template v-else>
                    <div class="sm:col-span-2 md:col-span-3 lg:col-span-2 xl:col-span-3 py-7">
                        <h1 class="my-5 font-anonymous text-red-500 text-center">0 data ujian</h1>
                    </div>
                </template>
            </template>
            <template v-else>
                <div class="sm:col-span-2 md:col-span-3 lg:col-span-2 xl:col-span-3 h-80 flex items-center justify-center">
                    <div>
                        <PrimaryLoading size="50" :class="'stroke-emerald-500'" />
                        <h1 class="my-5 font-anonymous text-red-500 text-center">Fetching data</h1>
                    </div>
                </div>
            </template>
        </section>
        <section>
            <PaginationCard :name="'Tipe Ujian'" :links="links" @next="handlenextpage" @page="handlepage" @prev="handleprevpage" />
        </section>
        <Create v-if="modalcreate" @close="modalcreate = false" @success="successcreate" />
        <Update v-if="modalupdate" :ujian="data" @close="closeupdate" @success="successupdate" />
        <Delete v-if="modaldelete" :id="data?.id" @close="closehapus" @success="successhapus" />
    </Auth>
</template>

<style scoped>

</style>
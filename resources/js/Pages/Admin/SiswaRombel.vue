<script setup>
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import { onMounted, ref, watch } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { ChevronRight, Plus } from "lucide-vue-next";
import Search from '@/Components/21Dev/Search.vue';
import GradientButton from '@/Components/21Dev/GradientButton.vue';
import PaginationCard from '@/Components/PaginationCard.vue';
import { eror } from '@/Helper.js/Toast';
import axios from 'axios';
import PrimaryLoading from '@/Components/21Dev/PrimaryLoading.vue';
import Card from '@/Components/Admin/RombelSiswa/Card.vue';
import Create from '@/Components/Admin/RombelSiswa/Create.vue';
import Delete from '@/Components/Admin/RombelSiswa/Delete.vue';

const search = ref('');
const user = usePage().props?.auth?.user;
const props = defineProps(['ta', 'siswa', 'kelassiswa']);
const rombels = ref([]);
const data = ref({});
const links = ref({});
const loading = ref(false);
const modalcreate = ref(false);
const modaldelete = ref(false);

async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(`/api/Admin/siswa/${props?.siswa?.id}/rombel/${props?.ta?.id}`, {
            params: {
                page: page,
                search: search.value,
            }
        })
        console.log(response.data);
        rombels.value = response?.data?.data ?? []
        links.value = response?.data?.meta;
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
function successcreate(){
    modalcreate.value = false;
    get();
}
function handleopendelete(record){
    if(record){
        data.value = record;
        modaldelete.value = true;
    }
}
function handleclosedelete(){
    modaldelete.value = false;
    data.value = {};
}
function handlesuccesdelete(){
    modaldelete.value = false;
    data.value = {};
    get();
}
watch((search), (newsearch)=>{
    setTimeout(()=>{
        get()
    },1000);
},{immediate:true});
onMounted(()=>{
    get()
})
</script>

<template>
    <Head title="Rombel Siswa" />
    <Auth>
        <template #aside>
            Rombel Siswa
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Rombel Siswa
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
            <div class="text-xs lg:text-sm font-primary uppercase tracking-wider text-slate-400 flex items-center gap-x-2"><span data-aos="fade-left" class="text-xs">Rombel</span> <ChevronRight size="20" /> <span data-aos="fade-left" class="text-xs">Siswa</span> <ChevronRight size="20" /> <span data-aos="fade-right" class="px-2 py-1 rounded-lg bg-red-200 text-red-500 text-xs">{{ props?.siswa?.nama }}</span></div>
            <div data-aos="fade-up" data-aos-offset="0" class="mb-1 mt-3 font-primary text-3xl font-semibold text-slate-900">
                Rombel TA {{ props?.ta?.tahun }}
            </div>
            <div class="flex flex-wrap items-center justify-between gap-x-3 mb-2">
                <p data-aos="fade-down" data-aos-offset="0" class="text-slate-400 text-sm font-primary">Kelola Rombel {{ props?.siswa?.nama }} untuk Tahun Ajaran {{ props?.ta?.tahun }}</p>
            </div>
        </section>

        <section>
            <div class="grid grid-cols-2 md:grid-cols-1 gap-2.5 p-3 border-1 border-slate-100 bg-white shadow-md">
                <div class="block md:hidden">
                    <Search v-model="search" placeholder="Cari siswa..." />
                </div>
                <div class="flex items-center justify-end gap-x-3">
                    <GradientButton color="red" type="button" @click="modalcreate = true" class="flex items-center justify-center gap-2 font-primary py-3 px-6 text-white rounded-xl">
                        <Plus class="w-5 h-5"/> Tambah Rombel
                    </GradientButton>
                </div>
            </div>
            <div class="my-5">
                <template v-if="loading">
                    <PrimaryLoading :size="50" />
                </template>
                <template v-else>
                    <template v-if="rombels.length > 0">
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                            <Card v-for="rombel in rombels" :key="rombel?.id" :rombel="rombel" @hapus="handleopendelete" />
                        </div>
                    </template>
                    <template v-else>
                        <h1 class="my-10 font-anonymous text-red-500 text-center">Belum memilih rombel untuk Tahun Ajaran {{ props?.ta?.tahun }}</h1>
                    </template>
                </template>
            </div>
            <PaginationCard :links="links" :name="'Rombel'" @next="handlenextpage" @page="handlepage" @prev="handleprevpage" />
        </section>

        <Create v-if="modalcreate" @close="modalcreate = false" @success="successcreate" :ta="props?.ta" :tingkat="props?.kelassiswa?.kelas?.tingkat" :siswa="props?.siswa" />
        <Delete v-if="modaldelete" @close="handleclosedelete" @success="handlesuccesdelete" :rombel="data" :siswa="props?.siswa" />
    </Auth>
</template>
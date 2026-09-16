<script setup>
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { eror, success } from '@/Helper.js/Toast';
import { onMounted, ref } from 'vue';
import PaginationCard from '@/Components/PaginationCard.vue';
import PrimaryLoading from '@/Components/21Dev/PrimaryLoading.vue';
import { ChevronDown, CalendarDays, FingerprintPattern, NotepadText, WalletCards, ChevronRight, Plus, CircleCheck, TriangleAlert, ClockPlus } from "lucide-vue-next";
import Menu from '@/Components/Menu.vue';
import GradientButton from '@/Components/21Dev/GradientButton.vue';
import Create from '@/Components/Tentor/Pertemuan/Create.vue';
import { formatDate, formatTime } from '@/Helper.js/DateTime';
import Loading from '@/Components/Tentor/Pertemuan/Loading.vue';

const user = usePage().props?.auth?.user;
const isOpen = ref(false);
const modalcreate = ref(false);

const props = defineProps(['rombel', 'siswa']);
const loading = ref(false);
const openloading = ref(false);
const pertemuans = ref([]);
const links = ref({});
async function get(page = 1) {
    try{
        loading.value = true;
        const response = await axios.get(`/api/Tentor/${props?.rombel?.id}/pertemuans`, {
            params: {
                page: page
            }
        });
        pertemuans.value = response?.data?.data ?? [];
        links.value = response?.data?.meta ?? {}
        pertemuans.value = pertemuans.value.map((item)=>({
            ...item,
            saved: localStorage.getItem(item.id) ? true : false
        }))
        console.log(pertemuans.value);
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
async function done(id) {
    try{
        openloading.value = true;
        const response = await axios.patch(`/api/Tentor/pertemuan/${id}`);
        localStorage.removeItem(id);
        localStorage.removeItem(`nilai-${id}`);
        success('Berhasil menyelesaikan pertemuan');
        get();
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        openloading.value = false;
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
function handlesuccescreate(data){
    modalcreate.value = false
    pertemuans.value.unshift(data);
}
onMounted(()=>{
    get()
    console.log(props?.rombel);
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
                <p class="md:text-sm text-xs font-primary text-black/50">Kelola rombel {{ props?.rombel?.name }} untuk presensi dan nilai pada Tahun Ajaran {{ props?.rombel?.tahun?.tahun }}</p>
            </div>
        </section>
        

        <section class="my-5">
            <div class="p-3 shadow-sm bg-white flex items-center justify-between gap-x-3 my-5">
                <div>
                    <Menu :href="route('tentor.rombel.tambahan', props?.rombel?.id)" class="px-3 py-1 bg-red-500 rounded-sm text-white flex items-center justify-center gap-x-1 hover:bg-red-600 active:scale-95 transition-all duration-300">
                        <ClockPlus size="20" />
                        Tambahan
                    </Menu>
                </div>
                <GradientButton type="button" @click="modalcreate = true" class="text-white px-2.5 py-1 rounded-lg flex items-center gap-x-1">
                    <Plus size="20" />
                    Pertemuan Baru
                </GradientButton>
            </div>

            <template v-if="!loading">
                <template v-if="pertemuans.length > 0">
                    <div v-for="pertemuan in pertemuans" :key="pertemuan?.id" class="meeting-card my-1.5">
                        <button type="button" class="meeting-header" @click="isOpen = isOpen === pertemuan.id ? null : pertemuan?.id">
                            <div class="meeting-left">
                                <div class="meeting-icon">
                                    <CalendarDays :size="15" />
                                </div>
                                <div class="meeting-title">
                                    <template v-if="pertemuan?.tipe == 'Pertemuan'">
                                        <div class="font-primary text-2xl font-semibold">
                                            Pertemuan {{ pertemuan?.pertemuan }}
                                        </div>
                                    </template>
                                    <template v-else>
                                        <div class="font-primary text-2xl font-semibold text-red-500">
                                            Tambahan {{ pertemuan?.pertemuan }}
                                        </div>
                                    </template>
                                    <div class="font-primary text-sm">
                                        {{ pertemuan?.materi }}
                                    </div>
                                </div>
                            </div>
                            <div class="flex shrink-0 items-center gap-3">
                                <span v-if="pertemuan?.status == 1" class="status">SELESAI</span>
                                <TriangleAlert v-if="pertemuan?.saved" size="20" class="text-yellow-300" />
                                <ChevronDown :size="20" class="transition-all duration-300" :class="isOpen === pertemuan?.id ? 'rotate-180' : 'rotate-0'"/>
                            </div>
                        </button>
                        <Transition name="collapse">
                            <div v-if="isOpen === pertemuan?.id" class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                <div class="flex flex-col gap-3 p-2 col-span-2 md:col-span-1">
                                    <span class="text-md font-primary">Tanggal</span>
                                    <span class="text-sm">{{ pertemuan?.tanggal ? formatDate(pertemuan?.tanggal) : 'Baru saja' }}</span>
                                </div>

                                <div class="flex flex-col gap-3 p-2">
                                    <span class="text-md font-primary">Absen</span>
                                    <span class="text-sm">
                                        <strong>{{ pertemuan?.absen ?? 0 }}</strong> / {{ pertemuan?.total }} Total Siswa
                                    </span>
                                </div>
                                <template v-if="pertemuan?.tipe == 'Pertemuan'">
                                    <div class="flex flex-col gap-3 p-2">
                                        <span class="text-md font-primary">Nilai</span>
                                        <span class="text-sm">
                                            <strong>{{ pertemuan?.nilai ?? 0 }}</strong> / {{ pertemuan?.absen ?? 0 }} Siswa Hadir
                                        </span>
                                    </div>
                                </template>
                                <div class="md:col-span-3 col-span-2 my-1.5 px-3 grid grid-cols-1 gap-2">
                                    <template v-if="pertemuan.status == 1">
                                        <Menu :href="route('tentor.pertemuan.detail', pertemuan?.id)" class="w-full py-1.5 rounded-lg bg-sky-400 hover:bg-sky-500 text-white flex items-center justify-center gap-x-2 text-center active:scale-95 transition-all duration-300">
                                            <WalletCards size="20" />
                                            Detail
                                        </Menu>
                                    </template>
                                    <template v-else>
                                        <Menu :href="route('tentor.absen', pertemuan?.id)" class="w-full py-1.5 rounded-lg bg-emerald-400 hover:bg-emerald-500 text-white flex items-center justify-center gap-x-2 text-center active:scale-95 transition-all duration-300">
                                            <FingerprintPattern size="20" />
                                            Absen
                                        </Menu>
                                        <Menu :href="route('tentor.nilai', pertemuan?.id)" class="w-full py-1.5 rounded-lg bg-red-400 hover:bg-red-500 text-white flex items-center justify-center gap-x-2 text-center active:scale-95 transition-all duration-300">
                                            <NotepadText size="20" />
                                            Nilai
                                        </Menu>
                                        <form action="" @submit.prevent="done(pertemuan?.id)">
                                        <button type="submit" class="w-full py-1.5 rounded-lg bg-sky-400 hover:bg-sky-500 text-white flex items-center justify-center gap-x-2 text-center active:scale-95 transition-all duration-300">
                                            <CircleCheck size="20" />
                                            Selesai
                                        </button>
                                        </form>
                                    </template>
                                </div>
                            </div>
                        </Transition>
                    </div>
                </template>
                <template v-else>
                    <h1 class="my-5 font-anonymous text-red-500 text-center">Tidak ada pertemuan pada rombel {{ props?.rombel?.name }}</h1>
                </template>
            </template>
            <template v-else>
                <div>
                    <PrimaryLoading size="50" :class="'stroke-emerald-500'" />
                    <h1 class="my-5 font-anonymous text-red-500 text-center">Fetching Pertemuan</h1>
                </div>
            </template>
            <div class="my-5">
                <PaginationCard :links="links" :name="'Pertemuan'" @next="handlenextpage" @page="handlepage" @prev="handleprevpage" />
            </div>
        </section>

        <Create v-if="modalcreate" @success="handlesuccescreate" @close="modalcreate = false" :rombel="props?.rombel" />
        <Loading v-if="openloading" />
    </Auth>
</template>

<style scoped>
.meeting-card {
    width: 100%;
    overflow: hidden;

    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;

    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
}

/* =========================
   HEADER
========================= */

.meeting-header {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 12px 14px;

    background: transparent;
    border: 0;

    text-align: left;
    cursor: pointer;
}

.meeting-left {
    display: flex;
    align-items: center;
    gap: 10px;

    min-width: 0;
}

.meeting-icon {
    flex-shrink: 0;

    width: 28px;
    height: 28px;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #ef4444;
    background: #fef2f2;
    border-radius: 50%;
}

.meeting-title {
    min-width: 0;
}

.title {
    color: #374151;
    font-size: 12px;
    font-weight: 600;

    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.meeting-meta {
    display: flex;
    align-items: center;
    gap: 6px;

    margin-top: 3px;

    color: #9ca3af;
    font-size: 10px;
}

.meeting-right {
    display: flex;
    align-items: center;
    gap: 12px;

    flex-shrink: 0;
}

.status {
    padding: 3px 8px;

    color: #10b981;
    background: #ecfdf5;

    border-radius: 999px;

    font-size: 8px;
    font-weight: 700;
}

.chevron {
    color: #64748b;

    transition:
        transform 0.25s ease,
        color 0.2s ease;
}

.chevron.rotate {
    transform: rotate(180deg);
}


/* =========================
   COLLAPSE ANIMATION
========================= */

.collapse-enter-active,
.collapse-leave-active {
    transition:
        opacity 0.25s ease,
        transform 0.25s ease,
        max-height 0.5s ease;
}

.collapse-enter-from,
.collapse-leave-to {
    max-height: 0;
    opacity: 0;
    transform: translateY(-6px);
}

.collapse-enter-to,
.collapse-leave-from {
    max-height: 400px;
    opacity: 1;
    transform: translateY(0);
}

/* =========================
   MOBILE
========================= */

@media (max-width: 640px) {
    .meeting-detail {
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .meeting-header {
        padding: 11px 12px;
    }

    .title {
        max-width: 190px;
    }

    .meeting-right {
        gap: 7px;
    }
}
</style>
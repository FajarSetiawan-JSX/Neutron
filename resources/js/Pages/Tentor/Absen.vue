<script setup>
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { eror, success } from '@/Helper.js/Toast';
import { onMounted, ref } from 'vue';
import { ChevronRight, BookOpenText, CloudUpload, Save } from "lucide-vue-next";
import Loading from '@/Components/Tentor/Pertemuan/Loading.vue';

const user = usePage().props?.auth?.user;
const props = defineProps(['pertemuan', 'siswa']);
const closebutton = ref(false);
const siswaaktif = ref([]);
const loading = ref(false);
const form = ref({
   pertemuan: '',
   hadir: [] 
});
async function create() {
    try{
        loading.value = true;
        const response = await axios.post('/api/Tentor/absen/pertemuan', form.value);
        success('Berhasil Absensi');
        closebutton.value = true;
        localStorage.setItem(form?.value?.pertemuan, JSON.stringify(response?.data?.data));
    }catch(error){
        console.log(error.response);
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
function sementara(){
    localStorage.setItem(form?.value?.pertemuan, JSON.stringify(form.value.hadir));
    success('Berhasil menyimpan presensi sementara');
}
onMounted(()=>{
    const saved = localStorage.getItem(props?.pertemuan?.id)
    if(saved){
        form.value.hadir = JSON.parse(saved);
    }
    form.value.pertemuan = props?.pertemuan?.id
    if(props?.siswa?.length > 0){
        siswaaktif.value = props.siswa.filter(item => item.status == 1);
    }
})
</script>

<template>
    <Head title="Absen Siswa" />
    <Auth>
        <template #aside>
            Absen Siswa
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Absen iswa
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
                <h3 class="text-lg lg:text-2xl font-semibold font-primary text-slate-500 mb-1.5 flex items-center justify-start gap-x-1">{{ props?.pertemuan?.rombel?.name }}<span><ChevronRight size="20" /></span> <span class="text-black">Pertemuan {{ props?.pertemuan?.pertemuan }}</span></h3>
                <p class="md:text-sm text-xs font-primary text-black/50">Detail siswa rombel {{ props?.pertemuan?.rombel?.name }} Tahun Ajaran {{ props?.pertemuan?.rombel?.tahun?.tahun }}</p>
                <p class="md:text-sm text-xs font-primary text-black flex items-center gap-x-2 mt-1"><BookOpenText size="20" /> <span>{{ props?.pertemuan?.materi }}</span></p>
            </div>
        </section>
        
        <form action="" @submit.prevent="create">
            <section class="my-5">
                <div class="max-w-screen-xl">
                    <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                            <div class="w-full md:w-1/2">
                                <h3 class="text-md font-semibold text-slate-500 font-primary">
                                    Total Siswa Aktif <span class="text-slate-700"> {{ props?.siswa?.length }}</span>
                                </h3>
                            </div>
                        </div>
                        <div class="overflow-x-auto custom-scroll">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-4 py-4">No</th>
                                        <th scope="col" class="px-4 py-3">Absen</th>
                                        <th scope="col" class="px-4 py-3">Nama</th>
                                        <th scope="col" class="px-4 py-3">Nis</th>
                                        <th scope="col" class="px-4 py-3">Sekolah</th>
                                        <th scope="col" class="px-4 py-3">Kelas Asal</th>
                                        <th scope="col" class="px-4 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="siswaaktif.length > 0">
                                        <tr v-for="(siswa, index) in siswaaktif" :key="siswa?.id" class="border-b">
                                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ index + 1 }}</th>
                                            <td class="px-4 py-3"><input type="checkbox" v-model="form.hadir" :value="siswa?.id" class="border-2 border-sky-500"></td>
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
                                </tbody>
                            </table>
                        </div>
                        <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4">
                            <p class="text-xs font-anonymous text-black">{{ form?.hadir?.length }} <span class="text-black/80">siswa dipilih</span></p>
                        </nav>
                    </div>
                </div>
                <template v-if="props.pertemuan.absensi.length == 0 && !closebutton">
                    <div class="my-5">
                        <div class="p-3 shadow-sm bg-white grid grid-cols-1 gap-3">
                            <button type="submit" class="py-1 bg-emerald-400 text-white hover:bg-emerald-500 flex items-center justify-center w-full rounded-lg gap-x-2 active:scale-95 transition-all duration-300">
                                <CloudUpload size="20" />
                                <span>Submit</span>
                            </button>
                            <button type="button" @click="sementara" class="py-1 bg-sky-600 text-white hover:bg-sky-700 flex items-center justify-center w-full rounded-lg gap-x-2 active:scale-95 transition-all duration-300">
                                <Save size="20" />
                                <span>Simpan sementara</span>
                            </button>
                        </div>
                    </div>
                </template>
            </section>
        </form>
        <Loading v-if="loading" />
    </Auth>
</template>

<style scoped>

</style>
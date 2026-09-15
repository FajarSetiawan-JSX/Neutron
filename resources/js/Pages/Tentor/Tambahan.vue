<script setup>
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { eror, success } from '@/Helper.js/Toast';
import { onMounted, ref } from 'vue';
import { ChevronRight, Undo2, CloudUpload, Save } from "lucide-vue-next";
import Loading from '@/Components/Tentor/Pertemuan/Loading.vue';
import Menu from '@/Components/Menu.vue';

const user = usePage().props?.auth?.user;
const props = defineProps(['rombel', 'siswas']);
const closebutton = ref(false);
const siswaaktif = ref([]);
const loading = ref(false);
const err = ref({});
const form = ref({
    rombel: '',
    materi: '',
    siswa: [] 
});
function clear(){
    err.value = {};
    form.value.materi = '',
    form.value.siswa = [];
}
async function create() {
    try{
        err.value = {};
        loading.value = true;
        const response = await axios.post('/api/Tentor/absen/tambahan', form.value);
        success('Berhasil Absensi Tambahan');
        clear();
    }catch(error){
        if(error.response.status == 422){
            err.value = error?.response?.data?.errors;
        }
        console.log(error.response);
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
onMounted(()=>{
    form.value.rombel = props?.rombel?.id;
})
</script>

<template>
    <Head title="Tambahan" />
    <Auth>
        <template #aside>
            Tambahan
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Tambahan
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
                <h3 class="text-lg lg:text-2xl font-semibold font-primary text-slate-500 mb-1.5 flex items-center justify-start gap-x-1">{{ props?.rombel?.name }}<span><ChevronRight size="20" /></span> <span class="text-black">Tambahan</span></h3>
                <p class="md:text-sm text-xs font-primary text-black/50">Tahun Ajaran {{ props?.rombel?.tahun?.tahun }}</p>
                <Menu :href="route('tentor.rombel.detail', props?.rombel?.id)" class="px-3 py-1.5 my-2 flex items-center justify-start gap-x-1 bg-red-500 max-w-max text-white rounded-md hover:bg-red-600 active:scale-95 transition-all duration-300">
                    <Undo2 size="18" />
                    Kembali
                </Menu>
            </div>
        </section>
        
        <form action="" @submit.prevent="create">
            <section class="my-5">
                <div class="max-w-screen-xl">
                    <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                            <div class="w-full md:w-1/2">
                                <h3 class="text-md font-semibold text-slate-500 font-primary">
                                    Total Siswa <span class="text-slate-700"> {{ props?.siswas?.length }}</span>
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
                                    <template v-if="props?.siswas?.length > 0">
                                        <tr v-for="(siswa, index) in props?.siswas" :key="siswa?.id" class="border-b">
                                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ index + 1 }}</th>
                                            <td class="px-4 py-3"><input type="checkbox" v-model="form.siswa" :value="siswa?.id" class="border-2 border-sky-500"></td>
                                            <td class="px-4 py-3">{{ siswa?.nama }}</td>
                                            <td class="px-4 py-3">{{ siswa?.nis }}</td>
                                            <td class="px-4 py-3 max-w-[12rem] truncate">{{ siswa?.sekolah }}</td>
                                            <td class="px-4 py-3">{{ siswa?.kelas?.kelas?.nama }}</td>
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
                            <p class="text-xs font-anonymous text-black">{{ form?.siswa?.length }} <span class="text-black/80">siswa dipilih</span></p>
                        </nav>
                    </div>

                    <div class="p-3 bg-white rounded-sm my-5 text-sm font-primary shadow-sm grid grid-cols-1 gap-3">
                        <div>
                            <label for="materi" class="text-sm">Materi</label>
                            <textarea id="materi" v-model="form.materi" class="w-full rounded-sm mt-2 border-2 border-slate-300 focus:ring-0 focus:border-red-400"></textarea>
                            <p v-if="err?.materi" class="text-xs font-anonymous text-red-500">{{ err?.materi[0] }}</p>
                        </div>
                    </div>
                </div>
                <div class="my-5">
                    <div class="p-3 shadow-sm bg-white grid grid-cols-1 gap-3">
                        <button type="submit" class="py-1 bg-emerald-400 text-white hover:bg-emerald-500 flex items-center justify-center w-full rounded-lg gap-x-2 active:scale-95 transition-all duration-300">
                            <CloudUpload size="20" />
                            <span>Submit</span>
                        </button>
                    </div>
                </div>
            </section>
        </form>
        <Loading v-if="loading" />
    </Auth>
</template>

<style scoped>

</style>
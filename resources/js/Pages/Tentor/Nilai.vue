<script setup>
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { eror, success } from '@/Helper.js/Toast';
import { onMounted, ref } from 'vue';
import { ChevronRight, NotebookPen, CloudUpload, Save } from "lucide-vue-next";
import Loading from '@/Components/Tentor/Pertemuan/Loading.vue';
import Catatan from '@/Components/Tentor/Nilai/Catatan.vue';

const user = usePage().props?.auth?.user;
const props = defineProps(['pertemuan', 'siswa', 'types']);
const siswas = ref([]);
const modalcatatan = ref(false);
const record = ref({});
const loading = ref(false);
const done = ref(false);
const form = ref({
    tipe: '',
    pertemuan: '',
    data: [] 
});
function buatcatatan(siswa){
    modalcatatan.value = true;
    record.value = siswa;
}
function closecatatan(){
    modalcatatan.value = false;
    record.value = {};
}
function tambahcatatan(value){
    if(value){
        const data = form.value.data.find(item => item.id === record?.value.id);
        data.note = value
    }
    record.value = {};
    modalcatatan.value = false;
}
async function create() {
    try{
        loading.value = true;
        const response = await axios.post('/api/Tentor/nilai/pertemuan', form.value);
        success('Berhasil memasukan nilai');
        localStorage.removeItem(props?.pertemuan?.id);
        localStorage.removeItem(`nilai-${form?.value?.pertemuan}`);
        done.value = true;
    }catch(error){
        console.log(error.response);
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
function getNilai(id) { 
    return form.value.data.find(item => item.id === id)?.nilai ?? ''; 
}
function setNilai(id, value) { 
    const data = form.value.data.find(item => item.id === id); 
    if (data) { 
        data.nilai = value; 
    } 
}
function sementara(){
    localStorage.setItem(`nilai-${form?.value?.pertemuan}`, JSON.stringify(form?.value.data));
    success('Berhasil menyimpan nilai sementara');
}
function addSiswaToForm(siswa) {
    const exists = form.value.data.some(
        item => item.id === siswa.id
    );
    if (!exists) {
        form.value.data.push({
            id: siswa.id,
            nilai: '',
            note: '',
        });
    }
}
function getNote(id) {
    return form.value.data.find(
        item => item.id === id
    )?.note ?? '';
}
function getSiswaAbsen() { 
    const saved = localStorage.getItem( String(props?.pertemuan?.id) ); 
    if (!saved) { 
        siswas.value = []; 
        return; 
    } 
    try { 
        const siswaIds = JSON.parse(saved); 
        if (!Array.isArray(siswaIds)) { 
            siswas.value = []; 
            return; 
        } 
        siswas.value = props.siswa.filter(siswa => siswaIds.includes(siswa.id) ); 
    } catch (error) { 
        eror('Gagal mengambil data siswa',  'Bilang ke developer! local storage eror!')
        siswas.value = []; 
    } 
}
function loadNilaiSementara() {
    const saved = localStorage.getItem(`nilai-${props?.pertemuan?.id}`);
    if (!saved) {
        return;
    }
    try {
        const data = JSON.parse(saved);
        if (!Array.isArray(data)) {
            return;
        }
        data.forEach(item => {
            const exists = form.value.data.find(
                dataItem => dataItem.id === item.id
            );
            if (exists) {
                exists.nilai = item.nilai ?? '';
                exists.note = item.note ?? '';
            } else {
                form.value.data.push({
                    id: item.id,
                    nilai: item.nilai ?? '',
                    note: item.note ?? '',
                });
            }
        });
    } catch (error) {
        eror('Gagal mengambil nilai siswa', 'Bilang ke developer! local storage error!');
    }
}
function syncData() { 
    getSiswaAbsen(); 
    /* | Semua siswa yang sekarang sudah diabsen | dimasukkan ke form. */ 
    siswas.value.forEach(siswa => { 
        addSiswaToForm(siswa); 
    }); 
    /* | Setelah siswa dimasukkan, load nilai sementara. | Nilai siswa lama akan tetap dipertahankan. */ 
    loadNilaiSementara(); 
}
onMounted(()=>{
    console.log(props.pertemuan)
    form.value.pertemuan = props?.pertemuan?.id
    syncData();
})
</script>

<template>
    <Head title="Nilai Siswa" />
    <Auth>
        <template #aside>
            Nailai Siswa
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
                <p class="md:text-sm text-xs font-primary text-black/50">Daftar siswa terpilih presensi</p>
            </div>
        </section>
        
        <form action="" @submit.prevent="create">
            <section class="my-5">
                <div class="max-w-screen-xl">
                    <div class="bg-white relative shadow-md sm:rounded-lg overflow-hidden">
                        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                            <div class="w-full flex items-center justify-between">
                                <h3 class="text-md font-semibold text-slate-500 font-primary">
                                    Total Siswa <span class="text-slate-700"> {{ form?.data?.length }}</span>
                                </h3>
                                <select name="" id="" v-model="form.tipe" class="rounded-lg border-0 ring-2 ring-slate-300 focus:ring-sky-500">
                                    <option value="" disabled selected>Pilih Ujian</option>
                                    <option v-for="tipe in props?.types" :key="tipe.id" :value="tipe.id">{{ tipe?.nama }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="overflow-x-auto custom-scroll">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-4 py-4">No</th>
                                        <th scope="col" class="px-4 py-3">Nilai</th>
                                        <th scope="col" class="px-4 py-3">Nama</th>
                                        <th scope="col" class="px-4 py-3">Nis</th>
                                        <th scope="col" class="px-4 py-3">Catatan</th>
                                        <th scope="col" class="px-4 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-if="siswas.length > 0">
                                        <tr v-for="(siswa, index) in siswas" :key="siswa?.id" class="border-b">
                                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ index + 1 }}</th>
                                            <td class="px-4 py-3"><input type="number" min="0" max="100" :value="getNilai(siswa.id)" @input="setNilai(siswa.id, $event.target.value)" class="w-24 px-3 py-2 border border-slate-300 rounded-lg"/></td>
                                            <td class="px-4 py-3">{{ siswa?.nama }}</td>
                                            <td class="px-4 py-3">{{ siswa?.nis }}</td>
                                            <td class="px-4 py-3">
                                                <template v-if="getNote(siswa?.id)">
                                                    {{ getNote(siswa?.id) }}
                                                </template>
                                                <template v-else>
                                                    <button type="button" @click="buatcatatan(siswa)" class="flex items-center justify-start gap-x-1 px-2 py-0.5 rounded-sm bg-emerald-100 text-slate-500 cursor-pointer hover:bg-emerald-200 transition-all duration-300 active:scale-95">
                                                        <NotebookPen size="15" class="text-emerald-500" />
                                                        buat catatan
                                                    </button>
                                                </template>
                                            </td>
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
                        <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"/>
                    </div>
                </div>
                    <div v-if="props?.pertemuan?.selesai == 0 && !done" class="my-5">
                        <div class="p-3 shadow-sm bg-white grid grid-cols-1 gap-3">
                            <button type="submit" class="py-1 bg-emerald-400 text-white hover:bg-emerald-500 flex items-center justify-center w-full rounded-lg gap-x-2 active:scale-95 transition-all duration-300">
                                <CloudUpload size="20" />
                                <span>Submit</span>
                            </button>
                            <button type="button" @click="sementara" class="py-1 bg-sky-600 text-white hover:bg-sky-700 flex items-center justify-center w-full rounded-lg gap-x-2 active:scale-95 transition-all duration-300">
                                <Save size="20" />
                                <span>Simpan nilai sementara</span>
                            </button>
                        </div>
                    </div>
            </section>
        </form>
        <Loading v-if="loading" />
        <Catatan v-if="modalcatatan" :siswa="record" @close="closecatatan" @tambah="tambahcatatan" />
    </Auth>
</template>

<style scoped>

</style>
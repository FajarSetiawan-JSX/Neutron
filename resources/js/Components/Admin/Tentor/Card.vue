<script setup>
import { ref, onMounted, onBeforeUnmount, computed } from "vue";
import { MoreVertical, Key, Trash2, Mail, Phone, School, User, LibraryBig, CirclePile, Route } from "lucide-vue-next";
import { eror,success } from "@/Helper.js/Toast";
import axios from 'axios';
import Toogle from "@/Components/21Dev/Toogle.vue";
import ChangePass from "./ChangePass.vue";
import Kelas from "./Kelas.vue";
import Mapel from "./Mapel.vue";
import Menu from "@/Components/Menu.vue";

const props = defineProps(['tentor']);
const emit = defineEmits(['kelas', 'mapel']);
const showMenu = ref(false);
const modalchangepass = ref(false);
const modalkelas = ref(false);
const modalmapel = ref(false);

const toggleMenu = () => {
    showMenu.value = !showMenu.value;
};

const closeMenu = (e) => {
    if (!e.target.closest(".menu-wrapper")) {
        showMenu.value = false;
    }
};
const active = computed({
    get: () => props.tentor.active === 1,
    set: val => props.tentor.active = val ? 1 : 0
})
const loading = ref(false);
async function status() {
    try{
        loading.value = true;
        const response = await axios.patch(`/api/Admin/tentor/status/${props?.tentor?.id}`, {
            status: active.value
        });
        success('Berhasil mengubah status akun pengajar.');
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}

function succesclass(){
    modalkelas.value = false;
    emit('kelas');
}
function succesmapel(){
    modalmapel.value = false;
    emit('mapel');
}
onMounted(() => {
    document.addEventListener("click", closeMenu);
});

onBeforeUnmount(() => {
    document.removeEventListener("click", closeMenu);
});
</script>

<template>
    <div class="relative w-full rounded-3xl border border-gray-200 bg-white p-5 shadow-md transition-all hover:shadow-xl">
        <div class="flex items-start justify-between">
            <div class="flex gap-3">
                <img
                    :src="`https://ui-avatars.com/api/?name=${encodeURIComponent(props?.tentor?.nama)}&background=DC2626&color=fff`"
                    class="w-14 h-14 rounded-2xl"
                />
                <div>
                    <h2 class="font-bold text-gray-900">
                        {{ props?.tentor?.nama }}
                    </h2>
                    <span :class="props.tentor.active == 1 ? 'bg-emerald-100 text-teal-600' : 'bg-red-100 text-red-600'" class="px-2 py-1 rounded-lg text-xs">{{ props?.tentor?.active == 1 ? 'Active' : 'Non active' }}</span>
                </div>
            </div>
            <div class="menu-wrapper relative">
                <button @click.stop="toggleMenu" class="rounded-lg p-2 transition hover:bg-gray-100">
                    <MoreVertical :size="20" />
                </button>
                <Transition
                    enter-active-class="transition duration-200"
                    enter-from-class="opacity-0 scale-95"
                    enter-to-class="opacity-100 scale-100"
                    leave-active-class="transition duration-150"
                    leave-from-class="opacity-100 scale-100"
                    leave-to-class="opacity-0 scale-95"
                >
                    <div v-if="showMenu" class="absolute right-0 top-11 z-50 w-40 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-xl">
                        <button type="button" @click="modalkelas = true" class="flex w-full items-center gap-3 px-4 py-3 text-sm transition hover:bg-yellow-50 hover:text-yellow-600">
                            <School :size="17" />
                            Kelas
                        </button>

                        <button type="button" @click="modalmapel = true" class="flex w-full items-center gap-3 px-4 py-3 text-sm transition hover:bg-purple-50 hover:text-purple-600">
                            <LibraryBig :size="17" />
                            Mapel
                        </button>

                        <Menu :href="route('admin.tentor.rombel', props?.tentor?.slug)" :class="'flex w-full items-center gap-3 px-4 py-3 text-sm transition hover:bg-sky-50 hover:text-sky-600'">
                            <CirclePile :size="17" />
                            Rombel
                        </Menu>

                        <button type="button" @click="modalchangepass = true" class="flex w-full items-center gap-3 px-4 py-3 text-sm transition hover:bg-emerald-100 hover:text-emerald-600">
                            <Key :size="17" />
                            Ubah Password
                        </button>

                        <button class="flex w-full items-center gap-3 px-4 py-3 text-sm transition hover:bg-rose-50 hover:text-rose-600">
                            <Route :size="17" />
                            Journey
                        </button>
                    </div>
                </Transition>
            </div>
        </div>
        <div class="mt-5 space-y-3 text-sm text-gray-600">
            <div class="flex items-center gap-2">
                <Mail :size="16" class="text-gray-400" />
                {{ props?.tentor?.email }}
            </div>
            <div class="flex items-center gap-2">
                <Phone :size="16" class="text-gray-400" />
                {{ props?.tentor?.phone }}
            </div>
        </div>
        <div class="mt-5 border-t pt-4 text-sm">
            <p>
                <span class="font-semibold">Mengajar:</span>
                {{ props?.tentor?.mapel?.length }} Mata Pelajaran
            </p>
            <p class="mt-1">
                <span class="font-semibold">Wali Kelas:</span>
                <span v-for="kelas in props?.tentor?.kelas" :key="kelas.id" class="font-semibold text-red-500 mx-1">
                    {{ kelas.nama }}
                </span>
            </p>
            <p>
                <span class="font-semibold">Rombel:</span>
                <span class="font-semibold text-emerald-500">
                    {{ props?.tentor?.rombel }}
                </span>
            </p>
        </div>
        <div class="my-3 text-sm flex items-center justify-end">
            <Toogle v-model="active" :disabled="loading" @change="status" />
        </div>
    </div>
    <ChangePass v-if="modalchangepass" :tentor="props?.tentor" @close="modalchangepass = false" @success="modalchangepass = false" />
    <Kelas v-if="modalkelas" :tentor="props?.tentor" :kelas="props?.tentor?.id_kelas" @close="modalkelas = false" @success="succesclass" />
    <Mapel v-if="modalmapel" :tentor="props?.tentor" :mapel="props?.tentor?.id_mapel" @close="modalmapel = false" @success="succesmapel" />
</template>
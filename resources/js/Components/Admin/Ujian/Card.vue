<script setup>
import Toogle from '@/Components/21Dev/Toogle.vue';
import { Pencil, Trash2 } from 'lucide-vue-next';
import { formatDate } from '@/Helper.js/DateTime';
import { computed, ref } from 'vue';
import axios from 'axios';
import { eror, success } from '@/Helper.js/Toast';

const props = defineProps(['ujian']);
const emit = defineEmits(['hapus', 'update']);
const active = computed({
    get: () => props.ujian.active === 1,
    set: val => props.ujian.active = val ? 1 : 0
})
const loading = ref(false);
async function status() {
    try{
        loading.value = true;
        const response = await axios.patch(`/api/Admin/ujian/status/${props?.ujian?.id}`, {
            status: active.value
        });
        success('Berhasil mengubah Status Tipe Ujian.');
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
</script>

<template>
    <div class="group flex h-full flex-col rounded-3xl border border-slate-200 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
        <!-- Header -->
        <div class="flex items-start justify-between">
            <div class="h-12 w-12 overflow-hidden rounded-full">
                <img
                    :src="`https://ui-avatars.com/api/?name=${encodeURIComponent(props?.ujian?.nama)}`"
                    :alt="props?.ujian?.nama"
                    class="h-full w-full object-cover"
                >
            </div>
            <span :class="props.ujian.active === 1 ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600'" class="rounded-full px-3 py-1 text-xs font-semibold">
                {{ props?.ujian?.active ? 'Aktif' : 'Non aktif' }}
            </span>
        </div>

        <!-- Content -->
        <div class="mt-5 flex-1">
            <h3 class="line-clamp-2 text-lg font-bold text-slate-900">
                {{ props?.ujian?.nama }}
            </h3>

            <p class="mt-1 text-xs text-slate-400">
                Diperbarui : {{ formatDate(props?.ujian?.updated) }}
            </p>

            <p class="mt-4 line-clamp-3 text-sm leading-6 text-slate-500">
                {{ props?.ujian?.deskripsi }}
            </p>
        </div>

        <!-- Footer -->
        <div class="mt-6 flex items-center justify-between">
            <div class="flex gap-2">
                <button type="button" @click="emit('update', props?.ujian)" class="rounded-xl bg-slate-100 p-3 text-slate-500 transition hover:bg-blue-50 hover:text-blue-600">
                    <Pencil :size="16"/>
                </button>

                <button type="button" @click="emit('hapus', props?.ujian)" class="rounded-xl bg-slate-100 p-3 text-slate-500 transition hover:bg-red-50 hover:text-red-600">
                    <Trash2 :size="16"/>
                </button>
            </div>
            <Toogle v-model="active" :disabled="loading" @change="status" />
        </div>
    </div>
</template>
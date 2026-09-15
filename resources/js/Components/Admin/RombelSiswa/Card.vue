<script setup>
import { UserRound, UsersRound, ArrowRight } from 'lucide-vue-next';

const props = defineProps(['rombel']);
const emit = defineEmits(['hapus'])
</script>

<template>
    <div class="w-full rounded-xl border border-slate-200 bg-white p-3 shadow-sm">
        <div class="flex items-center justify-between">
            <span class="rounded-md bg-pink-100 px-2 py-0.5 text-sm font-semibold text-pink-500">
                {{ props?.rombel?.mapel }}
            </span>

            <span class="rounded-md bg-emerald-50 px-2 py-0.5 text-sm font-semibold text-emerald-500">
                TINGKAT {{ props?.rombel?.tingkat }} - {{ props?.rombel?.jenjang }}
            </span>
        </div>
        <div class="mt-2">
            <h3 class="text-md font-semibold text-slate-900">
                {{ props?.rombel?.nama }}
            </h3>

            <p class="mt-0.5 text-sm text-slate-400">
                Tahun Ajaran {{ props?.rombel?.tahun }}
            </p>
        </div>
        <div class="mt-3 space-y-2.5">
            <div class="flex items-center gap-2">
                <div class="p-2 rounded-full bg-slate-50 text-slate-400">
                    <UserRound :size="20" :stroke-width="1.8" />
                </div>

                <div class="min-w-0">
                    <p class="text-sm font-medium uppercase tracking-wide text-slate-400">
                        Pengajar
                    </p>

                    <p class="truncate text-sm font-medium text-slate-700">
                        {{ props?.rombel?.tentor }}
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <div class="p-2 rounded-full bg-slate-50 text-slate-400">
                    <UsersRound :size="20" :stroke-width="1.8" />
                </div>

                <div class="min-w-0">
                    <p class="text-sm font-medium uppercase tracking-wide text-slate-400">
                        Total
                    </p>

                    <p class="text-sm font-medium text-slate-700">
                        {{ props?.rombel?.siswa }} Siswa Terdaftar
                    </p>
                </div>
            </div>

        </div>
        <div class="mt-3 flex items-center gap-2">
            <button type="button" @click="emit('hapus', props?.rombel)" class="flex h-8 flex-1 items-center justify-center gap-1.5 rounded-lg bg-slate-900 text-sm font-primary text-white transition hover:bg-slate-800 active:scale-[0.98]">
                <span>Keluar</span>
                <ArrowRight :size="12" :stroke-width="2" />
            </button>
        </div>
    </div>
</template>
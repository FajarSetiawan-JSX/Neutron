<script setup>
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';
import { eror, success } from '@/Helper.js/Toast';
import { onMounted, ref } from 'vue';
import { Atom, Monitor, Users, Award, FileText, Clock, Calendar } from "lucide-vue-next";
import { formatDate } from '@/Helper.js/DateTime';
import { useCounter } from '@/Helper.js/counter';

const user = usePage().props?.auth?.user;
const counttotalsiswa = useCounter();
const countabsen = useCounter();
const persentase = useCounter();
const progresabsen = ref(0);
const ratanilai = ref(0);
const props = defineProps(['pertemuan']);
const loading = ref(false);

onMounted(()=>{
    counttotalsiswa.start(props?.pertemuan?.total, 50);
    countabsen.start(props?.pertemuan?.absen, 50);
    persentase.start(props?.pertemuan?.persentase, 20);

    const targetabsen = Number(props?.pertemuan?.persentase ?? 0);
    const interval = setInterval(() => {
        progresabsen.value += 1;
        if (progresabsen.value >= targetabsen) {
            progresabsen.value = targetabsen;
            clearInterval(interval);
        }
    }, 20);
    const targetnilai = Number(props?.pertemuan?.nilai ?? 0);
    const countnilai = setInterval(()=>{
        ratanilai.value += 1;
        if(ratanilai.value >= targetnilai){
            ratanilai.value = targetnilai;
            clearInterval(countnilai);
        }
    }, 20);
})
</script>

<template>
    <Head title="Detail Pertemuan" />
    <Auth>
        <template #aside>
            Detail Pertemuan
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Detail Pertemuan
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
            <div class="relative w-full overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-br from-[#0b1120] via-[#2a1339] to-[#5c1130] p-4 text-white shadow-xl sm:p-5 md:p-6">
                <div class="pointer-events-none absolute -right-24 -top-24 h-64 w-64 rounded-full bg-rose-600/20 blur-3xl"/>
                <div class="relative flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                    <div class="flex flex-wrap items-center gap-2">
                        <span data-aos="zoom-in" class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-3 py-1 text-sm font-medium backdrop-blur-sm">
                            <Atom class="h-4 w-4 text-orange-400" />
                            {{ props?.pertemuan?.mapel }}
                        </span>
                        <span data-aos="zoom-in"data-aos-delay="300" class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-3 py-1 text-sm text-white/80 backdrop-blur-sm">
                        <span class="h-2 w-2 rounded-full bg-emerald-400"/>
                            Selesai
                        </span>
                    </div>
                    <div data-aos="zoom-in" class="flex flex-col items-start gap-1 rounded-xl border border-white/10 bg-rose-950/40 px-4 py-2 sm:items-end">
                        <span class="text-sm text-white/50">Tipe pertemuan</span>
                        <span class="flex items-center gap-1.5 text-sm font-semibold">
                            <Monitor class="h-4 w-4" />
                            {{ props?.pertemuan?.tipe }}
                        </span>
                    </div>
                </div>
                <h2 data-aos="fade-up" class="relative mt-4 text-lg font-semibold leading-snug sm:text-xl md:text-2xl">Rombel {{ props?.pertemuan?.rombel }}<span class="mx-1 text-white/40">•</span>Pertemuan {{ props?.pertemuan?.pertemuan }}</h2>
                <p data-aos="fade-down" class="relative mt-1 text-sm text-white/60 md:text-base">Materi: {{ props?.pertemuan?.materi }}</p>
                <div class="relative mt-5 grid grid-cols-1 gap-3 sm:grid-cols-3">
                    <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                        <div class="flex items-center justify-between">
                            <span class="flex items-center gap-1.5 text-sm text-white/60">
                                <Users class="h-4 w-4" />
                                Presensi Siswa
                            </span>
                            <span class="text-sm font-semibold text-emerald-400">{{persentase.count}}%</span>
                        </div>
                        <p class="mt-2 text-xl font-semibold md:text-2xl">{{ countabsen.count }}<span class="text-sm font-normal text-white/50 md:text-base"> /{{ counttotalsiswa.count }} Siswa</span></p>
                        <div class="mt-3 h-1.5 w-full overflow-hidden rounded-full bg-white/10">
                            <div :style="{width: `${progresabsen}%`}" class="h-full rounded-full bg-gradient-to-r from-emerald-400 to-teal-300"/>
                        </div>
                    </div>
                    <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                        <div class="flex items-center justify-between">
                            <span class="flex items-center gap-1.5 text-sm text-white/60">
                                <Award class="h-4 w-4" />
                                Rata-rata Nilai
                            </span>
                        </div>
                        <p class="mt-2 flex items-center gap-2 text-xl font-semibold md:text-2xl">{{ ratanilai }}<span class="text-sm font-normal text-white/50 md:text-base">/100</span></p>
                        <div class="mt-3 h-1.5 w-full overflow-hidden rounded-full bg-white/10">
                            <div :style="{width: `${ratanilai}%`}" class="h-full rounded-full bg-gradient-to-r from-amber-400 to-rose-400"/>
                        </div>
                    </div>
                    <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                        <div class="flex items-center justify-between">
                            <span class="flex items-center gap-1.5 text-sm text-white/60">
                                <FileText class="h-4 w-4" />
                                Tipe Ujian
                            </span>
                        </div>
                        <p class="mt-2 text-lg font-semibold leading-snug md:text-xl">{{ props?.pertemuan?.ujian }}</p>
                        <p class="mt-3 flex items-center gap-1.5 text-sm text-white/50">
                            <Clock class="h-4 w-4" />
                            Durasi: {{ props.pertemuan.tipe == 'Pertemuan' ? '90 Menit' : 'Tidak diketahui' }}
                        </p>
                    </div>
                </div>
                <div class="relative mt-5 flex flex-col gap-3 border-t border-white/10 pt-4 sm:flex-row sm:items-center sm:justify-between">
                    <span class="flex items-center gap-1.5 text-sm text-white/60">
                        <Calendar class="h-4 w-4" />
                        {{ formatDate(props?.pertemuan?.tanggal) }}
                    </span>
                </div>
            </div>
        </section>

    </Auth>
</template>

<style scoped>

</style>
<script setup>
import Menu from "@/Components/Menu.vue";
import { ChessPawn, ChessBishop, UsersRound, User, ArrowRight ,ChessKing } from "lucide-vue-next";

const props = defineProps(['rombel']);
</script>

<template>
    <div class="relative w-full overflow-hidden rounded-2xl border border-slate-700/80 bg-[#07131f] shadow-lg">
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('/assets/kelas.png');"/>
        <div class="absolute inset-0 bg-[#020b12]/70"/>
        <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-cyan-500/10 blur-3xl"/>
        <div class="absolute -bottom-20 -left-10 h-44 w-44 rounded-full bg-blue-500/10 blur-3xl"/>
        <div class="relative z-10 p-7 font-primary">
            <div class="flex items-start justify-between gap-4">
                <span class="rounded-full bg-slate-700/80 px-4 py-1.5 text-sm font-medium tracking-wide text-slate-200">
                    Tingkat {{ props?.rombel?.tingkat }}
                </span>
                <template v-if="props.rombel.jenjang == 'SMA'">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-[#c9a32760] text-[#C9A227]">
                        <ChessKing :size="25" stroke-width="1.8" />
                    </div>
                </template>
                <template v-else-if="props.rombel.jenjang == 'SMP'">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-[#4169e150] text-[#4169E1]">
                        <ChessBishop :size="25" stroke-width="1.8" />
                    </div>
                </template>
                <template v-else>
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-[#c0c0c053] text-[#C0C0C0]">
                        <ChessPawn :size="25" stroke-width="1.8" />
                    </div>
                </template>
            </div>

            <h2 class="mt-5 text-3xl font-semibold tracking-tight text-white">
                {{ props?.rombel?.nama }}
            </h2>
            <p class="mt-2 text-sm font-semibold tracking-tight text-emerald-300 font-primary">
                {{ props?.rombel?.mapel }}
            </p>

            <div class="mt-7 space-y-4">
                <div class="flex items-center gap-4 text-lg text-red-500">
                    <UsersRound :size="21" />
                    <span>{{ props?.rombel?.siswa }} Siswa</span>
                </div>

                <div class="flex items-center gap-4 text-lg text-white">
                    <User :size="21" />
                    <span>{{ props?.rombel?.tentor }}</span>
                </div>
            </div>

            <div class="my-6 border-t border-slate-600/70"></div>
            <Menu :href="route('tentor.rombel.detail.siswa', props?.rombel?.id)" class="flex w-full items-center justify-center gap-3 rounded-xl bg-white px-6 py-2 my-2 text-sm font-primary font-medium text-slate-900 transition hover:bg-slate-100 active:scale-95">
                <span>Detail Siswa</span>
            </Menu>
            <Menu :href="route('tentor.rombel.detail', props?.rombel?.id)" class="flex w-full items-center justify-center gap-3 rounded-xl bg-[#ff554d] px-6 py-4 text-sm font-primary font-medium text-white transition hover:bg-[#ff665e] active:scale-[0.99]">
                <span>Mulai Pembelajaran</span>
                <ArrowRight :size="20" />
            </Menu>
        </div>
    </div>
</template>
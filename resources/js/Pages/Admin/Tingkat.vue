<script setup>
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import { usePage } from '@inertiajs/vue3';
import GradientButton from '@/Components/21Dev/GradientButton.vue';
import TildCard from '@/Components/21Dev/TildCard.vue';
import BorderAnimation from '@/Components/21Dev/BorderAnimation.vue';
import { ref } from "vue";
import {
    GraduationCap,
    FlaskConical,
    Users,
    ArrowRight,
} from "lucide-vue-next";

const user = usePage().props?.auth?.user;
const props = defineProps(['levels']);
const aurora = 'bg-gradient-to-br from-cyan-50 via-violet-50 to-pink-100';
const nature = 'bg-gradient-to-br from-lime-50 via-green-50 to-emerald-100';
const ocean = 'bg-gradient-to-br from-cyan-50 via-sky-50 to-blue-100';
const dropdown = ref(null);
function handledropdown (id){
    dropdown.value = dropdown.value === id ? null : id;
}
</script>

<template>
    <Head title="Tingkat" />
    <Auth>
        <template #aside>
            Tingkat
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Tingkat
                </h1>
            </div>
            <!-- <div class="hidden md:block flex-1 max-w-md mx-8">
                <AnimatedGlowingSearchBar />
                <input type="text" placeholder="Search..." class="w-full rounded-xl border border-red-200 bg-red-50 px-4 py-2 outline-none focus:border-red-500">
            </div> -->
            <div class="flex items-center gap-3">
                <button class="w-10 h-10 rounded-xl bg-red-50 hover:bg-red-500 hover:text-white transition">
                    🔔
                </button>
                <img
                    :src="`https://ui-avatars.com/api/?name=${encodeURIComponent(user?.name)}&background=DC2626&color=fff`"
                    class="w-10 h-10 rounded-full"
                />
                <div class="text-sm font-primary text-white hidden md:grid md:grid-cols-1">
                    <span>{{ user?.name }}</span>
                    <span class="text-white/70">{{ user?.email }}</span>
                </div>
            </div>
        </template>

        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="mt-2 flex flex-col lg:flex-row gap-4 justify-between lg:items-center">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800">Manajemen Tingkat</h1>
                    <p class="text-gray-500 mt-1">Kelola struktur pendidikan, pembagian kelas dan sumber daya.</p>
                </div>
            </div>
            <div class="mt-10 space-y-8">
                <section v-for="level in props.levels" :key="level.id" :class="level.id === 1 ? aurora : level.id ? nature : ocean" class="rounded-3xl border border-slate-200 p-6 shadow-sm">
                    <!-- Header Jenjang -->
                    <button @click="handledropdown(level.id)" type="button" class="flex items-center justify-between text-slate-800 w-full">
                        <div class="flex gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center">
                                <GraduationCap class="w-6 h-6 text-red-600" />
                            </div>
                            <div>
                                <h2 class="font-bold text-lg">{{ level.nama }} ({{ level.slug }})</h2>
                                <p class="text-sm text-gray-500 mt-1 text-left">{{ level.subtitle }} • 3 Jenjang Aktif</p>
                            </div>
                        </div>
                        <div class="text-black">
                            <svg class="fill-current transition duration-300" :class="dropdown === level.id ? 'rotate-180' : 'rotate-0'" width="15px" height="15px" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.1025513,12.7783485 L16.8106554,6.0794438 C17.0871744,5.80330401 17.5303978,5.80851813 17.8006227,6.09108986 C18.0708475,6.37366159 18.0657451,6.82658676 17.7892261,7.10272655 L10.5858152,14.2962587 C10.3114043,14.5702933 9.87226896,14.5675493 9.60115804,14.2901058 L2.2046872,6.72087106 C1.93149355,6.44129625 1.93181183,5.98834118 2.20539811,5.7091676 C2.47898439,5.42999401 2.92223711,5.43031926 3.19543076,5.70989407 L10.1025513,12.7783485 Z"/>
                            </svg>
                        </div>
                    </button>
                    <!-- GRID KELAS -->
                     <Transition name="accordion">
                        <div v-if="dropdown === level.id" class="mt-6 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
                            <TildCard v-for="tingkat in level.tingkat" :key="tingkat.id" class="group rounded-2xl border border-slate-200 bg-white p-5 hover:border-red-400 hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                                <!-- Header -->
                                <div class="flex justify-between items-start">
                                    <div class="w-11 h-11 rounded-xl bg-red-50 flex items-center justify-center">
                                        <FlaskConical class="w-5 h-5 text-red-600"/>
                                    </div>
                                    <BorderAnimation class="bg-white px-3 py-1 shadow-sm">
                                        active
                                    </BorderAnimation>
                                </div>
                                <h3 class="mt-5 text-lg font-bold text-slate-800">Tingkat {{ tingkat.tingkat }}</h3>
                                <div class="mt-2 flex items-center gap-2 text-gray-500 text-sm">
                                    <Users class="w-4 h-4"/>
                                    0 Siswa
                                </div>

                                <!-- Footer -->

                                <div class="mt-6 flex justify-between items-center">
                                    <button class="text-red-600 text-sm font-semibold">Detail</button>
                                    <button class="w-9 h-9 rounded-full bg-red-50 flex items-center justify-center group-hover:bg-red-600 transition">
                                        <ArrowRight class="w-4 h-4 text-red-600 group-hover:text-white"/>
                                    </button>
                                </div>
                            </TildCard>
                        </div>
                     </Transition>
                </section>
            </div>
        </div>
    </Auth>
</template>

<style scoped>
.accordion-enter-active,
.accordion-leave-active {
    transition: all 0.3s ease;
    overflow: hidden;
}

.accordion-enter-from,
.accordion-leave-to {
    opacity: 0;
    max-height: 0;
}

.accordion-enter-to,
.accordion-leave-from {
    opacity: 1;
    max-height: 1500px;
}
</style>
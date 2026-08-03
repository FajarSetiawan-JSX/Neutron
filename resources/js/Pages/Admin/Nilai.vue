<script setup>
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import AnimatedGlowingSearchBar from '@/Components/21Dev/AnimatedGlowingSearchBar.vue';
import { usePage } from '@inertiajs/vue3';
import { TrendingUp, TrendingDown, TrendingUpDown } from "lucide-vue-next";
import PaginationCard from '@/Components/PaginationCard.vue';
import GradientButton from '@/Components/21Dev/GradientButton.vue';

const user = usePage().props?.auth?.user;
</script>

<template>
    <Head title="Nilai" />
    <Auth>
        <template #aside>
            Nilai
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Nilai
                </h1>
            </div>
            <div class="hidden md:block flex-1 max-w-md mx-8">
                <AnimatedGlowingSearchBar />
                <!-- <input type="text" placeholder="Search..." class="w-full rounded-xl border border-red-200 bg-red-50 px-4 py-2 outline-none focus:border-red-500"> -->
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

        <section class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div data-aos="fade-up-right" class="bg-emerald-500 rounded-lg w-full font-primary shadow-xl">
                <div class="ml-1 rounded-lg w-full p-3 flex items-start gap-x-2.5 bg-white min-h-full">
                    <div class="p-2 rounded-lg bg-emerald-200">
                        <TrendingUp size="30" class="text-emerald-400" />
                    </div>
                    <div class="text-black bg-white">
                        <h1 class="text-lg">Nilai tertinggi</h1>
                        <p class="text-sm text-emerald-500">100</p>
                    </div>
                </div>
            </div>
            <div data-aos="zoom-in-up" class="bg-sky-500 rounded-lg w-full font-primary shadow-xl">
                <div class="ml-1 rounded-lg w-full p-3 flex items-start gap-x-2.5 bg-white min-h-full">
                    <div class="p-2 rounded-lg bg-sky-200">
                        <TrendingUpDown size="30" class="text-sky-400" />
                    </div>
                    <div class="text-black bg-white">
                        <h1 class="text-lg">Rata rata nilai</h1>
                        <p class="text-sm text-sky-500">85</p>
                    </div>
                </div>
            </div>
            <div data-aos="fade-up-left" class="bg-red-500 rounded-lg w-full font-primary shadow-xl">
                <div class="ml-1 rounded-lg w-full p-3 flex items-start gap-x-2.5 bg-white min-h-full">
                    <div class="p-2 rounded-lg bg-red-200">
                        <TrendingDown size="30" class="text-red-400" />
                    </div>
                    <div class="text-black bg-white">
                        <h1 class="text-lg">Nilai terendah</h1>
                        <p class="text-sm text-red-500">50</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="my-3.5 relative overflow-visible">
            <div class="flex items-center justify-end flex-wrap bg-white p-3 gap-x-3 rounded-t-lg">
                <select name="" id="" class="pl-2 py-1 rounded-lg bg-white border-0 ring-1 ring-slate-300 focus:ring-2 focus:ring-sky-300">
                    <option selected value="">Filter Kelas</option>
                </select>
                <select name="" id="" class="pl-2 py-1 rounded-lg bg-white border-0 ring-1 ring-slate-300 focus:ring-2 focus:ring-sky-300">
                    <option selected value="">Filter Tingkat</option>
                </select>
                <select name="" id="" class="pl-2 py-1 rounded-lg bg-white border-0 ring-1 ring-slate-300 focus:ring-2 focus:ring-sky-300">
                    <option selected value="">Filter Jenjang</option>
                </select>
                <GradientButton color="red" type="button" class="px-3 py-1 rounded-lg text-white flex items-center gap-x-2">
                    <Trash2 size="20" />
                    Hapus semua nilai
                </GradientButton>
            </div>
            <div class="overflow-x-scroll bg-white mb-4">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-4">No</th>
                            <th scope="col" class="px-4 py-3">Nama</th>
                            <th scope="col" class="px-4 py-3">Nis</th>
                            <th scope="col" class="px-4 py-3">Mapel</th>
                            <th scope="col" class="px-4 py-3">Jenis nilai</th>
                            <th scope="col" class="px-4 py-3">Tanggal</th>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">Apple iMac 27&#34;</th>
                            <td class="px-4 py-3">lorem ipsum dolor memet</td>
                            <td class="px-4 py-3">Apple</td>
                            <td class="px-4 py-3 max-w-[12rem] truncate">What is a product description? A product description describes a product.</td>
                            <td class="px-4 py-3">19:00</td>
                            <td class="px-4 py-3">21 Januari 2026</td>
                            <td class="px-4 py-3 flex items-center justify-end absolute right-0">
                                <button class="inline-flex items-center text-sm font-medium hover:bg-gray-100 p-1.5 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" type="button">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                                <div class="w-44 bg-white rounded divide-y divide-gray-100 shadow absolute top-0">
                                    <ul class="py-1 text-sm">
                                        <li>
                                            <button type="button" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 text-gray-700">
                                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                                </svg>
                                                Edit
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 text-red-500">
                                                <svg class="w-4 h-4 mr-2" viewbox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" d="M6.09922 0.300781C5.93212 0.30087 5.76835 0.347476 5.62625 0.435378C5.48414 0.523281 5.36931 0.649009 5.29462 0.798481L4.64302 2.10078H1.59922C1.36052 2.10078 1.13161 2.1956 0.962823 2.36439C0.79404 2.53317 0.699219 2.76209 0.699219 3.00078C0.699219 3.23948 0.79404 3.46839 0.962823 3.63718C1.13161 3.80596 1.36052 3.90078 1.59922 3.90078V12.9008C1.59922 13.3782 1.78886 13.836 2.12643 14.1736C2.46399 14.5111 2.92183 14.7008 3.39922 14.7008H10.5992C11.0766 14.7008 11.5344 14.5111 11.872 14.1736C12.2096 13.836 12.3992 13.3782 12.3992 12.9008V3.90078C12.6379 3.90078 12.8668 3.80596 13.0356 3.63718C13.2044 3.46839 13.2992 3.23948 13.2992 3.00078C13.2992 2.76209 13.2044 2.53317 13.0356 2.36439C12.8668 2.1956 12.6379 2.10078 12.3992 2.10078H9.35542L8.70382 0.798481C8.62913 0.649009 8.5143 0.523281 8.37219 0.435378C8.23009 0.347476 8.06631 0.30087 7.89922 0.300781H6.09922ZM4.29922 5.70078C4.29922 5.46209 4.39404 5.23317 4.56282 5.06439C4.73161 4.8956 4.96052 4.80078 5.19922 4.80078C5.43791 4.80078 5.66683 4.8956 5.83561 5.06439C6.0044 5.23317 6.09922 5.46209 6.09922 5.70078V11.1008C6.09922 11.3395 6.0044 11.5684 5.83561 11.7372C5.66683 11.906 5.43791 12.0008 5.19922 12.0008C4.96052 12.0008 4.73161 11.906 4.56282 11.7372C4.39404 11.5684 4.29922 11.3395 4.29922 11.1008V5.70078ZM8.79922 4.80078C8.56052 4.80078 8.33161 4.8956 8.16282 5.06439C7.99404 5.23317 7.89922 5.46209 7.89922 5.70078V11.1008C7.89922 11.3395 7.99404 11.5684 8.16282 11.7372C8.33161 11.906 8.56052 12.0008 8.79922 12.0008C9.03791 12.0008 9.26683 11.906 9.43561 11.7372C9.6044 11.5684 9.69922 11.3395 9.69922 11.1008V5.70078C9.69922 5.46209 9.6044 5.23317 9.43561 5.06439C9.26683 4.8956 9.03791 4.80078 8.79922 4.80078Z" />
                                                </svg>
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <PaginationCard />
        </section>
    </Auth>
</template>
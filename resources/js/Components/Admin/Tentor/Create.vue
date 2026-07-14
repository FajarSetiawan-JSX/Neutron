<script setup>
import CardBorderAnimation from "@/Components/21Dev/CardBorderAnimation.vue";
import GradientButton from "@/Components/21Dev/GradientButton.vue";
import { ref, Teleport } from "vue";
import { Plus, LoaderCircle } from "lucide-vue-next";
import PrimaryLoading from "@/Components/21Dev/PrimaryLoading.vue";

const emit = defineEmits(['close']);
const loading = ref(false)
async function create() {
    loading.value = true;

    setTimeout(()=>{
        loading.value = false;
    }, 2000)
    // try{
    //     loading.value = true
    // }catch(error){
    //     console.log(error);
    // }finally{
    //     loading.value = false;
    // }
}
</script>

<template>
    <Teleport to="body">
        <div class="fixed max-h-screen inset-0 z-[9999] bg-black/50 overflow-y-auto">
            <div class="p-3 md:py-5 flex justify-center items-center lg:h-screen">
                <CardBorderAnimation>
                    <form @submit.prevent="create">
                        <div class="rounded-xl bg-black p-6 max-w-5xl">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div class="space-y-3">
                                    <div>
                                        <label class="mb-2 block text-sm font-medium text-gray-300">
                                            Nama Lengkap
                                        </label>

                                        <input
                                            type="text"
                                            placeholder="Contoh: Nama Pengajar, S.Pd."
                                            class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white placeholder:text-gray-500 outline-none transition focus:outline-0 focus:ring-2 focus:ring-purple-700"
                                        />
                                        <p class="text-red-500 mt-1 text-xs md:text-sm">error</p>
                                    </div>
                                    <div>
                                        <label class="mb-2 block text-sm font-medium text-gray-300">
                                            Alamat Email
                                        </label>

                                        <input
                                            type="email"
                                            placeholder="budi@email.com"
                                            class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white placeholder:text-gray-500 outline-none transition focus:outline-0 focus:ring-2 focus:ring-purple-700"
                                        />
                                        <p class="text-red-500 mt-1 text-xs md:text-sm">error</p>
                                    </div>
                                    <div>
                                        <label class="mb-2 block text-sm font-medium text-gray-300">
                                            Nomor Telepon
                                        </label>
                                        <input
                                            type="text"
                                            placeholder="0812xxxxxxxx"
                                            class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white placeholder:text-gray-500 outline-none transition focus:outline-0 focus:ring-2 focus:ring-purple-700"
                                        />
                                        <p class="text-red-500 mt-1 text-xs md:text-sm">error</p>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="mb-4 font-semibold text-white">
                                        Mata Pelajaran
                                    </h4>
                                    <div class="flex flex-row flex-wrap gap-3">
                                        <label
                                            v-for="mapel in ['Mathematics','Physics','Biology','English','History','Chemistry','Agama', 'iformatika']"
                                            :key="mapel"
                                            class="flex flex-row cursor-pointer items-center gap-3 rounded-lg border border-white/10 bg-[#1d1d1d] p-3 text-gray-300 transition hover:border-red-500 hover:bg-[#252525]"
                                        >
                                            <input type="checkbox" class="accent-red-500" />
                                            <span class="text-sm">
                                                {{ mapel }}
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="my-8 border-t border-white/10"></div>
                            <h3 class="mb-5 text-xs font-semibold uppercase tracking-[0.25em] text-gray-500">
                                Detail Penugasan
                            </h3>
                            <div class="grid grid-cols-1">
                                <div>
                                    <h4 class="mb-4 font-semibold text-white">
                                        Penempatan Kelas Wali
                                    </h4>
                                    <div class="flex flex-wrap flex-row gap-1.5">
                                        <label
                                            v-for="kelas in ['10 IPA 1','10 IPA 2','11 IPS 1','11 IPS 2','12 IPA 3','12 IPS 1']"
                                            :key="kelas"
                                            class="flex cursor-pointer items-center gap-3 rounded-lg border border-white/10 bg-[#1d1d1d] p-3 text-gray-300 transition hover:border-red-500 hover:bg-[#252525] min-w-24"
                                        >
                                            <input type="checkbox" class="accent-red-500"/>
                                            <span class="text-xs">
                                                {{ kelas }}
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-10 flex justify-end gap-3">
                                <button type="button" @click="emit('close')" class="rounded-lg border border-white/10 bg-[#1d1d1d] px-6 py-3 text-gray-300 transition hover:bg-[#2a2a2a]">
                                    Batal
                                </button>
                                <GradientButton color="red" type="submit" :disabled="loading" :class="loading ? 'opacity-50 cursor-not-allowed' : 'opacity-100 cursor-pointer'" class="flex items-center justify-center gap-2 font-primary py-3 px-6 text-white rounded-xl">
                                    <Plus v-if="!loading" class="w-5 h-5"/>
                                    <PrimaryLoading v-else :size="20" :class="'stroke-white'" />
                                    {{ loading ? 'Menambah Pengajar Baru' : 'Tambah Pengajar Baru' }}
                                </GradientButton>
                            </div>
                        </div>
                    </form>
                </CardBorderAnimation>
            </div>
        </div> 
    </Teleport>
</template>
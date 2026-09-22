<script setup>
import Auth from '@/Layouts/Auth.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';
import { ChevronRight, Plus } from "lucide-vue-next";
import { computed, onMounted, ref } from 'vue';
import { eror, success } from '@/Helper.js/Toast';
import GradientButton from '@/Components/21Dev/GradientButton.vue';
import PrimaryLoading from '@/Components/21Dev/PrimaryLoading.vue';

const user = usePage().props?.auth?.user;
const props = defineProps(['rombel', 'tentors']);
const tentor = ref([]);
const loading = ref(false);
const err = ref({});
const form = ref({
    id: props?.rombel?.id,
    subjek: ''
})
async function set() {
    try{
        loading.value = true;
        const response = await axios.patch(`/api/Admin/rombel/${form?.value.id}/subjek`, form?.value);
        success('Berhasil memperbarui tentor')
    }catch(error){
        if(error?.response?.status === 422){
            err.value = error?.response?.data?.errors
        }
        eror(error?.response?.status, error?.response?.data?.message);
    }finally{
        loading.value = false;
    }
}
const selected = ref(null);
const mapels = computed(()=>{
    return tentor.value.find(item => item.id === selected.value);
})
onMounted(()=>{
    tentor.value = props?.tentors;
    selected.value = props?.rombel?.subjek?.tentor?.id ?? null;
    form.value.subjek = props?.rombel?.subjek_id ?? '';
})
</script>

<template>
    <Head title="Rombel Detail" />
    <Auth>
        <template #aside>
            Rombel Edit Tentor
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Rombel Edit Tentor
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
            <h1 class="font-primary text-2xl font-semibold text-slate-500 flex items-center justify-start gap-x-2">Rombel <ChevronRight size="15" /> <span class="text-black">{{ props?.rombel?.name }}</span></h1>
            <p class="font-primary text-lg text-slate-500">Rombel Tahun Ajaran {{ props?.rombel?.tahun?.tahun }} Tingkat {{ props?.rombel?.tingkat?.tingkat }}</p>
        </section>

        <section class="my-5">
            <form action="" @submit.prevent="set" class="space-y-5">
                <div class="p-5 rounded-md bg-white shadow-sm flex items-center justify-start gap-x-5">
                    <label for="" class="text-md font-primary">
                        Pilih Tentor
                    </label>
                    <select name="" id="" v-model="selected" class="rounded-lg">
                        <option disabled selected value="">Pilih Tentor</option>
                        <option v-for="t in tentor" :key="t?.id" :value="t?.id">{{ t?.nama }}</option>
                    </select>
                </div>

                <div class="px-5 py-2 rounded-md bg-white shadow-sm">
                    <div class="text-md font-primary mb-3">
                        Pilih mapel
                    </div>
                    <div v-if="mapels" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 my-5">
                        <div v-for="(subjek, index ) in mapels.subjek" :key="subjek?.id">
                            <label :for="`subjek-${index + 1}`">
                                <input type="radio" :id="`subjek-${index + 1}`" :value="subjek?.id" v-model="form.subjek">
                                {{ subjek?.mapel }}
                            </label>
                        </div>
                    </div>
                    <div v-if="err?.subjek" class="text-xs text-red-500">
                        {{ err?.subjek[0] }}
                    </div>
                </div>

                <div class="p-5 rounded-md bg-white shadow-sm flex items-center justify-start gap-x-5">
                    <GradientButton color="red" type="submit" :disabled="loading" :class="loading ? 'opacity-50 cursor-not-allowed' : 'opacity-100 cursor-pointer'" class="flex items-center justify-center w-full gap-2 font-primary py-3 px-6 text-white rounded-xl">
                        <Plus v-if="!loading" class="w-5 h-5"/>
                        <PrimaryLoading v-else :size="20" :class="'stroke-white'" />
                        {{ loading ? '' : 'Terapkan' }}
                    </GradientButton>
                </div>
            </form>
        </section>

    </Auth>
</template>

<style scoped>
/* Chrome, Edge, Safari */
.custom-scroll::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.custom-scroll::-webkit-scrollbar-track {
    background: #f1f5f9;
    border-radius: 999px;
}

.custom-scroll::-webkit-scrollbar-thumb {
    background: #94a3b8;
    border-radius: 999px;
    border: 2px solid #f1f5f9;
    transition: background .2s;
}

.custom-scroll::-webkit-scrollbar-thumb:hover {
    background: #64748b;
}

.custom-scroll::-webkit-scrollbar-corner {
    background: transparent;
}

/* Firefox */
.custom-scroll {
    scrollbar-width: thin;
    scrollbar-color: #94a3b8 #f1f5f9;
}
</style>
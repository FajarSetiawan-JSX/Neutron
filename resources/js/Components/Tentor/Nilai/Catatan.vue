<script setup>
import CardBorderAnimation from "@/Components/21Dev/CardBorderAnimation.vue";
import GradientButton from "@/Components/21Dev/GradientButton.vue";
import { onMounted, ref, Teleport } from "vue";
import { Plus, User } from "lucide-vue-next";

const emit = defineEmits(['close', 'tambah']);
const props = defineProps(['siswa']);
const note = ref('');
function tambah(){
    emit('tambah', note.value);
}
onMounted(()=>{
    console.log(props.siswa)
})
</script>

<template>
    <Teleport to="body">
        <div @click="emit('close')" class="fixed h-screen inset-0 flex justify-center items-center z-[9999] bg-black/50 overflow-y-auto px-2">
            <CardBorderAnimation @click.stop data-aos="zoom-in">
                    <div class="rounded-xl bg-black p-6 w-sm lg:w-md">
                        <div data-aos="fade-up" class="flex items-center justify-center gap-x-2">
                            <User size="20" class="text-sky-400" />
                            <h1 class="text-white text-lg">{{ props?.siswa?.nama }}</h1>
                        </div>
                        <p data-aos="fade-down" class="text-center text-sm text-slate-300">Tambah catatan baru untuk {{ props?.siswa?.nama }}</p>
                        <div>
                            <label for="note" class="mb-2 block text-sm font-medium text-gray-300">
                                Catatan
                            </label>
                            <textarea id="note" v-model="note" class="w-full rounded-lg border border-white/10 bg-[#1d1d1d] px-4 py-3 text-white placeholder:text-gray-500 outline-none transition focus:outline-0 focus:ring-2 focus:ring-purple-700"></textarea>
                        </div>
                        <div class="mt-4 flex justify-end gap-3">
                            <GradientButton color="red" type="button" @click="tambah" class="flex items-center justify-center cursor-pointer w-full gap-2 font-primary py-3 px-6 text-white rounded-xl">
                                <Plus class="w-5 h-5"/>
                                Tambah Catatan
                            </GradientButton>
                        </div>
                    </div>
            </CardBorderAnimation>
        </div> 
    </Teleport>
</template>
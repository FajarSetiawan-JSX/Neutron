<script setup>
import { ref, onMounted, onBeforeUnmount, computed } from "vue";
import { MoreVertical, Pencil, Trash2, BookOpenCheck } from "lucide-vue-next";
import { useCounter } from "@/Helper.js/counter";

const siswa = useCounter();
const total = useCounter();
const props = defineProps(['mapel']);
const showMenu = ref(false);
const emit = defineEmits(['update', 'hapus']);
const toggleMenu = () => {
    showMenu.value = !showMenu.value;
};

const closeMenu = (e) => {
    if (!e.target.closest(".menu-wrapper")) {
        showMenu.value = false;
    }
};

onMounted(() => {
    siswa.start(props?.mapel?.siswa, 200);
    total.start(props?.mapel?.total, 100);
    document.addEventListener("click", closeMenu);
});

onBeforeUnmount(() => {
    document.removeEventListener("click", closeMenu);
});
</script>

<template>
    <div class="relative w-full rounded-3xl border p-5 shadow-md transition-all hover:shadow-xl border-white/5 bg-[#1A1D26] font-primary">
        <div class="flex items-start justify-between">
            <div class="flex justify-start items-end">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-red-500">
                    <BookOpenCheck class="text-white" :size="28" />
                </div>
            </div>
            <div class="menu-wrapper relative">
                <button @click.stop="toggleMenu" class="rounded-lg p-2 transition hover:bg-slate-600 bg-slate-800">
                    <MoreVertical :size="20" class="text-white" />
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
                        <button type="button" @click="emit('update', props.mapel)" class="flex w-full items-center gap-3 px-4 py-3 text-sm transition hover:bg-blue-50 hover:text-blue-600">
                            <Pencil :size="17" />
                            Edit
                        </button>

                        <button type="button" @click="emit('hapus', props?.mapel?.id)" class="flex w-full items-center gap-3 px-4 py-3 text-sm transition hover:bg-red-50 hover:text-red-600">
                            <Trash2 :size="17" />
                            Hapus
                        </button>
                    </div>
                </Transition>
            </div>
        </div>
        <h2 class="text-xl font-bold text-zinc-100 mt-6">
            {{ props?.mapel?.nama ?? '' }}
        </h2>
        <div class="mt-6 flex items-center gap-3 rounded-2xl bg-[#232735] p-3">
            <div class="flex items-center justify-center">
                <template v-if="props?.mapel?.tentors.length > 0">
                    <img v-for="(tentor, index) in props?.mapel?.tentors" :key="item"
                        :src="tentor?.avatar ? `/tentor/${tentor.avatar}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(tentor?.nama)}&background=DC2626&color=fff`"
                        class="flex h-10 w-10 items-center justify-center rounded-full bg-pink-500 text-xs text-white shadow-lg ring-4 ring-[#1b1f2a]"
                        :class="`z-${(index)*10}`"
                        :style="{
                            left: `${index * 52}px`
                        }"
                        :title="tentor?.nama"
                        alt="Image"
                    />
                </template>
                
                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-pink-500 text-xs text-white shadow-lg ring-4 ring-[#1b1f2a] z-[99]"
                    :style="{
                        left: `${props?.mapel?.tentors.length * 52}px`
                    }"
                >
                    {{ props?.mapel?.tentors.length }}+
                </div>
            </div>
        </div>
        <div class="mt-6">
            <div class="h-2 rounded-full bg-[#2B3040]">
                <div class="h-full rounded-full bg-red-500 transition-all duration-1000" :style="{width:(siswa.count.value / props?.mapel?.total * 100) +'%'}"/>
            </div>
        </div>
        <h3 class="mt-2.5 text-white/80">{{ siswa.count }} / {{ total.count }} siswa</h3>
    </div>
</template>
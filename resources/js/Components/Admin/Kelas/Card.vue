<script setup>
import { onBeforeUnmount, onMounted, ref } from "vue";
import { MoreVertical, Pencil, Trash2, Users, GraduationCap, Info } from "lucide-vue-next";
import Menu from "@/Components/Menu.vue";
const emit = defineEmits(['update', 'hapus']);
defineProps({
    kelas: {
        type: Object,
        default: () => ({
            nama: "Kelas 9 Unggulan",
            tingkat: "SMP",
            siswa: 24,
            wali: "Ibu Rina W., S.SI.",
        }),
    },
});

const showMenu = ref(false);

const toggleMenu = () => {
    showMenu.value = !showMenu.value;
};

const closeMenu = (e) => {
    if (!e.target.closest(".menu-wrapper")) {
        showMenu.value = false;
    }
};

onMounted(() => {
    document.addEventListener("click", closeMenu);
});

onBeforeUnmount(() => {
    document.removeEventListener("click", closeMenu);
});
</script>

<template>
    <div class="group overflow-hidden rounded-3xl bg-[#151515] shadow-xl transition-all duration-300 hover:-translate-y-1 hover:shadow-red-500/10">
        <div class="relative h-52 overflow-hidden">
            <img :src="'https://picsum.photos/600/400?random=room'" class="h-full w-full object-cover"/>
            <div class="absolute inset-0 bg-gradient-to-t from-[#151515] via-[#151515]/30 to-transparent"/>
            <div class="absolute right-4 top-4">
                <button @click.stop="toggleMenu" class="rounded-full bg-black/50 p-2 text-white backdrop-blur transition hover:bg-black/70">
                    <MoreVertical class="h-5 w-5" />
                </button>

                <Transition
                    enter-active-class="transition duration-150"
                    enter-from-class="opacity-0 scale-95"
                    enter-to-class="opacity-100 scale-100"
                    leave-active-class="transition duration-100"
                    leave-from-class="opacity-100 scale-100"
                    leave-to-class="opacity-0 scale-95"
                >
                    <div v-if="showMenu" class="absolute right-0 mt-2 w-40 z-10 overflow-hidden rounded-xl border border-white/10 bg-[#222] shadow-2xl">
                        <Menu :href="route('admin.kelas.detail', kelas?.slug)" class="flex w-full items-center gap-3 px-4 py-3 text-sm text-white transition hover:bg-sky-500/10">
                            <Info class="h-4 w-4 text-sky-400" />
                            Detail
                        </Menu>
                        <button @click="emit('update', kelas)" class="flex w-full items-center gap-3 px-4 py-3 text-sm text-white transition hover:bg-white/10">
                            <Pencil class="h-4 w-4 text-yellow-400" />
                            Edit
                        </button>
                        <button @click="emit('hapus', kelas.id)" class="flex w-full items-center gap-3 px-4 py-3 text-sm text-red-400 transition hover:bg-red-500/10">
                            <Trash2 class="h-4 w-4" />
                            Hapus
                        </button>
                    </div>
                </Transition>
            </div>
            <div class="absolute bottom-4 left-4 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-white backdrop-blur z-0">
                {{ kelas.singkatan }}
            </div>

            <div class="absolute bottom-4 right-4 flex items-center gap-2 rounded-full bg-black/50 px-3 py-1 text-sm text-white backdrop-blur z-0">
                <Users class="h-4 w-4" />
                {{ kelas.siswa }}
            </div>
        </div>
        <div class="space-y-5 p-5">
            <div>
                <p class="text-[11px] font-bold uppercase tracking-[0.25em] text-red-500">
                    Tingkat {{ kelas.tingkat }} · {{ kelas.jenjang }}
                </p>

                <h2 class="mt-1 text-2xl font-bold text-white">
                    {{ kelas.nama }}
                </h2>
            </div>
            <div class="flex items-end justify-between">
                <div>
                    <p class="text-[10px] uppercase text-white/40">Status</p>
                    <div class="mt-1 flex h-8 w-8 items-center justify-center rounded-full bg-white/15">
                        <GraduationCap class="h-4 w-4 text-white" />
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-[10px] uppercase text-white/40">
                        Wali Kelas
                    </p>
                    <p class="mt-1 font-semibold text-red-400">
                        {{ kelas.wali }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
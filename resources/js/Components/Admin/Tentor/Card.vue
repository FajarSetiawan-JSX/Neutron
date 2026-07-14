<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import {
    MoreVertical,
    Key,
    Trash2,
    Mail,
    Phone,
    Star,
    User,
} from "lucide-vue-next";

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
    <div class="relative w-full rounded-3xl border border-gray-200 bg-white p-5 shadow-md transition-all hover:shadow-xl">
        <div class="flex items-start justify-between">
            <div class="flex gap-3">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-red-100">
                    <User class="text-red-500" :size="28" />
                </div>
                <div>
                    <h2 class="font-bold text-gray-900">
                        Siti Aminah
                    </h2>
                    <p class="text-sm text-gray-500">
                        Mathematics
                    </p>
                </div>
            </div>
            <div class="menu-wrapper relative">
                <button @click.stop="toggleMenu" class="rounded-lg p-2 transition hover:bg-gray-100">
                    <MoreVertical :size="20" />
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
                        <button class="flex w-full items-center gap-3 px-4 py-3 text-sm transition hover:bg-blue-50 hover:text-blue-600">
                            <Key :size="17" />
                            Ubah Password
                        </button>

                        <button class="flex w-full items-center gap-3 px-4 py-3 text-sm transition hover:bg-red-50 hover:text-red-600">
                            <Trash2 :size="17" />
                            Hapus
                        </button>
                    </div>
                </Transition>
            </div>
        </div>
        <div class="mt-5 space-y-3 text-sm text-gray-600">
            <div class="flex items-center gap-2">
                <Mail :size="16" class="text-gray-400" />
                sitiaminah@example.com
            </div>
            <div class="flex items-center gap-2">
                <Phone :size="16" class="text-gray-400" />
                +62 812 3456 7890
            </div>
        </div>
        <div class="mt-5 border-t pt-4 text-sm">
            <p>
                <span class="font-semibold">Mengajar:</span>
                Matematika Dasar
            </p>
            <p class="mt-1">
                <span class="font-semibold">Wali Kelas:</span>
                <span class="font-semibold text-red-500">
                    XI IPA 1
                </span>
            </p>
        </div>
    </div>
</template>
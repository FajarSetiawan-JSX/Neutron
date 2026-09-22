<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { MoreVertical, Users, Pencil, GraduationCap } from 'lucide-vue-next'
import Menu from '@/Components/Menu.vue';

const isMenuOpen = ref(false);
const props = defineProps(['rombel']);
const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value
}
const closeMenu = () => {
    isMenuOpen.value = false
}

// Tutup menu ketika klik di luar
const handleClickOutside = (event) => {
    if (!event.target.closest('.group-menu')) {
        closeMenu()
    }
}

onMounted(() => {
    document.addEventListener('click', handleClickOutside)
})

onUnmounted(() => {
    document.removeEventListener('click', handleClickOutside)
})
</script>

<template>
    <div class="w-full rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="min-w-0">
                <div class="mb-2 flex items-center gap-2">
                    <span class="rounded-md bg-rose-50 px-2 py-1 text-[10px] font-medium uppercase tracking-wide text-rose-400">
                        {{ props?.rombel?.mapel }}
                    </span>
                    <span class="rounded-md bg-slate-100 px-2 py-1 text-[10px] font-medium text-slate-500">
                        Tingkat {{ props?.rombel?.tingkat }}
                    </span>
                    <span class="rounded-md bg-emerald-100 px-2 py-1 text-[10px] font-medium text-emerald-500">
                        {{ props?.rombel?.jenjang }}
                    </span>
                </div>
                <h3 class="truncate text-md font-semibold text-slate-800 font-primary">
                    {{ props?.rombel?.nama }}
                </h3>
            </div>
            <div class="group-menu relative ml-3 shrink-0">
                <button type="button" @click.stop="toggleMenu" class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 transition-colors hover:bg-slate-100 hover:text-slate-600">
                    <MoreVertical class="h-4 w-4" />
                </button>
                <Transition
                    enter-active-class="transition duration-150 ease-out"
                    enter-from-class="scale-95 opacity-0"
                    enter-to-class="scale-100 opacity-100"
                    leave-active-class="transition duration-100 ease-in"
                    leave-from-class="scale-100 opacity-100"
                    leave-to-class="scale-95 opacity-0"
                >
                    <div v-if="isMenuOpen" class="absolute right-0 top-9 z-30 w-36 overflow-hidden rounded-lg border border-slate-200 bg-white p-1 shadow-lg" >
                        <!-- <button type="button" @click="editGroup" class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-left text-xs text-slate-600 transition-colors hover:bg-slate-50">
                            <Pencil class="h-4 w-4 text-slate-400" />
                            <span>Audit</span>
                        </button> -->
                        <Menu :href="route('admin.rombel.pengajar', props?.rombel?.id)" class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-left text-xs text-slate-600 transition-colors hover:bg-slate-50">
                            <GraduationCap class="h-4 w-4 text-slate-400"/>
                            <span>Pengajar</span>
                        </Menu>
                    </div>
                </Transition>
            </div>
        </div>
        <div class="my-4 h-px bg-slate-100" />
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-rose-50">
                    <Users class="h-4 w-4 text-rose-400" />
                </div>
                <span class="text-sm text-slate-500">
                    Total Students
                </span>
            </div>
            <span class="text-base font-semibold text-slate-800">
                {{ props?.rombel?.siswa }}
            </span>
        </div>
        <div class="mt-4 flex items-center gap-3">
            <img v-if="props?.rombel?.avatar"
                :src="props?.rombel?.avatar ? `/storage/${props?.rombel?.avatar}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(props?.rombel?.tentor)}&background=DC2626&color=fff`"
                class="w-10 h-10 rounded-full"
            />
            <div class="min-w-0 leading-tight">
                <p class="text-sm text-slate-400">
                    Tentor
                </p>
                <p class="truncate text-sm font-medium text-slate-700">
                    {{ props?.rombel?.tentor }}
                </p>
            </div>
        </div>
        <Menu :href="route('admin.rombel.siswa', props?.rombel?.id)" class="mt-4 p-2 w-full text-center block rounded-lg border border-rose-300 bg-white text-sm font-medium text-rose-500 hover:bg-rose-50 active:scale-95 transition-all duration-300">
            Detail siswa
        </Menu>
        
    </div>
</template>
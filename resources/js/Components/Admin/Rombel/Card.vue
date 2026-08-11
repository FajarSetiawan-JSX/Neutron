<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import {
    MoreVertical,
    Users,
    UserRound,
    Pencil,
    GraduationCap,
} from 'lucide-vue-next'

const isMenuOpen = ref(false)

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

const editGroup = () => {
    isMenuOpen.value = false
    console.log('Edit group')
}

const manageTeacher = () => {
    isMenuOpen.value = false
    console.log('Manage teacher')
}
</script>

<template>
    <div class="w-full rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
        <div class="flex items-start justify-between">
            <div class="min-w-0">
                <div class="mb-2 flex items-center gap-2">
                    <span class="rounded-md bg-rose-50 px-2 py-1 text-[10px] font-medium uppercase tracking-wide text-rose-400">
                        SOCIAL
                    </span>
                    <span class="rounded-md bg-slate-100 px-2 py-1 text-[10px] font-medium text-slate-500">
                        GRADE 11
                    </span>
                </div>
                <h3 class="truncate text-md font-semibold text-slate-800 font-primary">
                    Kelas 11 - IPS 1
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
                        <button type="button" @click="editGroup" class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-left text-xs text-slate-600 transition-colors hover:bg-slate-50">
                            <Pencil class="h-4 w-4 text-slate-400" />
                            <span>Edit</span>
                        </button>
                        <button type="button" @click="manageTeacher" class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-left text-xs text-slate-600 transition-colors hover:bg-slate-50">
                            <GraduationCap class="h-4 w-4 text-slate-400"/>
                            <span>Pengajar</span>
                        </button>
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
                35
            </span>
        </div>
        <div class="mt-4 flex items-center gap-3">
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-50 text-sm font-semibold text-blue-500">
                AH
            </div>
            <div class="min-w-0 leading-tight">
                <p class="text-sm text-slate-400">
                    Homeroom Teacher
                </p>
                <p class="truncate text-sm font-medium text-slate-700">
                    Ahmad Hidayat
                </p>
            </div>
        </div>
        <button type="button" class="mt-4 h-9 w-full rounded-lg border border-rose-300 bg-white text-sm font-medium text-rose-500 transition-colors hover:bg-rose-50">
            Manage Group
        </button>
    </div>
</template>
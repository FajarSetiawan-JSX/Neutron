<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import Auth from '@/Layouts/Auth.vue';
import { usePage } from '@inertiajs/vue3';
import { CircleCheckBig, Camera, Save, User } from "lucide-vue-next";
import GradientButton from '@/Components/21Dev/GradientButton.vue';
import { onMounted, ref } from 'vue';
import PrimaryLoading from '@/Components/21Dev/PrimaryLoading.vue';
import ChangePass from '@/Components/Profile/ChangePass.vue';
import { formatDate } from '@/Helper.js/DateTime.js';
import axios from 'axios';
import LoadingImage from '@/Components/Profile/LoadingImage.vue';
import { eror,success } from '@/Helper.js/Toast.js';

const user = usePage().props?.auth?.user;
const form = ref({
    id: '',
    name: '',
    email: '',
    phone: ''
})
const loading = ref(false);
const uploading = ref(false);
const err = ref({});
async function update() {
    try{
        loading.value = true
        const response = await axios.patch(`/api/profile/${user?.id}`, form.value);
        success('Berhasil memperbarui profile.')
        err.value = {};
    }catch(error){
        console.log(error.response);
        if(error?.response?.status === 422){
            err.value = error?.response?.data?.errors;
        }else{
            eror(error?.response?.status, error?.response?.data?.message);
        }
    }finally{
        loading.value = false;
    }
}
defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
onMounted(()=>{
    form.value.id = user?.id;
    form.value.name = user?.name;
    form.value.email = user?.email;
    form.value.phone = user?.phone;
})

const fileInput = ref(null);
const imageFile = ref(null);

const openFile = () => {
    fileInput.value.click()
}
const preview = ref(user?.avatar ? `/storage/${user.avatar}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(user?.name)}&background=DC2626&color=fff`)

const changePhoto = (e) => {
    const file = e.target.files[0]
    if (!file) return
    imageFile.value = file;
    preview.value = URL.createObjectURL(file)
    image()
}
async function image() {
    try{
        uploading.value = true;
        const formData = new FormData()
        formData.append('image', imageFile.value)
        const response = await axios.post('/api/image', formData);
        success('Berhasil mengubah foto profile');
    }catch(error){
        eror(error?.response?.status, error?.response?.data?.message)
        //console.log(error?.response);
    }finally{
        uploading.value = false;
    }
}
</script>

<template>
    <Head title="Profile" />
    <Auth>
        <template #aside>
            Profil anda
        </template>
        <template #header="{ toggleSidebar }">
            <div class="flex items-center gap-4">
                <button @click="toggleSidebar" class="lg:hidden w-10 h-10 rounded-xl bg-red-500 text-white">
                    ☰
                </button>
                <h1 class="text-xl font-bold text-white">
                    Profil anda
                </h1>
            </div>
            <div class="hidden md:block flex-1 max-w-md mx-8">
                <!-- <AnimatedGlowingSearchBar /> -->
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

        <section class="w-full p-5 rounded-lg bg-white outline-1 outline-slate-50 shadow-lg">
            <header class="flex justify-start items-center flex-wrap font-primary gap-x-2.5">
                <div class="relative w-32 h-32">
                    <img
                        :src="preview"
                        @click="openFile"
                        class="w-full h-full rounded-md object-cover cursor-pointer"
                    >
                    <button
                        type="button"
                        @click="openFile"
                        class="absolute -bottom-2 -right-2 z-10 rounded-full bg-red-500 p-2 text-white shadow-lg"
                    >
                        <Camera class="w-8 h-8" />
                    </button>
                    <input
                        ref="fileInput"
                        type="file"
                        accept="image/*"
                        class="hidden"
                        @change="changePhoto"
                    >
                </div>
                <div class="mt-2.5 sm:mt-0">
                    <h2 class="text-2xl font-semibold">Informasi Profil</h2>
                    <p class="text-sm text-slate-500">Perbarui data diri dan informasi akademik anda secara berkala</p>
                </div>
            </header>
            <form action="" @submit.prevent="update" class="relative">
                <div class="grid grid-cols-1 gap-2 my-3 font-primary">
                    <div class="grid grid-cols-1 gap-y-1">
                        <div>
                            <span class="text-slate-900">Nama</span>
                        </div>
                        <div class="px-2.5 outline-2 outline-slate-100 text-slate-200 rounded-lg flex justify-start items-center gap-x-0.5 focus-within:outline-2 focus-within:outline-slate-300 focus-within:text-slate-300">
                            <svg class="fill-current" width="20px" height="20px" viewBox="0 0 24 24" id="圖層_1" data-name="圖層 1" xmlns="http://www.w3.org/2000/svg"><title>profile</title><path d="M17.56,14.11a7.48,7.48,0,0,1-1.77-.82,9.46,9.46,0,0,0,1.64-2.68,1.25,1.25,0,0,0,.46-.45c.73-1.29.9-2.32.52-3.14a1.89,1.89,0,0,0-.51-.66,9.75,9.75,0,0,0-.29-2.18A5.5,5.5,0,0,0,12.08.43,5.5,5.5,0,0,0,6.56,4.18a9.64,9.64,0,0,0-.29,2.17A1.9,1.9,0,0,0,5.76,7c-.38.82-.21,1.85.52,3.15a1.24,1.24,0,0,0,.46.44,9.46,9.46,0,0,0,1.64,2.68,7.47,7.47,0,0,1-1.77.82c-2.36.75-5.53,2.33-5.77,7.42a1,1,0,0,0,.79,1,54.3,54.3,0,0,0,10.46.94,54.29,54.29,0,0,0,10.46-.94,1,1,0,0,0,.79-1C23.09,16.43,19.92,14.85,17.56,14.11ZM7.91,9A2.14,2.14,0,0,1,7.57,7.9a1,1,0,0,0,.71-1,8.2,8.2,0,0,1,.21-2.18,3.45,3.45,0,0,1,3.59-2.28,3.45,3.45,0,0,1,3.59,2.26,8.23,8.23,0,0,1,.22,2.19,1,1,0,0,0,.71,1A2.15,2.15,0,0,1,16.25,9a1.26,1.26,0,0,0-.63.72c-.21.72-1.68,3.54-3.54,3.54S8.75,10.42,8.54,9.7A1.25,1.25,0,0,0,7.91,9Zm4.17,12.5a56.68,56.68,0,0,1-9.17-.73c.43-3.09,2.31-4.11,4.3-4.74A9.22,9.22,0,0,0,10,14.63a4,4,0,0,0,4.25,0A9.22,9.22,0,0,0,17,16c2,.63,3.87,1.65,4.3,4.74A56.67,56.67,0,0,1,12.08,21.49Z"/></svg>
                            <input v-model="form.name" type="text" name="" id="" class="w-full border-0 focus:ring-0 text-slate-700 focus:text-slate-900" placeholder="Nama anda, S.Pd.">
                        </div>
                        <div class="text-red-500 text-xs italic">
                            <span v-if="err?.name">{{ err.name[0] }}</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-1 md:gap-y-0 md:gap-x-4">
                        <div class="grid grid-cols-1 gap-y-1">
                            <div>
                                <span class="text-slate-900">Email</span>
                            </div>
                            <div class="px-2.5 outline-2 outline-slate-100 text-slate-200 rounded-lg flex justify-start items-center gap-x-0.5 focus-within:outline-2 focus-within:outline-slate-300 focus-within:text-slate-300">
                                <svg class="fill-current" width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6zm3.519 0L12 11.671 18.481 6H5.52zM20 7.329l-7.341 6.424a1 1 0 0 1-1.318 0L4 7.329V18h16V7.329z" /></svg>
                                <input v-model="form.email" type="email" name="" id="" class="w-full border-0 focus:ring-0 text-slate-700 focus:text-slate-900" placeholder="EmailAnda@gmail.com">
                            </div>
                            <div class="text-red-500 text-xs italic">
                                <span v-if="err?.email">{{ err.email[0] }}</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-y-1">
                            <div>
                                <span class="text-slate-900">Phone (WhatsApp)</span>
                            </div>
                            <div class="px-2.5 outline-2 outline-slate-100 text-slate-500 rounded-lg flex justify-start items-center gap-x-0.5 focus-within:outline-2 focus-within:outline-slate-300 focus-within:text-slate-500">
                                <div>
                                    +62
                                </div>
                                <input v-model="form.phone" type="text" name="" id="" class="w-full border-0 focus:ring-0 text-slate-700 focus:text-slate-900" placeholder="8123456789">
                            </div>
                            <div class="text-red-500 text-xs italic">
                                <span v-if="err?.phone">{{ err.phone[0] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <GradientButton :type="'submit'" :disabled="loading" :class="'px-5 py-2 text-lg text-white rounded-full w-full flex justify-center items-center gap-x-1'">
                    <Save v-if="!loading" />
                    <PrimaryLoading v-else :size="20" :class="'stroke-white'" />
                    Update
                </GradientButton>
            </form>
        </section>

        <section class="my-5">
            <ChangePass />
        </section>

        <section class="w-full p-5 rounded-lg bg-white outline-1 outline-slate-50 shadow-lg">
            <div class="flex justify-between items-center">
                <div class="flex items-center justify-start">
                    <div class="p-2 rounded-sm bg-emerald-200">
                        <CircleCheckBig :size="30" class="text-emerald-500" />
                    </div>
                    <div class="mx-2.5 font-primary text-slate-900">
                        <p class="text-sm">Status verifikasi akun</p>
                        <p class="text-xs text-slate-500">Tervirikasi oleh sistem sejak {{ formatDate(user?.email_verified_at) }}</p>
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <div :class="user?.email_verified_at ? 'bg-emerald-100' : 'bg-red-100'" class="py-1 px-2 rounded-full flex items-center justify-center gap-x-1.5">
                        <div :class="user?.email_verified_at ? 'bg-emerald-500' : 'bg-red-100'" class="w-2 h-2 rounded-full" />
                        <h5 :class="user?.email_verified_at ? 'text-emerald-700' : 'text-red-700'" class="font-semibold uppercase text-sm">{{ user?.email_verified_at ? 'Terverifikasi' : 'Belum terverfikasi' }}</h5>
                    </div>
                </div>
            </div>
        </section>
        <LoadingImage v-if="uploading" />
        <!-- <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div
                    class="bg-white p-4 shadow-sm sm:rounded-lg sm:p-8"
                >
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div
                    class="bg-white p-4 shadow-sm sm:rounded-lg sm:p-8"
                >
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div
                    class="bg-white p-4 shadow-sm sm:rounded-lg sm:p-8"
                >
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div> -->
    </Auth>
</template>

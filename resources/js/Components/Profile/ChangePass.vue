<script setup>
import { UserKey, FileLock, Eye, EyeOff } from "lucide-vue-next";
import { ref } from "vue";
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';
import { eror, success } from "@/Helper.js/Toast";

const user = usePage().props?.auth?.user;
const currentpass = ref(false);
const newpass = ref(false);
const confirm = ref(false);
const form = ref({
    password: '',
    newPassword: '',
    confirm: ''
})
const err = ref({});
const loading = ref(false);
async function change() {
    try{
        loading.value = true;
        const response = await axios.patch(`/api/password/${user?.id}`, form.value);
        success('Password baru telah diterapkan.');
        err.value = {};
    }catch(error){
        if(error.response.status === 422){
            err.value = error?.response?.data?.errors;
        }else{
            eror(error?.response?.status, error?.response?.data?.message)
        }
    }finally{
        loading.value = false;
    }
}
</script>

<template>
    <section class="w-full p-5 rounded-lg bg-white outline-1 outline-slate-50 shadow-lg">
        <div class="flex items-center gap-x-2">
            <div class="p-2 rounded-lg bg-red-200">
                <UserKey :size="30" class="text-red-400" />
            </div>
            <div class="font-primary">
                <h1 class="font-semibold text-lg">Ubah Kata Sandi</h1>
                <p class="text-xs text-slate-500">Gunakan kata sandi yang kuat untuk keamanan akun anda.</p>
            </div>
        </div>
        <form action="" @submit.prevent="change" class="my-5">
            <div class="grid grid-cols-1 gap-5">
                <div>
                    <div class="grid grid-cols-1 gap-y-1">
                        <div>
                            <span class="text-slate-900">Password saat ini</span>
                        </div>
                        <div class="px-2.5 outline-2 outline-slate-100 text-slate-200 rounded-lg flex justify-start items-center gap-x-0.5 focus-within:outline-2 focus-within:outline-slate-300 focus-within:text-slate-300">
                            <FileLock :size="20" />
                            <input v-model="form.password" :type="currentpass ? 'text' : 'password'" name="" id="" class="w-full border-0 focus:ring-0 text-slate-700 focus:text-slate-900" placeholder="*****">
                            <button @click="currentpass = !currentpass" type="button" class="max-w-max">
                                <Eye v-if="!currentpass" :size="20" class="text-slate-300" />
                                <EyeOff v-else :size="20" class="text-slate-300" />
                            </button>
                        </div>
                        <div class="text-red-500 text-xs italic">
                            <span v-if="err?.password">{{ err?.password[0] }}</span>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="grid grid-cols-1 gap-y-1">
                        <div>
                            <span class="text-slate-900">Password baru</span>
                        </div>
                        <div class="px-2.5 outline-2 outline-slate-100 text-slate-200 rounded-lg flex justify-start items-center gap-x-0.5 focus-within:outline-2 focus-within:outline-slate-300 focus-within:text-slate-300">
                            <FileLock :size="20" />
                            <input v-model="form.newPassword" :type="newpass ? 'text' : 'password'" name="" id="" class="w-full border-0 focus:ring-0 text-slate-700 focus:text-slate-900" placeholder="*****">
                            <button @click="newpass = !newpass" type="button" class="max-w-max">
                                <Eye v-if="!newpass" :size="20" class="text-slate-300" />
                                <EyeOff v-else :size="20" class="text-slate-300" />
                            </button>
                        </div>
                        <div class="text-red-500 text-xs italic">
                            <span v-if="err?.newPassword">{{ err?.newPassword[0] }}</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-y-1">
                        <div>
                            <span class="text-slate-900">Konfirmasi password</span>
                        </div>
                        <div class="px-2.5 outline-2 outline-slate-100 text-slate-200 rounded-lg flex justify-start items-center gap-x-0.5 focus-within:outline-2 focus-within:outline-slate-300 focus-within:text-slate-300">
                            <FileLock :size="20" />
                            <input v-model="form.confirm" :type="confirm ? 'text' : 'password'" name="" id="" class="w-full border-0 focus:ring-0 text-slate-700 focus:text-slate-900" placeholder="*****">
                            <button @click="confirm = !confirm" type="button" class="max-w-max">
                                <Eye v-if="!confirm" :size="20" class="text-slate-300" />
                                <EyeOff v-else :size="20" class="text-slate-300" />
                            </button>
                        </div>
                        <div class="text-red-500 text-xs italic">
                            <span v-if="err?.confirm">{{ err?.confirm[0] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end my-3">
                <button type="submit" :disabled="loading" :class="loading ? 'opacity-50' : 'opacity-100 hover:bg-red-600 active:scale-95'" class="px-3.5 py-1.5 rounded-lg bg-red-500 text-white transition-all duration-300">Ubah Password</button>
            </div>
        </form>
    </section>
</template>

<style scoped>
input[type="password"]::-ms-reveal,
input[type="password"]::-ms-clear {
    opacity: 0;
    pointer-events: none;
}
</style>
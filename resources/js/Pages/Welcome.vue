<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import ShaderBackground from '@/Components/ShaderBackground.vue'
import HyperText from '@/Components/HyperText.vue';
import Card from '@/Components/Card.vue';
import { onMounted, ref } from 'vue';
import { useCounter } from '@/Helper.js/counter';
import InputAnimation from '@/Components/InputAnimation.vue';
import InputError from '@/Components/InputError.vue';
import ButtonRainbow from '@/Components/21Dev/ButtonRainbow.vue';
import { usePage } from '@inertiajs/vue3';
import GrowingShadow from '@/Components/21Dev/GrowingShadow.vue';
console.log(usePage().props.auth);

const page = usePage()?.props?.auth;
const student = useCounter();
const mapels = useCounter();
const tutor = useCounter();
const classes = useCounter();
const show = ref(false);

const showEmail = ref(false);
const showPassword = ref(false);
const showButton = ref(false);

function openForm() {
    show.value = true;

    setTimeout(() => {
        showEmail.value = true;
    }, 100);

    setTimeout(() => {
        showPassword.value = true;
    }, 300);

    setTimeout(() => {
        showButton.value = true;
    }, 500);
}
const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    pengajar: Number,
    mapel: Number,
    kelas: Number,
    siswa: Number,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('hidden!');
    document.getElementById('docs-card')?.classList.add('row-span-1!');
    document.getElementById('docs-card-content')?.classList.add('flex-row!');
    document.getElementById('background')?.classList.add('hidden!');
}
const titles = [
  "M", "o", "d", "e", "r", "n", " ",
  "E", "d", "u", "c", "a", "t", "i", "o", "n", " ",
  "M", "a", "n", "a", "g", "e", "m", "e", "n", "t", " ",
  "P", "l", "a", "t", "f", "o", "r", "m"
];
onMounted(()=>{
    student.start(props?.siswa);
    mapels.start(props?.mapel);
    tutor.start(props?.pengajar);
    classes.start(props.kelas);
});
</script>

<template>
    <Head title="Welcome" />
    <ShaderBackground />
    <div class="relative p-6 md:p-12 flex min-h-screen flex-col selection:bg-[#FF2D20] selection:text-white">
        <div class="p-3.5 grid grid-cols-1 lg:grid-cols-2 gap-5">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1">
                <div class="h-64 w-full">
                    <HyperText text="Welcome To" :duration="1200" :delay="0" class="text-6xl font-bold font-anonymous text-white" />
                    <HyperText text="Neutron" :duration="800" :delay="1200" class="text-4xl font-bold font-anonymous text-red-500" />
                    <HyperText text="Purbalingga" :duration="1000" :delay="2000" class="text-6xl font-bold font-anonymous text-white" />
                </div>
                <div class="hidden md:block">
                    <h1 data-aos="fade-up" v-for="(title, index) in titles" class="text-3xl text-white font-primary font-semibold inline-block min-w-2 hover:scale-120 duration-200">
                        {{ title }}
                    </h1>
                    <p data-aos="fade-down" class="py-2 text-white">Digitization of the entire academic process ranging from grade recording, attendance, <br> and course management to student and tutor administration <br> within a single, intuitive system.</p>
                </div>
            </div>
            <div class="w-full hidden lg:block">
                <div class="flex justify-center">
                    <GrowingShadow :image="'/assets/neutron.png'" />
                    <!-- <Card variant="backdrop-blur-sm p-4">
                        <img src="/assets/neutron.png" alt="Logo" class="w-48 md:w-72">
                    </Card> -->
                </div>
                <div class="flex justify-center mt-10">
                    <Card data-aos="zoom-out-down" data-aos-delay="0" :variant="'backdrop-blur-sm text-white max-w-max mx-auto p-2'">
                        <span class="block mb-0.5 text-center text-sm text-red-500">{{ student.count }}</span>
                        <span class="text-xs">Students</span>
                    </Card>
                    <Card data-aos="zoom-out-down" data-aos-delay="300" :variant="'backdrop-blur-sm text-white max-w-max mx-auto p-2'">
                        <span class="block mb-0.5 text-center text-sm text-yellow-500">{{ mapels.count }}</span>
                        <span class="text-xs">Mapels</span>
                    </Card>
                    <Card data-aos="zoom-out-down" data-aos-delay="600" :variant="'backdrop-blur-sm text-white max-w-max mx-auto p-2'">
                        <span class="block mb-0.5 text-center text-sm text-emerald-500">{{ tutor.count }}</span>
                        <span class="text-xs">Tutors</span>
                    </Card>
                    <Card data-aos="zoom-out-down" data-aos-delay="900" :variant="'backdrop-blur-sm text-white max-w-max mx-auto p-2'">
                        <span class="block mb-0.5 text-center text-sm text-sky-500">{{ classes.count }}</span>
                        <span class="text-xs">Classes</span>
                    </Card>
                </div>
            </div>
        </div>
        <section class="my-5">
            <p class="text-center py-2 text-white md:hidden">Digitization of the entire academic process ranging from grade recording, attendance, <br> and course management to student and tutor administration <br> within a single, intuitive system.</p>
            <div class="flex justify-center">
                <template v-if="page?.user">
                    <Link
                        :href="route(`${page?.home}`)"
                        class="rounded-md px-3 py-2 text-white bg-blue-500 ring-1 ring-transparent transition hover:bg-blue-600 focus:outline-hidden focus-visible:ring-[#FF2D20]"
                    >
                        Dashboard
                    </Link>
                </template>
                <template v-else>
                    <Transition name="rocket">
                        <ButtonRainbow v-if="!show" @click="openForm" type="button" class="rainbow-border p-0.5 relative overflow-hidden hover:scale-105 active:scale-95 transition-all duration-300 shadow-lg hover:shadow-pink-500/30">
                            <div class="bg-red-500 px-10 py-1.5 rounded-xl text-black font-primary font-semibold hover:text-white flex items-center gap-x-2.5">
                                <span>Go</span>
                                <svg class="fill-current" width="15px" height="15px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1"><path d="M22.60107,2.062a1.00088,1.00088,0,0,0-.71289-.71289A11.25224,11.25224,0,0,0,10.46924,4.97217L9.35431,6.296l-2.6048-.62848A2.77733,2.77733,0,0,0,3.36279,7.0249L1.1626,10.9248A.99989.99989,0,0,0,1.82422,12.394l3.07275.65869a13.41952,13.41952,0,0,0-.55517,2.43409,1.00031,1.00031,0,0,0,.28466.83642l3.1001,3.1001a.99941.99941,0,0,0,.707.293c.02881,0,.05762-.00147.08692-.00391a12.16892,12.16892,0,0,0,2.49157-.49l.64368,3.00318a1.0003,1.0003,0,0,0,1.46924.66162l3.90527-2.20264a3.03526,3.03526,0,0,0,1.375-3.30371l-.6687-2.759,1.23706-1.13751A11.20387,11.20387,0,0,0,22.60107,2.062ZM3.57227,10.72314,5.12842,7.96338a.82552.82552,0,0,1,1.06982-.37549l1.71741.4162-.65.77179A13.09523,13.09523,0,0,0,5.67633,11.174Zm12.47021,8.22217L13.32666,20.477l-.4295-2.00464a11.33992,11.33992,0,0,0,2.41339-1.61987l.74353-.68366.40344,1.66462A1.041,1.041,0,0,1,16.04248,18.94531ZM17.65674,11.98l-3.68457,3.38623a9.77348,9.77348,0,0,1-5.17041,2.3042l-2.4043-2.4043a10.932,10.932,0,0,1,2.40088-5.206l1.67834-1.99268a.9635.9635,0,0,0,.07813-.09277L11.98975,6.271a9.27757,9.27757,0,0,1,8.80957-3.12012A9.21808,9.21808,0,0,1,17.65674,11.98Zm-.923-6.16376a1.5,1.5,0,1,0,1.5,1.5A1.49992,1.49992,0,0,0,16.7337,5.81622Z"/></svg>
                            </div>
                        </ButtonRainbow>
                    </Transition>
                </template>
            </div>
            <form v-if="show" @submit.prevent="submit" class="my-2.5 max-w-max mx-auto">
                <Transition name="item">
                    <div v-if="showEmail" class="mb-3">
                        <InputAnimation
                            v-model="form.email"
                            label="Email"
                            placeholder="Email"
                            class="mb-6 max-w-sm"
                            type="email"
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>
                </Transition>
                <Transition name="item">
                    <div v-if="showPassword">
                        <InputAnimation
                            v-model="form.password"
                            label="Password"
                            placeholder="*****"
                            class="mb-6 max-w-sm"
                            type="password"
                        />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>
                </Transition>
                <Transition name="item">
                    <button v-if="showButton" type="submit" :disabled="form.processing" :class="form.processing ? 'opacity-50' :'opacity-100'" class="w-full bg-red-500 hover:bg-red-600 focus:scale-90 transition-all duration-300 py-2 rounded-lg text-center text-white font-anonymous">Sign In</button>
                </Transition>
            </form>
        </section>
        
        <footer class="fixed bottom-3.5 text-slate-200 text-center text-xs">
            2026 A site by Fajar Setiawan
        </footer>
    </div>
</template>

<style scoped>
.rocket-leave-active {
    transition: all .5s ease;
}

.rocket-leave-to {
    transform: translateY(-250px) scale(.4);
    opacity: 0;
}

.item-enter-active {
    transition: all .4s ease;
}

.item-enter-from {
    opacity: 0;
    transform: translateY(20px);
}

.item-enter-to {
    opacity: 1;
    transform: translateY(0);
}
</style>